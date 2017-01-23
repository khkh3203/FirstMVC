<!--상품 카테고리 하나만 보기-->

<?php $this->setPageTitle('title', "상품목록"); ?>

<br><h1 id="titles"><?php print $_menu.' - '.$_category ?></h1><div id="listLink">
<a href="<?php print $base_url.$_path ?>">[더보기]</a></div>
<hr>
<div class="container">
<?php foreach($_items as $_item): ?>
  <!--$_items는 스테이트먼트  객체의 배열이지만 렌더하면서 다시 변수로 갈라짐-->
  <!--$_items는 array (0){ array (0){'키' => 값}} 형식 -->
  <!--$_items는 _items (0){ _item (0){'키' => 값}}} 형식 -->
<?php print $this->render('item/list',array('_item' => $_item)); ?>
<?php endforeach; ?>
</div>
