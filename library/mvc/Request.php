<?php
/*
 $_GET,$_POSTはスーパーグローバル変数のため再代入可能。
 再代入可能ということは、ユーザーリクエストがサーバ側で変更できてしまうことになる。
 本来サーバ側では変更できてはいけないため、ユーザーリクエストの内容をクラス化して、
 取得のみできるようにするというルールを作る。
*/
class Request
{
    // POSTパラメータ
    private $post;
    // GETパラメータ
    private $query;
    // URLパラメータ
    private $param;

    // コンストラクタ
    public function __construct()
    {
        $this->post = new Post();
        $this->query = new QueryString();
        $this->param = new UrlParameter();
    }

    // POST変数取得
    // 引数なしでgetPost()が呼ばれたら$valuesをそのまま返す
    // 引数が存在して、$valuesの中に$keyが存在しなければnullを返す
    // 引数が存在して、$valuesの中に$keyが存在したら、
    // 連想配列$valuesの$keyがキーとなる値を返す
    public function getPost($key = null)
    {
        if (null == $key) {
            return $this->post->get(); //getメソッドはRequestVariables.phpに記載
        }
        if (false == $this->post->has($key)) { //hasメソッドはRequestVariables.phpに記載
            return null;
        }
        return $this->post->get($key);
    }

    // GET変数取得
    // 引数なしでgetQuery()が呼ばれたら$valuesをそのまま返す
    // 引数が存在して、$valuesの中に$keyが存在しなければnullを返す
    // 引数が存在して、$valuesの中に$keyが存在したら、
    // 連想配列$valuesの$keyがキーとなる値を返す
    public function getQuery($key = null)
    {
        if (null == $key) {
            return $this->query->get();
        }
        if (false == $this->query->has($key)) {
            return null;
        }
        return $this->query->get($key);
    }

    // URLパラメーター取得
    // 引数なしでgetParam()が呼ばれたら$valuesをそのまま返す
    // 引数が存在して、$valuesの中に$keyが存在しなければnullを返す
    // 引数が存在して、$valuesの中に$keyが存在したら、
    // 連想配列$valuesの$keyがキーとなる値を返す
    public function getParam($key = null)
    {
        if (null == $key) {
            return $this->param->get();
        }
        if (false == $this->param->has($key)) {
            return null;
        }
        return $this->param->get($key);
    }
}

?>
