<?php

class UserController extends Controller{
      const UPDATE   = "user/update";
      const UNMEMBER = "user/unmember";

    //마이페이지 리스트 - 안쓸듯
      public function listAction(){

      }
    //회원정보수정
      public function updateAction(){
        $user = $this->_session->get('user');
        $id = $user['id']; //현재 세셩에서 사용자 id값 획득

        //사용자정보 디비에서 추출
        $member = $this->_connect_model->get('members')->getUserRecord($id);
        //전화번호 나누기
        list($phone1,$phone2,$phone3) = explode('-',$member['phone']);

        //렌더링
        $update_view = $this->render(array(
                  '_member' => $member,
                  '_phone2' => $phone2,
                  '_phone3' => $phone3,
                  '_token'  => $this->getToken(self::UPDATE),
        ));

        return $update_view;
      }
    //회원정보수정 처리 - UPDATE
      public function registAction(){
        //토큰 처리
        $token = $this->_request->getPost('_token');
        if(!$this->checkToken(self::UPDATE,$token)){
          return $this->redirect('/');
        }

        //포스트로 값가져옴
        $id       =$this->_request->getPost('id');
        $pw       =$this->_request->getPost('pw');
        $name     =$this->_request->getPost('name');
        $grade    =$this->_request->getPost('grade');
        $birth    =$this->_request->getPost('birth');
        $phone    =$this->_request->getPost('phone1').'-'.$this->_request->getPost('phone2').'-'.$this->_request->getPost('phone3');
        $sex      =$this->_request->getPost('sex');

        //디비로 값수정
        $this->_connect_model->get('members')->updateMember($id,$pw,$name,$grade,$birth,$phone,$sex);

        //수정된 값을 다시 호출
        $user = $this->_connect_model->get('members')->getUserRecord($id);
        var_dump($user);
        //세션 초기화 로그아웃
        $this->_session->setAuthenticateStaus(false);
        //
        // //세션값 변경 user값에 덮어씌우고 로그인
        $this->_session->setAuthenticateStaus(true);
        $this->_session->set('user',$user);
        //
        // //리다이렉트
        return $this->redirect('/'.self::UPDATE);
      }
    //구매내역
      public function historyAction(){
        list($dump,$dump,$offset,$dump,$mypage) = explode('/',ltrim($this->_request->getPath(),'/'));
         //offset = 오프셋 값 (현재오프셋)
         //mypage = 페이징 값 (현재페이지값)

        $_block = 5; //한블럭당 히스토리 수
        $_page  = 5; //한페이지당 블럭수
        $isPrev = false;
        $isNext = true;
        $max    = $_page;
        //페이징 limit(시작값,추출하는 행의수5)
        //유저 히스토리값 추출
          $user = $this->_session->get('user');
          $data = $this->_connect_model->get('members')->getUserRecord($user['id']);
          $history = $data['history'];

          $isEmpty = true;  //히스토리가 비어있는지 여부

          if(!$history == 'none'){
            $isEmpty = false;
          }

        //전체 히스토리수 추출
        //echo $history."<br><br>";
          $historys = explode('/',ltrim($history,'/'));
          $rows =  count($historys);
        // 1차 페이징 5게시글 => 1블럭(5)
        for($i=$rows,$block=0;$i>=0;$i-=$_block){
          $block++;
        }
        // //2차 페이징 5블럭 => 1페이지(25)
        for($i=$block,$page=0;$i>=0;$i-=$_page){
          $page++;
        }

        // echo $block."<br>";
        // echo $page;
        //이전 버튼 유무
        if($mypage > 1){
          $isPrev = true;
        }
        // //다음 버튼 유무
        if($mypage == $page){
          $isNext = false;
          $max    = $block%10;
          if($max == 0){
            $max = $_page;
          }
        }
        $datas = array();
        //히스토리즈 배열 이미지/제목/갯수/가격/날짜
        for ($i=$offset,$j=0;$i<$offset+$_block;$i++,$j++) {
            if(isset($historys[$i])){
            // echo $historys[$i]."<br>";

            list($img,$title,$num,$cost,$date) = explode('|',$historys[$i]);
            $datas[$j] = array(
                      'hnum'  => $i+1,
                      'img'    => $img,
                      'title'  => $title,
                      'num'    => $num,
                      'cost'   => $cost,
                      'date'   => $date
            );
            }
        }

        //렌더링
        $history_view = $this->render(array(
          '_history'=> $datas,
          '_isnext' => $isNext,
          '_isprev' => $isPrev,
          '_page'   => $mypage,
          '_num'    => ($mypage-1)*10,
          '_size'   => $_block,
          '_now'    => ($mypage-1)*25,
          '_max'    => $max,
          '_isEmpty'  => $isEmpty,
        ));

      return $history_view;
      }
    //뀨
      public function creatorAction(){
        return $this->render();
      }
    //회원탈퇴

    //회원탈퇴 처리 -UNMEMBER

}
 ?>
