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

define('_PS_ADMIN_DIR_', getcwd());

include(_PS_ADMIN_DIR_.'/../config/config.inc.php');

if (!isset(Context::getContext()->employee) || !Context::getContext()->employee->isLoggedBack())
	die;

if (isset($_FILES['virtual_product_file']) AND is_uploaded_file($_FILES['virtual_product_file']['tmp_name']) AND 
(isset($_FILES['virtual_product_file']['error']) AND !$_FILES['virtual_product_file']['error'])	OR 
(!empty($_FILES['virtual_product_file']['tmp_name']) AND $_FILES['virtual_product_file']['tmp_name'] != 'none'))
{
	$filename = $_FILES['virtual_product_file']['name'];
	$file = $_FILES['virtual_product_file']['tmp_name'];
	$newfilename = ProductDownload::getNewFilename();

	if (!copy($file, _PS_DOWNLOAD_DIR_.$newfilename))
	{
		header('HTTP/1.1 500 Error');
		echo '<return result="error" msg="No permissions to write in the download folder" filename="'.Tools::safeOutput($filename).'" />';
	}
	@unlink($file);

	header('HTTP/1.1 200 OK');
	echo '<return result="success" msg="'.Tools::safeOutput($newfilename).'" filename="'.Tools::safeOutput($filename).'" />';
}
else
{
	header('HTTP/1.1 500 Error');
	echo '<return result="error" msg="Could not upload file" filename="'.Tools::safeOutput(ProductDownload::getNewFilename()).'" />';
}
