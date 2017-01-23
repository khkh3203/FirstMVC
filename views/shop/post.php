<!--게시글 작성-->
<?php $user = $session->get('user'); ?>
<?php $this->setPageTitle('title','글쓰기'); ?>
<form enctype="multipart/form-data" id="boardInput" action="<?php print $base_url; ?>/shop/postRegist" method="post">
  <input type="hidden" name="_token" value="<?php print $_token; ?>">
<h1>◆ 게시글 작성</h1>
<hr>
  <div class="bd_title" ><input  type="text" name="title" required placeholder="제목"> | <b><?php print $user['name'] ?></b> | <b><?php print $_time; ?></b></div>
  <input type="hidden" name="name" value="<?php print $user['name']; ?>">
  <input type="hidden" name="time" value="<?php print $_time; ?>">
  <input type="hidden" name="id" value="<?php print $user['id']; ?>">
  <br>
  <div class="bd_content"><textarea  name="content" rows="8" cols="80" placeholder="내용"></textarea></div>
  <br>
  <div class="bd_file" ><h2>첨부파일</h2><input type="file" name="board_file" value="none"></div>
  <hr>
  <div class="bd_btn"><input class="bd_subbtn" type="submit" value="작성하기">
  <input class="bd_bacbtn" type="button" value="뒤로가기" onclick="back()"></div>
</form>
