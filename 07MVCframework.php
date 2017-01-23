Routing을 하는 Router클래스

  모든 Request는 Front Controller에서 전달
  Routing : Request URL로 부터 Action Controller와 Action 명을 구해내는 것

※MVC에서 URL을 다루는 방법들
 : Directory변조
   MVC에서 웹페이지 != php파일

통상적인 GET방법
  http://www.example.com/bbs.php?mode=browse&page=2; 이런식

방법 1>
  http://www.example.com/bbs/browse&page=2
  Controller : bbs / action명 : browse / parameter : 2

방법 2> 물음표와 & 를 없애자
  http://www.example.com/bbs/browse/page/2
  도메인명/키1/값1/키2/값2

방법 3> 다양하게 존재할 수 있다.

※Routing 정보의 정의 : AppBase클래스의 서브클래스의 getRouteDefinition()에서 처리
