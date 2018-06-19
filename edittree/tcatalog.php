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
  <!-- <link rel="stylesheet" href="/css/w3.css" /> -->
<!--   <link rel="stylesheet" href="/css/pagination.css" /> -->
  <link rel="stylesheet" href="/css/mystyle.css" />
  <script src="/js/jquery-3.2.1.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <!-- <script src="/javascript/ul-drop.js"></script> -->
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
        <!-- <li class="active"><a href="#" onclick="addBid()" id="select">Заявка на ремонт телефона</a></li> -->
                   <!-- <li class="active">
             <a class="dropdown-toggle" data-toggle="dropdown" href="#">Скачать справочник
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/download/СПРАВОЧНИКV2.pdf" onclick="countDownloads()"><img border="0" src="/images/pdf.png" alt="W3Schools" width="32" height="32"> pdf</a></li>
                <li><a href="/download/СПРАВОЧНИКV2.docx" onclick="countDownloads()"><img border="0" src="/images/docx.png" alt="W3Schools" width="32" height="32"> docx</a></li>
              </ul>
            </li> -->

      </ul>
    </div>
  </nav>
<!-- <div class="col-md-12">
<div class="col-md-3 preclass">
<pre class="preclass">
Пожарная часть  1-01, 32-07
Медпункт «ЗПП» 57-13
Медпункт «Транзистор»  31-55
</pre>
</div>
<div class="col-md-3 preclass">
<pre class="preclass">
Пульт ОПС «ЗПП» 33-22
Пульт ОПС «Транзистор» 25-00
Пульт ОПС «Мион» 58-08
</pre>
</div>
<div class="col-md-3 preclass">
<pre class="preclass">
АТС «ЗПП» 58-11
АТС «Транзистор» 32-22
АТС «Мион» 51-33
</pre>
</div>
<div class="col-md-3 preclass">
<pre class="preclass">
Дежурный  ОАО «ИНТЕГРАЛ»  69-04
Дежурный «Транзистор»  25-25
Дежурный энергетик 61-00, 34-44, 22-00
</pre>
</div>
</div>
<hr>
  <div class="container-fluid" >
    <div class="row">
      <div class="col-sm-6"  id="header_area"></div>
      <div class="col-sm-6" style="text-align:right;" id="header_form"></div>
    </div>

<hr> -->
   <!--  <div class="row" id="poisk">  -->     <noscript>
      <p class="alert alert-danger">Необходимо включить JAVASCRIPT в настройках браузера<br>
Необходимо наличие установленного браузера:<br>
Chrome  версии 49 и выше<br>
Opera   версии 43 и выше<br>
Firefox версии 46 и выше<br>
Internet explorer 11 и выше<br></p>
</noscript></div><hr>


    <div id="container_p">

<?php
require_once 'tcatalog_phone.php';?>
  </div>

</div>
<hr>
<!-- <footer class="container-fluid text-left well">
  <div class="col-md-4"><h3>Контакты</h3>
  Транзистор Кросс 3222<br>
  Мион Кросс 5133<br>
  Дзержинка Кросс 5811<br>
</div>
<div class="col-md-4"><h4>Для работы со справочником</h4>
Необходимо наличие установленного браузера:<br>
Chrome  версии 49 и выше<br>
Opera   версии 43 и выше<br>
Firefox версии 46 и выше<br>
Internet explorer 11 и выше<br></div>
<div class="col-md-4"></div>
<div class="col-md-12 text-right" id="copywriteblock">ADragunov</div>

</footer> -->

</body>
</html>