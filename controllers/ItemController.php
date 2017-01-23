<?php
class ItemController extends Controller{
  protected $_authentication = array('delete','update','buyItem','upload'); //로그인이 필요한 액션
  const DETAIL = "item/detail";
  const UPDATE = "item/update";
  const UPLOAD = "item/upload";
  //등록된 상품목록 보여줌
  public function showListAction(){
    //uri값을 읽어서 item을 지우고, /로 메뉴와,카테고리로 구분
    $value = explode('/',substr($this->_request->getPath(),5));
    //맨앞에 비어있는 배열 삭제
    array_shift($value);
    //배열을 메뉴와 카테고리 변수로 저장
    //menu = overlork,others,clothe
    //category는 숫자들
    list($menu,$category) = $value;
    //상품목록 경로
    $path = $this->_request->getPath();

    // echo $this->_request->getPath()."<br>";
    // echo $category."<br>";

    //전체출력인지 부분출력인지 검사
    if($category == 'all'){
      $count; //카테고리 갯수
      switch ($menu) {
        case "overlork":
            $menu = "오버로크";
            $count= 3;
            $category = array('전역마크',
                              '부대마크',
                              '계급장');
          break;

        case "clothe":
            $menu = "전투복";
            $count= 5;
            $category = array('방상외피',
                              '방상내피',
                              '전투복',
                              '베레모',
                              '전투화');
          break;

        case "others":
            $menu = "군장물품";
            $count= 4;
            $category = array('침낭',
                              '수통',
                              '야전삽',
                              '군장덮개');
          break;
      }


      //반복횟수v
      // $allitem_show = $this->render(array(
      //   '_menu'     => $menu, //메뉴이름v
      //   '_category' => $category, //카테고리이름배열v
      //   '_path'     => $path, //카테고리경로배열v
      //   '_items'    => $itemss,  //상품값 2차원배열v
      // ),'allitems');

      $paths = array();
      $itemss= array();

      //카테고리수만큼 반복
      for($i=1;$i<=$count;$i++){
        //카테고리별 경로받아오기
        $paths[] = substr($path,0,-3).$i;

        //카테고리별 상품받아오기(3개씩) 카테고리배열이 인자값
        $itemss[]= $this->_connect_model->get('Itemlist')->getLimitItem($category[$i-1]);
      }
        $allItem_show = $this->render(array(
          '_menu'     => $menu,
          '_categorys' => $category,
          '_paths'     => $paths,
          '_itemss'   => $itemss,
        ),'allitems');

        return $allItem_show;

    }
    else
    {
      //메뉴에따른 카테고리를 한글문자열로 변환
      switch($menu){
        case "overlork":
            $menu = "오버로크";
            switch($category){
              case 1:
                $category = "전역마크";
              break;
              case 2:
                $category = "부대마크";
              break;
              case 3:
                $category = "계급장";
              break;
            }
          break;
        case "others":
            $menu = "군장물품";
            switch($category){
              case 1:
                $category = "침낭";
              break;
              case 2:
                $category = "수통";
              break;
              case 3:
                $category = "야전삽";
              break;
              case 4:
                $category = "군장덮개";
              break;
            }
          break;
        case "clothe":
            $menu = "전 투 복";
            switch($category){
              case 1:
                $category = "방상외피";
              break;
              case 2:
                $category = "방상내피";
              break;
              case 3:
                $category = "전투복";
              break;
              case 4:
                $category = "베레모";
              break;
              case 5:
                $category = "전투화";
              break;
            }
          break;
        }
          //디비에서 카테고리에 맞는 상품들고오기
          //PDO스테이트먼트 객체 반환
          $items = $this->_connect_model->get('Itemlist')->getItem($category);

          //값전부 넘겨주면서 렌더링
          $item_show = $this->render(array(
            '_menu'     => $menu,
            '_category' => $category,
            '_path'     => $path,
            '_items'    => $items,
          ),'items');

          return $item_show;
      }

        //재고체크는 뷰에서 함
    } //---end showListAction

  //상품 상세보기
  public function detailAction(){
    $arr = ltrim($this->_request->getPath(),'/');
    $arr = explode('/',$arr);
    //배열의 맨뒤의 값 추출
    $num = array_pop($arr);
    //경로의 넘버값 잘라내기  num

    $item = $this->_connect_model->get('Itemlist')->getDetail($num);
    //넘버값에 따른 상품데이터 출력

    $detail_view = $this->render(array(
     '_item'     => $item,
     '_token'    => $this->getToken(self::DETAIL),
    ));
    return $detail_view;
  }

  //상품 삭제
  public function deleteAction(){
    $arr = ltrim($this->_request->getPath(),'/');
    $arr = explode('/',$arr);
    //배열의 맨뒤의 값 추출
    $num = array_pop($arr);
    //경로의 넘버값 잘라내기  num
    $user = $this->_session->get('user');

    if($user['id'] != 'admin'){
      //관리자 체크
      echo "<script>alert('잘못된접근입니다.')</script>";
      echo "<script>history.go(-1)</script>";
      $this->redirect('/');
    }
      $this->_connect_model->get('ItemList')->deleteItem($num);

      $this->redirect('/');
  }

  //상품 수정뷰
    public function updateAction(){
      $arr = ltrim($this->_request->getPath(),'/');
      $arr = explode('/',$arr);
      //배열의 맨뒤의 값 추출
      $num = array_pop($arr);
      //경로의 넘버값 잘라내기  num
      $user = $this->_session->get('user');

      if($user['id'] != 'admin'){
        //관리자 체크
        echo "<script>alert('잘못된접근입니다.')</script>";
        echo "<script>history.go(-1)</script>";
        return $this->redirect('/');
      }

      $item = $this->_connect_model->get('Itemlist')->getDetail($num);
      //넘버값에 따른 상품데이터 출력

      $update_view = $this->render(array(
       '_item'     => $item,
       '_token'    => $this->getToken(self::UPDATE),
      ));
      return $update_view;
    }

  //상품 수정 작업
    public function updateSubmitAction(){
      //토큰체크 update
      $token = $this->_request->getPost('_token');
      if(!$this->checkToken(self::UPDATE,$token)){
        return $this->redirect('/');
      }

      //post값 불러오기
      $num      = $this->_request->getPost('num');
      $category = $this->_request->getPost('category');
      $title    = $this->_request->getPost('title');
      $summary  = $this->_request->getPost('summary');
      $price    = $this->_request->getPost('price');
      $stock    = $this->_request->getPost('stock');

      //데이터베이스 처리
      $this->_connect_model->get('Itemlist')->updateItem($num,$category,$title,$summary,$price,$stock);

      return $this->redirect('/detail'.'/'.$num);
    }

  //상품 구매
    public function buyItemAction(){
      //토큰체크 DETAIL
      $token = $this->_request->getPost('_token');
      if(!$this->checkToken(self::DETAIL,$token)){
        echo "인증에러";
        // return $this->redirect('/');
      }
      //로그인은 맨위 프로퍼티에서 디스패치하기전에 체크
      //세션의 아이디 추출
      $user = $this->_session->get('user');

      //포스트로 넘어오는 변수받기
      //id값/상품번호/구매수량/구매가격/구매시각
      $id    = $user['id'];
      $num   = $this->_request->getPost('num');
      //해당 상품레코트 추출
      $items = $this->_connect_model->get('Itemlist')->getDetail($num);

      $choiced_stock = $this->_request->getPost('stock');
      $price = $this->_request->getPost('price');
      $price = number_format(intval($price*$choiced_stock));
      $Time  = date("Y년m월d일");

      //데이터베이스에서 값 추출
      //상품이미지/상품명/현재재고//판매후수량
      $img   = $items['image'];
      $title = $items['title'];
      $stock = $items['stock'];
      $afterStock = $stock - $choiced_stock;
      if($stock == 0){
        //상품이 남아있지않으면 리다이렉트
        return $this->redirect('/');
      }
      if($afterStock < 0){
        //재고보다 구매량이 많을때 리다이렉트
        return $this->redirect('/');
      }

      // '/'로 게시글 구분  '|'로 각 멤버구분    상품이미지,상품명, 재고, 가격, 구매시간순

      //현재 아이디의 사용자 정보 추출
      $userData = $this->_connect_model->get('members')->getUserRecord($id);

        $history = $userData['history'];
        $history .= "/".$img."|".$title."|".$choiced_stock."|".$price."|".$Time;

      //변경된 사용자 정보 처리
        $this->_connect_model->get('members')->updateHistory($id,$history);
      //변경된 상품정보 처리
        $this->_connect_model->get('Itemlist')->updateStock($num,$afterStock);
      //구매페이지로 리다이렉트
      return $this->redirect('/detail'.'/'.$num);
    }

  //상품 등록 페이지
    public function uploadAction(){
      $upload_view = $this->render(array(
        '_token'   => $this->getToken(self::UPLOAD),
      ));
      return $upload_view;
    }

  //상품 등록
    public function itemRegisterAction(){
      //토큰체크 UPLOAD
      $token = $this->_request->getPost('_token');
      if(!$this->checkToken(self::UPLOAD,$token)){
        return $this->redirect('/');
      }
      //img 업로드
         $uploadDir = "C:/xampp/htdocs/shopmall.localhost/mvc_htdocs/img/GoodsImg/";
         //디렉토리 문자열
         $filename   = basename(rand(0,9999999).'_'.$_FILES['Goods_img']['name']);
         $uploadFile = iconv("UTF-8","EUC-KR",$uploadDir.$filename);
         //이미지 경로 문자열 파일이름 랜덤으로해서 중복사진 저장가능
         $imageFileType = pathinfo($uploadFile,PATHINFO_EXTENSION);
         //이미지 파일 타입 검사
         $check = getimagesize($_FILES['Goods_img']['tmp_name']);
         //이미지에대한 정보를 배열로 출력

           if(($check['mime'] != 'image/jpeg') && ($check['mime'] != 'image/png') && ($check['mime'] != 'image/gif')){
             //이미지 확장자에 따른 검사
             echo "<script>
                alert('jpg,png,gif 이미지 파일만 등록해주세요');
             </script>";
             echo "<script>
                   history.go(-1);
                </script>";
              return;
           }
          // echo $uploadDir;

          if(!move_uploaded_file($_FILES['Goods_img']['tmp_name'], $uploadFile)){
            //이미지 업로드 성공시 true
             echo "<script>
                alert('이미지 업로드에 문제가 발생하였습니다. 파일을 확인하여 주세요');
             </script>";
            //  echo "<script>
            //        history.go(-1);
            //     </script>";
          }

          //포스트로 넘어오는 값 저장
          $category= $this->_request->getPost('category');
          $title   = $this->_request->getPost('title');
          $summary = $this->_request->getPost('summary');
          $price   = $this->_request->getPost('price');
          $stock   = $this->_request->getPost('stock');
          $img     = $filename;

          //상품등록
          $this->_connect_model->get('Itemlist')->uploadItem($category,$title,$summary,$price,$stock,$img);

          //기본페이지로 리다이렉션
          return $this->redirect('/');


    }
}
 ?>
