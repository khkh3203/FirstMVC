<!-- foreach ($_item as $value) {
    echo $value."<br>";
} -->
<a href="<?php print $base_url; ?>/detail/<?php print $_item['num'] ?>">
<div class="list_box">
  <div class="list_box_title"><?php print $_item['title'] ?></div>
  <img src="/img/GoodsImg/<?php print $_item['image'] ?>">
  <pre class="list_box_text">
    <?php if($_item['stock'] == 0): ?>
      <p id='soldOut'>[ SOLD OUT ]</p>
    <?php else: print $_item['summary'];?>
    <?php endif; ?>
  </pre>
</div>
</a>
