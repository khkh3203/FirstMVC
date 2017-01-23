<!-- 게시글상세보기 -->
<?php $this->setPageTitle('title',$_board['title']); ?>

<form id="board" action="<?php print $base_url; ?>/shop/update" method="post">
  <input type="hidden" name="_token" value="<?php print $_token; ?>">
  <input type='hidden' name='num' value=<?php print $_board['num']; ?>>
  <input type='hidden' name='id' value=<?php print $_board['id']; ?>>
  <div id="board_title">
    <div id="board_title_col1"><p class="board_title_txt_title"><?php print $_board['title']; ?></p></div>
    <div id="board_title_col3">조회수 : <p class="board_title_txt"><?php print $_board['view']; ?></p></div>
    <div id="board_title_col4">작성일 : <p class="board_title_txt"><?php print $_board['tim']; ?></p></div>
    <div id="board_title_col2">작성자 : <p class="board_title_txt"><?php print $_board['name']; ?></p></div>
  </div>

  <div id="board_content">
  <hr>
    <pre><?php print $_board['content']; ?></pre>
  </div>
  <br>
  <h1>
  <?php if($_board['file'] != 'none'): ?>
    <div id="board_file"><?php print $_file; ?><a href="<?php print $base_url; ?>/shop/download/<?php print $_board['file']; ?>"> [다운로드]</a></div>
  <?php else: ?>
    <div id="board_file">첨부파일없음</div>
  <?php endif; ?>
  </h1>
<hr>
<a href="<?php print $base_url; ?>/shop/board/0/page/1"><input id="board_backbtn" class="board_btns" type="button" value="목록으로"></a>
<?php if($_ismy): ?>
<input id="board_subbtn" class="board_btns" type="submit" value="수정하기">
<a href="<?php print $base_url; ?>/shop/delete/<?php print $_board['num']; ?>"><input id="board_delbtn"  class="board_btns" type="button" value="삭제하기"></a>
<?php endif; ?>
</form>
<br>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;■ 댓글</h2>
<form id="ripple_form" action="<?php print $base_url; ?>/ripple/comment" method="post">
<input type="hidden" name="_token" value="<?php print $_token; ?>">
<div id="board_ripple_inputForm">
<textarea name='ripple' rows="8" cols="80" required></textarea>
<input type='submit' value='댓글작성'>
</div>
<?php  $user = $session->get('user'); ?>
<input type='hidden' name='name' value="<?php print $user['name']; ?>">
<input type='hidden' name='grade' value="<?php print $user['grade']; ?>">
<input type='hidden' name='num' value="<?php print $_board['num']; ?>">
<input type='hidden' name='id' value="<?php print $user['id']; ?>">
</form>
<div id="board_ripple">
  <?php foreach ($_ripples as $ripple):?>
  <?php print $this->render('shop/ripple',array('_ripple' => $ripple, '_num' => $_board['num'])); ?>
  <?php endforeach; ?>
</div>
