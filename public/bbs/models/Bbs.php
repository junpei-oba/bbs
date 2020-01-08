<?php

class Bbs extends ModelBase
{
  // テーブル名設定
    protected $name = 'news';

    //掲示板一覧情報取得
    public function getAll()
    {
        $sql = sprintf('SELECT * FROM %s' , $this->name);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        // var_dump($rows);
        return $rows;
    }

    // 新規投稿
    public function postNews($title, $body)
    {
        $sql = sprintf('INSERT INTO %s (id, title, body) VALUES(null , :title, :body)', $this->name);
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':body', $body, PDO::PARAM_STR);
        $res = $stmt->execute();
        return $res;
      }

    // 追加投稿  引数$dataは連想配列
    public function add($data)
    {
       return $this->insert($data); //insertメソッドはModelBase.phpに記載あり
    }

    //idをキーとしてデータベースからデータを取得
    public function getById($id)
    {
       $sql = sprintf('SELECT * FROM %s where id = :id', $this->name); //nameテーブルのid=:idを選択
       $params = array('id' => $id); //キー'をid'、値を引数の$idとする連想配列を$paramsに代入
       return $this->query($sql, $params);//queryメソッドはModelBase.phpに記載あり
    }

    // 記事登録
    public function regist($data)
    {
        // $vals['title']  = $data['title'];
        // $vals['body'] = $data['body'];
        $res = $this->insert($data);


        return $res;
      }

      // 新規記事作成
      public function create($data)
          {
              $sql = sprintf('INSERT INTO %s (title,body) VALUES(:title, :body)', $this->name);
              $stmt = $this->db->prepare($sql);
              $stmt->bindValue(':title', $data["title"]);
              $stmt->bindValue(':body', $data["body"]);
              $res = $stmt->execute();
              return $res;
          }


}

?>
