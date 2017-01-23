<?php
//문자열들 이미지로 대체할 것
//아이디 중복 체크

require_once "./dbconn.php";
 if(empty($_GET['id'])){
   //입력값이 비어있을경우
   echo "<h1 style='color:red'>아이디를 입력하세요<h1>";
   return;
 }else{
   $id = $_GET['id'];
 }

try {
  $db = connected();
  $query = "select * from members where id = '$id'";

  $stmt = $db->prepare($query);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if($id == $result['id']){
    echo "<h1 style='color:red'>".$id."은(는) 존재하는 아이디입니다.<br>";
  }else{
    echo $id."은(는) 사용가능한 아이디 입니다.<br>";
  }
} catch (PDOException $e) {
  echo "Error : ".$e->getMessage();
}
 ?>
