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

class AdminRequestSqlControllerCore extends AdminController
{
	/**
	 * @var array : List of encoding type for a file
	 */
	public static $encoding_file = array(
		array('value' => 1, 'name' => 'utf-8'),
		array('value' => 2, 'name' => 'iso-8859-1')
	);

	public function __construct()
	{
		$this->table = 'request_sql';
		$this->className = 'RequestSql';
	 	$this->lang = false;
		$this->export = true;

		$this->context = Context::getContext();

		$this->fields_list = array(
			'id_request_sql' => array('title' => $this->l('ID'), 'width' => 25),
			'name' => array('title' => $this->l('Name'), 'width' => 300),
			'sql' => array('title' => $this->l('Request'), 'width' => 500)
		);

		$this->fields_options = array(
			'general' => array(
				'title' =>	$this->l('Settings'),
				'fields' =>	array(
					'PS_ENCODING_FILE_MANAGER_SQL' => array(
						'title' => $this->l('Select your encoding file by default'),
						'cast' => 'intval',
						'type' => 'select',
						'identifier' => 'value',
						'list' => self::$encoding_file,
						'visibility' => Shop::CONTEXT_ALL
					)
				),
				'submit' => array()
			)
		);

	 	$this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'),'confirm' => $this->l('Delete selected items?')));

		parent::__construct();
	}

	public function renderOptions()
	{
		// Set toolbar options
		$this->display = 'options';
		$this->show_toolbar = true;
		$this->toolbar_scroll = true;
		$this->initToolbar();

		return parent::renderOptions();
	}

	public function initToolbar()
	{
		if ($this->display == 'view' && $id_request = Tools::getValue('id_request_sql'))
			$this->toolbar_btn['edit'] = array(
				'href' => self::$currentIndex.'&amp;updaterequest_sql&amp;token='.$this->token.'&amp;id_request_sql='.(int)$id_request,
				'desc' => $this->l('Edit this request')
			);

		parent::initToolbar();

		if ($this->display == 'options')
			unset($this->toolbar_btn['new']);
		else
			unset($this->toolbar_btn['save']);
	}

	public function renderList()
	{
		// Set toolbar options
		$this->display = null;
		$this->initToolbar();

		$this->displayWarning($this->l('When saving the query, only the request type "SELECT" are allowed.'));
		$this->displayInformation('
		<strong>'.$this->l('How to create a new sql query?').'</strong><br />
		<ul>
			<li>'.$this->l('Click "Add new".').'</li>
			<li>'.$this->l('Fill in the fields and click "Save".').'</li>
			<li>'.$this->l('You can then view the query results by clicking on the tab:').' <img src="../img/admin/details.gif" /></li>
			<li>'.$this->l('You can then export the query results as CSV file by clicking on the tab:').' <img src="../img/admin/export.gif" /></li>
		</ul>');

		$this->addRowAction('export');
		$this->addRowAction('view');
		$this->addRowAction('edit');
		$this->addRowAction('delete');

	 	return parent::renderList();
	}

	public function renderForm()
	{
		$this->fields_form = array(
			'legend' => array(
				'title' => $this->l('Request')
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Name:'),
					'name' => 'name',
					'size' => 103,
					'required' => true
				),
				array(
					'type' => 'textarea',
					'label' => $this->l('Request:'),
					'name' => 'sql',
					'cols' => 100,
					'rows' => 10,
					'required' => true
				)
			),
			'submit' => array(
				'title' => $this->l('Save'),
				'class' => 'button'
			)
		);

		$request = new RequestSql();
		$this->tpl_form_vars = array('tables' => $request->getTables());

		return parent::renderForm();
	}

	/**
	 * method call when ajax request is made with the details row action
	 * @see AdminController::postProcess()
	 */
	public function ajaxProcess()
	{
		if ($table = Tools::GetValue('table'))
		{
			$request_sql = new RequestSql();
			$attributes = $request_sql->getAttributesByTable($table);
			foreach ($attributes as $key => $attribute)
			{
				unset($attributes[$key]['Null']);
				unset($attributes[$key]['Key']);
				unset($attributes[$key]['Default']);
				unset($attributes[$key]['Extra']);
			}
			die(Tools::jsonEncode($attributes));
		}
	}

	public function renderView()
	{
		if (!($obj = $this->loadObject(true)))
			return;

		$view = array();

		if ($results = Db::getInstance()->executeS($obj->sql))
		{
			foreach (array_keys($results[0]) as $key)
				$tab_key[] = $key;

			$view['name'] = $obj->name;
			$view['key'] = $tab_key;
			$view['results'] = $results;

			$request_sql = new RequestSql();
			$view['attributes'] = $request_sql->attributes;
		}
		else
			$view['error'] = true;

		$this->tpl_view_vars = array(
			'view' => $view
		);
		return parent::renderView();
	}

	public function _childValidation()
	{
		if (Tools::getValue('submitAdd'.$this->table) && $sql = Tools::getValue('sql'))
		{
			$request_sql = new RequestSql();
			$parser = $request_sql->parsingSql($sql);
			$validate = $request_sql->validateParser($parser, false, $sql);

			if (!$validate || !empty($request_sql->error_sql))
				$this->displayError($request_sql->error_sql);
		}
	}

	/**
	 * Display export action link
	 */
	public function displayExportLink($token, $id)
	{
		$tpl = $this->createTemplate('list_action_export.tpl');

		$tpl->assign(array(
			'href' => self::$currentIndex.'&token='.$this->token.'&'.$this->identifier.'='.$id.'&export'.$this->table.'=1',
			'action' => $this->l('Export')
		));

		return $tpl->fetch();
	}

	public function initProcess()
	{
		parent::initProcess();
		if (Tools::getValue('export'.$this->table))
		{
			$this->display = 'export';
			$this->action = 'export';
		}
	}

	public function initContent()
	{
		// toolbar (save, cancel, new, ..)
		$this->initToolbar();
		if ($this->display == 'edit' || $this->display == 'add')
		{
			if (!$this->loadObject(true))
				return;

			$this->content .= $this->renderForm();
		}
		else if ($this->display == 'view')
		{
			// Some controllers use the view action without an object
			if ($this->className)
				$this->loadObject(true);
			$this->content .= $this->renderView();
		}
		else if ($this->display == 'export')
			$this->generateExport();
		else if (!$this->ajax)
		{
			$this->content .= $this->renderList();
			$this->content .= $this->renderOptions();
		}

		$this->context->smarty->assign(array(
			'content' => $this->content,
			'url_post' => self::$currentIndex.'&token='.$this->token,
		));
	}

	/**
	 * Genrating a export file
	 */
	public function generateExport()
	{
		$id = Tools::getValue($this->identifier);
		if (!Validate::isFileName($id))
			die(Tools::displayError());
		$file = 'request_sql_'.$id.'.csv';
		if ($csv = fopen(_PS_ADMIN_DIR_.'/export/'.$file, 'w'))
		{
			$sql = RequestSql::getRequestSqlById($id);

			if ($sql)
			{
				$results = Db::getInstance()->executeS($sql[0]['sql']);
				foreach (array_keys($results[0]) as $key)
				{
					$tab_key[] = $key;
					fputs($csv, $key.';');
				}
				foreach ($results as $result)
				{
					fputs($csv, "\n");
					foreach ($tab_key as $name)
						fputs($csv, '"'.strip_tags($result[$name]).'";');
				}
				if (file_exists(_PS_ADMIN_DIR_.'/export/'.$file))
				{
					$filesize = filesize(_PS_ADMIN_DIR_.'/export/'.$file);
					$upload_max_filesize = $this->returnBytes(ini_get('upload_max_filesize'));
					if ($filesize < $upload_max_filesize)
					{
						if (Configuration::get('PS_ENCODING_FILE_MANAGER_SQL'))
							$charset = Configuration::get('PS_ENCODING_FILE_MANAGER_SQL');
						else
							$charset = self::$encoding_file[0]['name'];

						header('Content-Type: text/csv; charset='.$charset);
						header('Cache-Control: no-store, no-cache');
						header('Content-Disposition: attachment; filename="'.$file.'"');
						header('Content-Length: '.$filesize);
						readfile(_PS_ADMIN_DIR_.'/export/'.$file);
						die();
					}
					else
						$this->errors[] = Tools::DisplayError('The file is too large and can not be downloaded. Please use the clause "LIMIT" in this query.');
				}
			}
		}
	}

	/**
	 * Get number of bytes
	 *
	 * @param $val
	 * @return int|string
	 */
	public function returnBytes($val)
	{
	    $val = trim($val);
	    $last = strtolower($val[strlen($val) - 1]);
	    switch ($last)
	    {
	        case 'g':
	            $val *= 1024;
	        case 'm':
	            $val *= 1024;
	        case 'k':
	            $val *= 1024;
	    }
	    return $val;
	}

	/**
	 * Display all errors
	 *
	 * @param $e : array of errors
	 */
	public function displayError($e)
	{
		foreach (array_keys($e) as $key)
		{
			switch ($key)
			{
				case 'checkedFrom':
					if (isset($e[$key]['table']))
						$this->errors[] = sprintf(Tools::displayError('The Table "%s" doesn\'t exist.'), $e[$key]['table']);
					else if (isset($e[$key]['attribut']))
						$this->errors[] = sprintf(
							Tools::displayError('The attribute "%1$s" does not exist in the table: %2$s.'),
							$e[$key]['attribut'][0],
							$e[$key]['attribut'][1]
						);
					else
						$this->errors[] = Tools::displayError('Error');
				break;

				case 'checkedSelect':
					if (isset($e[$key]['table']))
						$this->errors[] = sprintf(Tools::displayError('The Table "%s" doesn\'t exist.'), $e[$key]['table']);
					else if (isset($e[$key]['attribut']))
						$this->errors[] = sprintf(
							Tools::displayError('The attribute "%1$s" does not exist in the table: %2$s.'),
							$e[$key]['attribut'][0],
							$e[$key]['attribut'][1]
						);
					else if (isset($e[$key]['*']))
						$this->errors[] = Tools::displayError('The operator "*" can be used in a nested query.');
					else
						$this->errors[] = Tools::displayError('Error');
				break;

				case 'checkedWhere':
					if (isset($e[$key]['operator']))
						$this->errors[] = sprintf(Tools::displayError('The operator "%s" used is incorrect.'), $e[$key]['operator']);
					else if (isset($e[$key]['attribut']))
						$this->errors[] = sprintf(
							Tools::displayError('The attribute "%1$s" does not exist in the table: %2$s.'),
							$e[$key]['attribut'][0],
							$e[$key]['attribut'][1]
						);
					else
						$this->errors[] = Tools::displayError('Error');
				break;

				case 'checkedHaving':
					if (isset($e[$key]['operator']))
						$this->errors[] = sprintf(Tools::displayError('The operator "%s" used is incorrect.'), $e[$key]['operator']);
					else if (isset($e[$key]['attribut']))
						$this->errors[] = sprintf(
							Tools::displayError('The attribute "%1$s" does not exist in the table: %2$s.'),
							$e[$key]['attribut'][0],
							$e[$key]['attribut'][1]
						);
					else
						$this->errors[] = Tools::displayError('Error');
				break;

				case 'checkedOrder':
					if (isset($e[$key]['attribut']))
						$this->errors[] = sprintf(
							Tools::displayError('The attribute "%1$s" does not exist in the table: %2$s.'),
							$e[$key]['attribut'][0],
							$e[$key]['attribut'][1]
						);
					else
						$this->errors[] = Tools::displayError('Error');
				break;

				case 'checkedGroupBy':
					if (isset($e[$key]['attribut']))
						$this->errors[] = sprintf(
							Tools::displayError('The attribute "%1$s" does not exist in the table: %2$s.'),
							$e[$key]['attribut'][0],
							$e[$key]['attribut'][1]
						);
					else
						$this->errors[] = Tools::displayError('Error');
				break;

				case 'checkedLimit':
						$this->errors[] = Tools::displayError('The LIMIT clause must contain numeric arguments.');
				break;

				case 'returnNameTable':
						if (isset($e[$key]['reference']))
							$this->errors[] = sprintf(
								Tools::displayError('The reference "%1$s" does not exist in the table: %2$s.'),
								$e[$key]['reference'][0],
								$e[$key]['attribut'][1]
							);
						else
							$this->errors[] = Tools::displayError('When multiple tables are used, each attribute must refer to a table.');
				break;

				case 'testedRequired':
						$this->errors[] = sprintf(Tools::displayError('%s doesn\'t exist.'), $e[$key]);
					break;

				case 'testedUnauthorized':
						$this->errors[] = sprintf(Tools::displayError('is an unauthorized keyword.'), $e[$key]);
				break;
			}
		}
	}
}


