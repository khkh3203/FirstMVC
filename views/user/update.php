<?php $this->setPageTitle('title','회원정보수정'); ?>
<!--리스트 출력-->
<?php print $this->render('user/list'); ?>
<div class="mypage_col2">
<img id="member_img" src="/img/joinmain.jpg"><h1>&nbsp;&nbsp;&nbsp;■ 회원정보수정</h1><hr>
  <ul id="memberUl">
    <li>이름</li>
    <li>계급</li>
    <li>아 이 디</li>
    <li>비밀번호</li>
    <li>비밀번호 확인</li>
    <li>생년월일</li>
    <li>전화번호</li>
    <div id="clear"></div>
    <li>성별</li>
  </ul>
  <form name="memberForm" action="<?php print $base_url; ?>/user/regist" method="post">
    <input type="hidden" name="_token" value="<?php print $_token; ?>">
  <ul id="memberFormUl">
    <li><input class="box" type="text" name="name" value="<?php print $_member['name']; ?>"></li>
   <li><select class="box" name="grade"></li>
     <option value="<?php print $_member['grade']; ?>" selected="select"><?php print $_member['grade']; ?></option>
     <option value="하사">하사</option>
     <option value="중사">중사</option>
     <option value="상사">상사</option>
     <option value="원사">원사</option>
     <option value="준위">준위</option>
     <option value="소위">소위</option>
     <option value="중위">중위</option>
     <option value="대위">대위</option>
     <option value="소령">소령</option>
     <option value="중령">중령</option>
     <option value="대령">대령</option>
     <option value="준장">준장</option>
     <option value="소장">소장</option>
     <option value="중장">중장</option>
     <option value="대장">대장</option>
   </select>
    <li><div class="box"><?php print $_member['id']; ?></div> </li>
        <input type="hidden" name="id" value="<?php print $_member['id']; ?>">
    <li><input class="box" type="password" name="pw"></li>
    <li><input class="box" type="password" name="pw_confirm"></li>
    <li><input class="box" type="date" name="birth" value="<?php print $_member['birth']; ?>"></li>
    <li><select class="box" name="phone1">
      <option value="010" selected="select">010</option>
      <option value="011">011</option>
      <option value="016">016</option>
      <option value="017">017</option>
      <option value="018">018</option>
      <option value="019">019</option>
    </select>
    - <input class="phone" type="text" name="phone2" value="<?php print $_phone2; ?>" maxlength="4">
    - <input class="phone" type="text" name="phone3" value="<?php print $_phone3; ?>" maxlength="4"></li>
    <?php if($_member['sex'] == 'female'): ?>
      <li><h4>남성</h4><input class="sex" type="radio" name="sex" value="male">
      <h4>여성</h4><input class="sex" type="radio" name="sex" value="female" checked></li>'
    <?php else: ?>
      <li><h4>남성</h4><input class="sex" type="radio" name="sex" value="male" checked>
      <h4>여성</h4><input class="sex" type="radio" name="sex" value="female"></li>'
    <?php endif; ?>
    <ul>
    <input id="sub_btn" type="button" value="수정하기" onclick="checkList()">
  </form>
</div>
