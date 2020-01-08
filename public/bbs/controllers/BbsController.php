<?php

class BbsController extends ControllerBase
{
    //掲示板一覧情報表示
     public function indexAction()
     {
       $bbs = new Bbs();
       // データ取得
       $bbsdata = $bbs->getAll();
       // var_dump($bbsdata);
       // index.htmlに$bbsdataのデータを渡して出力
       $this->view->assign("bbsdata", $bbsdata);
       // このページのタイトルを設定
     }

      // 投稿処理
     public function registAction()
     {
       $post = $this->request->getPost();

       $bbs = new Bbs();
       // $bbs->create($post);
       $bbs->regist($post);
       // $bbs->regist(["title"=>"123","body"=>"456"]);
       $this->redirect('Bbs/index');

      }
}

?>
