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

class AdminCustomerPreferencesControllerCore extends AdminController
{
	public function __construct()
	{
		$this->className = 'Configuration';
		$this->table = 'configuration';

		parent::__construct();

		$registration_process_type = array(
			array(
				'value' => PS_REGISTRATION_PROCESS_STANDARD,
				'name' => $this->l('Only account creation')
			),
			array(
				'value' => PS_REGISTRATION_PROCESS_AIO,
				'name' => $this->l('Standard (account creation and address creation)')
			)
		);

		$this->fields_options = array(
			'general' => array(
				'title' =>	$this->l('General'),
				'icon' =>	'tab-preferences',
				'fields' =>	array(
					'PS_REGISTRATION_PROCESS_TYPE' => array(
						'title' => $this->l('Registration process type'),
						'desc' => $this->l('The "Only account creation" registration option allows the customer to register faster, and create his address later.'),
						'validation' => 'isInt',
						'cast' => 'intval',
						'type' => 'select',
						'list' => $registration_process_type,
						'identifier' => 'value'
					),
					'PS_CART_FOLLOWING' => array(
						'title' => $this->l('Cart re-display at login'),
						'desc' => $this->l('After customer logs in, recall and display contents of his/her last shopping cart'),
						'validation' => 'isBool',
						'cast' => 'intval',
						'type' => 'bool'
					),
					'PS_PASSWD_TIME_FRONT' => array(
						'title' => $this->l('Regenerate password'),
						'desc' => $this->l('Security minimum time to wait to regenerate the password'),
						'validation' => 'isUnsignedInt',
						'cast' => 'intval',
						'size' => 5,
						'type' => 'text',
						'suffix' => $this->l('minutes')
					),
					'PS_B2B_ENABLE' => array(
						'title' => $this->l('Enable B2B mode'),
						'desc' => $this->l('Activate or deactivate B2B mode. When this option is enabled, some B2B features are available.'),
						'validation' => 'isBool',
						'cast' => 'intval',
						'type' => 'bool'
					),
				),
				'submit' => array('title' => $this->l('Save'), 'class' => 'button'),
			),
		);
	}

	/**
	 * Update PS_B2B_ENABLE and enables / disables the associated tabs
	 * @param $value integer Value of option
	 */
	public function updateOptionPsB2bEnable($value)
	{
		$value = (int)$value;

		$tabs_class_name = array('AdminOutstanding');
		if (!empty($tabs_class_name))
		{
			foreach ($tabs_class_name as $tab_class_name)
			{
				$tab = Tab::getInstanceFromClassName($tab_class_name);
				if (Validate::isLoadedObject($tab))
				{
					$tab->active = $value;
					$tab->save();
				}
			}
		}
		Configuration::updateValue('PS_B2B_ENABLE', $value);
	}
}
