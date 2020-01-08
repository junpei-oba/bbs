<?php
/* Smarty version 3.1.33, created on 2019-12-20 02:27:44
  from 'C:\Users\淳平\program\mvc_template\public\bbs\views\templates\Bbs\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5dfc31a07598f8_54997763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d3d2142fcd0def2772d4edf43a7be5b5a81b6b3' => 
    array (
      0 => 'C:\\Users\\淳平\\program\\mvc_template\\public\\bbs\\views\\templates\\Bbs\\index.html',
      1 => 1576808851,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5dfc31a07598f8_54997763 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">

div.allbbs {
  width:800px;
  border:1px solid #888888;
  margin:5px 0 0 0;
  padding:10px;
  background-color:#FFEEFF;
}
form {
  display:inline;
  margin:0;
  padding:0;
}



</style>
</head>
<body>
  <h1>掲示板</h1>

  <form method="post" action="/Bbs/regist">
  タイトル<br /><input type="text" name="title" size="50" /><br />
  本文<br /><textarea name="body" cols="50" rows="8" placeholder="投稿内容"></textarea><br />
  <input type="submit" value="投稿"><br />
  </form>
  <h2>過去投稿一覧</h2><br />
  <div class="allbbs">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bbsdata']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
    <?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
<br />
    <?php echo $_smarty_tpl->tpl_vars['data']->value['body'];?>
<br /><br />
  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </div>

</body>
</html>
<?php }
}
