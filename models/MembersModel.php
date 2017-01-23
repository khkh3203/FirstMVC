<?php
  class MembersModel extends ExecuteModel{

    // public function isOverlapUserName($user_name) {
    //   $sql = "SELECT COUNT(id) as count
    //           FROM user
    //           WHERE user_name = :user_name";
    //
    //   $row = $this->getRecord(
    //           $sql,
    //           array(':user_name' => $user_name));
    //   if($row['count']==='0') { // $user_name의 유저가 미동륵이면
    //   return true;
    // }
    //     return false;
    //   }

    //아이디 중복검사
    public function isOverlapID($user_id){
      $sql = "SELECT COUNT(id) as count
              FROM members
              WHERE id = :user_id";

      $row = $this->getRecord(
              $sql,
              array(':user_id' => $user_id));
      if($row['count']==='0') { // ID가 미동륵이면
      return false;
      }
        return true;
    }
    //회원 넘버값 1증가시켜서 반환
    public function getNum(){
      $sql = "SELECT MAX(num) as num
              FROM members";
      $row = $this->getRecord($sql);

      $num = intval($row['num']+1);

      return $num;
    }

    //회원등록
    public function insertMember($num,$id,$pw,$name,$grade,$birth,$phone,$history,$sex){
      $sql = "INSERT INTO members(num,id,pw,name,grade,birth,phone,history,sex)
              VALUES(:num, :id, :pw, :name, :grade, :birth, :phone, :history, :sex)";
      $stmt = $this->execute($sql,array(
        ':num'     => $num,
        ':id'      => $id,
        ':pw'      => $pw,
        ':name'    => $name,
        ':grade'   => $grade,
        ':birth'   => $birth,
        ':phone'   => $phone,
        ':history' => $history,
        ':sex'     => $sex,
      ));


    }
    //회원정보 추출
    public function getUserRecord($user_id){
      $sql = "SELECT *
              FROM members
              WHERE id = :user_id";

      $Data = $this->getRecord($sql,
                     array(':user_id' => $user_id));

      return $Data;
    }

    //회원탈퇴
    public function deleteMember(){
      
    }

    //회원정보수정
    public function updateMember($id,$pw,$name,$grade,$birth,$phone,$sex){
      $sql = "UPDATE members SET
                pw = '$pw',
               name = '$name',
               grade = '$grade',
               birth = '$birth',
               phone = '$phone',
               sex = '$sex'
              WHERE id = :id";

      $this->execute($sql,array(':id' => $id));
    }

    //구매내역수정
    public function updateHistory($id,$history){
      $sql = "UPDATE members SET
              history='$history'
              WHERE id = :id ";
      $this->execute($sql,array(':id' => $id));
    }
  }
 ?>
