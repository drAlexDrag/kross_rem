<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="no-cache" />
  <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Упорядочить абонентов</title>
  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="/css/bootstrap.css" />
  <link rel="stylesheet" href="/css/mystyle.css" />
  <script src="/js/jquery-3.2.1.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/myjs_edittree.js"></script>
</head>
<body>
  <button onclick="topFunction()" id="myBtn" title="Go to top"><span class="glyphicon glyphicon-arrow-up"></span></button>
  <?php
  $ip=$_SERVER["REMOTE_ADDR"];
  $hostname = gethostbyaddr ($ip);
  ?>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#" onclick="loadData()">Редактировать порядок отображения абонентов в справочнике</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#" onclick="loadData()">Главная</a></li>
      </ul>
    </div>
  </nav>
  <noscript>
    <p class="alert alert-danger">Необходимо включить JAVASCRIPT в настройках браузера<br>
      Необходимо наличие установленного браузера:<br>
      Chrome  версии 49 и выше<br>
      Opera   версии 43 и выше<br>
      Firefox версии 46 и выше<br>
      Internet explorer 11 и выше<br></p>
    </noscript>
  </div>
  <hr>
  <div id="container_p">
    <?php
    require_once 'tcatalog_phone.php';?>
  </div>
</div>
<hr>
</body>
</html>