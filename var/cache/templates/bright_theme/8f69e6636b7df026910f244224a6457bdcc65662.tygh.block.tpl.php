<?php /* Smarty version Smarty-3.1.21, created on 2017-02-12 15:41:35
         compiled from "C:\OpenServer\domains\localhost\cscart\design\themes\responsive\templates\views\block_manager\render\block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2107258a057ff81fc21-11429149%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f69e6636b7df026910f244224a6457bdcc65662' => 
    array (
      0 => 'C:\\OpenServer\\domains\\localhost\\cscart\\design\\themes\\responsive\\templates\\views\\block_manager\\render\\block.tpl',
      1 => 1486903167,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '2107258a057ff81fc21-11429149',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'block' => 0,
    'content_alignment' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a057ff843109_75930416',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a057ff843109_75930416')) {function content_58a057ff843109_75930416($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['block']->value['user_class']||$_smarty_tpl->tpl_vars['content_alignment']->value=='RIGHT'||$_smarty_tpl->tpl_vars['content_alignment']->value=='LEFT') {?>
    <div class="<?php if ($_smarty_tpl->tpl_vars['block']->value['user_class']) {?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['user_class'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['content_alignment']->value=='RIGHT') {?> ty-float-right<?php } elseif ($_smarty_tpl->tpl_vars['content_alignment']->value=='LEFT') {?>
    ty-float-left<?php }?>">
<?php }?>
        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php if ($_smarty_tpl->tpl_vars['block']->value['user_class']||$_smarty_tpl->tpl_vars['content_alignment']->value=='RIGHT'||$_smarty_tpl->tpl_vars['content_alignment']->value=='LEFT') {?>
    </div>
<?php }?><?php }} ?>