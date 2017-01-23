9_1.AppBase를 상속받은 BlogApp클래스 작성

10_1. 모든페이지에서 사용할 Layout file작성
파일명 : template.php
경로   : weblog.localhost/views/

View클래스와 관련, 구체적으로는 ..

10_2. 파일경로는 require된경우 require한 파일의 경로를 가리킨다.


11.MVC framework 이용하여 Web app만들기
1)AppBase를 계승한 클래스를 작성해야 함
  doDbConnection()
  getRouterDefinition() : Controller, Action

2)Controller의 작성
  ActionMethod를 작성

1>AccountController를 작성
