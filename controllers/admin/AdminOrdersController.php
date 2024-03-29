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

class AdminOrdersControllerCore extends AdminController
{
	public $toolbar_title;

	public function __construct()
	{
		$this->table = 'order';
		$this->className = 'Order';
		$this->lang = false;
		$this->addRowAction('view');

		$this->deleted = false;
		$this->context = Context::getContext();

		$this->_select = '
		a.id_order AS id_pdf,
		CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) AS `customer`,
		osl.`name` AS `osname`,
		os.`color`,
		IF((SELECT COUNT(so.id_order) FROM `'._DB_PREFIX_.'orders` so WHERE so.id_customer = a.id_customer) > 1, 0, 1) as new';

		$this->_join = '
		LEFT JOIN `'._DB_PREFIX_.'customer` c ON (c.`id_customer` = a.`id_customer`)
		LEFT JOIN `'._DB_PREFIX_.'order_history` oh ON (oh.`id_order` = a.`id_order`)
		LEFT JOIN `'._DB_PREFIX_.'order_state` os ON (os.`id_order_state` = oh.`id_order_state`)
		LEFT JOIN `'._DB_PREFIX_.'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = '.(int)$this->context->language->id.')';
		$this->_where = 'AND oh.`id_order_history` = (SELECT MAX(`id_order_history`) FROM `'._DB_PREFIX_.'order_history` moh WHERE moh.`id_order` = a.`id_order` GROUP BY moh.`id_order`)';
		$this->_orderBy = 'id_order';
		$this->_orderWay = 'DESC';

		$statuses_array = array();
		$statuses = OrderState::getOrderStates((int)$this->context->language->id);

		foreach ($statuses as $status)
			$statuses_array[$status['id_order_state']] = $status['name'];

		$this->fields_list = array(
		'id_order' => array(
			'title' => $this->l('ID'),
			'align' => 'center',
			'width' => 25
		),
		'reference' => array(
			'title' => $this->l('Reference'),
			'align' => 'center',
			'width' => 65
		),
		'new' => array(
			'title' => $this->l('New'),
			'width' => 25,
			'align' => 'center',
			'type' => 'bool',
			'filter_key' => 'new',
			'tmpTableFilter' => true,
			'icon' => array(
				0 => 'blank.gif',
				1 => array(
					'src' => 'note.png',
					'alt' => $this->l('First customer order'),
				)
			),
			'orderby' => false
		),
		'customer' => array(
			'title' => $this->l('Customer'),
			'filter_key' => 'customer',
			'tmpTableFilter' => true
		),
		'total_paid_tax_incl' => array(
			'title' => $this->l('Total'),
			'width' => 70,
			'align' => 'right',
			'prefix' => '<b>',
			'suffix' => '</b>',
			'type' => 'price',
			'currency' => true
		),
		'payment' => array(
			'title' => $this->l('Payment'),
			'width' => 100
		),
		'osname' => array(
			'title' => $this->l('Status'),
			'color' => 'color',
			'width' => 280,
			'type' => 'select',
			'list' => $statuses_array,
			'filter_key' => 'os!id_order_state',
			'filter_type' => 'int'
		),
		'date_add' => array(
			'title' => $this->l('Date'),
			'width' => 130,
			'align' => 'right',
			'type' => 'datetime',
			'filter_key' => 'a!date_add'
		),
		'id_pdf' => array(
			'title' => $this->l('PDF'),
			'width' => 35,
			'align' => 'center',
			'callback' => 'printPDFIcons',
			'orderby' => false,
			'search' => false,
			'remove_onclick' => true)
		);

		$this->shopLinkType = 'shop';
		$this->shopShareDatas = Shop::SHARE_ORDER;

		if (Tools::isSubmit('id_order'))
		{
			// Save context (in order to apply cart rule)
			$order = new Order((int)Tools::getValue('id_order'));
			if (!Validate::isLoadedObject($order))
				throw new PrestaShopException('Cannot load Order object');
			$this->context->cart = new Cart($order->id_cart);
			$this->context->customer = new Customer($order->id_customer);
		}

		parent::__construct();
	}

	public function renderForm()
	{
		if (Context::getContext()->shop->getContext() != Shop::CONTEXT_SHOP && Shop::isFeatureActive())
			$this->errors[] = $this->l('You have to select a shop in order to create new orders.');

		$id_cart = (int)Tools::getValue('id_cart');
		$cart = new Cart((int)$id_cart);
		if ($id_cart && !Validate::isLoadedObject($cart))
			$this->errors[] = $this->l('This cart does not exists');
		if ($id_cart && Validate::isLoadedObject($cart) && !$cart->id_customer)
			$this->errors[] = $this->l('The cart must have a customer');
		if (count($this->errors))
			return false;

		parent::renderForm();
		unset($this->toolbar_btn['save']);
		$this->addJqueryPlugin(array('autocomplete', 'fancybox', 'typewatch'));

		$defaults_order_state = array('cheque' => (int)Configuration::get('PS_OS_CHEQUE'),
												'bankwire' => (int)Configuration::get('PS_OS_BANKWIRE'),
												'cashondelivery' => (int)Configuration::get('PS_OS_PREPARATION'),
												'other' => (int)Configuration::get('PS_OS_PAYMENT'));
		$this->context->smarty->assign(array(
			'recyclable_pack' => (int)Configuration::get('PS_RECYCLABLE_PACK'),
			'gift_wrapping' => (int)Configuration::get('PS_GIFT_WRAPPING'),
			'cart' => $cart,
			'currencies' => Currency::getCurrencies(),
			'langs' => Language::getLanguages(true, Context::getContext()->shop->id),
			'payment_modules' => PaymentModule::getInstalledPaymentModules(),
			'order_states' => OrderState::getOrderStates((int)Context::getContext()->language->id),
			'defaults_order_state' => $defaults_order_state,
			'show_toolbar' => $this->show_toolbar,
			'toolbar_btn' => $this->toolbar_btn,
			'toolbar_scroll' => $this->toolbar_scroll,
			'title' => array($this->l('Orders'), $this->l('create order'))
		));
		$this->content .= $this->createTemplate('form.tpl')->fetch();
	}

	public function initToolbar()
	{
		if ($this->display == 'view')
		{
			$order = new Order((int)Tools::getValue('id_order'));
			if ($order->hasBeenDelivered())
				$type = $this->l('Return products');
			elseif ($order->hasBeenPaid())
				$type = $this->l('Standard refund');
			else
				$type = $this->l('Cancel products');

			if (!$order->hasBeenDelivered())
				$this->toolbar_btn['new'] = array(
					'short' => 'Create',
					'href' => '#',
					'desc' => $this->l('Add a product'),
					'class' => 'add_product'
				);

			if (Configuration::get('PS_ORDER_RETURN'))
				$this->toolbar_btn['standard_refund'] = array(
					'short' => 'Create',
					'href' => '',
					'desc' => $type,
					'class' => 'process-icon-standardRefund'
				);
			
			if ($order->hasInvoice())
				$this->toolbar_btn['partial_refund'] = array(
					'short' => 'Create',
					'href' => '',
					'desc' => $this->l('Partial refund'),
					'class' => 'process-icon-partialRefund'
				);
		}
		$res = parent::initToolbar();
		if (Context::getContext()->shop->getContext() != Shop::CONTEXT_SHOP && isset($this->toolbar_btn['new']) && Shop::isFeatureActive())
			unset($this->toolbar_btn['new']);
		return $res;
	}

	public function setMedia()
	{
		parent::setMedia();
		$this->addJqueryUI('ui.datepicker');
		if ($this->tabAccess['edit'] == 1 && $this->display == 'view')
		{
			$this->addJS(_PS_JS_DIR_.'admin_order.js');
			$this->addJS(_PS_JS_DIR_.'tools.js');
			$this->addJqueryPlugin('autocomplete');
		}
	}

	public function printPDFIcons($id_order, $tr)
	{
		$order = new Order($id_order);
		$order_state = $order->getCurrentOrderState();
		if (!Validate::isLoadedObject($order_state) || !Validate::isLoadedObject($order))
			return '';

		$this->context->smarty->assign(array(
			'order' => $order,
			'order_state' => $order_state,
			'tr' => $tr
		));

		return $this->createTemplate('_print_pdf_icon.tpl')->fetch();
	}

	public function postProcess()
	{
		// If id_order is sent, we instanciate a new Order object
		if (Tools::isSubmit('id_order') && Tools::getValue('id_order') > 0)
		{
			$order = new Order(Tools::getValue('id_order'));
			if (!Validate::isLoadedObject($order))
				throw new PrestaShopException('Can\'t load Order object');
		}

		/* Update shipping number */
		if (Tools::isSubmit('submitShippingNumber') && isset($order))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				$order_carrier = new OrderCarrier(Tools::getValue('id_order_carrier'));
				if (!Validate::isLoadedObject($order_carrier))
					$this->errors[] = Tools::displayError('Order carrier ID is invalid');
				elseif (!Validate::isTrackingNumber(Tools::getValue('tracking_number')))
					$this->errors[] = Tools::displayError('Tracking number is incorrect');
				else
				{
					// update shipping number
					// Keep these two following lines for backward compatibility, remove on 1.6 version
					$order->shipping_number = Tools::getValue('tracking_number');
					$order->update();

					// Update order_carrier
					$order_carrier->tracking_number = pSQL(Tools::getValue('tracking_number'));
					if ($order_carrier->update())
					{
						// Send mail to customer
						$customer = new Customer((int)$order->id_customer);
						$carrier = new Carrier((int)$order->id_carrier, $order->id_lang);
						if (!Validate::isLoadedObject($customer))
							throw new PrestaShopException('Can\'t load Customer object');
						if (!Validate::isLoadedObject($carrier))
							throw new PrestaShopException('Can\'t load Carrier object');
						$templateVars = array(
							'{followup}' => str_replace('@', $order->shipping_number, $carrier->url),
							'{firstname}' => $customer->firstname,
							'{lastname}' => $customer->lastname,
							'{id_order}' => $order->id,
							'{order_name}' => $order->getUniqReference()
						);
						if (@Mail::Send((int)$order->id_lang, 'in_transit', Mail::l('Package in transit', (int)$order->id_lang), $templateVars,
							$customer->email, $customer->firstname.' '.$customer->lastname, null, null, null, null,
							_PS_MAIL_DIR_, true, (int)$order->id_shop))
						{
							Hook::exec('actionAdminOrdersTrackingNumberUpdate', array('order' => $order));
							Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=4&token='.$this->token);
						}
						else
							$this->errors[] = Tools::displayError('An error occurred while sending e-mail to the customer.');
					}
					else
						$this->errors[] = Tools::displayError('Order carrier can\'t be updated');
				}
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to edit here.');
		}

		/* Change order state, add a new entry in order history and send an e-mail to the customer if needed */
		elseif (Tools::isSubmit('submitState') && isset($order))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				$order_state = new OrderState(Tools::getValue('id_order_state'));

				if (!Validate::isLoadedObject($order_state))
					$this->errors[] = Tools::displayError('Invalid new order status');
				else
				{
					$current_order_state = $order->getCurrentOrderState();
					if ($current_order_state->id != $order_state->id)
					{
						// Create new OrderHistory
						$history = new OrderHistory();
						$history->id_order = $order->id;
						$history->id_employee = (int)$this->context->employee->id;

						$use_existings_payment = false;
						if (!$order->hasInvoice())
							$use_existings_payment = true;
						$history->changeIdOrderState($order_state->id, $order->id, $use_existings_payment);

						$carrier = new Carrier($order->id_carrier, $order->id_lang);
						$templateVars = array();
						if ($history->id_order_state == Configuration::get('PS_OS_SHIPPING') && $order->shipping_number)
							$templateVars = array('{followup}' => str_replace('@', $order->shipping_number, $carrier->url));
						// Save all changes
						if ($history->addWithemail(true, $templateVars))
						{
							// synchronizes quantities if needed..
							if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT'))
							{
								foreach ($order->getProducts() as $product)
								{
									if (StockAvailable::dependsOnStock($product['product_id']))
										StockAvailable::synchronize($product['product_id'], (int)$product['id_shop']);
								}
							}

							Tools::redirectAdmin(self::$currentIndex.'&id_order='.(int)$order->id.'&vieworder&token='.$this->token);
						}
						$this->errors[] = Tools::displayError('An error occurred while changing the status or was unable to send e-mail to the customer.');
					}
					else
						$this->errors[] = Tools::displayError('This order is already assigned this status');
				}
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to edit here.');
		}

		/* Add a new message for the current order and send an e-mail to the customer if needed */
		elseif (Tools::isSubmit('submitMessage') && isset($order))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				$customer = new Customer(Tools::getValue('id_customer'));
				if (!Validate::isLoadedObject($customer))
					$this->errors[] = Tools::displayError('Customer is invalid');
				elseif (!Tools::getValue('message'))
					$this->errors[] = Tools::displayError('Message cannot be blank');
				else
				{
					/* Get message rules and and check fields validity */
					$rules = call_user_func(array('Message', 'getValidationRules'), 'Message');
					foreach ($rules['required'] as $field)
						if (($value = Tools::getValue($field)) == false && (string)$value != '0')
							if (!Tools::getValue('id_'.$this->table) || $field != 'passwd')
								$this->errors[] = sprintf(Tools::displayError('field %s is required.'), $field);
					foreach ($rules['size'] as $field => $maxLength)
						if (Tools::getValue($field) && Tools::strlen(Tools::getValue($field)) > $maxLength)
							$this->errors[] = sprintf(Tools::displayError('field %1$s is too long (%2$d chars max).'), $field, $maxLength);
					foreach ($rules['validate'] as $field => $function)
						if (Tools::getValue($field))
							if (!Validate::$function(htmlentities(Tools::getValue($field), ENT_COMPAT, 'UTF-8')))
								$this->errors[] = sprintf(Tools::displayError('field %s is invalid.'), $field);

					if (!count($this->errors))
					{
						//check if a thread already exist
						$id_customer_thread = CustomerThread::getIdCustomerThreadByEmailAndIdOrder($customer->email, $order->id);
						if (!$id_customer_thread)
						{
							$customer_thread = new CustomerThread();
							$customer_thread->id_contact = 0;
							$customer_thread->id_customer = (int)$order->id_customer;
							$customer_thread->id_shop = (int)$this->context->shop->id;
							$customer_thread->id_order = (int)$order->id;
							$customer_thread->id_lang = (int)$this->context->language->id;
							$customer_thread->email = $customer->email;
							$customer_thread->status = 'open';
							$customer_thread->token = Tools::passwdGen(12);
							$customer_thread->add();
						}
						else
							$customer_thread = new CustomerThread((int)$id_customer_thread);

						$customer_message = new CustomerMessage();
						$customer_message->id_customer_thread = $customer_thread->id;
						$customer_message->id_employee = (int)$this->context->employee->id;
						$customer_message->message = htmlentities(Tools::getValue('message'), ENT_COMPAT, 'UTF-8');
						$customer_message->private = Tools::getValue('visibility');

						if (!$customer_message->add())
							$this->errors[] = Tools::displayError('An error occurred while saving message');
						elseif ($customer_message->private)
							Tools::redirectAdmin(self::$currentIndex.'&id_order='.(int)$order->id.'&vieworder&conf=11&token='.$this->token);
						else
						{
							$message = $customer_message->message;
							if (Configuration::get('PS_MAIL_TYPE') != Mail::TYPE_TEXT)
								$message = Tools::nl2br($customer_message->message);

							$varsTpl = array(
								'{lastname}' => $customer->lastname,
								'{firstname}' => $customer->firstname,
								'{id_order}' => $order->id,
								'{order_name}' => $order->getUniqReference(),
								'{message}' => $message
							);
							if (@Mail::Send((int)$order->id_lang, 'order_merchant_comment',
								Mail::l('New message regarding your order', (int)$order->id_lang), $varsTpl, $customer->email,
								$customer->firstname.' '.$customer->lastname, null, null, null, null, _PS_MAIL_DIR_, true, (int)$order->id_shop))
								Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=11'.'&token='.$this->token);
						}
						$this->errors[] = Tools::displayError('An error occurred while sending e-mail to the customer.');
					}
				}
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to delete here.');
		}

		/* Partial refund from order */
		elseif (Tools::isSubmit('partialRefund') && isset($order))
		{
			if ($this->tabAccess['edit'] == '1')
			{
				if (is_array($_POST['partialRefundProduct']))
				{
					$amount = 0;
					$order_detail_list = array();
					foreach ($_POST['partialRefundProduct'] as $id_order_detail => $amount_detail)
					{
						$order_detail_list[$id_order_detail]['quantity'] = (int)$_POST['partialRefundProductQuantity'][$id_order_detail];

						if (empty($amount_detail))
						{
							$order_detail = new OrderDetail((int)$id_order_detail);
							$order_detail_list[$id_order_detail]['amount'] = $order_detail->unit_price_tax_incl * $order_detail_list[$id_order_detail]['quantity'];
						}
						else
							$order_detail_list[$id_order_detail]['amount'] = (float)$amount_detail;

						$amount += $order_detail_list[$id_order_detail]['amount'];
					}

					$shipping_cost_amount = (float)str_replace(',', '.', Tools::getValue('partialRefundShippingCost'));
					if ($shipping_cost_amount > 0)
						$amount += $shipping_cost_amount;

					if ($amount > 0)
					{
						if (!OrderSlip::createPartialOrderSlip($order, $amount, $shipping_cost_amount, $order_detail_list))
							$this->errors[] = Tools::displayError('Cannot generate partial credit slip');

						// Generate voucher
						if (Tools::isSubmit('generateDiscountRefund') && !count($this->errors))
						{
							$cart_rule = new CartRule();
							$cart_rule->description = sprintf($this->l('Credit Slip for order #%d'), $order->id);
							$languages = Language::getLanguages(false);
							foreach ($languages as $language)
								// Define a temporary name
								$cart_rule->name[$language['id_lang']] = sprintf('V0C%1$dO%2$d', $order->id_customer, $order->id);

							// Define a temporary code
							$cart_rule->code = sprintf('V0C%1$dO%2$d', $order->id_customer, $order->id);
							$cart_rule->quantity = 1;
							$cart_rule->quantity_per_user = 1;

							// Specific to the customer
							$cart_rule->id_customer = $order->id_customer;
							$now = time();
							$cart_rule->date_from = date('Y-m-d H:i:s', $now);
							$cart_rule->date_to = date('Y-m-d H:i:s', $now + (3600 * 24 * 365.25)); /* 1 year */
							$cart_rule->active = 1;

							$cart_rule->reduction_amount = $amount;
							$cart_rule->reduction_tax = true;
							$cart_rule->minimum_amount_currency = $order->id_currency;
							$cart_rule->reduction_currency = $order->id_currency;

							if (!$cart_rule->add())
								$this->errors[] = Tools::displayError('Cannot generate voucher');
							else
							{
								// Update the voucher code and name
								foreach ($languages as $language)
									$cart_rule->name[$language['id_lang']] = sprintf('V%1$dC%2$dO%3$d', $cart_rule->id, $order->id_customer, $order->id);
								$cart_rule->code = sprintf('V%1$dC%2$dO%3$d', $cart_rule->id, $order->id_customer, $order->id);

								if (!$cart_rule->update())
									$this->errors[] = Tools::displayError('Cannot generate voucher');
								else
								{
									$currency = $this->context->currency;
									$params['{voucher_amount}'] = Tools::displayPrice($cart_rule->reduction_amount, $currency, false);
									$params['{voucher_num}'] = $cart_rule->code;
									$customer = new Customer((int)$order->id_customer);
									@Mail::Send((int)$order->id_lang, 'voucher', sprintf(Mail::l('New voucher regarding your order %s', (int)$order->id_lang), $order->reference),
										$params, $customer->email, $customer->firstname.' '.$customer->lastname, null, null, null,
										null, _PS_MAIL_DIR_, true, (int)$order->id_shop);
								}
							}
						}
					}
					else
						$this->errors[] = Tools::displayError('You have to write an amount if you want to do a partial credit slip');

					// Redirect if no errors
					if (!count($this->errors))
						Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=30&token='.$this->token);
				}
				else
					$this->errors[] = Tools::displayError('Partial refund data is incorrect');
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to delete here.');
		}

		/* Cancel product from order */
		elseif (Tools::isSubmit('cancelProduct') && isset($order))
		{
		 	if ($this->tabAccess['delete'] === '1')
			{
				if (!Tools::isSubmit('id_order_detail'))
					$this->errors[] = Tools::displayError('You must select a product');
				elseif (!Tools::isSubmit('cancelQuantity'))
					$this->errors[] = Tools::displayError('You must enter a quantity');
				else
				{
					$productList = Tools::getValue('id_order_detail');
					if ($productList)
						$productList = array_map('intval', $productList);
					
					$customizationList = Tools::getValue('id_customization');
					if ($customizationList)
						$customizationList = array_map('intval', $customizationList);
						
					$qtyList = Tools::getValue('cancelQuantity');
					if ($qtyList)
						$qtyList = array_map('intval', $qtyList);
						
					$customizationQtyList = Tools::getValue('cancelCustomizationQuantity');
					if ($customizationQtyList)
						$customizationQtyList = array_map('intval', $customizationQtyList);

					$full_product_list = $productList;
					$full_quantity_list = $qtyList;

					if ($customizationList)
						foreach ($customizationList as $key => $id_order_detail)
						{
							$full_product_list[(int)$id_order_detail] = $id_order_detail;
							$full_quantity_list[(int)$id_order_detail] += $customizationQtyList[$key];
						}

					if ($productList || $customizationList)
					{
						if ($productList)
						{
							$id_cart = Cart::getCartIdByOrderId($order->id);
							$customization_quantities = Customization::countQuantityByCart($id_cart);

							foreach ($productList as $key => $id_order_detail)
							{
								$qtyCancelProduct = abs($qtyList[$key]);
								if (!$qtyCancelProduct)
									$this->errors[] = Tools::displayError('No quantity selected for product.');

								$order_detail = new OrderDetail($id_order_detail);
								$customization_quantity = 0;
								if (array_key_exists($order_detail->product_id, $customization_quantities) && array_key_exists($order_detail->product_attribute_id, $customization_quantities[$order_detail->product_id]))
									$customization_quantity = (int)$customization_quantities[$order_detail->product_id][$order_detail->product_attribute_id];

								if (($order_detail->product_quantity - $customization_quantity - $order_detail->product_quantity_refunded - $order_detail->product_quantity_return) < $qtyCancelProduct)
									$this->errors[] = Tools::displayError('Invalid quantity selected for product.');

							}
						}
						if ($customizationList)
						{
							$customization_quantities = Customization::retrieveQuantitiesFromIds(array_keys($customizationList));

							foreach ($customizationList as $id_customization => $id_order_detail)
							{
								$qtyCancelProduct = abs($customizationQtyList[$id_customization]);
								$customization_quantity = $customization_quantities[$id_customization];

								if (!$qtyCancelProduct)
									$this->errors[] = Tools::displayError('No quantity selected for product.');

								if ($qtyCancelProduct > ($customization_quantity['quantity'] - ($customization_quantity['quantity_refunded'] + $customization_quantity['quantity_returned'])))
									$this->errors[] = Tools::displayError('Invalid quantity selected for product.');
							}
						}

						if (!count($this->errors) && $productList)
							foreach ($productList as $key => $id_order_detail)
							{
								$qty_cancel_product = abs($qtyList[$key]);
								$order_detail = new OrderDetail((int)($id_order_detail));

								// Reinject product
								if (!$order->hasBeenDelivered() || ($order->hasBeenDelivered() && Tools::isSubmit('reinjectQuantities')))
								{
									$reinjectable_quantity = (int)$order_detail->product_quantity - (int)$order_detail->product_quantity_reinjected;
									$quantity_to_reinject = $qty_cancel_product > $reinjectable_quantity ? $reinjectable_quantity : $qty_cancel_product;

									// @since 1.5.0 : Advanced Stock Management
									$product_to_inject = new Product($order_detail->product_id, false, $this->context->language->id, $order->id_shop);

									$product = new Product($order_detail->product_id);

									if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')
										&& $product->advanced_stock_management
										&& $order_detail->id_warehouse != 0)
									{

										$manager = StockManagerFactory::getManager();

										$movements = StockMvt::getNegativeStockMvts(
											$order_detail->id_order,
											$order_detail->product_id,
											$order_detail->product_attribute_id,
											$quantity_to_reinject
										);

										foreach ($movements as $movement)
										{
											$manager->addProduct(
												$order_detail->product_id,
												$order_detail->product_attribute_id,
												new Warehouse($movement['id_warehouse']),
												$movement['physical_quantity'],
												null,
												$movement['price_te'],
												true
											);
										}
										StockAvailable::synchronize($order_detail->product_id);
									}
									else if ($order_detail->id_warehouse == 0)
									{
										StockAvailable::updateQuantity(
											$order_detail->product_id,
											$order_detail->product_attribute_id,
											$quantity_to_reinject,
											$order->id_shop
										);
									}
									else
										$this->errors[] = Tools::displayError('Cannot re-stock product');
								}

								// Delete product
								$order_detail = new OrderDetail((int)$id_order_detail);
								if (!$order->deleteProduct($order, $order_detail, $qtyCancelProduct))
									$this->errors[] = Tools::displayError('An error occurred during deletion of the product.').' <span class="bold">'.$order_detail->product_name.'</span>';
								Hook::exec('actionProductCancel', array('order' => $order, 'id_order_detail' => (int)$id_order_detail));
							}
						if (!count($this->errors) && $customizationList)
							foreach ($customizationList as $id_customization => $id_order_detail)
							{
								$order_detail = new OrderDetail((int)($id_order_detail));
								$qtyCancelProduct = abs($customizationQtyList[$id_customization]);
								if (!$order->deleteCustomization($id_customization, $qtyCancelProduct, $order_detail))
									$this->errors[] = Tools::displayError('An error occurred during deletion of product customization.').' '.$id_customization;
							}
						// E-mail params
						if ((Tools::isSubmit('generateCreditSlip') || Tools::isSubmit('generateDiscount')) && !count($this->errors))
						{
							$customer = new Customer((int)($order->id_customer));
							$params['{lastname}'] = $customer->lastname;
							$params['{firstname}'] = $customer->firstname;
							$params['{id_order}'] = $order->id;
							$params['{order_name}'] = $order->getUniqReference();
						}

						// Generate credit slip
						if (Tools::isSubmit('generateCreditSlip') && !count($this->errors))
						{
							if (!OrderSlip::createOrderSlip($order, $full_product_list, $full_quantity_list, Tools::isSubmit('shippingBack')))
								$this->errors[] = Tools::displayError('Cannot generate credit slip');
							else
							{
								Hook::exec('actionOrderSlipAdd', array('order' => $order, 'productList' => $full_product_list, 'qtyList' => $full_quantity_list));
								@Mail::Send(
									(int)$order->id_lang,
									'credit_slip',
									Mail::l('New credit slip regarding your order', $order->id_lang),
									$params,
									$customer->email,
									$customer->firstname.' '.$customer->lastname,
									null,
									null,
									null,
									null,
									_PS_MAIL_DIR_,
									true,
									(int)$order->id_shop
								);
							}
						}

						// Generate voucher
						if (Tools::isSubmit('generateDiscount') && !count($this->errors))
						{
							$cartrule = new CartRule();
							$languages = Language::getLanguages($order);
							$cartrule->description = sprintf($this->l('Credit Slip for order #%d'), $order->id);
							foreach ($languages as $language)
							{
								// Define a temporary name
								$cartrule->name[$language['id_lang']] = 'V0C'.(int)($order->id_customer).'O'.(int)($order->id);
							}
							// Define a temporary code
							$cartrule->code = 'V0C'.(int)($order->id_customer).'O'.(int)($order->id);

							$cartrule->quantity = 1;
							$cartrule->quantity_per_user = 1;
							// Specific to the customer
							$cartrule->id_customer = $order->id_customer;
							$now = time();
							$cartrule->date_from = date('Y-m-d H:i:s', $now);
							$cartrule->date_to = date('Y-m-d H:i:s', $now + (3600 * 24 * 365.25)); /* 1 year */
							$cartrule->active = 1;

							$products = $order->getProducts(false, $full_product_list, $full_quantity_list);

							$total = 0;
							foreach ($products as $product)
								$total += $product['unit_price_tax_incl'] * $product['product_quantity'];

							if (Tools::isSubmit('shippingBack'))
								$total += $order->total_shipping;

							$cartrule->reduction_amount = $total;
							$cartrule->reduction_tax = true;
							$cartrule->minimum_amount_currency = $order->id_currency;
							$cartrule->reduction_currency = $order->id_currency;

							if (!$cartrule->add())
								$this->errors[] = Tools::displayError('Cannot generate voucher');
							else
							{
								// Update the voucher code and name
								foreach ($languages as $language)
									$cartrule->name[$language['id_lang']] = 'V'.(int)($cartrule->id).'C'.(int)($order->id_customer).'O'.$order->id;
								$cartrule->code = 'V'.(int)($cartrule->id).'C'.(int)($order->id_customer).'O'.$order->id;
								if (!$cartrule->update())
									$this->errors[] = Tools::displayError('Cannot generate voucher');
								else
								{
									$currency = $this->context->currency;
									$params['{voucher_amount}'] = Tools::displayPrice($cartrule->reduction_amount, $currency, false);
									$params['{voucher_num}'] = $cartrule->code;
									@Mail::Send((int)$order->id_lang, 'voucher', sprintf(Mail::l('New voucher regarding your order %s', (int)$order->id_lang), $order->reference),
									$params, $customer->email, $customer->firstname.' '.$customer->lastname, null, null, null,
									null, _PS_MAIL_DIR_, true, (int)$order->id_shop);
								}
							}
						}
					}
					else
						$this->errors[] = Tools::displayError('No product or quantity selected.');

					// Redirect if no errors
					if (!count($this->errors))
						Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=31&token='.$this->token);
				}
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to delete here.');
		}
		elseif (Tools::isSubmit('messageReaded'))
			Message::markAsReaded(Tools::getValue('messageReaded'), $this->context->employee->id);
		elseif (Tools::isSubmit('submitAddPayment') && isset($order))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				$amount = str_replace(',', '.', Tools::getValue('payment_amount'));
				$currency = new Currency(Tools::getValue('payment_currency'));
				$order_has_invoice = $order->hasInvoice();
				if ($order_has_invoice)
					$order_invoice = new OrderInvoice(Tools::getValue('payment_invoice'));
				else
					$order_invoice = null;

				if (!Validate::isLoadedObject($order))
					$this->errors[] = Tools::displayError('Order can\'t be found');
				elseif (!Validate::isNegativePrice($amount))
					$this->errors[] = Tools::displayError('Amount is invalid');
				elseif (!Validate::isString(Tools::getValue('payment_method')))
					$this->errors[] = Tools::displayError('Payment method is invalid');
				elseif (!Validate::isString(Tools::getValue('payment_transaction_id')))
					$this->errors[] = Tools::displayError('Transaction ID is invalid');
				elseif (!Validate::isLoadedObject($currency))
					$this->errors[] = Tools::displayError('Currency is invalid');
				elseif ($order_has_invoice && !Validate::isLoadedObject($order_invoice))
					$this->errors[] = Tools::displayError('Invoice is invalid');
				elseif (!Validate::isDate(Tools::getValue('payment_date')))
					$this->errors[] = Tools::displayError('Date is invalid');
				else
				{
					if (!$order->addOrderPayment($amount, Tools::getValue('payment_method'), Tools::getValue('payment_transaction_id'), $currency, Tools::getValue('payment_date'), $order_invoice))
						$this->errors[] = Tools::displayError('An error occurred on adding order payment');
					else
						Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=4&token='.$this->token);
				}
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to edit here.');
		}
		elseif (Tools::isSubmit('submitEditNote'))
		{
			$note = Tools::getValue('note');
			$order_invoice = new OrderInvoice((int)Tools::getValue('id_order_invoice'));
			if (Validate::isLoadedObject($order_invoice) && Validate::isCleanHtml($note))
			{
				if ($this->tabAccess['edit'] === '1')
				{
					$order_invoice->note = $note;
					if ($order_invoice->save())
						Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order_invoice->id_order.'&vieworder&conf=4&token='.$this->token);
					else
						$this->errors[] = Tools::displayError('Unable to save invoice note.');
				}
				else
					$this->errors[] = Tools::displayError('You do not have permission to edit here.');
			}
			else
				$this->errors[] = Tools::displayError('Unable to load invoice for edit note.');
		}
		elseif (Tools::isSubmit('submitAddOrder') && ($id_cart = Tools::getValue('id_cart')) &&
			($module_name = Tools::getValue('payment_module_name')) &&
			($id_order_state = Tools::getValue('id_order_state')) && Validate::isModuleName($module_name))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				$payment_module = Module::getInstanceByName($module_name);
				$cart = new Cart((int)$id_cart);
				Context::getContext()->currency = new Currency((int)$cart->id_currency);
				Context::getContext()->customer = new Customer((int)$cart->id_customer);
				$employee = new Employee((int)Context::getContext()->cookie->id_employee);
				$payment_module->validateOrder(
					(int)$cart->id, (int)$id_order_state,
					$cart->getOrderTotal(true, Cart::BOTH), $payment_module->displayName, $this->l('Manual order - Employee:').
					Tools::safeOutput(substr($employee->firstname, 0, 1).'. '.$employee->lastname), array(), null, false, $cart->secure_key
				);
				if ($payment_module->currentOrder)
					Tools::redirectAdmin(self::$currentIndex.'&id_order='.$payment_module->currentOrder.'&vieworder'.'&token='.$this->token);
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to add here.');
		}
		elseif ((Tools::isSubmit('submitAddressShipping') || Tools::isSubmit('submitAddressInvoice')) && isset($order))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				$address = new Address(Tools::getValue('id_address'));
				if (Validate::isLoadedObject($address))
				{
					// Update the address on order
					if (Tools::isSubmit('submitAddressShipping'))
						$order->id_address_delivery = $address->id;
					elseif (Tools::isSubmit('submitAddressInvoice'))
						$order->id_address_invoice = $address->id;
					$order->update();
					Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=4&token='.$this->token);
				}
				else
					$this->errors[] = Tools::displayErrror('This address can\'t be loaded');
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to edit here.');
		}
		elseif (Tools::isSubmit('submitChangeCurrency') && isset($order))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				if (Tools::getValue('new_currency') != $order->id_currency && !$order->valid)
				{
					$old_currency = new Currency($order->id_currency);
					$currency = new Currency(Tools::getValue('new_currency'));
					if (!Validate::isLoadedObject($currency))
						throw new PrestaShopException('Can\'t load Currency object');

					// Update order detail amount
					foreach ($order->getOrderDetailList() as $row)
					{
						$order_detail = new OrderDetail($row['id_order_detail']);
						$fields = array(
							'ecotax',
							'product_price',
							'reduction_amount',
							'total_shipping',
							'total_shipping_tax_excl',
							'total_shipping_tax_incl',
							'total_products',
							'total_products_wt',
							'total_paid',
							'total_paid_tax_incl',
							'total_paid_tax_excl',
							'total_paid_real',
							'product_quantity_discount',
							'purchase_supplier_price',
							'reduction_amount_tax_incl',
							'reduction_amount_tax_excl'
						);
						foreach ($fields as $field)
							$order_detail->{$field} = Tools::convertPriceFull($order_detail->{$field}, $old_currency, $currency);

						$order_detail->update();
					}

					$id_order_carrier = Db::getInstance()->getValue('
						SELECT `id_order_carrier`
						FROM `'._DB_PREFIX_.'order_carrier`
						WHERE `id_order` = '.(int)$order->id);
					if ($id_order_carrier)
					{
						$order_carrier = new OrderCarrier($id_order_carrier);
						$order_carrier->shipping_cost_tax_excl = (float)Tools::convertPriceFull($order_carrier->shipping_cost_tax_excl, $old_currency, $currency);
						$order_carrier->shipping_cost_tax_incl = (float)Tools::convertPriceFull($order_carrier->shipping_cost_tax_incl, $old_currency, $currency);
						$order_carrier->update();
					}

					// Update order amount
					$fields = array(
						'total_discounts',
						'total_discounts_tax_incl',
						'total_discounts_tax_excl',
						'total_paid',
						'total_paid_tax_incl',
						'total_paid_tax_excl',
						'total_paid_real',
						'total_products',
						'total_products_wt',
						'total_shipping',
						'total_shipping_tax_incl',
						'total_shipping_tax_excl',
						'total_wrapping',
						'total_wrapping_tax_incl',
						'total_wrapping_tax_excl',
					);
					foreach ($fields as $field)
						$order->{$field} = Tools::convertPriceFull($order->{$field}, $old_currency, $currency);

					// Update currency in order
					$order->id_currency = $currency->id;

					$order->update();
				}
				else
					$this->errors[] = Tools::displayError('You cannot change the currency');
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to edit here.');
		}
		elseif (Tools::isSubmit('submitGenerateInvoice') && isset($order))
		{
			if (!Configuration::get('PS_INVOICE'))
				$this->errors[] = Tools::displayError('Invoice management has been disabled');
			elseif ($order->hasInvoice())
				$this->errors[] = Tools::displayError('This order already has an invoice');
			else
			{
				$order->setInvoice(true);
				Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=4&token='.$this->token);
			}
		}
		elseif (Tools::isSubmit('submitDeleteVoucher') && isset($order))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				$order_cart_rule = new OrderCartRule(Tools::getValue('id_order_cart_rule'));
				if (Validate::isLoadedObject($order_cart_rule) && $order_cart_rule->id_order == $order->id)
				{
					if ($order_cart_rule->id_order_invoice)
					{
						$order_invoice = new OrderInvoice($order_cart_rule->id_order_invoice);
						if (!Validate::isLoadedObject($order_invoice))
							throw new PrestaShopException('Can\'t load Order Invoice object');

						// Update amounts of Order Invoice
						$order_invoice->total_discount_tax_excl -= $order_cart_rule->value_tax_excl;
						$order_invoice->total_discount_tax_incl -= $order_cart_rule->value;

						$order_invoice->total_paid_tax_excl += $order_cart_rule->value_tax_excl;
						$order_invoice->total_paid_tax_incl += $order_cart_rule->value;

						// Update Order Invoice
						$order_invoice->update();
					}

					// Update amounts of order
					$order->total_discounts -= $order_cart_rule->value;
					$order->total_discounts_tax_incl -= $order_cart_rule->value;
					$order->total_discounts_tax_excl -= $order_cart_rule->value_tax_excl;

					$order->total_paid += $order_cart_rule->value;
					$order->total_paid_tax_incl += $order_cart_rule->value;
					$order->total_paid_tax_excl += $order_cart_rule->value_tax_excl;

					// Delete Order Cart Rule and update Order
					$order_cart_rule->delete();
					$order->update();
					Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=4&token='.$this->token);
				}
				else
					$this->errors[] = Tools::displayError('Cannot edit this Order Cart Rule');
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to edit here.');
		}
		elseif (Tools::getValue('submitNewVoucher') && isset($order))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				if (!Tools::getValue('discount_name'))
					$this->errors[] = Tools::displayError('You must specify a name in order to create a new discount');
				else
				{
					if ($order->hasInvoice())
					{
						// If the discount is for only one invoice
						if (!Tools::isSubmit('discount_all_invoices'))
						{
							$order_invoice = new OrderInvoice(Tools::getValue('discount_invoice'));
							if (!Validate::isLoadedObject($order_invoice))
								throw new PrestaShopException('Can\'t load Order Invoice object');
						}
					}

					$cart_rules = array();
					switch (Tools::getValue('discount_type'))
					{
						// Percent type
						case 1:
							if (Tools::getValue('discount_value') < 100)
							{
								if (isset($order_invoice))
								{
									$cart_rules[$order_invoice->id]['value_tax_incl'] = Tools::ps_round($order_invoice->total_paid_tax_incl * Tools::getValue('discount_value') / 100, 2);
									$cart_rules[$order_invoice->id]['value_tax_excl'] = Tools::ps_round($order_invoice->total_paid_tax_excl * Tools::getValue('discount_value') / 100, 2);

									// Update OrderInvoice
									$this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
								}
								elseif ($order->hasInvoice())
								{
									$order_invoices_collection = $order->getInvoicesCollection();
									foreach ($order_invoices_collection as $order_invoice)
									{
										$cart_rules[$order_invoice->id]['value_tax_incl'] = Tools::ps_round($order_invoice->total_paid_tax_incl * Tools::getValue('discount_value') / 100, 2);
										$cart_rules[$order_invoice->id]['value_tax_excl'] = Tools::ps_round($order_invoice->total_paid_tax_excl * Tools::getValue('discount_value') / 100, 2);

										// Update OrderInvoice
										$this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
									}
								}
								else
								{
									$cart_rules[0]['value_tax_incl'] = Tools::ps_round($order->total_paid_tax_incl * Tools::getValue('discount_value') / 100, 2);
									$cart_rules[0]['value_tax_excl'] = Tools::ps_round($order->total_paid_tax_excl * Tools::getValue('discount_value') / 100, 2);
								}
							}
							else
								$this->errors[] = Tools::displayError('Discount value is invalid');
							break;
						// Amount type
						case 2:
							if (isset($order_invoice))
							{
								if (Tools::getValue('discount_value') > $order_invoice->total_paid_tax_incl)
									$this->errors[] = Tools::displayError('Discount value is greater than the order invoice total');
								else
								{
									$cart_rules[$order_invoice->id]['value_tax_incl'] = Tools::ps_round(Tools::getValue('discount_value'), 2);
									$cart_rules[$order_invoice->id]['value_tax_excl'] = Tools::ps_round(Tools::getValue('discount_value') / (1 + ($order->getTaxesAverageUsed() / 100)), 2);

									// Update OrderInvoice
									$this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
								}
							}
							elseif ($order->hasInvoice())
							{
								$order_invoices_collection = $order->getInvoicesCollection();
								foreach ($order_invoices_collection as $order_invoice)
								{
									if (Tools::getValue('discount_value') > $order_invoice->total_paid_tax_incl)
										$this->errors[] = Tools::displayError('Discount value is greater than the order invoice total (Invoice:').$order_invoice->getInvoiceNumberFormatted(Context::getContext()->language->id).')';
									else
									{
										$cart_rules[$order_invoice->id]['value_tax_incl'] = Tools::ps_round(Tools::getValue('discount_value'), 2);
										$cart_rules[$order_invoice->id]['value_tax_excl'] = Tools::ps_round(Tools::getValue('discount_value') / (1 + ($order->getTaxesAverageUsed() / 100)), 2);

										// Update OrderInvoice
										$this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
									}
								}
							}
							else
							{
								if (Tools::getValue('discount_value') > $order->total_paid_tax_incl)
									$this->errors[] = Tools::displayError('Discount value is greater than the order total');
								else
								{
									$cart_rules[0]['value_tax_incl'] = Tools::ps_round(Tools::getValue('discount_value'), 2);
									$cart_rules[0]['value_tax_excl'] = Tools::ps_round(Tools::getValue('discount_value') / (1 + ($order->getTaxesAverageUsed() / 100)), 2);
								}
							}
							break;
						// Free shipping type
						case 3:
							if (isset($order_invoice))
							{
								if ($order_invoice->total_shipping_tax_incl > 0)
								{
									$cart_rules[$order_invoice->id]['value_tax_incl'] = $order_invoice->total_shipping_tax_incl;
									$cart_rules[$order_invoice->id]['value_tax_excl'] = $order_invoice->total_shipping_tax_excl;

									// Update OrderInvoice
									$this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
								}
							}
							elseif ($order->hasInvoice())
							{
								$order_invoices_collection = $order->getInvoicesCollection();
								foreach ($order_invoices_collection as $order_invoice)
								{
									if ($order_invoice->total_shipping_tax_incl <= 0)
										continue;
									$cart_rules[$order_invoice->id]['value_tax_incl'] = $order_invoice->total_shipping_tax_incl;
									$cart_rules[$order_invoice->id]['value_tax_excl'] = $order_invoice->total_shipping_tax_excl;

									// Update OrderInvoice
									$this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
								}
							}
							else
							{
								$cart_rules[0]['value_tax_incl'] = $order->total_shipping_tax_incl;
								$cart_rules[0]['value_tax_excl'] = $order->total_shipping_tax_excl;
							}
							break;
						default:
							$this->errors[] = Tools::displayError('Discount type is invalid');
					}

					$res = true;
					foreach ($cart_rules as &$cart_rule)
					{
						$cartRuleObj = new CartRule();
						$cartRuleObj->date_from = date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($order->date_add)));
						$cartRuleObj->date_to = date('Y-m-d H:i:s', strtotime('+1 hour'));
						$cartRuleObj->name[Configuration::get('PS_LANG_DEFAULT')] = Tools::getValue('discount_name');
						$cartRuleObj->quantity = 0;
						$cartRuleObj->quantity_per_user = 1;
						if (Tools::getValue('discount_type') == 1)
							$cartRuleObj->reduction_percent = Tools::getValue('discount_value');
						elseif (Tools::getValue('discount_type') == 2)
							$cartRuleObj->reduction_amount = $cart_rule['value_tax_excl'];
						elseif (Tools::getValue('discount_type') == 3)
							$cartRuleObj->free_shipping = 1;
						$cartRuleObj->active = 0;
						if ($res = $cartRuleObj->add())
							$cart_rule['id'] = $cartRuleObj->id;
						else
							break;
					}

					if ($res)
					{
						foreach ($cart_rules as $id_order_invoice => $cart_rule)
						{
							// Create OrderCartRule
							$order_cart_rule = new OrderCartRule();
							$order_cart_rule->id_order = $order->id;
							$order_cart_rule->id_cart_rule = $cart_rule['id'];
							$order_cart_rule->id_order_invoice = $id_order_invoice;
							$order_cart_rule->name = Tools::getValue('discount_name');
							$order_cart_rule->value = $cart_rule['value_tax_incl'];
							$order_cart_rule->value_tax_excl = $cart_rule['value_tax_excl'];
							$res &= $order_cart_rule->add();

							$order->total_discounts += $order_cart_rule->value;
							$order->total_discounts_tax_incl += $order_cart_rule->value;
							$order->total_discounts_tax_excl += $order_cart_rule->value_tax_excl;
							$order->total_paid -= $order_cart_rule->value;
							$order->total_paid_tax_incl -= $order_cart_rule->value;
							$order->total_paid_tax_excl -= $order_cart_rule->value_tax_excl;
						}

						// Update Order
						$res &= $order->update();
					}

					if ($res)
						Tools::redirectAdmin(self::$currentIndex.'&id_order='.$order->id.'&vieworder&conf=4&token='.$this->token);
					else
						$this->errors[] = Tools::displayError('An error occurred on OrderCartRule creation');
				}
			}
			else
				$this->errors[] = Tools::displayError('You do not have permission to edit here.');
		}

		parent::postProcess();
	}

	public function renderView()
	{
		$order = new Order(Tools::getValue('id_order'));
		if (!Validate::isLoadedObject($order))
			throw new PrestaShopException('object can\'t be loaded');

		$customer = new Customer($order->id_customer);
		$carrier = new Carrier($order->id_carrier);
		$products = $this->getProducts($order);

		// Carrier module call
		$carrier_module_call = null;
		if ($carrier->is_module)
		{
			$module = Module::getInstanceByName($carrier->external_module_name);
			if (method_exists($module, 'displayInfoByCart'))
				$carrier_module_call = call_user_func(array($module, 'displayInfoByCart'), $order->id_cart);
		}

		// Retrieve addresses information
		$addressInvoice = new Address($order->id_address_invoice, $this->context->language->id);
		if (Validate::isLoadedObject($addressInvoice) && $addressInvoice->id_state)
			$invoiceState = new State((int)$addressInvoice->id_state);

		if ($order->id_address_invoice == $order->id_address_delivery)
		{
			$addressDelivery = $addressInvoice;
			if (isset($invoiceState))
				$deliveryState = $invoiceState;
		}
		else
		{
			$addressDelivery = new Address($order->id_address_delivery, $this->context->language->id);
			if (Validate::isLoadedObject($addressDelivery) && $addressDelivery->id_state)
				$deliveryState = new State((int)($addressDelivery->id_state));
		}

		$this->toolbar_title = sprintf($this->l('Order #%1$d (%2$s) - %3$s %4$s'), $order->id, $order->reference, $customer->firstname, $customer->lastname);

		// gets warehouses to ship products, if and only if advanced stock management is activated
		$warehouse_list = null;

		$order_details = $order->getOrderDetailList();
		foreach ($order_details as $order_detail)
		{
			$product = new Product($order_detail['product_id']);

			if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')
				&& $product->advanced_stock_management)
			{
				$warehouses = Warehouse::getWarehousesByProductId($order_detail['product_id'], $order_detail['product_attribute_id']);
				foreach ($warehouses as $warehouse)
				{
					if (!isset($warehouse_list[$warehouse['id_warehouse']]))
						$warehouse_list[$warehouse['id_warehouse']] = $warehouse;
				}
			}
		}

		$payment_methods = array();
		foreach (PaymentModule::getInstalledPaymentModules() as $payment)
		{
			$module = Module::getInstanceByName($payment['name']);
			if (Validate::isLoadedObject($module))
				$payment_methods[] = $module->displayName;
		}

		// display warning if there are products out of stock
		$display_out_of_stock_warning = false;
		$current_order_state = $order->getCurrentOrderState();
		if ($current_order_state->delivery != 1 && $current_order_state->shipped != 1)
			$display_out_of_stock_warning = true;

		// products current stock (from stock_available)
		foreach ($products as &$product)
		{
			$product['current_stock'] = StockAvailable::getQuantityAvailableByProduct($product['product_id'], $product['product_attribute_id'], $product['id_shop']);
			
			$resume = OrderSlip::getProductSlipResume($product['id_order_detail']);
			$product['quantity_refundable'] = $product['product_quantity'] - $resume['product_quantity'];
			$product['amount_refundable'] = $product['total_price_tax_incl'] - $resume['amount_tax_incl'];
			$product['amount_refund'] = Tools::displayPrice($resume['amount_tax_incl']);
			$product['refund_history'] = OrderSlip::getProductSlipDetail($product['id_order_detail']);
			$product['return_history'] = OrderReturn::getProductReturnDetail($product['id_order_detail']);
			
			// if the current stock requires a warning
			if ($product['current_stock'] == 0 && $display_out_of_stock_warning)
				$this->displayWarning($this->l('This product is out of stock: ').' '.$product['product_name']);
		}

		// Smarty assign
		$this->tpl_view_vars = array(
			'order' => $order,
			'cart' => new Cart($order->id_cart),
			'customer' => $customer,
			'customer_addresses' => $customer->getAddresses($this->context->language->id),
			'addresses' => array(
				'delivery' => $addressDelivery,
				'deliveryState' => isset($deliveryState) ? $deliveryState : null,
				'invoice' => $addressInvoice,
				'invoiceState' => isset($invoiceState) ? $invoiceState : null
			),
			'customerStats' => $customer->getStats(),
			'products' => $products,
			'discounts' => $order->getCartRules(),
			'orders_total_paid_tax_incl' => $order->getOrdersTotalPaid(), // Get the sum of total_paid_tax_incl of the order with similar reference
			'total_paid' => $order->getTotalPaid(),
			'returns' => OrderReturn::getOrdersReturn($order->id_customer, $order->id),
			'customer_thread_message' => CustomerThread::getCustomerMessages($order->id_customer, 0),
			'orderMessages' => OrderMessage::getOrderMessages($order->id_lang),
			'messages' => Message::getMessagesByOrderId($order->id, true),
			'carrier' => new Carrier($order->id_carrier),
			'history' => $order->getHistory($this->context->language->id),
			'states' => OrderState::getOrderStates($this->context->language->id),
			'warehouse_list' => $warehouse_list,
			'sources' => ConnectionsSource::getOrderSources($order->id),
			'currentState' => $order->getCurrentOrderState(),
			'currency' => new Currency($order->id_currency),
			'currencies' => Currency::getCurrencies(),
			'previousOrder' => $order->getPreviousOrderId(),
			'nextOrder' => $order->getNextOrderId(),
			'current_index' => self::$currentIndex,
			'carrierModuleCall' => $carrier_module_call,
			'iso_code_lang' => $this->context->language->iso_code,
			'id_lang' => $this->context->language->id,
			'can_edit' => ($this->tabAccess['edit'] == 1),
			'current_id_lang' => $this->context->language->id,
			'invoices_collection' => $order->getInvoicesCollection(),
			'not_paid_invoices_collection' => $order->getNotPaidInvoicesCollection(),
			'payment_methods' => $payment_methods,
			'invoice_management_active' => Configuration::get('PS_INVOICE')
		);

		return parent::renderView();
	}

	public function ajaxProcessSearchCustomers()
	{
		if ($customers = Customer::searchByName(pSQL(Tools::getValue('customer_search'))))
			$to_return = array('customers' => $customers,
									'found' => true);
		else
			$to_return = array('found' => false);
		$this->content = Tools::jsonEncode($to_return);
	}

	public function ajaxProcessSearchProducts()
	{
		Context::getContext()->customer = new Customer((int)Tools::getValue('id_customer'));
		$currency = new Currency(Tools::getValue('id_currency'));
		if ($products = Product::searchByName((int)$this->context->language->id, pSQL(Tools::getValue('product_search'))))
		{
			foreach ($products as &$product)
			{
				// Formatted price
				$product['formatted_price'] = Tools::displayPrice(Tools::convertPrice($product['price_tax_incl'], $currency), $currency);
				// Concret price
				$product['price_tax_incl'] = Tools::ps_round(Tools::convertPrice($product['price_tax_incl'], $currency), 2);
				$product['price_tax_excl'] = Tools::ps_round(Tools::convertPrice($product['price_tax_excl'], $currency), 2);
				$productObj = new Product((int)$product['id_product'], false, (int)$this->context->language->id);
				$combinations = array();
				$attributes = $productObj->getAttributesGroups((int)$this->context->language->id);
				
				// Tax rate for this customer
				if (Tools::isSubmit('id_address'))
					$product['tax_rate'] = $productObj->getTaxesRate(new Address(Tools::getValue('id_address')));

				$product['warehouse_list'] = array();

				foreach ($attributes as $attribute)
				{
					if (!isset($combinations[$attribute['id_product_attribute']]['attributes']))
						$combinations[$attribute['id_product_attribute']]['attributes'] = '';
					$combinations[$attribute['id_product_attribute']]['attributes'] .= $attribute['attribute_name'].' - ';
					$combinations[$attribute['id_product_attribute']]['id_product_attribute'] = $attribute['id_product_attribute'];
					$combinations[$attribute['id_product_attribute']]['default_on'] = $attribute['default_on'];
					if (!isset($combinations[$attribute['id_product_attribute']]['price']))
					{
						$price_tax_incl = Product::getPriceStatic((int)$product['id_product'], true, $attribute['id_product_attribute']);
						$price_tax_excl = Product::getPriceStatic((int)$product['id_product'], false, $attribute['id_product_attribute']);
						$combinations[$attribute['id_product_attribute']]['price_tax_incl'] = Tools::ps_round(Tools::convertPrice($price_tax_incl, $currency), 2);
						$combinations[$attribute['id_product_attribute']]['price_tax_excl'] = Tools::ps_round(Tools::convertPrice($price_tax_excl, $currency), 2);
						$combinations[$attribute['id_product_attribute']]['formatted_price'] = Tools::displayPrice(Tools::convertPrice($price_tax_excl, $currency), $currency);
					}
					if (!isset($combinations[$attribute['id_product_attribute']]['qty_in_stock']))
						$combinations[$attribute['id_product_attribute']]['qty_in_stock'] = StockAvailable::getQuantityAvailableByProduct((int)$product['id_product'], $attribute['id_product_attribute'], (int)$this->context->shop->id);

					if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && (int)$product['advanced_stock_management'] == 1)
						$product['warehouse_list'][$attribute['id_product_attribute']] = Warehouse::getProductWarehouseList($product['id_product'], $attribute['id_product_attribute']);
					else
						$product['warehouse_list'][$attribute['id_product_attribute']] = array();

					$product['stock'][$attribute['id_product_attribute']] = Product::getRealQuantity($product['id_product'], $attribute['id_product_attribute']);

				}

				if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && (int)$product['advanced_stock_management'] == 1)
					$product['warehouse_list'][0] = Warehouse::getProductWarehouseList($product['id_product']);
				else
					$product['warehouse_list'][0] = array();

				$product['stock'][0] = StockAvailable::getQuantityAvailableByProduct((int)$product['id_product'], 0, (int)$this->context->shop->id);

				foreach ($combinations as &$combination)
					$combination['attributes'] = rtrim($combination['attributes'], ' - ');
				$product['combinations'] = $combinations;
				
				if ($product['customizable'])
				{
					$product_instance = new Product((int)$product['id_product']);
					$product['customization_fields'] = $product_instance->getCustomizationFields($this->context->language->id);
				}
			}

			$to_return = array(
				'products' => $products,
				'found' => true
			);
		}
		else
			$to_return = array('found' => false);

		$this->content = Tools::jsonEncode($to_return);
	}

	public function ajaxProcessSendMailValidateOrder()
	{
		if ($this->tabAccess['edit'] === '1')
		{
			$cart = new Cart((int)Tools::getValue('id_cart'));
			if (Validate::isLoadedObject($cart))
			{
				$customer = new Customer((int)$cart->id_customer);
				if (Validate::isLoadedObject($customer))
				{
					$mailVars = array(
						'{order_link}' => Context::getContext()->link->getPageLink('order', false, (int)$cart->id_lang, 'step=3&recover_cart='.(int)$cart->id.'&token_cart='.md5(_COOKIE_KEY_.'recover_cart_'.(int)$cart->id)),
						'{firstname}' => $customer->firstname,
						'{lastname}' => $customer->lastname
					);
					if (Mail::Send((int)$cart->id_lang, 'backoffice_order', Mail::l('Process the payment of your order', (int)$cart->id_lang), $mailVars, $customer->email,
							$customer->firstname.' '.$customer->lastname, null, null, null, null, _PS_MAIL_DIR_, true, $cart->id_shop))
						die(Tools::jsonEncode(array('errors' => false, 'result' => $this->l('The mail was sent to your customer.'))));
				}
			}
			$this->content = Tools::jsonEncode(array('errors' => true, 'result' => $this->l('Error in sending the e-mail to your customer.')));
		}
	}

	public function ajaxProcessAddProductOnOrder()
	{
		// Load object
		$order = new Order(Tools::getValue('id_order'));
		if (!Validate::isLoadedObject($order))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order object')
			)));

		if ($order->hasBeenDelivered())
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t add a product on delivered order')
			)));

		$product_informations = $_POST['add_product'];
		if (isset($_POST['add_invoice']))
			$invoice_informations = $_POST['add_invoice'];
		else
			$invoice_informations = array();
		$product = new Product($product_informations['product_id'], false, $order->id_lang);
		if (!Validate::isLoadedObject($product))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Product object')
			)));

		if (isset($product_informations['product_attribute_id']) && $product_informations['product_attribute_id'])
		{
			$combination = new Combination($product_informations['product_attribute_id']);
			if (!Validate::isLoadedObject($combination))
				die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Combination object')
			)));
		}

		// Total method
		$total_method = Cart::BOTH_WITHOUT_SHIPPING;

		// Create new cart
		$cart = new Cart();
		$cart->id_shop_group = $order->id_shop_group;
		$cart->id_shop = $order->id_shop;
		$cart->id_customer = $order->id_customer;
		$cart->id_carrier = $order->id_carrier;
		$cart->id_address_delivery = $order->id_address_delivery;
		$cart->id_address_invoice = $order->id_address_invoice;
		$cart->id_currency = $order->id_currency;
		$cart->id_customer = $order->id_customer;
		$cart->id_lang = $order->id_lang;
		$cart->id_carrier = $order->id_carrier;
		$cart->secure_key = $order->secure_key;

		// Save new cart
		$cart->add();

		// Save context (in order to apply cart rule)
		$this->context->cart = $cart;
		$this->context->customer = new Customer($order->id_customer);

		$use_taxes = ($order->getTaxCalculationMethod() == PS_TAX_INC);

		$initial_prodcut_price_tax_incl = Product::getPriceStatic($product->id, $use_taxes, isset($combination) ? $combination->id : null, 2, null, false, true, 1,
			false, $order->id_customer, $cart->id, $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});

		// Creating specific price if needed
		if ($product_informations['product_price_tax_incl'] != $initial_prodcut_price_tax_incl)
		{
			$specific_price = new SpecificPrice();
			$specific_price->id_shop = 0;
			$specific_price->id_shop_group = 0;
			$specific_price->id_currency = 0;
			$specific_price->id_country = 0;
			$specific_price->id_group = 0;
			$specific_price->id_customer = $order->id_customer;
			$specific_price->id_product = $product->id;
			if (isset($combination))
				$specific_price->id_product_attribute = $combination->id;
			else
				$specific_price->id_product_attribute = 0;
			$specific_price->price = $product_informations['product_price_tax_excl'];
			$specific_price->from_quantity = 1;
			$specific_price->reduction = 0;
			$specific_price->reduction_type = 'amount';
			$specific_price->from = '0000-00-00 00:00:00';
			$specific_price->to = '0000-00-00 00:00:00';
			$specific_price->add();
		}

		// Add product to cart
		$update_quantity = $cart->updateQty($product_informations['product_quantity'], $product->id, isset($product_informations['product_attribute_id']) ? $product_informations['product_attribute_id'] : null,
			isset($combination) ? $combination->id : null, 'up', 0, new Shop($cart->id_shop));
			
		if ($update_quantity < 0)
		{
			// If product has attribute, minimal quantity is set with minimal quantity of attribute
			$minimal_quantity = ($product_informations['product_attribute_id']) ? Attribute::getAttributeMinimalQty($product_informations['product_attribute_id']) : $product->minimal_quantity;
			die(Tools::jsonEncode(array('error' => sprintf(Tools::displayError('You must add %d minimum quantity', false), $minimal_quantity))));
		}
		elseif (!$update_quantity)
			die(Tools::jsonEncode(array('error' => Tools::displayError('You already have the maximum quantity available for this product.', false))));
		
		// If order is valid, we can create a new invoice or edit an existing invoice
		if ($order->hasInvoice())
		{
			$order_invoice = new OrderInvoice($product_informations['invoice']);
			// Create new invoice
			if ($order_invoice->id == 0)
			{
				// If we create a new invoice, we calculate shipping cost
				$total_method = Cart::BOTH;
				// Create Cart rule in order to make free shipping
				if (isset($invoice_informations['free_shipping']) && $invoice_informations['free_shipping'])
				{
					$cart_rule = new CartRule();
					$cart_rule->id_customer = $order->id_customer;
					$cart_rule->name = array(
						Configuration::get('PS_LANG_DEFAULT') => $this->l('[Generated] CartRule for Free Shipping')
					);
					$cart_rule->date_from = date('Y-m-d H:i:s', time());
					$cart_rule->date_to = date('Y-m-d H:i:s', time() + 24 * 3600);
					$cart_rule->quantity = 1;
					$cart_rule->quantity_per_user = 1;
					$cart_rule->minimum_amount_currency = $order->id_currency;
					$cart_rule->reduction_currency = $order->id_currency;
					$cart_rule->free_shipping = true;
					$cart_rule->active = 1;
					$cart_rule->add();

					// Add cart rule to cart and in order
					$cart->addCartRule($cart_rule->id);
					$values = array(
						'tax_incl' => $cart_rule->getContextualValue(true),
						'tax_excl' => $cart_rule->getContextualValue(false)
					);
					$order->addCartRule($cart_rule->id, $cart_rule->name[Configuration::get('PS_LANG_DEFAULT')], $values);
				}

				$order_invoice->id_order = $order->id;
				if ($order_invoice->number)
					Configuration::updateValue('PS_INVOICE_START_NUMBER', false);
				else
					$order_invoice->number = Order::getLastInvoiceNumber() + 1;

				$invoice_address = new Address((int)$order->id_address_invoice);
				$carrier = new Carrier((int)$order->id_carrier);
				$tax_calculator = $carrier->getTaxCalculator($invoice_address);

				$order_invoice->total_paid_tax_excl = Tools::ps_round((float)$cart->getOrderTotal(false, $total_method), 2);
				$order_invoice->total_paid_tax_incl = Tools::ps_round((float)$cart->getOrderTotal($use_taxes, $total_method), 2);
				$order_invoice->total_products = (float)$cart->getOrderTotal(false, Cart::ONLY_PRODUCTS);
				$order_invoice->total_products_wt = (float)$cart->getOrderTotal($use_taxes, Cart::ONLY_PRODUCTS);
				$order_invoice->total_shipping_tax_excl = (float)$cart->getTotalShippingCost(null, false);
				$order_invoice->total_shipping_tax_incl = (float)$cart->getTotalShippingCost();

				$order_invoice->total_wrapping_tax_excl = abs($cart->getOrderTotal(false, Cart::ONLY_WRAPPING));
				$order_invoice->total_wrapping_tax_incl = abs($cart->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order_invoice->shipping_tax_computation_method = (int)$tax_calculator->computation_method;

				// Update current order field, only shipping because other field is updated later
				$order->total_shipping += $order_invoice->total_shipping_tax_incl;
				$order->total_shipping_tax_excl += $order_invoice->total_shipping_tax_excl;
				$order->total_shipping_tax_incl += ($use_taxes) ? $order_invoice->total_shipping_tax_incl : $order_invoice->total_shipping_tax_excl;

				$order->total_wrapping += abs($cart->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order->total_wrapping_tax_excl += abs($cart->getOrderTotal(false, Cart::ONLY_WRAPPING));
				$order->total_wrapping_tax_incl += abs($cart->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order_invoice->add();

				$order_invoice->saveCarrierTaxCalculator($tax_calculator->getTaxesAmount($order_invoice->total_shipping_tax_excl));

				$order_carrier = new OrderCarrier();
				$order_carrier->id_order = (int)$order->id;
				$order_carrier->id_carrier = (int)$order->id_carrier;
				$order_carrier->id_order_invoice = (int)$order_invoice->id;
				$order_carrier->weight = (float)$cart->getTotalWeight();
				$order_carrier->shipping_cost_tax_excl = (float)$order_invoice->total_shipping_tax_excl;
				$order_carrier->shipping_cost_tax_incl = ($use_taxes) ? (float)$order_invoice->total_shipping_tax_incl : (float)$order_invoice->total_shipping_tax_excl;
				$order_carrier->add();
			}
			// Update current invoice
			else
			{
				$order_invoice->total_paid_tax_excl += Tools::ps_round((float)($cart->getOrderTotal(false, $total_method)), 2);
				$order_invoice->total_paid_tax_incl += Tools::ps_round((float)($cart->getOrderTotal($use_taxes, $total_method)), 2);
				$order_invoice->total_products += (float)$cart->getOrderTotal(false, Cart::ONLY_PRODUCTS);
				$order_invoice->total_products_wt += (float)$cart->getOrderTotal($use_taxes, Cart::ONLY_PRODUCTS);
				$order_invoice->total_shipping_tax_excl += (float)$cart->getTotalShippingCost(null, false);
				$order_invoice->total_shipping_tax_incl += (float)$cart->getTotalShippingCost(null, $use_taxes);
				$order_invoice->total_wrapping_tax_excl += abs($cart->getOrderTotal(false, Cart::ONLY_WRAPPING));
				$order_invoice->total_wrapping_tax_incl += abs($cart->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order_invoice->update();
			}
		}

		// Create Order detail information
		$order_detail = new OrderDetail();
		$order_detail->createList($order, $cart, $order->getCurrentOrderState(), $cart->getProducts(), (isset($order_invoice) ? $order_invoice->id : 0), $use_taxes, (int)Tools::getValue('add_product_warehouse'));

		// update totals amount of order
		$order->total_products += (float)$cart->getOrderTotal(false, Cart::ONLY_PRODUCTS);
		$order->total_products_wt += (float)$cart->getOrderTotal($use_taxes, Cart::ONLY_PRODUCTS);

		$order->total_paid += Tools::ps_round((float)($cart->getOrderTotal(true, $total_method)), 2);
		$order->total_paid_tax_excl += Tools::ps_round((float)($cart->getOrderTotal(false, $total_method)), 2);
		$order->total_paid_tax_incl += Tools::ps_round((float)($cart->getOrderTotal($use_taxes, $total_method)), 2);

		// discount
		$order->total_discounts += (float)abs($cart->getOrderTotal(true, Cart::ONLY_DISCOUNTS));
		$order->total_discounts_tax_excl += (float)abs($cart->getOrderTotal(false, Cart::ONLY_DISCOUNTS));
		$order->total_discounts_tax_incl += (float)abs($cart->getOrderTotal(true, Cart::ONLY_DISCOUNTS));

		// Save changes of order
		$order->update();

		// Delete specific price if exists
		if (isset($specific_price))
			$specific_price->delete();

		$products = $this->getProducts($order);

		// Get the last product
		$product = end($products);
		$resume = OrderSlip::getProductSlipResume($product['id_order_detail']);
		$product['quantity_refundable'] = $product['product_quantity'] - $resume['product_quantity'];
		$product['amount_refundable'] = $product['total_price_tax_incl'] - $resume['amount_tax_incl'];
		$product['amount_refund'] = Tools::displayPrice($resume['amount_tax_incl']);

		// Get invoices collection
		$invoice_collection = $order->getInvoicesCollection();

		$invoice_array = array();
		foreach ($invoice_collection as $invoice)
		{
			$invoice->name = $invoice->getInvoiceNumberFormatted(Context::getContext()->language->id);
			$invoice_array[] = $invoice;
		}

		// Assign to smarty informations in order to show the new product line
		$this->context->smarty->assign(array(
			'product' => $product,
			'order' => $order,
			'currency' => new Currency($order->id_currency),
			'can_edit' => $this->tabAccess['edit'],
			'invoices_collection' => $invoice_collection,
			'current_id_lang' => Context::getContext()->language->id,
			'link' => Context::getContext()->link,
			'current_index' => self::$currentIndex
		));
		
		$this->sendChangedNotification($order);

		die(Tools::jsonEncode(array(
			'result' => true,
			'view' => $this->createTemplate('_product_line.tpl')->fetch(),
			'can_edit' => $this->tabAccess['add'],
			'order' => $order,
			'invoices' => $invoice_array,
			'documents_html' => $this->createTemplate('_documents.tpl')->fetch(),
			'shipping_html' => $this->createTemplate('_shipping.tpl')->fetch(),
			'discount_form_html' => $this->createTemplate('_discount_form.tpl')->fetch()
		)));
	}
	
	public function sendChangedNotification(Order $order = null)
	{
		if (is_null($order))
			$order = new Order(Tools::getValue('id_order'));
		
		$data = array(
			'{lastname}' => $order->getCustomer()->lastname,
			'{firstname}' => $order->getCustomer()->firstname,
			'{id_order}' => (int)$order->id,
			'{order_name}' => $order->getUniqReference()
		);
		
		Mail::Send(
			(int)$order->id_lang,
			'order_changed',
			Mail::l('Your order has been changed', $order->id_lang),
			$data,
			$order->getCustomer()->email,
			$order->getCustomer()->firstname.' '.$order->getCustomer()->lastname,
			null, null, null, null, _PS_MAIL_DIR_, true, (int)$order->id_shop);
	}

	public function ajaxProcessLoadProductInformation()
	{
		$order_detail = new OrderDetail(Tools::getValue('id_order_detail'));
		if (!Validate::isLoadedObject($order_detail))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load OrderDetail object')
			)));

		$product = new Product($order_detail->product_id);
		if (!Validate::isLoadedObject($product))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Product object')
			)));

		$address = new Address(Tools::getValue('id_address'));
		if (!Validate::isLoadedObject($address))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Address object')
			)));

		die(Tools::jsonEncode(array(
			'result' => true,
			'product' => $product,
			'tax_rate' => $product->getTaxesRate($address),
			'price_tax_incl' => Product::getPriceStatic($product->id, true, $order_detail->product_attribute_id, 2),
			'price_tax_excl' => Product::getPriceStatic($product->id, false, $order_detail->product_attribute_id, 2)
		)));
	}

	public function ajaxProcessEditProductOnOrder()
	{
		// Return value
		$res = true;

		$order = new Order(Tools::getValue('id_order'));
		$order_detail = new OrderDetail(Tools::getValue('product_id_order_detail'));
		if (Tools::isSubmit('product_invoice'))
			$order_invoice = new OrderInvoice(Tools::getValue('product_invoice'));

		// Check fields validity
		$this->doEditProductValidation($order_detail, $order, isset($order_invoice) ? $order_invoice : null);

		// If multiple product_quantity, the order details concern a product customized
		$product_quantity = 0;
		if (is_array(Tools::getValue('product_quantity')))
			foreach (Tools::getValue('product_quantity') as $id_customization => $qty)
			{
				// Update quantity of each customization
				Db::getInstance()->update('customization', array('quantity' => $qty), 'id_customization = '.(int)$id_customization);
				// Calculate the real quantity of the product
				$product_quantity += $qty;
			}
		else
			$product_quantity = Tools::getValue('product_quantity');

		$product_price_tax_incl = Tools::ps_round(Tools::getValue('product_price_tax_incl'), 2);
		$product_price_tax_excl = Tools::ps_round(Tools::getValue('product_price_tax_excl'), 2);
		$total_products_tax_incl = $product_price_tax_incl * $product_quantity;
		$total_products_tax_excl = $product_price_tax_excl * $product_quantity;

		// Calculate differences of price (Before / After)
		$diff_price_tax_incl = $total_products_tax_incl - $order_detail->total_price_tax_incl;
		$diff_price_tax_excl = $total_products_tax_excl - $order_detail->total_price_tax_excl;

		// Apply change on OrderInvoice
		if (isset($order_invoice))
			// If OrderInvoice to use is different, we update the old invoice and new invoice
			if ($order_detail->id_order_invoice != $order_invoice->id)
			{
				$old_order_invoice = new OrderInvoice($order_detail->id_order_invoice);
				// We remove cost of products
				$old_order_invoice->total_products -= $order_detail->total_price_tax_excl;
				$old_order_invoice->total_products_wt -= $order_detail->total_price_tax_incl;

				$old_order_invoice->total_paid_tax_excl -= $order_detail->total_price_tax_excl;
				$old_order_invoice->total_paid_tax_incl -= $order_detail->total_price_tax_incl;

				$res &= $old_order_invoice->update();

				$order_invoice->total_products += $order_detail->total_price_tax_excl;
				$order_invoice->total_products_wt += $order_detail->total_price_tax_incl;

				$order_invoice->total_paid_tax_excl += $order_detail->total_price_tax_excl;
				$order_invoice->total_paid_tax_incl += $order_detail->total_price_tax_incl;

				$order_detail->id_order_invoice = $order_invoice->id;
			}

		if ($diff_price_tax_incl != 0 && $diff_price_tax_excl != 0)
		{
			$order_detail->unit_price_tax_excl = $product_price_tax_excl;
			$order_detail->unit_price_tax_incl = $product_price_tax_incl;

			$order_detail->total_price_tax_incl += $diff_price_tax_incl;
			$order_detail->total_price_tax_excl += $diff_price_tax_excl;

			if (isset($order_invoice))
			{
				// Apply changes on OrderInvoice
				$order_invoice->total_products += $diff_price_tax_excl;
				$order_invoice->total_products_wt += $diff_price_tax_incl;

				$order_invoice->total_paid_tax_excl += $diff_price_tax_excl;
				$order_invoice->total_paid_tax_incl += $diff_price_tax_incl;
			}

			// Apply changes on Order
			$order = new Order($order_detail->id_order);
			$order->total_products += $diff_price_tax_excl;
			$order->total_products_wt += $diff_price_tax_incl;

			$order->total_paid += $diff_price_tax_incl;
			$order->total_paid_tax_excl += $diff_price_tax_excl;
			$order->total_paid_tax_incl += $diff_price_tax_incl;

			$res &= $order->update();
		}

		$old_quantity = $order_detail->product_quantity;

		$order_detail->product_quantity = $product_quantity;
		// Save order detail
		$res &= $order_detail->update();
		// Save order invoice
		if (isset($order_invoice))
			 $res &= $order_invoice->update();

		// Update product available quantity
		StockAvailable::updateQuantity($order_detail->product_id, $order_detail->product_attribute_id, ($old_quantity - $order_detail->product_quantity), $order->id_shop);

		$products = $this->getProducts($order);
		// Get the last product
		$product = $products[$order_detail->id];
		$resume = OrderSlip::getProductSlipResume($order_detail->id);
		$product['quantity_refundable'] = $product['product_quantity'] - $resume['product_quantity'];
		$product['amount_refundable'] = $product['total_price_tax_incl'] - $resume['amount_tax_incl'];
		$product['amount_refund'] = Tools::displayPrice($resume['amount_tax_incl']);

		// Get invoices collection
		$invoice_collection = $order->getInvoicesCollection();

		$invoice_array = array();
		foreach ($invoice_collection as $invoice)
		{
			$invoice->name = $invoice->getInvoiceNumberFormatted(Context::getContext()->language->id);
			$invoice_array[] = $invoice;
		}

		// Assign to smarty informations in order to show the new product line
		$this->context->smarty->assign(array(
			'product' => $product,
			'order' => $order,
			'currency' => new Currency($order->id_currency),
			'can_edit' => $this->tabAccess['edit'],
			'invoices_collection' => $invoice_collection,
			'current_id_lang' => Context::getContext()->language->id,
			'link' => Context::getContext()->link,
			'current_index' => self::$currentIndex
		));

		if (!$res)
			die(Tools::jsonEncode(array(
				'result' => $res,
				'error' => Tools::displayError('Error occurred while editing this product line')
			)));


		if (is_array(Tools::getValue('product_quantity')))
			$view = $this->createTemplate('_customized_data.tpl')->fetch();
		else
			$view = $this->createTemplate('_product_line.tpl')->fetch();
			
		$this->sendChangedNotification($order);

		die(Tools::jsonEncode(array(
			'result' => $res,
			'view' => $view,
			'can_edit' => $this->tabAccess['add'],
			'invoices_collection' => $invoice_collection,
			'order' => $order,
			'invoices' => $invoice_array,
			'documents_html' => $this->createTemplate('_documents.tpl')->fetch(),
			'shipping_html' => $this->createTemplate('_shipping.tpl')->fetch(),
			'customized_product' => is_array(Tools::getValue('product_quantity'))
		)));
	}

	public function ajaxProcessDeleteProductLine()
	{
		$res = true;

		$order_detail = new OrderDetail(Tools::getValue('id_order_detail'));
		$order = new Order(Tools::getValue('id_order'));

		$this->doDeleteProductLineValidation($order_detail, $order);

		// Update OrderInvoice of this OrderDetail
		if ($order_detail->id_order_invoice != 0)
		{
			$order_invoice = new OrderInvoice($order_detail->id_order_invoice);
			$order_invoice->total_paid_tax_excl -= $order_detail->total_price_tax_excl;
			$order_invoice->total_paid_tax_incl -= $order_detail->total_price_tax_incl;
			$order_invoice->total_products -= $order_detail->total_price_tax_excl;
			$order_invoice->total_products_wt -= $order_detail->total_price_tax_incl;
			$res &= $order_invoice->update();
		}

		// Update Order
		$order->total_paid -= $order_detail->total_price_tax_incl;
		$order->total_paid_tax_incl -= $order_detail->total_price_tax_incl;
		$order->total_paid_tax_excl -= $order_detail->total_price_tax_excl;
		$order->total_products -= $order_detail->total_price_tax_excl;
		$order->total_products_wt -= $order_detail->total_price_tax_incl;

		$res &= $order->update();

		// Delete OrderDetail
		$res &= $order_detail->delete();

		if (!$res)
			die(Tools::jsonEncode(array(
				'result' => $res,
				'error' => Tools::displayError('Error occurred on deletion of this product line')
			)));

		// Get invoices collection
		$invoice_collection = $order->getInvoicesCollection();

		$invoice_array = array();
		foreach ($invoice_collection as $invoice)
		{
			$invoice->name = $invoice->getInvoiceNumberFormatted(Context::getContext()->language->id);
			$invoice_array[] = $invoice;
		}

		// Assign to smarty informations in order to show the new product line
		$this->context->smarty->assign(array(
			'order' => $order,
			'currency' => new Currency($order->id_currency),
			'invoices_collection' => $invoice_collection,
			'current_id_lang' => Context::getContext()->language->id,
			'link' => Context::getContext()->link,
			'current_index' => self::$currentIndex
		));
		
		$this->sendChangedNotification($order);

		die(Tools::jsonEncode(array(
			'result' => $res,
			'order' => $order,
			'invoices' => $invoice_array,
			'documents_html' => $this->createTemplate('_documents.tpl')->fetch(),
			'shipping_html' => $this->createTemplate('_shipping.tpl')->fetch()
		)));
	}

	protected function doEditProductValidation(OrderDetail $order_detail, Order $order, OrderInvoice $order_invoice = null)
	{
		if (!Validate::isLoadedObject($order_detail))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order Detail object')
			)));

		if (!empty($order_invoice) && !Validate::isLoadedObject($order_invoice))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Invoice object')
			)));

		if (!Validate::isLoadedObject($order))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order object')
			)));

		if ($order_detail->id_order != $order->id)
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t edit this Order Detail for this order')
			)));

		// We can't edit a delivered order
		if ($order->hasBeenDelivered())
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t edit a delivered order')
			)));

		if (!empty($order_invoice) && $order_invoice->id_order != Tools::getValue('id_order'))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t use this invoice for this order')
			)));

		// Clean price
		$product_price_tax_incl = str_replace(',', '.', Tools::getValue('product_price_tax_incl'));
		$product_price_tax_excl = str_replace(',', '.', Tools::getValue('product_price_tax_excl'));

		if (!Validate::isPrice($product_price_tax_incl) || !Validate::isPrice($product_price_tax_excl))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Invalid price')
			)));

		if (!is_array(Tools::getValue('product_quantity')) && !Validate::isUnsignedInt(Tools::getValue('product_quantity')))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Invalid quantity')
			)));
		elseif (is_array(Tools::getValue('product_quantity')))
			foreach (Tools::getValue('product_quantity') as $qty)
				if (!Validate::isUnsignedInt($qty))
					die(Tools::jsonEncode(array(
						'result' => false,
						'error' => Tools::displayError('Invalid quantity')
					)));
	}

	protected function doDeleteProductLineValidation(OrderDetail $order_detail, Order $order)
	{
		if (!Validate::isLoadedObject($order_detail))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order Detail object')
			)));

		if (!Validate::isLoadedObject($order))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t load Order object')
			)));

		if ($order_detail->id_order != $order->id)
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t delete this Order Detail for this order')
			)));

		// We can't edit a delivered order
		if ($order->hasBeenDelivered())
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('Can\'t edit a delivered order')
			)));
	}

	protected function getProducts($order)
	{
		$products = $order->getProducts();

		foreach ($products as &$product)
		{
			if ($product['image'] != null)
			{
				$name = 'product_mini_'.(int)$product['product_id'].(isset($product['product_attribute_id']) ? '_'.(int)$product['product_attribute_id'] : '').'.jpg';
				// generate image cache, only for back office
				$product['image_tag'] = ImageManager::thumbnail(_PS_IMG_DIR_.'p/'.$product['image']->getExistingImgPath().'.jpg', $name, 45, 'jpg');
				if (file_exists(_PS_TMP_IMG_DIR_.$name))
					$product['image_size'] = getimagesize(_PS_TMP_IMG_DIR_.$name);
				else
					$product['image_size'] = false;
			}
		}

		return $products;
	}

	protected function applyDiscountOnInvoice($order_invoice, $value_tax_incl, $value_tax_excl)
	{
		// Update OrderInvoice
		$order_invoice->total_discount_tax_incl += $value_tax_incl;
		$order_invoice->total_discount_tax_excl += $value_tax_excl;
		$order_invoice->total_paid_tax_incl -= $value_tax_incl;
		$order_invoice->total_paid_tax_excl -= $value_tax_excl;
		$order_invoice->update();
	}
}

