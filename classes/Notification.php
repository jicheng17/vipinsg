<?php
/*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class NotificationCore
{
	public $types;

	public function __construct()
	{
		$this->types = array('order', 'customer_message', 'customer');
	}

	/**
	 * getLastElements return all the notifications (new order, new customer registration, and new customer message)
	 * Get all the notifications
	 *
	 * @return array containing the notifications
	 */
	public function getLastElements()
	{
		global $cookie;

		$notifications = array();
		$employee_infos = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
				SELECT id_last_order, id_last_customer_message, id_last_customer
				FROM `'._DB_PREFIX_.'employee`
				WHERE `id_employee` = '.(int)$cookie->id_employee);

		foreach ($this->types as $type)
			$notifications[$type] = Notification::getLastElementsIdsByType($type, $employee_infos['id_last_'.$type]);

		return $notifications;
	}

	public function installDb()
	{
		Db::getInstance(_PS_USE_SQL_SLAVE_)->execute('ALTER TABLE `'._DB_PREFIX_.'employee`
						ADD `id_last_order` INT(10) unsigned NOT NULL default "0"
						ADD `id_last_customer_message` INT(10) unsigned NOT NULL default "0"
						ADD `id_last_message` INT(10) unsigned NOT NULL default "0"');
	}

	/**
	 * getLastElementsIdsByType return all the element ids to show (order, customer registration, and customer message)
	 * Get all the element ids
	 *
	 * @param string $type contains the field name of the Employee table
	 * @param integer $id_last_element contains the id of the last seen element
	 * @return array containing the notifications
	 */
	public static function getLastElementsIdsByType($type, $id_last_element)
	{
		switch ($type)
		{
			case 'order':
				$sql = '
					SELECT o.`id_order`, o.`id_customer`, o.`total_paid`, o.`id_currency`, c.`firstname`, c.`lastname`
					FROM `'._DB_PREFIX_.'orders` as o
					LEFT JOIN `'._DB_PREFIX_.'customer` as c ON (c.`id_customer` = o.`id_customer`)
					WHERE `id_order` > '.(int)$id_last_element.
					Shop::addSqlRestriction(false, 'o').'
					ORDER BY `id_order` DESC
				';
				break;

			case 'customer_message':
				$sql = '
					SELECT c.`id_customer_message`, ct.`id_customer`, ct.`id_customer_thread`, ct.`email`
					FROM `'._DB_PREFIX_.'customer_message` as c
					LEFT JOIN `'._DB_PREFIX_.'customer_thread` as ct ON (c.`id_customer_thread` = ct.`id_customer_thread`)
					WHERE c.`id_customer_message` > '.(int)$id_last_element.'
						AND c.`id_employee` = 0
						AND ct.id_shop IN ('.implode(', ', Shop::getContextListShopID()).')
					ORDER BY c.`id_customer_message` DESC
				';
				break;
			default:
				$sql = '
					SELECT t.`id_'.bqSQL($type).'`, t.*
					FROM `'._DB_PREFIX_.bqSQL($type).'` t
					WHERE t.`deleted` = 0 AND t.`id_'.bqSQL($type).'` > '.(int)$id_last_element.
					Shop::addSqlRestriction(false, 't').'
					ORDER BY t.`id_'.bqSQL($type).'` DESC
				';
				break;
		}

		$json = array();
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

		foreach ($result as $value)
		{
			$customer_name = '';
			if (isset($value['firstname']) && isset($value['lastname']))
				$customer_name = Tools::safeOutput($value['firstname'].' '.$value['lastname']);
			else if (isset($value['email']))
				$customer_name = Tools::safeOutput($value['email']);
			
			$json[] = array(
				'id_order' => ((!empty($value['id_order'])) ? (int)$value['id_order'] : 0),
				'id_customer' => ((!empty($value['id_customer'])) ? (int)$value['id_customer'] : 0),
				'id_customer_message' => ((!empty($value['id_customer_message'])) ? (int)$value['id_customer_message'] : 0),
				'id_customer_thread' => ((!empty($value['id_customer_thread'])) ? (int)$value['id_customer_thread'] : 0),
				'total_paid' => ((!empty($value['total_paid'])) ? Tools::displayPrice((float)$value['total_paid'], (int)$value['id_currency'], false) : 0),
				'customer_name' => $customer_name
			);
		}

		return $json;
	}

	/**
	 * updateEmployeeLastElement return 0 if the field doesn't exists in Employee table.
	 * Updates the last seen element by the employee
	 *
	 * @param string $type contains the field name of the Employee table
	 * @return boolean if type exists or not
	 */
	public function updateEmployeeLastElement($type)
	{
		global $cookie;

		if (in_array($type, $this->types))
			// We update the last item viewed
			return Db::getInstance()->execute('
					UPDATE `'._DB_PREFIX_.'employee`
					SET `id_last_'.bqSQL($type).'` = (
						SELECT MAX(`id_'.$type.'`)
						FROM `'._DB_PREFIX_.(($type == 'order') ? bqSQL($type).'s' : bqSQL($type)).'`
					)
					WHERE `id_employee` = '.(int)$cookie->id_employee);
		else
			return false;
	}
}
