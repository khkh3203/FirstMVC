02-1. Action응 실행하는 컨트롤러 : MVC의 C에 해당

Controller의 주요 목적 : Action을 실행
Controller의 종류
1) Front Controller
2) Action Controller
    APP에 의해 실행되어야 할 여러개의 Action을 정의
    Routing :
        Request된 URL로 부터 적절한 ActionController와 ActionMethod를 결정
    Dispatch :
        Request된 정보를 기반으로 ActionMethod를 실행
    Action Method 역할 :
        DB처리를 통해(Model Object) response로 보낼 화면(View)을 rendering함

※Action Controller의 기본기능 정의하는 클래스
  : 모든 Action Controller의 부모 클래스를 정의

실행순서
1>index.php : App 본체 클래스인스턴스화 함, run()실행
2>run()실행
2-1>Request된 URL을 분석(Routing관련처리=>Controller와 Action결정)
2-2>Controller와 Action명을 획득
2-3>App클래스의 getContent()실행
2-3-1>Controller의 서브클래스(Action Controller)를 인스턴스화
2-3-1-1>Action Controller의 dispatch()실행
2-3-1-1-1>Action Controller의 Action Method를 실행
          : 요청된 content(Rendering된 HTML 데이터 : view의 반환결과)를 받는다
2-3-1-2>Content가 Return
2-3-2>Content가 Return
2-4>Response 클래스에 결과처리
3>Response전송

※추상클래스 : 객체 생성 불가
 추상클래스를 정의하면 사용하기 위해서는 반드시 계승 후 사용해야 한다


※Action Method = 한개의 화면을 나타나게
  ex> 회원가입 화면(=>회원가입Action Method가 있어야 함)
