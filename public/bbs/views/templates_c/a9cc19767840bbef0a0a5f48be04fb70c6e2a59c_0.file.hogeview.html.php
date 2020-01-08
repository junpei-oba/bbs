<?php
/* Smarty version 3.1.33, created on 2019-12-08 09:03:52
  from 'C:\Users\淳平\program\mvc_template\public\sample\views\templates\hoge\hogeview.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5decbc787c1948_91405928',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9cc19767840bbef0a0a5f48be04fb70c6e2a59c' => 
    array (
      0 => 'C:\\Users\\淳平\\program\\mvc_template\\public\\sample\\views\\templates\\hoge\\hogeview.html',
      1 => 1575615317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5decbc787c1948_91405928 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>

    <?php echo $_smarty_tpl->tpl_vars['hello']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['name']->value;?>


    <ul>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['logs']->value, 'log');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['log']->value) {
?>
        <li><?php echo $_smarty_tpl->tpl_vars['log']->value;?>
</li>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>

  </body>
</html>
<?php }
}
