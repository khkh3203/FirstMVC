<?php
class ShopController extends Controller{
  protected $_authentication = array('post','delete','update','comment','commit','discomment'); //로그인이 필요한 액션
  const DETAIL = "shop/detail";
  const UPDATE = "shop/update";
  const POST = "shop/post";

//아무것도없는 메인화면
  public function indexAction(){
    $index_view = $this->render();
    return $index_view;
  }

  //게시판 리스트
    public function boardAction(){
      list($dump,$dump,$offset,$dump,$mypage) = explode('/',ltrim($this->_request->getPath(),'/'));
       //offset = 오프셋 값 (현재오프셋)
       //mypage = 페이징 값 (현재페이지값)

      $_block = 20; //한블럭당 게시글 수
      $_page  = 10; //한페이지당 블럭수
      $isPrev = false;
      $isNext = true;
      $max    = $_page;
      //페이징 limit(시작값,추출하는 행의수20)
      //전체 게시글수 추출
      $rows = $this->_connect_model->get('board')->boardCount();
      //1차 페이징 20게시글 => 1블럭(20)
      for($i=$rows,$block=0;$i>=0;$i-=$_block){
        $block++;
      }
      //2차 페이징 10블럭 => 1페이지(200)
      for($i=$block,$page=0;$i>=0;$i-=$_page){
        $page++;
      }

      //이전 버튼 유무
      if($mypage > 1){
        $isPrev = true;
      }
      //다음 버튼 유무
      if($mypage == $page){
        $isNext = false;
        $max    = $block%10;
        if($max == 0){
          $max = $_page;
        }
      }
      // echo $offset."<br>";
      // echo $mypage."<br>";
      // echo $rows."<br>";  //전체 게시글 수
      // echo $block."<br>"; //블럭수
      // echo $page."<br>";  //페이지 수

      //보드리스트를 들고온다.
      $boards = $this->_connect_model->get('board')->getBoards($offset,$_block);

      //렌더링
      $board_view = $this->render(array(
        '_boards' => $boards,
        '_isnext' => $isNext,
        '_isprev' => $isPrev,
        '_page'   => $mypage,
        '_num'    => ($mypage-1)*10,
        '_size'   => $_block,
        '_now'    => ($mypage-1)*200,
        '_max'    => $max,
      ));

      return $board_view;
    }

  //게시판 상세보기
    public function detailAction(){
      $arr = ltrim($this->_request->getPath(),'/');
      $arr = explode('/',$arr);
      //배열의 맨뒤의 값 추출
      $num = array_pop($arr);
      //경로의 넘버값 잘라내기  num
      $user = $this->_session->get('user');
      //유저 세션값 추출

      $isFile = false;  //파일존재여부
      $isMy   = false;  //게시글이 자기것인지 여부

      //조회수 증가
      $this->_connect_model->get('board')->increView($num);
      //해당 게시글 데이터 추출
      $board = $this->_connect_model->get('board')->getBoardDetail($num);

      //파일이 존재하면 지정된 문자열을 기준으로 나눈다.
      if($board['file'] != 'none' ){
        list($dump,$file)  = explode('_FILE_UNIQUE_NUMBER_',$board['file']);
        $isFile = true;
      }else{
        $file='';
      }
      //관리자 / 게시글 작성자id일 경우 버튼 활성화
      if($user['id'] == 'admin' || $user['id'] == $board['id']){
        $isMy = true;
      }

      //해당 게시글의 댓글 추출
      $ripples = $this->_connect_model->get('board')->getRipple($num);

      $detail_view = $this->render(array(
        '_ripples'=> $ripples,
        '_file'   => $file,
        '_ismy'   => $isMy,
        '_isfile' => $isFile,
        '_board'  => $board,
        '_token'  => $this->getToken(self::DETAIL),
      ));

      return $detail_view;
    }

  //게시글 작성페이지
    public function postAction(){
      $h    = date("H")-4;
      $time = date("Y년m월d일 - $h:i:s");

      $post_view = $this->render(array(
        '_time'   => $time,
        '_token'  => $this->getToken(self::POST),
      ));

      return $post_view;
    }

  //게시글 작성작업 POST
    public function registAction(){
      //토큰체크
      $token = $this->_request->getPost('_token');
      if(!$this->checkToken(self::POST,$token)){
        return $this->redirect('/');
      }

      if(isset($_FILES['board_file']) && !$_FILES['board_file']['error']){
        //파일을 넣었을때만 동작
        $uploadDir = 'C:/xampp/htdocs/shopmall.localhost/mvc_htdocs/files/';
        //디렉토리 문자열
        $filename   = basename(rand(0,9999999).'_FILE_UNIQUE_NUMBER_'.$_FILES['board_file']['name']);
        //파일명만 저장된 변수
        //db에 등록가능한 파일명
        //중복이름 제거 랜드함수이용 파일명과 넘버를 확실히 나누기 위해서 문자열 사용
        //나누는 이유는 파일 다운로드시 파일명을 깔끔하게 표기하기 위해서임

        $filenameEncode = iconv("UTF-8","EUC-KR",$filename);
        //한글파일명 폴더에 저장되게 인코딩  | db에 등록할 수 없는 형태임
        //메소드에서 사용할때 UTF-8을  EUC-KR
        //db에서 사용할때 EUC-KR을 UTF-8로 전환할 것
        $uploadFile = $uploadDir.$filenameEncode;   //경로포함 전체경로
        //이미지 경로 문자열 파일이름 랜덤으로해서 중복저장가능

        if(!move_uploaded_file($_FILES['board_file']['tmp_name'], $uploadFile)){
          //이미지 업로드 성공시 true
           echo "<script>
              alert('업로드에 문제가 발생하였습니다. 파일을 확인하여 주세요');
           </script>";
          return $this->redirect('/shop/board/0/page/1');
        }
      }else{
        //파일이 없으면 없다고 저장
        $filename = 'none';
      }
      //post값 변수에 저장

      $title  = $this->_request->getPost('title');
      $id     = $this->_request->getPost('id');
      $name   = $this->_request->getPost('name');
      $time   = $this->_request->getPost('time');
      $content= $this->_request->getPost('content');

      //게시글 등록
        $this->_connect_model->get('board')->setBoard($title,$id,$name,$time,$content,$filename);
      //리다이렉트
      return $this->redirect('/shop/board/0/page/1');
    }

  //게시글 삭제
    public function deleteAction(){
      //경로의 넘버값을 잘라낸다
      $path = explode('/',ltrim($this->_request->getPath(),'/'));
      $num = array_pop($path);

      // echo $num;

      $board = $this->_connect_model->get('board')->getBoardDetail($num);

      if($board['file'] == 'none'){
        //파일이없으면 아무것도 하지않음
      }else{
        //파일이 있으면 경로 파일 삭제
        unlink("C:/xampp/htdocs/shopmall.localhost/mvc_htdocs/files/".$board['file']);
      }
      //데이터베이스에서 삭제
      $this->_connect_model->get('board')->deleteBoard($num);

      //목록으로 리다이렉트
      return $this->redirect('/shop/board/0/page/1');

    }

  //게시글 수정페이지
    public function updateAction(){
      $num = $this->_request->getPost('num');
      //경로의 넘버값 잘라내기  num
      $user = $this->_session->get('user');

      $id   = $this->_request->getPost('id');
      if($user['id'] != $id){
        //관리자 체크
        return $this->redirect('/');
      }
      $board = $this->_connect_model->get('board')->getBoardDetail($num);
      //넘버값에 따른 상품데이터 출력

      if($board['file'] == 'none'){
        $file = "없음";
        $dumpNumber = '없음';
        //의미없는 변수 초기화하지않으면 에러발생
      }else{
        list($dumpNumber,$file) = explode('_FILE_UNIQUE_NUMBER_',$board['file']);
      }//파일 유무에 따른 폼변경

      $board_view = $this->render(array(
        '_dump'    => $dumpNumber,
        '_file'    => $file,
       '_board'    => $board,
       '_token'    => $this->getToken(self::UPDATE),
      ));
      return $board_view;
    }
  //게시글 수정 처리 UPDATE
    public function commitAction(){
      //토큰처리
      $token = $this->_request->getPost('_token');
      if(!$this->checkToken(self::UPDATE,$token)){
        return $this->redirect('/');
      }
      if(isset($_FILES['board_file']) && !$_FILES['board_file']['error']){
        //파일을 넣었을때만 동작
        if($this->_request->getPost('file') != '없음'){
          //파일넣었을떄 기존파일 남아있으면 경로에있는 기존파일 삭제
          $filedir = "../files/";
          unlink($filedir.$this->_request->getPost('dumpNumber').'_FILE_UNIQUE_NUMBER_'.$this->_request->getPost('file'));
            //파일삭제 되었으면 참 , 아니면 거짓
        }

        $uploadDir = 'C:/xampp/htdocs/shopmall.localhost/mvc_htdocs/files/';
        //디렉토리 문자열
        $filename   = basename(rand(0,9999999).'_FILE_UNIQUE_NUMBER_'.$_FILES['board_file']['name']);
        //파일명만 저장된 변수
        //db에 등록가능한 파일명

        $filenameEncode = iconv("UTF-8","EUC-KR",$filename);
        //한글파일명 폴더에 저장되게 인코딩  | db에 등록할 수 없는 형태임
        //메소드에서 사용할때 UTF-8을  EUC-KR
        //db에서 사용할때 EUC-KR을 UTF-8로 전환할 것
        $uploadFile = $uploadDir.$filenameEncode;   //경로포함 전체경로
        //이미지 경로 문자열 파일이름 랜덤으로해서 중복저장가능

        if(!move_uploaded_file($_FILES['board_file']['tmp_name'], $uploadFile)){
          //업로드 성공시 true
           echo "<script>
              alert('업로드에 문제가 발생하였습니다. 파일을 확인하여 주세요');
           </script>";

          return $this->redirect('/'.self::DETAIL.'/'.$num);
        }
      }
      else if($this->_request->getPost('file') != '없음'){
        //파일안넣고 기존파일 그대로 저장
        $filename = $this->_request->getPost('dumpNumber').'_FILE_UNIQUE_NUMBER_'.$this->_request->getPost('file');
      }else{
        //파일없으면 없다고 저장
        $filename = 'none';
      }
      $num      = $this->_request->getPost('num');
      $title    = $this->_request->getPost('title');
      $content  = $this->_request->getPost('content');

      //디비에 값 저장
      $this->_connect_model->get('board')->updateBoard($num,$title,$content,$filename);


      return $this->redirect('/'.self::DETAIL.'/'.$num);
    }
  //댓글 작성 DETAIL
    public function commentAction(){
      //토큰검사
      $token = $this->_request->getPost('_token');
      if(!$this->checkToken(self::DETAIL,$token)){
        return $this->redirect('/');
      }

      //포스트값 넘겨받기
      $id     = $this->_request->getPost('id');
      $ripple = $this->_request->getPost('ripple');
      $num    = $this->_request->getPost('num');
      $grade  = $this->_request->getPost('grade');
      $name   = $this->_request->getPost('name');
      // $h      = date("G")-4;
      $date   = date("a");
      $hour   = date("H");
      if($date == 'am' && $hour <= 4){
        $hour +=8;
      }else{
        $hour -=4;
      }
      $tim    = date("Y.m.d $hour:i a");

      $this->_connect_model->get('board')->commentRipple($num,$id,$grade,$name,$tim,$ripple);

      return $this->redirect('/shop/detail/'.$num);
    }
  //댓글 삭제
    public function discommentAction(){
      list($dump,$dump,$rnum,$dump,$num) = explode('/',ltrim($this->_request->getPath(),'/'));
      // echo $rnum."/".$num;

      $this->_connect_model->get('board')->deleteRipple($rnum);

      return $this->redirect('/shop/detail/'.$num);
    }

  //다운로드
      public function downloadAction(){
        $path = explode('/',ltrim($this->_request->getPath(),'/'));
        $filename = array_pop($path);

        $dirpath = "C:xampp/htdocs/shopmall.localhost/mvc_htdocs/files/";
        // echo $filename;

        $filepath = iconv("UTF-8","EUC-KR",$dirpath.$filename);
        //프로그램 상에서는 euckr로
        $filesize = filesize($filepath);
        $path_parts = pathinfo($filepath);
        // $dirpath = "C:xampp/htdocs/shopmall.localhost/mvc_htdocs/files/";
        //저장된 파일명에 경로를 추가하는 코드였음
        $filename = $path_parts['basename'];
        $extension = $path_parts['extension'];

        header("Pragma: private");
        header("Expires: 0");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: $filesize");

        ob_clean();
        flush();
        readfile($filepath);

      }
}

?>
