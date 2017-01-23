<!-- //자유게시판 목록 -->
<?php $this->setPageTitle('title','자유게시판'); ?>

<div class="boardCon">
  <h1><center>자유게시판 </center></h1><a id="board_btn" href="<?php print $base_url; ?>/shop/post"><h3 id="b_btn_con">글쓰기</h3></a>
  <br>
  <hr>
  <table>
    <tr id="boardList_title">
      <td width="10%">번호</td><td>제 목</td><td width="20%">작성자</td><td width="10%">조회수</td>
    </tr>
    <!--게시글 반복 출력-->
    <?php foreach ($_boards as $board): ?>
      <?php print $this->render('shop/list',array('_board' => $board)); ?>
    <?php endforeach; ?>
  </table>
</div>
<hr>
<div class="board_page">
  <?php  if($_isprev): ?>
    <a href="<?php print $base_url; ?>/shop/board/<?php print $_now-200; ?>/page/<?php print $_page-1; ?>">◀이전|</a>
  <?php  endif;?>

      <?php for($i=0;$i<$_max;$i++): ?>
        <a href="<?php print $base_url; ?>/shop/board/<?php print $_now+($i*$_size); ?>/page/<?php print $_page; ?>">[<?php print ($i+1+$_num); ?>]</a>
      <?php endfor; ?>

  <?php  if($_isnext): ?>
    <a href="<?php print $base_url; ?>/shop/board/<?php print $_now+200; ?>/page/<?php print $_page+1; ?>">|다음▶</a>
  <?php  endif;?>
</div>
