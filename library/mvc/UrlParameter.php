<?php

/*
  これまではURLのドメイン移行部分が２つまで(controller/action)であることが前提、それ以降は無視する作りだったが
  https://hoge.com/controller/action/2 = 2ページ目を表示、のように３つ目以降をパラメータとして利用する仕組みを実装する
*/
class UrlParameter extends RequestVariables
{
    protected function setValues()
    {
        // パラメーター取得（行頭末尾の / は削除）
        $param = preg_replace('/^\//', '', $_SERVER['REQUEST_URI']);
        $param = preg_replace('/\/$/', '', $param);

        $params = array();
        if ('' != $param) { //もし$paramが存在したら
            //http://hoge.com/contr/act/p?q=3 のq以降を除く
            $param = explode('?',$param)[0]; //文字列$paramを ? ごとに区切って配列とし、その0番目を$paramに代入（つまり ? 以降は削除）
            $params = explode('/', $param); // パラメーターを / で分割して配列として$paramsに代入
        }

        if (2 < count($params)) { //もし、配列$paramsの要素が2より多い場合
            foreach ($params as $param) {
                // "_"で分割。例：/page_2・・$param['page']で２が取れる
                $splited = explode('_', $param);
                if (2 == count($splited)) {
                  $key = $splited[0];
                  $val = $splited[1];
                  $this->values[$key] = $val;
                }
            }
        }
    }
}

?>
