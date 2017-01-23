<!--상품 상세보기 -->
<?php
if($session->isAuthenticated()):
//로그인이 되어있다면 세션정보 저장
$user = $session->get('user');
endif;
?>
<?php $this->setPageTitle('title', "상품상세보기") ?>

<div id="board_col1">
  <div><?php print $_item['title']; ?></div>
  <img src="/img/GoodsImg/<?php print $_item['image']; ?>">
  <pre><?php print $_item['summary']; ?></pre>
</div>
<div id="board_col2">

  <ul id="board_col2_col1">
    <li>가격 :</li><br><br>
    <li>재고 :</li>
  </ul>
  <ul id="board_col2_col2">
      <li><?php print number_format($_item['price']); ?><h3>원</h3></li><br>
    <li><?php print $_item['stock']; ?><h3>개</h3></li>
  </ul>
  <hr>
  <form action="<?php print $base_url; ?>/buyItem" method="post">
  <input type="hidden" name="_token" value=<?php print $_token; ?>>
  <div id="board_clear">
    <?php if($_item['stock'] == 0): ?>
      <!--재고에 따른 상품수량 표시 유무-->
    <h3>SOLD OUT</h3>
    <?php else: ?>
    <br><select id="board_choice_stock" name="stock">

      <?php for($i=1;$i<=$_item['stock'];$i++): ?>
        <!-- 재고수에 따른 select 박스 -->
        <option value=<?php print $i ?>>&nbsp;<?php print $i?></option>
      <?php endfor; ?>
        </select>
        <h1 id="board_count">개 선택</h1><br><br>
    <?php endif; ?>
  </div>
    <input type="hidden" name="num" value=<?php print $_item['num']; ?>>
    <input type="hidden" name="price" value=<?php print $_item['price']; ?>>
      <?php if(!$_item['stock'] == 0): ?>
      <!--재고에 따른 구매버튼 유무-->
    <input class="board_update_btn" type="submit" value="구매하기">
      <?php endif; ?>
    <input class="board_update_btn" type="button" value="뒤로가기" onclick="back()">

      <?php if($session->isAuthenticated() && $user['id'] && $user['id'] == 'admin'): ?>
      <!-- //관리자 계정용 옵션 추가 -->
        <a href="<?php print $base_url; ?>/update/<?php print $_item['num'];?>"><input type="button" class="board_update_btn" value="수정하기"></a>
        <a href="<?php print $base_url; ?>/delete/<?php print $_item['num'];?>"><input type="button" class="board_update_btn" value="삭제하기"></a>
      <?php endif; ?>
  </form>
</div>
