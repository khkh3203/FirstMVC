<?php
class AccountController extends Controller{
  const JOIN  = "account/join";
  const LOGIN = "account/login";

  //회원가입 페이지
  public function joinAction(){
    if($this->_session->isAuthenticated()){
      //로그인 중이라면 인덱스로 복귀
      $this->redirect('/');
    }
    $join_view = $this->render(array(
      '_token' => $this->getToken(self::JOIN),
    ));
    return $join_view;
  }

  //로그인 페이지
  public function loginAction(){
    if($this->_session->isAuthenticated()){
      //로그인 중이라면 인덱스로 복귀
      $this->redirect('/');
    }
    $login_view = $this->render(array(
      '_error' => '',
      '_token' => $this->getToken(self::LOGIN),
    ));
    return $login_view;
  }

  //회원가입 절차
  public function registAction(){
    //CSRF대첵 체크
    $token = $this->_request->getPost('_token');
    if(!$this->checkToken(self::JOIN,$token)){
      return $this->redirect('/'.self::JOIN);
    }

    //POST로 넘어오는 값 변수에 저장
    $num;
    $id       =$this->_request->getPost('id');
    $pw       =$this->_request->getPost('pw');
    $name     =$this->_request->getPost('name');
    $grade    =$this->_request->getPost('grade');
    $birth    =$this->_request->getPost('birth');
    $phone    =$this->_request->getPost('phone1').'-'.$this->_request->getPost('phone2').'-'.$this->_request->getPost('phone3');
    $history  ='';
    $sex      =$this->_request->getPost('sex');

    //유저 데이터베이스객체를 변수에 저장
    $member = $this->_connect_model->get('Members');
    //아이디검사 한번더 함
    if($member->isOverlapID($id)){
        //중복아이디 오류페이지 렌더
      $overlapID = $this->render(array(
        '_id' => $id
      ),'error/overlapID');
      return $overlapID;
    }
    //num값 불러와서 증가시킴
    $num = $member->getNum();
    //입력값의 여부는 VIEW에서 처리된다.
    $member->insertMember($num,$id,$pw,$name,$grade,$birth,$phone,$history,$sex);

    //로그인화면으로 리다이렉트
    return $this->redirect('/account/login');

  }

  //로그인 절차
  public function authenticateAction(){
    //CSRF대첵 체크
    $token = $this->_request->getPost('_token');
    if(!$this->checkToken(self::LOGIN,$token)){
      return $this->redirect('/'.self::LOGIN);
    }

    $user_id = $this->_request->getPost('id');
    $password= $this->_request->getPost('pw');
    //아이디비밀번호 입력확인은 VIEW에서 처리함

    $user = $this->_connect_model->get('members')->getUserRecord($user_id);
    //유저 아이디로 디비에서 값꺼내오기

    //유저값이 있고 비밀번호 맞는지 체크
    $error = '';
    if(!$user || !($password == $user['pw'])){
      //로그인 에러
      $error = 'Error :: Mistake ID or password.';
      return $this->render(array(
        '_error' => $error,
        '_token' => $this->getToken(self::LOGIN),
      ),'login');
    }else{
      //로그인 설정 - 참
      $this->_session->setAuthenticateStaus(true);
      //유저데이터 배열값을 세션에 저장
      $this->_session->set('user',$user);
      return $this->redirect('');
    }
  }

  //로그아웃
  public function logoutAction(){
    $this->_session->setAuthenticateStaus(false);

    $this->redirect('');
  }

}
 ?>
