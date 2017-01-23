<?php
class BoardModel extends ExecuteModel{

  //전체 게시글 수 리턴
  public function boardCount(){
    $sql = "SELECT count(*) as count
            FROM board ";

    $data = $this->getRecord($sql);

    return $data['count'];
  }
  //전체 게시글 불러오기 / 오프셋 사용
  public function getBoards($offset,$block){
    $sql = "SELECT *
            FROM board
            ORDER BY num desc
            LIMIT $offset,$block";
    $data = $this->execute($sql);

    return $data;
  }
  //게시글 단일행 데이터 불러오기 / 상세보기
  public function getBoardDetail($num){
    $sql = "SELECT *
            FROM board
            WHERE num = :num";
    $data= $this->getRecord($sql,array(':num' => $num));

    return $data;
  }
  //게시글 저장
  public function setBoard($title,$id,$name,$time,$content,$filename){
    $sql = "INSERT INTO board
            VALUES('',:title,:id,:name,:timer,:content,:filename,0)";

    $this->execute($sql,array(
            ':title'       => $title,
            ':id'          => $id,
            ':name'        => $name,
            ':timer'       => $time,
            ':content'     => $content,
            ':filename'    => $filename,
    ));
  }
  //게시글 수정 제목/내용/파일 만수정됨
  public function updateBoard($num,$title,$content,$filename){
    $sql ="UPDATE board SET
           title   = '$title',
           content = '$content',
           file    = '$filename'
           WHERE num = :num";
    $this->execute($sql,array(':num' => $num));
  }
  //게시글 삭제, 게시글에 포함된 댓글도 삭제
  public function deleteBoard($num){
    $sql = "DELETE FROM board
            where num = :num";

    $this->execute($sql,array(':num' => $num));

    $sql = "DELETE FROM board_ripple
            where num = :num";

    $this->execute($sql,array(':num' => $num));
  }

  //댓글 삭제
  public function deleteRipple($rnum){
    $sql = "DELETE FROM board_ripple
            where rnum = :rnum";

    $this->execute($sql,array(':rnum' => $rnum));
  }

  //댓글 등록
  public function commentRipple($num,$id,$grade,$name,$tim,$ripple){
    $sql = "INSERT INTO board_ripple
            VALUES('',:num,:id,:grade,:name,:tim,:ripple)";
    $this->execute($sql,array(
              ':num'    => $num,
              ':id'     => $id,
              ':grade'  => $grade,
              ':name'   => $name,
              ':tim'    => $tim,
              ':ripple' => $ripple,
    ));
  }
  //댓글 불러오기
  public function getRipple($num){
    $sql = "SELECT *
            FROM board_ripple
            WHERE num = :num";

    $data = $this->execute($sql,array(':num' => $num));

    return $data;
  }
  // 게시글 뷰 증가시키기
  public function increView($num){
    $sql = "UPDATE board SET
            view = view+1
            WHERE num = :num ";
   $this->execute($sql, array(':num' => $num));
  }
  //댓글 갯수 리턴 /게시글 번호
  public function rippleCount($num){
    $sql = "SELECT count(*) as count
            FROM board_ripple
            WHERE num = :num";

    $data = $this->getRecord($sql,array(':num' => $num));

    return $data['count'];
  }
}
 ?>
