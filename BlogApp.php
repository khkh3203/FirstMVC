<?php
class BlogApp extends AppBase {

  protected $_signinAction = array('account', 'login');

  //DB접속 실행
  protected function doDbConnection() {
    $this->_connectModel->connect('master', //접속이름
    array(
      'string'    => 'mysql:dbname=kim;host=localhost;charset=utf8',  //DB이름 - weblog
      'user'      => 'root',                                            //DB사용자명
      'password'  => ''                                             //DB사용자의 패스워드
    ));
  }//doDbConnection - function

  //Root Directory 경로를 반환
  public function getRootDirectory() {
    return dirname(__FILE__); //BlogApp.php가 저장되어 있는 디렉토리
    //http://php.net/menual/en/function.dirname.php
  }//getRootDirectory - function

  //Blog APP에서 사용되는 Controller, Action
  //Contorller  - action    - path정보                    - 내용
  //----------------------------------------------------------------------------
  //1)account   - index     - /account                    - 계정 정보의 톱페이지
  //2)account   - signin    - /account/:action            - 로그인
  //3)account   - signout   - /account/:action            - 로그아웃
  //4)account   - signup    - /account/:action            - 계정등록
  //5)account   - follow    - /follow                     - 계정등록(회원가입)
  //6)blog      - index     - /                           - 블로그의 톱페이지
  //7)blog      - post      - /status/post                - 글작성
  //8)blog      - user      - /user/:user_name            - 사용자 작성글 일람
  //9)blog      - specific  - /user/:user_name/status/:id - 작성글의 상세보기


  //Routiong 정의를 반환
  protected function getRouteDefinition() {
    return array(
      //AccountController 클래스 관련 Routing
      '/account/login'                           => array('controller' => 'account', 'action' => 'login'),
      '/account/join'                            => array('controller' => 'account', 'action' => 'join'),
      '/account/regist'                          => array('controller' => 'account', 'action' => 'regist'),
      '/account/loginsubmit'                     => array('controller' => 'account', 'action' => 'authenticate'),
      '/account/logout'                          => array('controller' => 'account', 'action' => 'logout'),
      //ItemController 클래스 관련 Routing
      '/item/:good/:num'                         => array('controller' => 'item', 'action' => 'showList'),
      '/detail/:num'                             => array('controller' => 'item', 'action' => 'detail'),
      '/delete/:num'                             => array('controller' => 'item', 'action' => 'delete'),
      '/update/:num'                             => array('controller' => 'item', 'action' => 'update'),
      '/updateSubmit'                            => array('controller' => 'item', 'action' => 'updateSubmit'),
      '/buyItem'                                 => array('controller' => 'item', 'action' => 'buyItem'),
      '/upload'                                  => array('controller' => 'item', 'action' => 'upload'),
      '/regist'                                  => array('controller' => 'item', 'action' => 'itemRegister'),
      //shopController 클래스 관련 Routing
      '/'                                        => array('controller' => 'shop', 'action' => 'index'),
      '/shop/board/:offset/page/:page'           => array('controller' => 'shop', 'action' => 'board'),
      '/shop/detail/:num'                        => array('controller' => 'shop', 'action' => 'detail'),
      '/shop/post'                               => array('controller' => 'shop', 'action' => 'post'),
      '/shop/postRegist'                         => array('controller' => 'shop', 'action' => 'regist'),
      '/shop/update'                             => array('controller' => 'shop', 'action' => 'update'),
      '/shop/commit'                             => array('controller' => 'shop', 'action' => 'commit'),
      '/shop/delete/:num'                        => array('controller' => 'shop', 'action' => 'delete'),
      '/shop/download/:file'                     => array('controller' => 'shop', 'action' => 'download'),
      '/ripple/comment'                          => array('controller' => 'shop', 'action' => 'comment'),
      '/ripple/delete/:rnum/board/:num'          => array('controller' => 'shop', 'action' => 'discomment'),
      //UserController 클래스 관련 Routing
      '/user/unmember'                           => array('controller' => 'user', 'action' => 'unmember'),
      '/user/update'                             => array('controller' => 'user', 'action' => 'update'),
      '/user/history/:offset/page/:page'         => array('controller' => 'user', 'action' => 'history'),
      '/user/creator'                            => array('controller' => 'user', 'action' => 'creator'),
      '/user/regist'                             => array('controller' => 'user', 'action' => 'regist'),

    );

  }//getRouteDefinition - function

}//BlogApp -class

 ?>
