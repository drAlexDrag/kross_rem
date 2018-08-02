<?php include 'count.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="no-cache" />
  <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Справочник телефонов ОАО "Интеграл"</title>
  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="/css/bootstrap.css" />
  <!-- <link rel="stylesheet" href="/css/w3.css" /> -->
  <!-- <link rel="stylesheet" href="/css/pagination.css" /> -->
  <link rel="stylesheet" href="/css/mystyle.css" />
  <script src="/js/jquery-3.2.1.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <!-- <script src="/javascript/ul-drop.js"></script> -->
  <script src="/js/myjs_cat.js"></script>
  <style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>
</head>
<body>
  <div id="loader" style="display:none;"></div>
  <button onclick="topFunction()" id="myBtn" title="Go to top"><span class="glyphicon glyphicon-arrow-up"></span></button>
  
  <nav class="navbar navbar-inverse myNavbar" id="myNavbar" name="myNavbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#" onclick="load_data(1)">Справочник телефонов ОАО "Интеграл"</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#" onclick="load_data(1)">Главная</a></li>
        <!-- <li class="active"><a href="#" onclick="addBid()" id="select">Заявка на ремонт телефона</a></li> -->
                   <li class="active">
             <a class="dropdown-toggle" data-toggle="dropdown" href="#">Скачать справочник
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <!-- <li><a href="#" onclick="countDownloads()"><img border="0" src="/images/pdf.png" alt="W3Schools" width="32" height="32"> pdf</a></li> -->
                <li><a download href="../catalogPdf.php" onclick="countDownloads()"><img border="0" src="/images/pdf.png" alt="W3Schools" width="32" height="32"> PDF</a></li>
                <li><a download href="../catalogWord.php" onclick="countDownloads()"><img border="0" src="/images/docx.png" alt="W3Schools" width="32" height="32"> WORD</a></li>
              </ul>
            </li>

      </ul>
      <div  id="poisk"></div>
    </div>


  </nav>
  <?php
$ip=$_SERVER["REMOTE_ADDR"];
$hostname = gethostbyaddr ($ip);
?>

<div class="container-fluid" style="padding-top: 55px">
  <div class="col-md-12">
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
</div></div>
</div>

<!-- <hr>
  <div class="container-fluid" >
    <div class="row">
      <div class="col-sm-6"  id="header_area"></div>
      <div class="col-sm-6" style="text-align:right;" id="header_form"></div>
    </div> -->

<hr>
    <!-- <div class="row" id="poisk"> -->      
      <noscript>
      <p class="alert alert-danger">Необходимо включить JAVASCRIPT в настройках браузера<br>
Необходимо наличие установленного браузера:<br>
Chrome  версии 49 и выше<br>
Opera   версии 43 и выше<br>
Firefox версии 46 и выше<br>
Internet explorer 11 и выше<br></p>
</noscript>
<!-- </div> -->
<!-- <hr> -->


    <div id="container_p">
<!-- <img id="loadImg" src="/images/load.gif" /> -->
<?php
require_once 'catalog_phone.php';?>

  </div>

</div>
<hr>
<footer class="container-fluid text-left well">
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

</footer>

<?php
require('catalog_modal.php');
require('myAlert-modal.php');
?>
<div class="modal fade" id="myMessange" tabindex="-1" role="dialog" aria-labelledby="myAlertLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myMessangeLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="myMessangeBody">
      <div class="alert alert-danger">
Версия справочника является тестовой<br>
Возможно наличие ошибок по информации содержащейся в справочнике<br>
Возможно наличие ошибок в интефейсе пользователя<br>
Организационные структуры подразделений можно направлять по адресам:
ABelov@integral.by &nbsp; Белов, Александр<br>
ADragunov@integral.by &nbsp; Драгунов, Александр<br>
        <div class="alert alert-info">Запросы на изменение информации в справочнике обрабатываются по мере поступления</div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
</body>
</html>