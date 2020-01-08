<?php
/*
  各コントローラで必ず呼び出す処理を共通化する
  使用するテンプレートの指定も、コントローラやアクション名と命名規則で関連付けることでいちいち設定しないようにする
*/
abstract class ControllerBase
{
    protected $systemRoot;
    protected $controller = 'index';
    protected $action = 'index';
    protected $view;
    protected $request;
    protected $templatePath;

    // コンストラクタ
    public function __construct()
    {
        $this->request = new Request();
    }

    // システムのルートディレクトリパスを設定
    public function setSystemRoot($path)
    {
        $this->systemRoot = $path; //$systemRootプロパティに$pathを代入
    }

    // コントローラーとアクションの文字列設定
    public function setControllerAction($controller, $action)
    {
        $this->controller = $controller; //$controllerプロパティに引数$controllerを代入
        $this->action = $action;  //$actionプロパティに引数$actionを代入
    }

    // 処理実行
    public function run()
    {
        try {

            // ビューの初期化
            $this->initializeView();

            // 共通前処理（子クラスで定義される）
            $this->preAction();

            // アクションメソッド
            $methodName = sprintf('%sAction', $this->action);
            $this->$methodName();
            // 表示
            $this->view->display($this->templatePath);

        } catch (Exception $e) {
            // ログ出力等の処理を記述
        }
    }

    // ビューの初期化
    protected function initializeView()
    {
        $this->view = new Smarty(); // Smartyのインスタンスを$viewプロパティに生成し代入
        $this->view->template_dir = sprintf('%s/views/templates/', $this->systemRoot);  // テンプレートディレクトリの初期パス設定
        $this->view->compile_dir = sprintf('%s/views/templates_c/', $this->systemRoot); // コンパイルされたテンプレートが置かれるディレクトリを設定
        $this->templatePath = sprintf('%s/%s.html', $this->controller, $this->action); //views/Controller名/action名.html＝命名規則によるビューテンプレート指定の自動化
    }

    // 共通前処理（オーバーライド前提）※何か実装した方がよい共通前処理があればここに記載する
    protected function preAction()
    {
    }

    // リダイレクト
    public function redirect($url)
    {
      $redirectUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$url;
      // 下記ログを仕込んで、今$redirectUrlにどんな値が入っているかをターミナルで確認
      // $find_error_log = "C:\MAMP\logs\phpLog.log";
      // file_put_contents($find_error_log,'★★'.$redirectUrl."\n");

      header('Location: ' . $redirectUrl);
      exit();
    }


 }

?>
