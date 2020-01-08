<?php
/* Smarty version 3.1.33, created on 2019-12-19 07:59:17
  from 'C:\Users\淳平\program\mvc_template\public\bbs\views\templates\Bbs\bbsview.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5dfb2dd5d56146_98427926',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6bc0a3522315ff9d57f24ff126b25aa3e13a6d66' => 
    array (
      0 => 'C:\\Users\\淳平\\program\\mvc_template\\public\\bbs\\views\\templates\\Bbs\\bbsview.html',
      1 => 1576742355,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5dfb2dd5d56146_98427926 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
    <ul>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bbsdata']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
         <?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
:<?php echo $_smarty_tpl->tpl_vars['data']->value['body'];?>
<br />
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>

    <a href= "http://localhost:84/Bbs/index">新規投稿画面へ</a>
  </body>
</html>
<?php }
}
