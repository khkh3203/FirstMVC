<?php
  require '../bootstrap.php';
  require '../BlogApp.php';

  $app = new BlogApp(true); // error 출력 여부(true-표시, false-미표시)
  $app->run();
?>
