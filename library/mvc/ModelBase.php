<?php

class ModelBase
{
    //static変数＝インスタンス間で共有する値
    private static $connInfo;
    protected $db;
    protected $name;

    public function __construct()
    {
        $this->initDb(); //下方のinitDbメソッド参照（PDOでmysqlのデータベースに接続して、PDOクラスのインスタンスを$dbへ代入する）
        // 継承先で$nameが設定されていない場合はクラス名からテーブル名を生成
        if ($this->name == null) { // もしnameプロパティが存在しなければ
            $this->setDefaultTableName(); //このファイル下部に記載のsetDefaultTableNameを実行
        }
    }

    // PDOでmysqlのデータベースに接続して、PDOクラスのインスタンスを$dbへ代入する
    public function initDb()
    {
        $dsn = sprintf(
          // データベース接続に必要な下記情報を$dsnに代入する
          // 連想配列$connInfo()のキーが'host','port','dbname','charset'である値を、
          // 'mysql:host=%s;port=%s;dbname=%s;charset=%s'の'%s'にそれぞれ代入する
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            self::$connInfo['host'],
            self::$connInfo['port'],
            self::$connInfo['dbname'],
            self::$connInfo['charset']
        );
        // PDOでmysqlのデータベースに接続。PDOクラスのインスタンスを$dbへ代入
        $this->db = new PDO($dsn, self::$connInfo['dbuser'], self::$connInfo['password']);
    }

    // データベース接続に関する情報を$connInfoへ代入する
    public static function setConnectionInfo($connInfo)
    {
        self::$connInfo = $connInfo;
    }

    // クエリ結果を取得
    public function query($sql, array $params = null)
    {
        $stmt = $this->db->prepare($sql); // PDOクラスのインスタンス(データベース接続情報)をprepare段階(データベース接続前準備段階)にして、$stmtへ代入
        if ($params != null) { // 引数$paramsの中身が存在したら
            foreach ($params as $key => $val) { //連想配列$paramsのキー$key、値$valをバインドする(セキュリティ向上のため)
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute(); // $stmtに入っているクエリを実行する
        $rows = $stmt->fetchAll(); // クエリ実行結果を$rowsへ代入する

        return $rows;
    }

    // INSERTを実行
    public function insert($data)
    {

      // $dataを出力-----
      // $error_log = "C:\MAMP\logs\php_error.log";
      // ----------------------

        $fields = array();
        $values = array();
        // 連想配列$dataの$keyを配列$fieldsに、':$key'を配列$valuesに代入
        foreach ($data as $key => $val) {
            $fields[] = $key;
            $values[] = ':' . $key;
        }
        // 下記SQL文を$sqlに代入
        // $nameテーブルの$fieldsカラムを','区切りで文字列にしたものを、
        // $valuesを','区切りで文字列にしたものに挿入する
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->name,
            implode(',', $fields), //'title','body'
            implode(',', $values)  //':title',':body'
        );

        // $sqlも出力-----
        // file_put_contents($error_log,'★★'.$sql."\n");
        // -----------------------------

        $stmt = $this->db->prepare($sql); // prepareメソッドを用いて$stmtへSQL文をセット
        // 引数の連想配列$dataのキー$key,値$valをbindValueメソッドを用いて
        // パラメータに値をセット
        foreach ($data as $key => $val) {
            $stmt->bindValue(':' . $key, $val);
        }
        $res  = $stmt->execute(); // executeメソッドでクエリ実行
        return $res;
    }

    // DELETEを実行！未検証
    public function delete($where, $params = null)
    {
        // $sqlにPDOのdelete文(途中まで)を代入。※テーブル名は$name
        $sql = sprintf("DELETE FROM %s", $this->name);

        if ($where != "") { // もし引数$whereが存在したら、
            $sql .= " WHERE " . $where; // "DELETE FROM $nameテーブル WHERE 条件$where"のSQL文を$sqlに代入
        }
        $stmt = $this->db->prepare($sql); // prepareメソッドを用いて$stmtへSQL文をセット

        if ($params != null) { // もし引数の連想配列$paramsが存在したら、
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val); // キー$key,値$valをbindValueメソッドを用いてパラメータに値をセット
            }
        }

        $res = $stmt->execute(); // executeメソッドでクエリ実行

        return $res;
    }

    //キャメルケースで命名されたクラス名からスネークケースのテーブル名を自動生成！動作未検証
    public function setDefaultTableName()
    {
        $className = get_class($this);
        $len = strlen($className); //$classNameの文字列の長さ（数値）を$lenに代入
        $tableName = '';
        for ($i = 0; $i < $len; $i++) {
            $char = substr($className, $i, 1); //文字列$classNameの$i番目の文字を$charに代入
            $lower = strtolower($char); //文字列$classNameのi番目の文字を小文字に変換して$lowerに代入
            if ($i > 0 && $char != $lower) { //もし文字列$classNameの先頭文字以外で、かつ$charが大文字だった場合
                $tableName .= '_'; //$tableName = $tableName.'_'
            }
            $tableName .= $lower; //$tableName = $tableName.$lower
        }
        $this->name  = $tableName; //ModelBaseクラスのnameプロパティに$tableNameを代入する
    }
}

?>
