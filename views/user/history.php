<?php $this->setPageTitle('title',"구매내역"); ?>

<?php print $this->render('user/list'); ?>
<div class="mypage_col2">
   <h1>■ 구매내역 </h1>
  <hr>
  <table id="history_table" >
    <tr id="history_table_top"><td width="10%">번호</td><td width="20%" >상품이미지</td><td width="10%">상품명</td><td width="10%">구매량</td><td width="2  0%">금액</td><td width="20%">구매일자</td></tr>

    <?php foreach($_history as $key => $val): ?>
      <tr id="history_table_list">
        <td><?php print $val['hnum']; ?></td>
        <td><img class="history_img" src="/img/GoodsImg/<?php print $val['img']; ?>"></td>
        <td><?php print $val['title']; ?></td>
        <td><?php print $val['num'];?></td>
        <td><?php print $val['cost']; ?></td>
        <td><?php print $val['date']; ?></td>
      </tr>
    <?php endforeach; ?>

  </table>

  <div class="history_page">
  <hr>
  <?php  if($_isprev): ?>
    <a href="<?php print $base_url; ?>/user/history/<?php print $_now-25; ?>/page/<?php print $_page-1; ?>">◀이전|</a>
  <?php  endif;?>

      <?php for($i=0;$i<$_max;$i++): ?>
        <a href="<?php print $base_url; ?>/user/history/<?php print $i*$_size; ?>/page/<?php print $_page; ?>">[<?php print ($i+1+$_num); ?>]</a>
      <?php endfor; ?>

  <?php  if($_isnext): ?>
    <a href="<?php print $base_url; ?>/user/history/<?php print $_now+25; ?>/page/<?php print $_page+1; ?>">|다음▶</a>
  <?php  endif;?>
  </div>
</div>
