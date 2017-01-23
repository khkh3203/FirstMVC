<!DOCTYPE html>
<html>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="/js/common.js"></script>
<script src="/js/menu.js"></script>
<link rel="stylesheet" href="/css/ad.css">
<link rel="stylesheet" href="/css/common.css">
<link rel="stylesheet" href="/css/memberForm.css">
<link rel="stylesheet" href="/css/itemList.css">
<link rel="stylesheet" href="/css/mypage.css">
<link rel="stylesheet" href="/css/board.css">
  <head>
    <meta charset="utf-8">
    <title><?php if (isset($title)): print $this->escape($title).'-'; endif; ?></title>
  </head>
  <body>
    <div id="top_Ad">
      <?php print $this->render("form/TOP_AD"); ?>
    </div>
    <div id="headLine">
      <?php print $this->render("form/HEADLINE"); ?>
    </div>
    <div id="menu">
      <?php print $this->render("form/MENU"); ?>
    </div>
    <div id="mainForm">
      <?php
        // var_dump($this->_initialValue['session']);
            print $_content;
       ?>
    </div>
    <div id="bottomLine">

    </div>
  </body>
</html>
