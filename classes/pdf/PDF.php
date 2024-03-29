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

/**
 * @since 1.5
 */
class PDFCore
{
	public $filename;
	public $pdf_renderer;
	public $objects;
	public $template;

	const TEMPLATE_INVOICE = 'Invoice';
	const TEMPLATE_ORDER_RETURN = 'OrderReturn';
	const TEMPLATE_ORDER_SLIP = 'OrderSlip';
	const TEMPLATE_DELIVERY_SLIP = 'DeliverySlip';
	const TEMPLATE_SUPPLY_ORDER_FORM = 'SupplyOrderForm';

	public function __construct($objects, $template, $smarty)
	{
		$this->pdf_renderer = new PDFGenerator((bool)Configuration::get('PS_PDF_USE_CACHE'));
		$this->template = $template;
		$this->smarty = $smarty;

		$this->objects = $objects;
		if (!($objects instanceof Iterator) && !is_array($objects))
			$this->objects = array($objects);
	}

	public function render($display = true)
	{
		$render = false;
		$this->pdf_renderer->setFontForLang('fr');
		foreach ($this->objects as $object)
		{
			$template = $this->getTemplateObject($object);
			if (!$template)
				continue;

			if (empty($this->filename))
			{
				$this->filename = $template->getFilename();
				if (count($this->objects) > 1)
					$this->filename = $template->getBulkFilename();
			}

			$template->assignHookData($object);

			$this->pdf_renderer->createHeader($template->getHeader());
			$this->pdf_renderer->createFooter($template->getFooter());
			$this->pdf_renderer->createContent($template->getContent());
			$this->pdf_renderer->writePage();
			$render = true;

			unset($template);
		}

		if ($render)
			return $this->pdf_renderer->render($this->filename, $display);
	}

	public function getTemplateObject($object)
	{
		$class = false;
		$classname = 'HTMLTemplate'.$this->template;

		if (class_exists($classname))
		{
			$class = new $classname($object, $this->smarty);
			if (!($class instanceof HTMLTemplate))
				throw new PrestaShopException('Invalid class. It should be an instance of HTMLTemplate');
		}

		return $class;
	}
}