<?php

class ItemlistModel extends ExecuteModel{

  //메뉴의 전체상품용 들고오기
    public function getLimitItem($category){
      $sql = "SELECT *
              FROM itemlist
              WHERE category = :category
              order by num
              limit 0,3";
      $data = $this->execute($sql,
                      array(':category' => $category));
      return $data;
    }
  //메뉴의 카테고리 들고오기
    public function getItem($category){
      $sql = "SELECT *
              FROM itemlist
              WHERE category = :category
              order by num";
      $data = $this->execute($sql,
                      array(':category' => $category));
      return $data;
    }

  //메뉴의 넘버로 상품정보 추출
      public function getDetail($num){
        $sql = "SELECT *
                FROM itemlist
                WHERE num = :num";
        $data = $this->getRecord($sql,
                        array(':num' => $num));
        return $data;
      }
  //상품 삭제
      public function deleteItem($num){
          // //서버에 상품이미지 삭제
          // 상품이미지는 계속 남겨둔다. 구매내역때문에

          $sql = "DELETE
                  FROM itemlist
                  WHERE num = :num";

          $this->execute($sql,array(':num'=>$num));
          //서버에서 상품정보 삭제
      }
    //상품 업데이트 이미지 제외
        public function updateItem($num,$category,$title,$summary,$price,$stock){
                    //변수에 ''씌어 주지않으면 에러뜬다
               $sql = "UPDATE itemlist SET
                           category = '$category',
                           title    = '$title',
                           summary  = '$summary',
                           price    = $price,
                           stock    = $stock
                      WHERE num = :num ";
              $this->execute($sql, array(':num' => $num));
        }
    //상품 재고 업데이트
        public function updateStock($num,$stock){
                    //변수에 ''씌어 주지않으면 에러뜬다
               $sql = "UPDATE itemlist SET
                       stock = $stock
                       WHERE num = :num ";
              $this->execute($sql, array(':num' => $num));
        }
    //상품등록
       public function uploadItem($category,$title,$summary,$price,$stock,$img){
                    $sql = "INSERT INTO itemList
                            VALUES('',:category,:title,:summary,:price,:stock,:img)";

                    $this->execute($sql,array(
                                ':category' => $category,
                                ':title'    => $title,
                                ':summary'  => $summary,
                                ':price'    => $price,
                                ':stock'    => $stock,
                                ':img'      => $img,
                    ));
       }
}
 ?>
