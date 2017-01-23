<div id="item_Input_form">
  <h1>상품등록</h1>
  <hr>
  <form enctype="multipart/form-data" name="uploadForm" action="<?php print $base_url; ?>/regist" method="post" >
    <input type="hidden" name="_token" value=<?php print $_token; ?>>
    <p id="category_text">카테고리 <select id="category" name="category">
      <optgroup label="오버로크">
        <option value="전역마크" >전역마크</option>
        <option value="부대마크" >부대마크</option>
        <option value="계급장" >계급장</option>
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
        <option value="수통" >수통</option>
        <option value="야전삽" >야전삽</option>
        <option value="군장덮개" >군장덮개</option>
      </optgroup>
    </select></p>
    <input id="Utitle" type="text" name="title" placeholder="상 품 명" required><br>
    <textarea id="Usum"rows="5" cols="30" name="summary" placeholder="상품설명"></textarea><br>
    <input id="Uprice" type="number" name="price" placeholder="상품가격" required><h2>원</h2>
    <input id="Ucount" type="number" name="stock" placeholder="상품재고" required><h2>개</h2>
    <p id="upload_img">상품이미지 등록 <input id="Ufile" type="file" name="Goods_img" required></p>
    <input id="Usubmit" type="submit" value="상품등록">
  </form>
</div>
