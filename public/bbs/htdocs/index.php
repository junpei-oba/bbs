<?php

$mvc_library_path = 'C:\Users\淳平\program\mvc_template\library\mvc\\';
$public_sapmle_path = 'C:\Users\淳平\program\mvc_template\public\bbs\\';
/*
上記2行の末尾の'\\'について
'\'は正規表現のエスケープ文字の為、'\\'と表記している
*/


//必要な外部phpファイルの読み込みは全てここで行っている。
require_once $mvc_library_path.'Dispatcher.php';
require_once $mvc_library_path.'RequestVariables.php';
require_once $mvc_library_path.'Post.php';
require_once $mvc_library_path.'QueryString.php';
require_once $mvc_library_path.'Request.php';
require_once $mvc_library_path.'ControllerBase.php';
require_once $mvc_library_path.'ModelBase.php';
require_once $mvc_library_path.'UrlParameter.php';
require_once $mvc_library_path.'Smarty\Smarty.class.php';

require_once $public_sapmle_path.'models\Bbs.php';

// DB接続情報設定
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'bbs',
    'charset'   => 'utf8mb4',
    'dbuser'   => 'root',
    'password' => 'root',
    'port' => '3308'
);
//ModelBaseの$connInfoはstaticであるので、インスタンスを超えて共有される値
ModelBase::setConnectionInfo($connInfo);

$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot('C:\Users\淳平\program\mvc_template\public\bbs'); //setSystemRootメソッドはControllerBase.phpに記載
$dispatcher->dispatch(); //全ての処理の起点、Dispatcherクラスのdispatchメソッドへ

?>
