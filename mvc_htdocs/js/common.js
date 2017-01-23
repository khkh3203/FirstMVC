//전체적인 자바스크립트 및 Jquery

function deleteAd(){
  //alert("삭제"); 광고 삭제
  var element = document.getElementById('top_Ad');
  element.style.display = 'none';
}

// function check_id(){
//   //아이디 중복검사
//   window.open("/error/check_id.php?id="+document.memberForm.id.value,
//       "IDcheck",
//        "left=400,top=200,width=500,height=500,scrollbars=no,resizable=yes");
// }

function check_id_turn(bool){
  if(bool){
    alert('참');
  }else{
    alert('거짓');
  }
}

//회원가입/정보수정 검사
function checkList(){
  if (!document.memberForm.name.value)
  {
      alert("이름을 입력하세요");
      document.memberForm.name.focus();
      return;
  }

  if (!document.memberForm.id.value)
  {
      alert("아이디를 입력하세요");
      document.memberForm.id.focus();
      return;
  }

  if (!document.memberForm.pw.value)
  {
      alert("비밀번호를 입력하세요");
      document.memberForm.pw.focus();
      return;
  }

  if (!document.memberForm.pw_confirm.value)
  {
      alert("비밀번호 확인을 입력하세요");
      document.memberForm.pw_confirm.focus();
      return;
  }

  if (!document.memberForm.birth.value)
  {
      alert("생년월일을 선택하세요");
      document.memberForm.birth.focus();
      return;
  }

  if (!document.memberForm.phone2.value || !document.memberForm.phone3.value )
  {
      alert("휴대폰 번호를 입력하세요");
      document.memberForm.phone2.focus();
      return;
  }

  if (document.memberForm.pw.value !=
        document.memberForm.pw_confirm.value)
  {
      alert("비밀번호가 일치하지 않습니다.\n다시입력해주세요.");
      document.memberForm.pw.focus();
      document.memberForm.pw.select();
      return;
  }

  document.memberForm.submit();
}

// //상품 수정페이지 이동
// function moveToUpdate(argNum){
//   location.href = "KSJMall.php?menu=itemUpdate&num="+argNum;
// }
// //상품 삭제페이지 이동
// function moveToDelete(argNum){
//   location.href = "index.php/delete/"+argNum;
// }
//게시판 삭제
// function moveTodelete_board(argNum){
//   location.href = "KSJMall.php?menu=boardDelete&num="+argNum;
// }
// //뒤로가기
function go_boardlist() {
  location.href = "index.php/shop/board/0/page/1";
}
function back() {
  history.go(-1);
}
