<?php
/*
　dispatch・・(意)送る、送り出す、発送する
*/
class Dispatcher
{
    private $sysRoot;

    public function setSystemRoot($path)
    {
        $this->sysRoot = rtrim($path, '/'); //引数$pathの文字列から / を削除して$sysRootプロパティへ代入
    }

    public function dispatch()
    {
        // パラメーター取得（行頭末尾の / は削除）
        // 例: http://hoge.com/contr/act?id=5/ → contr/act?id=5
        //正規表現覚え：'\'→直後の特殊文字を普通の文字として扱う
        $param = preg_replace('/^\//', '', $_SERVER['REQUEST_URI']); //ﾄﾞﾒｲﾝ以下のURLの先頭が / で始まる場合は''で置換する（つまり / を削除する）
        $param = preg_replace('/\/$/', '', $param); //上記の$paramの末尾が / であった場合は、''で置換する（つまり / を削除する）

        $params = array();
        if ('' != $param) {
            $param = explode('?',$param)[0]; //$paramを ? で区切った配列とし、その0番目を$paramに代入(つまり ? 以降は省いて$paramに代入)  例: contr/act?id=5 → contr/act
            $params = explode('/', $param); // パラメーターを / で分割して配列として$paramsに代入。例: $params = ['contr','act']
        }

        // $params[0]をコントローラー名として取得（$params[0]='contr'ならContrControllerをインスタンス化）
        $controller = null;
        if (0 < count($params)) { //もし$paramsの配列の中身が存在したら
            $controller = $params[0]; //$paramsの0番目の値を$controllerに代入
        }
        // 設定ファイルに基づいたルーティング処理→もし命名規則以外で指定があれば適用される
        $controller = $this->transferControler($controller); //transferControlerは下部にあり
        // $controller = $params[0] = http://hoge.com/contr/actの "contr" をもとにコントローラークラスインスタンス取得
        // どうして"contr"からContrControllerのインスタンスが生成できるのかは、下方のgetControllerInstanceメソッドの実装を読むとわかる
        $controllerInstance = $this->getControllerInstance($controller);//引数$controllerのコントローラーが存在すれば、$controllerクラスのインスタンスを$controllerInstanceに代入
        if (null == $controller) { //生成するコントローラが見つからなければ404を返して終了
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        // $params[1]をアクション名として取得（$params[1]='act'actActionメソッドを実行)
        $action= "index";
        if (1 < count($params)) {
            $action = $params[1];
        }
        // アクションメソッドの存在確認
        // 例: ContrController.phpにactActionメソッドがあるかどうか確認している
        if (!method_exists($controllerInstance, $action . 'Action')) { //もし$controllerInstanceクラスの$actionメソッドが存在しなければ404を返す
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        // コントローラー初期設定
        $controllerInstance->setSystemRoot($this->sysRoot); //$controllerクラスのインスタンスの$sysRootプロパティから / を削除して$sysRootプロパティへ代入
        $controllerInstance->setControllerAction($controller, $action); // $controllerクラスのインスタンスの$contollerプロパティに引数$contoller,$actionプロパティに引数$actionを代入
        // 処理実行
        $controllerInstance->run();
    }

    // コントローラークラスのインスタンスを取得
    private function getControllerInstance($controller)
    {
        // "."で文字列連結。一文字目のみ大文字に変換＋"Controller"
        $className = ucfirst(strtolower($controller)) . 'Controller';
        // ディレクトリとコントローラーファイル名の生成（例：$controllerFileName = /Users/淳平/program/mvc_template/public/bbs/controllers/BbsContrController.php）
        $controllerFileName = sprintf('%s/controllers/%s.php', $this->sysRoot, $className);
        // ファイル存在チェック。なければ呼び出し元で404を返すため。
        if (false == file_exists($controllerFileName)) {
            return null;
        }
        // クラスファイルを読込
        require_once $controllerFileName;
        // クラスが定義されているかチェック
        if (false == class_exists($className)) { //もし$classNameのクラス名が存在しなかったら、nullを返す
            return null;
        }
        // クラスインスタンス生成
        $controllerInstarnce = new $className(); //もし$classNameのクラス名が存在したら、そのクラス名のクラスのインスタンスを$controllerInstanceに代入する

        return $controllerInstarnce;
    }

    //URLのコントローラ部がtransfer.iniのキーに一致すれば、実際の遷移先をiniで定義したコントローラに変更する
    //例：basic/get → HogeController@get
    private function transferControler($controller)
    {
        $iniPath = $this->sysRoot . '/ini/transfer.ini';
        if (file_exists($iniPath)) {
            $ini = parse_ini_file($iniPath);
            if (array_key_exists($controller, $ini)) {
                $controller = $ini[$controller];
            }
        }
        return $controller;
    }
}

?>
