<!-- 로그인 폼 출력 -->
<?php $this->setPageTitle('title', "로그인"); ?>
<h1 style='color:red'><?php print $_error ?></h1>
<img id="Login_img" src="/img/loginmain.jpg"><h1>&nbsp;&nbsp;로그인</h1><hr>
<form action="<?php print $base_url;?>/account/loginsubmit" method="post">
  <input type="hidden" name="_token" value=<?php print $_token ?>>
  <input class="lbox" type="text" name="id" placeholder="아이디" required>
  <input class="lbox" type="password" name="pw" placeholder="비밀번호" required>
  <input id="sub_btn" type="submit" value="로그인">
</form>
