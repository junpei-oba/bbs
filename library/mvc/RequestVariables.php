<?php
/*
 リクエスト変数抽象クラス
 Post.php,QueryString.php,UrlParameter.phpの共通処理をまとめている
*/
abstract class RequestVariables
{
    protected $values;

    // コンストラクタ
    public function __construct()
    {
        $this->setValues();
    }

    // パラメータ値設定。protected＝このクラスと子クラスのみ参照可＝Request.phpやその他のクラスから値をセットすることは不可
    abstract protected function setValues();

    // 指定キーのパラメータを取得
    // 引数なしでget()が呼ばれたら$valuesをそのまま返す
    // 引数が存在したら、連想配列$valuesの$keyがキーとなっている値を返す
    public function get($key = null)
    {
        $ret = null;
        if (null == $key) { //もし$keyが存在しなければ
            $ret = $this->values; //$valuesプロパティの値を$retに代入する
        } else { //$keyが存在したら
            if (true == $this->has($key)) { //もし連想配列$valuesプロパティの中に$keyが存在する場合
                $ret = $this->values[$key]; //$valuesプロパティの$keyがキーとなっている値を$retに代入する
            }
        }
        return $ret;
    }

    // 指定のキーが存在するか確認
    // $valuesの中に$keyが存在すればtrue,しなければfalseを返す
    public function has($key)
    {
        return array_key_exists($key, $this->values);
    }
}

?>
