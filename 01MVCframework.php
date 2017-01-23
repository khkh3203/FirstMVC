1. mvc framework 작성
1) 프레임워크(후레-므와-쿠)의 개념
framework: Web 어플이 사용하는 기본기능을 정리해 둔 것
어플: Application 의 약자.
기본기능?
중복적이고 반복적인 기능
<프레임워크가 담당하는 기본기능>
	ㄱ.사용자로부터의 Request처리(controller)
	ㄴ.DB처리(model)
	ㄷ.결과페이지를 송신: Response(view)

 Framework: 웹서비스를 제공하는 어플리케이션 개발시 필요
 (도구이다)	기본적인 처리에 대한 것들을 클래스로 정의해서 제공해주는 것.
 			프로그래머는 Framework 제공의 클래스들을 상속(계승) 하여 메소드 오버라이딩을 통해 개발.
 			프로그래머가 자기가 작성하고자 하는 서비스에 집중할 수 있도록 도와준다.

 			오버라이딩 된 메소드는 자동으로 호출됨.(다형성)

 			협업을 가능하게 해준다.(객체지향적이기 때문에):통일성 있는 코딩

2.MVC FrameWork
1>M:Model(모데루): Data Access담당 (Main처리)
	DB관련 , Business Logic: 비지네스 로짓쿠

2>V:view(뷰-): 처리의 결과 - HTML5(HTML+CSS+JS)

3>C:Controller(콘토로-라-):Client로부터의 Request정보를 이용하여 Model에 처리를 의뢰 한다.
							의뢰 결과가 return되어 오면 View에 화면생성을 의뢰.
							의뢰 결과가 return되면 Response를 해준다.

				<MVC 행동 순서>
					클라이언트가 프론트 콘트롤러에 요청.->
					 어플리케이션 실행(객체생성)->
					 컨트롤러를 실행-> 
					 컨트롤러는 모델에 데이터를 요청->
					 모델은 요청받은 데이터를 뷰에 보냄->
					 뷰는 html을 붙여서 콘트롤러에 보냄->
					 콘트롤러는 return 받은 정보를 클라이언트에 보내줌

A.객체지향 MVC의 Controller
Action(아쿠숀): 어떤 처리를 하는 것
				사용자의 Request에 대해 하나의 Action을 정의한다.

					Action이 하는 일
					1>DB에 대한 처리 요청 (DB접속):Model실행
					2> '1>'의 처리결과에 대해 화면 생성을 View에 요청

					※[][]Action()메소드가 해당 Request 만큼 존재
						ex)registAction()

B.객체지향 MVC의 Model
	Application의 독자적인 기능(비지니스로직)을 위한 DB처리(SQL문장)

C.객체지향 MVC의 View: 화면, UI


※MVC의 장점: 유지보수
1>Request에서 사용되는 URL의 변경 => 컨트롤러만 수정(Action메소드 이름만 바꾸면 됨.)
	모델이나 뷰의 수정은 없다.
2>뷰를 수정 => Model, Controller의 수정은 없음
3>비지니스로직의 변경 => View, Controller 수정 없음.

※최신 MVC Framework: Front Controller를 가지고 있음.
	Front Controller: 모든 처리의 기점(basePoint)-모든 처리를 여기서함.
		-모든 Request의 수용
		Request에 대해서 (URL정보를 이용하여) 실행해야 하는 Action을 판단.
		ex) http://www.example.com/index.php/login/user


Front controller vs Action Controller
[모든 처리의 기점] - [MVC의 C]

※Routing(루-팅구): 실행해야 하는 Controller와 Action을 결정.

ex)http://www.example.com/account  (Request URL)
	account Request : 처리 컨트롤러(Action Controller): AccountCountroller 
														Action에 대한 정보가 비어있으면 기본적으로
														 indexAction()을 사용함.	

※Application Class 에서 하는 일
1>		Routing을 실행 : 실행해야하는 Controller와 Action을 결정.
2> 		Controller의 instance화 진행 후, Action Method를 실행.
2-1>	Model실행 
2-2>	View실행
2-3>	(Controller가 View의 결과값을 client에 보냄)-Response


<<<Request~~~Response 처리 흐름>>>
1> Request발생 (URL 정보가 담겨있음)
2> Front Controller: index.php => Application Class의 Object를 생성(인스턴스화)
					=>Routing
3> Application Class의 Object로 제어권이 넘어옴.
	Application Class의 생성자 => Response,Request,Session,Router,BaseModel Class(ex_DB생성) 등의 
									Object를 생성.(Application이 돌아가기 위해 필요한 object 생성)
							=>Routing => Countroller & Action을 결정
							=>Countroller Object를 생성
							Action 호출정보를 넘겨줌

4> Action Controller로 제어권이 넘어옴.
							Action실행 =>Model의 객체생성=>DB처리 =>View 객체 생성 => 화면생성
							=>화면을 Application으로 전달 

5>Application Class의 객체
							Response Object의 메소드를 호출해서 전달받은 화면을 Client로 송신

6>Response
	화면을 클라이언트에게 보낸다.










<<<환경설정>>>
1.Virtual Host설정
httpd-vhosts.conf 파일
xampp설치폴더\apache\conf\extra\ 폴더내부

복+붙

NameVirtualHost *:80
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/"
    ServerName localhost
</VirtualHost>
<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\webBlog.localhost\mvc_htdocs"
    ServerName webBlog.localhost
    DirectoryIndex index.php index.html
</VirtualHost>


2. C:\Windows\System32\drivers\etc 폴더 내의 hosts파일 수정
수정내용>>
127.0.0.1 weblog.localhost


3) weblog.localhost\mvc_htdocs폴더내의 .htaccess파일 수정
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>


<<<파일작성>>>
1) Front Controller: index.php
2) BootStrap: bootstrap.php
3) Class Loader: Loader.php

파일 상호관계
1> Client의 Request
2> Front Controller의 실행(index.php)
	-BootStrap 실행 
	-Class Loading
	-
3> Application 실행
	





