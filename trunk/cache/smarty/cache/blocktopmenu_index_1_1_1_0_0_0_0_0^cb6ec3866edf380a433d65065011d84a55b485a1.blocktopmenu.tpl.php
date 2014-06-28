<?php /*%%SmartyHeaderCode:34825254953ae6fd9d401d6-79606605%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb6ec3866edf380a433d65065011d84a55b485a1' => 
    array (
      0 => '/var/www/vipinsg/themes/theme895/modules/blocktopmenu/blocktopmenu.tpl',
      1 => 1403942698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34825254953ae6fd9d401d6-79606605',
  'cache_lifetime' => 31536000,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53ae9e2c02df80_93233592',
  'has_nocache_code' => false,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ae9e2c02df80_93233592')) {function content_53ae9e2c02df80_93233592($_smarty_tpl) {?></div>
<div class="menu_wrapper">
	<div class="container">
        <div id="menu-wrap" class="clearfix desktop">
            <div id="menu-trigger">Categories<i class="menu-icon icon-plus-sign-alt"></i></div>
                <ul id="menu-custom">
                <li ><a href="http://localhost/vipinsg/index.php">Home</a><ul><li ><a href="http://localhost/vipinsg/index.php?id_category=3&controller=category&id_lang=1">iPods</a></li><li ><a href="http://localhost/vipinsg/index.php?id_category=4&controller=category&id_lang=1">Accessories</a></li><li ><a href="http://localhost/vipinsg/index.php?id_category=5&controller=category&id_lang=1">Laptops</a></li></ul></li><li ><a href="http://localhost/vipinsg/index.php?id_category=3&controller=category&id_lang=1">iPods</a></li><li ><a href="http://localhost/vipinsg/index.php?id_category=4&controller=category&id_lang=1">Accessories</a></li><li ><a href="http://localhost/vipinsg/index.php?id_category=5&controller=category&id_lang=1">Laptops</a></li><li><a href="http://localhost/vipinsg/index.php?id_cms=4&controller=cms&id_lang=1">About us</a></li>
<li><a href="http://localhost/vipinsg/index.php?id_manufacturer=1&controller=manufacturer&id_lang=1">Apple Computer, Inc</a></li>
<li><a href="http://localhost/vipinsg/index.php?id_manufacturer=2&controller=manufacturer&id_lang=1">Shure Incorporated</a></li>

                                    </ul>
            </div>
        </div>
    <script type="text/javascript">
		$(document).ready(function() {
            $('#menu-custom li:has(ul)').addClass('hasSub');
			var i=1;
			$('#menu-custom > li').each(function() {
                $(this).addClass('cat-'+ i);
				i++;
            });
        });
	</script>
<?php }} ?>