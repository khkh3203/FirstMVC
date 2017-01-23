<?php $this->setPageTitle('title', "상품수정"); ?>
<div id="item_Input_form">
  <h1>상품수정</h1>
  <hr>
  <img id="boardupdate_titleIMG" src="/img/GoodsImg/<?php print $_item['image']; ?>">
  <div id="boardupdate_form">
  <form enctype="multipart/form-data" name="uploadForm" action="<?php print $base_url; ?>/updateSubmit" method="post" >
    <input type="hidden" name="_token" value="<?php print $_token; ?>">
    <input type="hidden" name="num" value="<?php print $_item['num']; ?>">
    <p id="category_text">카테고리 <select id="category" name="category">
        <option value="<?php print $_item['category']; ?>" selected="select"><?php print $_item['category']; ?></option>
      <optgroup label="오버로크">
        <option value="전역마크">전역마크</option>
        <option value="부대마크">부대마크</option>
        <option value="계급장">계급장</option>
      </optgroup>
      <optgroup label="전투복">
        <option value="방상외피" >방상외피</option>
        <option value="방상내피" >방상내피</option>
        <option value="전투복" >전투복</option>
        <option value="베레모" >베레모</option>
        <option value="전투화" >전투화</option>
      </optgroup>
      <optgroup label="군장물품">
        <option value="침낭" >침낭</option>
        <option value="야전삽" >야전삽</option>
        <option value="군장덮개" >군장덮개</option>
        <option value="수통" >수통</option>
      </optgroup>
    </select></p>
    <input id="Utitle" type="text" name="title" placeholder="상품명" value="<?php print $_item['title']; ?>" required><br>
    <textarea id="Usum"rows="5" cols="30" name="summary" placeholder="상품설명"><?php print $_item['summary']; ?></textarea><br>
    <input id="Uprice" type="number" name="price" placeholder="상품가격" value="<?php print $_item['price']; ?>" required><h2>원</h2>
    <input id="Ucount" type="number" name="stock" placeholder="상품재고" value="<?php print $_item['stock']; ?>" required><h2>개</h2><br>
    <input id="Usubmit" type="submit" value="수정하기">
  </form>
  </div>
</div>
