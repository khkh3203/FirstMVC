<?php $this->setPageTitle('title','게시글수정') ?>

<form enctype="multipart/form-data" id="boardInput" action="<?php print $base_url; ?>/shop/commit" method="post">
<h1>◆ 게시글 수정</h1>
<hr>
  <div class="bd_title" ><input  type="text" name="title" value="<?php print $_board['title']; ?>" required placeholder="제목"> | <b><?php print $_board['name']; ?></b> | <b><?php print $_board['tim']; ?></b></div>
  <input type="hidden" name="_token" value="<?php print $_token; ?>">
  <input type="hidden" name="name" value="<?php print $_board['name']; ?>">
  <input type="hidden" name="time" value="<?php print $_board['tim']; ?>">
  <input type="hidden" name="num" value="<?php print $_board['num']; ?>">
  <input type="hidden" name="file" value="<?php print $_file; ?>">
  <input type="hidden" name="dumpNumber" value=<?php print $_dump; ?>>
  <br>
  <div class="bd_content"><textarea  name="content" rows="8" cols="80" placeholder="내용"><?php print $_board['content']; ?></textarea></div>
  <br>
  <h3>현재 첨부파일 :: <?php print $_file; ?></h3>
  <div class="bd_file"> <h2>첨부파일 덮어쓰기</h2><input type="file" name="board_file"></div>
  <hr>
  <div class="bd_btn"><input class="bd_subbtn" type="submit" value="확인">
  <input class="bd_bacbtn" type="button" value="취소" onclick="back()"></div>
</form>
