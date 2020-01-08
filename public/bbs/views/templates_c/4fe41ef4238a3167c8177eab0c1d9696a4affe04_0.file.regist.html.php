<?php
/* Smarty version 3.1.33, created on 2019-12-19 18:27:17
  from 'C:\Users\淳平\program\mvc_template\public\bbs\views\templates\Bbs\regist.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5dfbc105322941_02386286',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4fe41ef4238a3167c8177eab0c1d9696a4affe04' => 
    array (
      0 => 'C:\\Users\\淳平\\program\\mvc_template\\public\\bbs\\views\\templates\\Bbs\\regist.html',
      1 => 1576780031,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5dfbc105322941_02386286 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
  <head>
    <meta charset="utf-8" />
    <title>新規投稿</title>
  </head>
  <body>
    <h1>掲示板～新規投稿画面～</h1>
    <form action="http://localhost:84/Bbs/index" method="post" id="postnews">
      <table summary="新規投稿画面">
      <tr>
        <th><label for="title">件名</label><br></th>
        <td><input type="text" name="title" size="30" id="title" </td>
      </tr>
      <tr>
        <th><label for="body">内容</label></th>
        <td><textarea name="body" cols="32" rows="5" id="body" placeholder="投稿内容" ></textarea></td>
      </tr>
      </table>
      <div class="submit">
        <input type="submit"  name="post_new" value="投稿する">
      </div>
    </form>
  <a href= "http://localhost:84/Bbs/index">投稿記事一覧へ</a>
  </body>
</html>
<?php }
}
