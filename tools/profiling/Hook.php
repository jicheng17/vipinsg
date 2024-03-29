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

//
// IMPORTANT : don't forget to delete the underscore _ in the file name if you want to use it !
//

class Hook extends HookCore
{
	private static $hookTime = array();
	private static $hookMemoryUsage = array();
	
	public static function getHookTime()
	{
		return self::$hookTime;
	}
	
	public static function getHookMemoryUsage()
	{
		return self::$hookMemoryUsage;
	}
	
	public static function exec($hook_name, $hookArgs = array(), $id_module = null)
	{
		$memoryUsage = memory_get_usage();
		$t0 = microtime(true);
		$result = parent::exec($hook_name, $hookArgs, $id_module);
		self::$hookTime[$hook_name] = microtime(true) - $t0;
		self::$hookMemoryUsage[$hook_name] = memory_get_usage() - $memoryUsage;
		return $result;
	}
}
