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

class AdminDeliverySlipControllerCore extends AdminController
{
	public function __construct()
	{
	 	$this->table = 'delivery';

		$this->context = Context::getContext();

		$this->fields_options = array(
			'general' => array(
				'title' =>	$this->l('Delivery slip options'),
				'fields' =>	array(
					'PS_DELIVERY_PREFIX' => array(
						'title' => $this->l('Delivery prefix:'),
						'desc' => $this->l('Prefix used for delivery slips'),
						'size' => 6,
						'type' => 'textLang'
					),
					'PS_DELIVERY_NUMBER' => array(
						'title' => $this->l('Delivery number:'),
						'desc' => $this->l('The next delivery slip will begin with this number, and then increase with each additional slip'),
						'size' => 6,
						'cast' => 'intval',
						'type' => 'text'
					)
				),
				'submit' => array()
			)
		);

		parent::__construct();
	}

	public function renderForm()
	{
		$this->fields_form = array(
			'legend' => array(
				'title' => $this->l('Print PDF delivery slips'),
				'image' => '../img/admin/AdminPdf.gif'
			),
			'input' => array(
				array(
					'type' => 'date',
					'label' => $this->l('From:'),
					'name' => 'date_from',
					'size' => 20,
					'maxlength' => 10,
					'required' => true,
					'desc' => $this->l('Format: 2011-12-31 (inclusive)')
				),
				array(
					'type' => 'date',
					'label' => $this->l('To:'),
					'name' => 'date_to',
					'size' => 20,
					'maxlength' => 10,
					'required' => true,
					'desc' => $this->l('Format: 2012-12-31 (inclusive)')
				)
			),
			'submit' => array(
				'title' => $this->l('Generate PDF file'),
				'class' => 'button'
			)
		);

		$this->fields_value = array(
			'date_from' => date('Y-m-d'),
			'date_to' => date('Y-m-d')
		);

		return parent::renderForm();
	}

	public function postProcess()
	{
		if (Tools::isSubmit('submitAdddelivery'))
		{
			if (!Validate::isDate(Tools::getValue('date_from')))
				$this->errors[] = Tools::displayError('Invalid \'from\' date');
			if (!Validate::isDate(Tools::getValue('date_to')))
				$this->errors[] = Tools::displayError('Invalid \'to\' date');
			if (!count($this->errors))
			{
				if (count(OrderInvoice::getByDeliveryDateInterval(Tools::getValue('date_from'), Tools::getValue('date_to'))))
					Tools::redirectAdmin($this->context->link->getAdminLink('AdminPdf').'&submitAction=generateDeliverySlipsPDF&date_from='.urlencode(Tools::getValue('date_from')).'&date_to='.urlencode(Tools::getValue('date_to')));
				else
					$this->errors[] = Tools::displayError('No delivery slip found for this period');
			}
		}
		else
			parent::postProcess();
	}

	public function initContent()
	{
		$this->content .= $this->renderForm().'<br />';
		$this->show_toolbar = false;
		$this->content .= $this->renderOptions();

		$this->context->smarty->assign(array(
			'content' => $this->content,
			'url_post' => self::$currentIndex.'&token='.$this->token,
		));
	}
}


