04-1. 데이타 아쿠세스를 처리하는 Model : MVD의 M
Framework상에서 Modeld은 메인처리
  (비지네스로지쿠)
DB처리를 하는 부분
Framework상에서 코딩할 때 DB 존재 여부를 의식하지 않고
소스코딩할 수 있도록...목표

Model을 나누어 구현 : ConnectionModel,  ExcuteModel
                   (DB연결관리 클래스) (SQL 실행 클래스)

※Controller에서 처리해야하는 것
1> Request와 Data입력을 처리
2> Model 호출
3> Model의 결과에 따라 View 생성을 요청
4> View 처리 결과 Response로 전달

1) ConnectionModel 클래스 : DB접속 관리 클래스
                        : PDO객체를 생성관리 클래스

2) ExecuteModel: DB아쿠세스 처리하는 기본 클래스
