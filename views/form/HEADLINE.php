
<!-- 헤드라인 -->



<?php if ($session->isAuthenticated()):
      //세션에 저장되어있는 유저데이터 변수에 저장
      $user = $session->get('user');?>
  <!-- 로그인 되어있다면 -->
  <!--
       $name = $_SESSION['name'];
       $grade= $_SESSION['grade'];
     -->
  <nav><div id='userHeader'><?php print $user['grade']." ".$user['name'] ?> 님 반갑습니다!</div>
  <?php if($user['grade'] == '관리자'): ?>
    <!-- 관리자 기능 추가 -->
    <a href="<?php print $base_url; ?>/upload">상품등록</a>
  <?php endif; ?>
    <a href="<?php print $base_url; ?>/shop/board/0/page/1">자유게시판</a>
    <a href="<?php print $base_url; ?>/user/update">마이페이지</a>
    <a href="<?php print $base_url; ?>/account/logout">로그아웃</a></nav>
  <?php else: ?>
  <!-- 비로그인 시 -->
  <nav><a href="<?php print $base_url; ?>/account/join" >회원가입</a>
  <a href="<?php print $base_url; ?>/account/login" >로그인</a></nav>
<?php endif; ?>
