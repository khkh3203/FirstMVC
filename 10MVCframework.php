MVC Frame Work의 동작

Front Controller에서 Action이 실행되어 HTML이 출력되기까지의 과정 요약

1)Client (Browser)에서 URL접근
2)Front Controller(index.php)실행
3)App객체 생성 (AppBase클래스 계승한 BlogApp객체생성)
  4) App객체의 생성자 처리
    - Error표시 처리 여부 설정
    - initialize() 실행 :
      Request,Response,Router,Session,ConnectModel 객체생성
      =>Router객체 생성시 routeConverter()실행
      (Routing 정의에 대한 처리)
    - doDbConnection() 실행 <DB서버와 접속 처리>
      => PDO객체 생성 처리
5)App객체에서 run()실행
  6) Router의 getRouteParams() 실행
    => Routing 정의에 대한 Request URL에서 잘라낸
       경로정보를 패턴매칭시켜 Routing 정의에서
       경로정보, Controller명, Action명을 알아냄
  7) AppBase에 정의되어 있는 getContent()실행
     getContent(Controller명
                ,Action명
                ,Routing정의에서 경로정보)
     Controller명을 활용해서 Controller의 객체를 생성
     =>AppBase의 getControllerObject()를 이용
  8) 생성된 Controller객체를 이용 dispatch()실행
    dispatch(Action명,
             Routin정의에서 경로정보)
    => Action명을 이용해서 Action메소드를 실행
  9) Action메서드 실행

    10) 생성된 Controller객체의 render() 실행
        View클래스 객체 생성(view파일의 경로와,
                            Default 정보)
        View클래스의 render()실행
        render(Controller명/Action명,
               Action메서드에서 전달된 Token등의 Data,
               Layout파일명)
  11) HTML정보를 Response의 $_Content에 설정
  12) Response의 send()실행
       : HTTP Header+body(HTML contents)


URL예제
- http://weblog.localhost/index_error.php/accoutn/signup.php
  BaseURL : index_error.php
  Path    : /account/signup.php
  http://weblog.localhost/accoutn/signup.php
  BaseURL : index.php
  Path    : /account/signup.php
