<?php /* Smarty version Smarty-3.1.21, created on 2017-02-12 15:41:31
         compiled from "C:\OpenServer\domains\localhost\cscart\design\themes\responsive\templates\addons\seo\hooks\index\meta_description.override.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2277858a057fb5ef1b3-74518417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55fec9d6866b3421115013a99b3a8a418d1a1866' => 
    array (
      0 => 'C:\\OpenServer\\domains\\localhost\\cscart\\design\\themes\\responsive\\templates\\addons\\seo\\hooks\\index\\meta_description.override.tpl',
      1 => 1486903175,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '2277858a057fb5ef1b3-74518417',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'search' => 0,
    'meta_description' => 0,
    'location_data' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a057fb644c38_00863433',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a057fb644c38_00863433')) {function content_58a057fb644c38_00863433($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'C:/OpenServer/domains/localhost/cscart/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['search']->value&&($_smarty_tpl->tpl_vars['meta_description']->value||$_smarty_tpl->tpl_vars['location_data']->value['meta_description'])) {?>
<meta name="description" content="<?php echo htmlspecialchars((($tmp = @html_entity_decode($_smarty_tpl->tpl_vars['meta_description']->value,@constant('ENT_COMPAT'),"UTF-8"))===null||$tmp==='' ? $_smarty_tpl->tpl_vars['location_data']->value['meta_description'] : $tmp), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(fn_get_seo_page_title($_smarty_tpl->tpl_vars['search']->value), ENT_QUOTES, 'UTF-8');?>
" />
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/seo/hooks/index/meta_description.override.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/seo/hooks/index/meta_description.override.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['search']->value&&($_smarty_tpl->tpl_vars['meta_description']->value||$_smarty_tpl->tpl_vars['location_data']->value['meta_description'])) {?>
<meta name="description" content="<?php echo htmlspecialchars((($tmp = @html_entity_decode($_smarty_tpl->tpl_vars['meta_description']->value,@constant('ENT_COMPAT'),"UTF-8"))===null||$tmp==='' ? $_smarty_tpl->tpl_vars['location_data']->value['meta_description'] : $tmp), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(fn_get_seo_page_title($_smarty_tpl->tpl_vars['search']->value), ENT_QUOTES, 'UTF-8');?>
" />
<?php }
}?><?php }} ?>
