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
 * @since 1.5.0
 */
class TranslateCore
{
	/**
	 * Get a translation for an admin controller
	 *
	 * @param $string
	 * @param string $class
	 * @param bool $addslashes
	 * @param bool $htmlentities
	 * @return string
	 */
	public static function getAdminTranslation($string, $class = 'AdminTab', $addslashes = false, $htmlentities = true, $sprintf = null)
	{
		static $modules_tabs = null;

		// @todo remove global keyword in translations files and use static
		global $_LANGADM;

		if ($modules_tabs === null)
			$modules_tabs = Tab::getModuleTabList();

		if ($_LANGADM == null)
		{
			$iso = Context::getContext()->language->iso_code;
			include_once(_PS_TRANSLATIONS_DIR_.$iso.'/admin.php');
		}

		if (isset($modules_tabs[strtolower($class)]))
		{
			$class_name_controller = $class.'controller';
			// if the class is extended by a module, use modules/[module_name]/xx.php lang file
			if (class_exists($class_name_controller) && Module::getModuleNameFromClass($class_name_controller))
			{
				$string = str_replace('\'', '\\\'', $string);
				return Translate::getModuleTranslation(Module::$classInModule[$class_name_controller], $string, $class);
			}
		}

		$key = md5(str_replace('\'', '\\\'', $string));
		if (isset($_LANGADM[$class.$key]))
			$str = $_LANGADM[$class.$key];
		else
			$str = Translate::getGenericAdminTranslation($string, $key, $_LANGADM);

		if ($htmlentities)
			$str = htmlentities($str, ENT_QUOTES, 'utf-8');
		$str = str_replace('"', '&quot;', $str);

		if ($sprintf !== null)
			$str = Translate::checkAndReplaceArgs($str, $sprintf);

		return ($addslashes ? addslashes($str) : stripslashes($str));
	}

	/**
	 * Return the translation for a string if it exists for the base AdminController or for helpers
	 *
	 * @static
	 * @param $string string to translate
	 * @param null $key md5 key if already calculated (optional)
	 * @param $lang_array global array of admin translations
	 * @return string translation
	 */
	public static function getGenericAdminTranslation($string, $key = null, &$lang_array)
	{
		if (is_null($key))
			$key = md5(str_replace('\'', '\\\'', $string));

		if (isset($lang_array['AdminController'.$key]))
			$str = $lang_array['AdminController'.$key];
		else if (isset($lang_array['Helper'.$key]))
			$str = $lang_array['Helper'.$key];
		else if (isset($lang_array['AdminTab'.$key]))
			$str = $lang_array['AdminTab'.$key];
		else
			// note in 1.5, some translations has moved from AdminXX to helper/*.tpl
			$str = $string;

		return $str;
	}

	/**
	 * Get a translation for a module
	 *
	 * @param string|Module $module
	 * @param string $string
	 * @param string $source
	 * @return string
	 */
	public static function getModuleTranslation($module, $string, $source, $sprintf = null)
	{
		global $_MODULES, $_MODULE, $_LANGADM;

		static $lang_cache = array();
		// $_MODULES is a cache of translations for all module.
		// $translations_merged is a cache of wether a specific module's translations have already been added to $_MODULES
		static $translations_merged = array();

		$name = $module instanceof Module ? $module->name : $module;
		if (!isset($translations_merged[$name]))
		{
			$filesByPriority = array(
				// Translations in theme
				_PS_THEME_DIR_.'modules/'.$name.'/translations/'.Context::getContext()->language->iso_code.'.php', 
				_PS_THEME_DIR_.'modules/'.$name.'/'.Context::getContext()->language->iso_code.'.php', 
				// PrestaShop 1.5 translations
				_PS_MODULE_DIR_.$name.'/translations/'.Context::getContext()->language->iso_code.'.php',
				// PrestaShop 1.4 translations
				_PS_MODULE_DIR_.$name.'/'.Context::getContext()->language->iso_code.'.php'
			);

			foreach ($filesByPriority as $file)
				if (Tools::file_exists_cache($file))
				{
					include_once($file);
					$_MODULES = !empty($_MODULES) ? array_merge($_MODULES, $_MODULE) : $_MODULE;
					$translations_merged[$name] = true;
					break;
				}
		}

		$key = md5(str_replace('\'', '\\\'', $string));

		$cache_key = $name.'|'.$string.'|'.$source;

		if (!isset($lang_cache[$cache_key]))
		{
			if ($_MODULES == null)
			{
				if ($sprintf !== null)
					$string = Translate::checkAndReplaceArgs($string, $sprintf);
				return str_replace('"', '&quot;', $string);
			}

			$current_key = strtolower('<{'.$name.'}'._THEME_NAME_.'>'.$source).'_'.$key;
			$default_key = strtolower('<{'.$name.'}prestashop>'.$source).'_'.$key;

			if (isset($_MODULES[$current_key]))
				$ret = stripslashes($_MODULES[$current_key]);
			elseif (isset($_MODULES[$default_key]))
				$ret = stripslashes($_MODULES[$default_key]);
			// if translation was not found in module, look for it in AdminController or Helpers
			elseif (!empty($_LANGADM))
				$ret = Translate::getGenericAdminTranslation($string, $key, $_LANGADM);
			else
				$ret = stripslashes($string);

			if ($sprintf !== null)
				$ret = Translate::checkAndReplaceArgs($ret, $sprintf);

			$lang_cache[$cache_key] = str_replace('"', '&quot;', $ret);
		}
		return $lang_cache[$cache_key];
	}

	/**
	 * Get a translation for a PDF
	 *
	 * @param string $string
	 * @return string
	 */
	public static function getPdfTranslation($string)
	{
		global $_LANGPDF;

		$iso = Context::getContext()->language->iso_code;

		if (!Validate::isLangIsoCode($iso))
			Tools::displayError(sprintf('Invalid iso lang (%s)', Tools::safeOutput($iso)));

		$override_i18n_file = _PS_THEME_DIR_.'pdf/lang/'.$iso.'.php';
		$i18n_file = _PS_TRANSLATIONS_DIR_.$iso.'/pdf.php';
		if (file_exists($override_i18n_file))
            $i18n_file = $override_i18n_file;

      if (!include($i18n_file))
            Tools::displayError(sprintf('Cannot include PDF translation language file : %s', $i18n_file));

		if (!isset($_LANGPDF) || !is_array($_LANGPDF))
			return str_replace('"', '&quot;', $string);

		$key = md5(str_replace('\'', '\\\'', $string));

		$str = (array_key_exists('PDF'.$key, $_LANGPDF) ? $_LANGPDF['PDF'.$key] : $string);

		return $str;
	}

	/**
	 * Check if string use a specif syntax for sprintf and replace arguments if use it
	 *
	 * @param $string
	 * @param $args
	 * @return string
	 */
	public static function checkAndReplaceArgs($string, $args)
	{
		if (preg_match_all('#(?:%%|%(?:[0-9]+\$)?[+-]?(?:[ 0]|\'.)?-?[0-9]*(?:\.[0-9]+)?[bcdeufFosxX])#', $string, $matches) && !is_null($args))
		{
			if (!is_array($args))
				$args = array($args);

			return vsprintf($string, $args);
		}
		return $string;
	}
}

