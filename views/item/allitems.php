<!--상품 카테고리 전체보기-->
<h1>전체보기</h1><br><br>
<!--카테고리 갯수만큼 반복하며 렌더링해서 전체상품출력 -->
<!--$_itemss는 array(0){array (0){ array (0){'키' => 값}}} 형식 -->
<!--$_itemss는 _itemss{_items (0){ _item (0){'키' => 값}}} 형식 -->
<?php foreach($_itemss as $key => $_items):?>
<?php print $this->render('item/items',array(
                        '_menu'     => $_menu,
                        '_category' => $_categorys[$key],
                        '_path'     => $_paths[$key],
                        '_items'    => $_items,
                      )); ?>
<?php endforeach; ?>
