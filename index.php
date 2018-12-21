<?php
require "connect.php";
if(isset($_SESSION['loginUser'])):?>
<!DOCTYPE html>
  <html>
  <head>
    <title id="kross">АРМ КРОСС</title>
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/myjs.js"></script>
    <!-- <script src="/js/livereload.js"></script> -->

  </head>    
  <body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><span class="glyphicon glyphicon-arrow-up"></span></button>
    <nav class="navbar navbar-inverse myNavbar" id="myNavbar" name="myNavbar">
      <div class="container-fluid">
        <div class="navbar-header" id="asd">
          <a class="navbar-brand" href="#" onclick="fetchData(1)">
            <span class="dot-red"></span>
            <span class="dot-yellow"></span>
            <span class="dot-green"></span>
            КРОСС</a>
             <!-- <audio id="myaudio" preload="auto">
           <source src="/1.ogg">
         Ваш браузер не поддерживает аудио при помощи html5.
         </audio><script>var myaudio = $("#myaudio")[0];
$("#asd a")
   .mouseenter(function() {
      myaudio.play();
   });
</script> -->
          <ul class="nav navbar-nav navbar-left"><li class="place navbar-form" id="area">
              <?php require_once 'list_area.php'; ?>
            </li></ul>
        </div>

        <!-- <div class="collapse navbar-collapse" id="myNavbar"> -->
          <ul class="nav navbar-nav navbar-left">
            

            <li ><a href="#" onclick="fetchData(1)">Домой <span class="glyphicon glyphicon-home"></span></a></li>
            <!-- <li ><a href="#" onclick="readBid()" id="counthref">Заявки</a><span class="label label-info" id="countbid"></span></li> -->

            <li class="dropdown">
             <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-phone-alt"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">По номерам</li>
                <li><a href="#" onclick="number('number')"><span>Номера Внутренние</span></a></li>
                <li><a href="#" onclick="number('city')"><span>Номера Городские</span></a></li>
                <!-- <li><a href="#" onclick="catalogFreeNumber()"><span>Свободные номера</span></a></li> -->
              </ul>
            </li>

            <li class="dropdown">
             <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="counthrefmess">Справочник
              <span class="caret"></span><span class="label label-info" id="countmess"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Работа со справочником</li>
                <li><a href="#" onclick="catalogOpen()"><span>Справочник телефонов</span></a></li>
                <li><a href="#" onclick="catalogEdit(1)"><span>Редактировать справочник</span></a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Сортировка</li>
                <li><a href="#" onclick="catalogEditTree()"><span>Порядок отображения абонентов</span></a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Статистика</li>
                <li><a href="#" onclick="stats()"><span>Статистика просмотра справочника</span></a></li>
                <!-- <li><a href="#" onclick="catalogFreeNumber()"><span>Свободные номера</span></a></li> -->
              </ul>
            </li>
            <!-- <li class="dropdown">
             <a class="dropdown-toggle" data-toggle="dropdown" href="#">Лог
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Логи операций с данными</li>
                <li><a href="#"  onclick="readLogData(1)"><span>Лог Данных</span></a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Логи операций со справочником</li>
                <li><a href="#"  onclick="readLogCatalog()"><span>Лог Справочника</span></a></li>
              </ul>
            </li> -->

            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">БД
               <span class="caret"></span></a>
               <ul class="dropdown-menu">
                <li class="dropdown-header">Редактировать списки</li>
                <li><a href="#" onclick=" staCRUD('sub', 'Абоненты')"><span>Абоненты</span></a></li>
                <li><a href="#" onclick=" staCRUD('unit', 'Управления')"><span>Управления</span></a></li>
                <li><a href="#" onclick=" staCRUD('department', 'Отделы/Бюро')"><span>Отделы/Бюро</span></a></li>
                <li><a href="#" onclick=" staCRUD('filial', 'Филиалы')"><span>Филиалы</span></a></li>
                <li><a href="#" onclick=" staCRUD('area', 'Площадки')"><span>Кроссовые журналы</span></a></li>
                <li><a href="#" onclick=" staCRUD('type', 'Типы')"><span>Типы</span></a></li>
                <li><a href="#" onclick=" staCRUD('raspred', 'Распределение')"><span>Распределение</span></a></li>
                <li><a href="#" onclick=" staCRUD('sector', 'ТЕСТ Сектор')"><span>ТЕСТ Сектор</span></a></li>
                <!-- <li><a href="#" onclick=" staCRUD('number', 'Номера')"><span>Номера (тест)</span></a></li> -->
                <li class="divider"></li>
                <li class="dropdown-header">Резервное копирование БД</li>
                <li><a href="#" onclick="dump()"><span>Сделать резервную копию БД</span></a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Лог работы</li>
                <li><a href="#"  onclick="readLogData(1)"><span>Лог Данных</span></a></li>
                <li><a href="#"  onclick="readLogCatalog()"><span>Лог Справочника</span></a></li>
                <li><a href="#"  onclick="readLogSta()"><span>Лог Таблиц</span></a></li>
              </ul>

            </li>
            <!-- </li> -->

            <li class="dropdown admin" >
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#" onclick="usersConfig()"><span>Настройка пользователей</span></a></li>
                  <!-- <li><a href="#" id="con"><span>Консоль</span></a></li> -->
                  <!-- <li><a href="#" id="napolnenie"><span>Наполнение справочника</span></a></li> -->
                  <!-- <li><a href="#" onclick="catalogEditTree()"><span>Порядок отображения абонентов</span></a></li> -->
                  <!-- <li> <a href="signup.php" id="registration"><span>Зарегистрировать пользователя</span></a></li> -->

                </ul>
              </li>
              <li ><a href="#" id="printt">Печать <span class="glyphicon glyphicon-print"></span></a></li>
              
            </ul>
            <ul class="nav navbar-nav navbar-right" style="border-left: 1px solid #FFFFFF;"><li><a href="#" onclick="exitKross()">Выход <span class="glyphicon glyphicon-off"></span></a></li></ul>
            <!-- </div> -->
          </div>
        </nav>

        <div class="container-fluid text-center" style="padding-top: 100px">
          <div class="row content">
            <div class="col-md-12 text-left">

              <div class="row" id="top_header_left">

                <nav class="navbar navbar-default">
  <div class="container-fluid">
  <div class="navbar-header" style="min-width: 15vw">
  <a class="navbar-brand" href="#" id="header_area"></a>
  </div>

<div id="poisk"></div>

    <div class="topnav topnav-right" id="topnav_right">

    </div>

  </div>
  </nav>
              </div>
              <div id="container_nl"></div><hr>
              <div id="container_k" class="collapse"></div>
              <div id="container_m"></div>
              <div id="container_p"></div>
              <hr>

              <!-- <h3>Test git</h3>
              <p>Lorem ipsum...test123</p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAVESURBVGhD7ZpbqFVFHIdXWioZZmpRlBZaEZaZlZWhIBJeUCvfhEIN7MG8hlnPoUWZlXnBwhRfvL16y2uoaSFWPvVQUZIEBtLVIisrf9/M+uM07b327L3X2ceH/cHHmVm3mbXXrJn/zDpZmzZtWs7N8nH5glwm38kl/bxkX395SXKfXCm/kv/KX+THcpvcnEuabWclx3DsW5JzO51J8iP5jzwkZ8vBshZ3ynmSczj3QzlRtpzb5T55Tq6Rt8qQa+RlPpndnwtsY1/IbZKm94fcm+dbwgz5m9wlB7Eh56b8LxyXD/lkNjUX2MY+IzyHH2OP5NqU0WF0kSvk73IWGwIul9/JPi7n89WwfRzLOfGxcyRP+k1pT7U0uOAG+b0cwYacJbKvTzYF1+Baxkj5g6TMUm9mlfxRDnW5iyyUV/tkU3ANrhVCWT/J5S5XAk9JmtODLpdl98qxPtkhcG3KgFGSTmCayzUBPQgvX/hOPCKbvnABXJsyjLnyVxn3jHVBF7vTJzsN3hG65fdcrgEY7GhSA10uyxbL53yyInfLJ+VVLtc8lEWZQMugiU1wuTphxGawM/rJ3j75PwZICrLQg5tKgWb0rrzC5f4LZVGmsVYe8cl0GIkJHaxdFo0L8IzkJr7N//4srXMoghiM4592ucpY2TwV6jTM5RIhmDvok9mNkoGriHWSCo2XL+bpM3KILGK45NivJU/lAblJHpDdJVA2dQCeyBs+mQYXZoQ14vgohoKpkIUsr0jyNLNr2VDADsmxX+Z/7cZ6SAjLni85LolbJBcjQk3lU8k5FqLQ01izeV9Wapo8ASLgk9Ju4DNJM7ObiOEJc1zSfOYxyZwBCB0I8rq6XHWsMmE4caVk/sH2l9kQQTNkH+2e0If0TBlD2dSBunB9xpTJsibM7KgAcOLDPlnIN5KKxPB0iZn+lnE00E1ScX5lOhfOt3clhjrYj3RCLvLJYl6X230ymWo3AlMk+3hpCQZ7yUowg+S4Wr0S79RrPlnM23KjT7qY5wmfLORzSSX4lWMI/4kQ2I+8O5Xg/aLJhM3ToA4Wf1E36liTRm7kmKSS17mcp6ek5wt7I1wq6yW8EbrnpBtppGkxs6OSDFrM+uh+eTes8vslwd95yXTgBtkoyU2Ll/0Tn3SPOZxIVWOrtAr/macJWZgY3SMN5hbs2+Jy6VCHul/2RyXdLyemdL8cHzYfRvSX5PUyhoDylOS41ACwUvdLQFsTFtgoKGVAZN5gN4DrJeNHEYxTHBuO3qkQjHJuuGhRCKFFSojCFJW5NotzFLBapkBT5H2xKUIRYdkLJD1kMrTlwz6ZFDRa6MA7kgKDXuqMLwwaWcijM0qGrq6eMJ7x4y952uXKJQ7jw84jiaMy7K+LJlZgcVXKkmkK8cSKqcIHPlkfrMXShfJLQK2pLvu5EULtMginundI6kKg2RBM+hnsUmBSxKN/1eXKgy6Xd48l2obhHWE5KOzBipaDaFb1dqkx8XLQs5JxranlIJgueaxErkBH0KoFujGSslmdKQXm8CxftnLJlN6JMhsJMqtCOyVuIhC0JwMdtYg9WhJclr6IDVyQpX6W/MN3BujrGbia/axAGbwTBJ58cyz9JkL4CMPLF39davZDD10svRPXTpkDlQLLPrslLyIrheENAfGR/Zq1Pr3xGY9gk2uxzhx+BWsZhOJEAIwfLJ4xGN4li5oE+4hiCQCJnTiXuG6c7HToLlkB/EIyujNnYK2L2Zx9nibNNvZxDFEsAWDdsVOroN0z2WIWR9dp/zBAmrCDBYbk+USbNm3KIMsuAAGfM32NU34wAAAAAElFTkSuQmCC"> -->

            </div>

          </div>
        </div>

        <footer class="container-fluid text-left well">
          <div class="col-md-4"><h3>Контакты</h3><hr>
            Транзистор Кросс 3222<br />
            Мион Кросс 5133<br/>
            Дзержинка Кросс 5811<br/><br/>
          </div>
          <div class="col-md-4"><h3>Просмотры справочника</h3><hr>
           <?php include 'show_stats.php';?>
         </div>
         <div class="col-md-4"><h3>Работает</h3><hr><p id="login"><?php echo $_SESSION["login"];?></p>
          <p>IP: <?php echo $_SERVER["REMOTE_ADDR"]; ?></p></div>
          <div id="adm" hidden><?php echo $_SESSION["admin"];?></div><?php echo $hostname; ?>

          <div class="col-md-12 text-right" id="copywriteblock">ADragunov</div>
        </footer>

        <div id="overlay" class="overlay">
          <!-- Button to close the overlay navigation -->
          <!-- <a href="javascript:void(0)" class="closebtn" onclick="off()">Закрыть подсказку</a> -->
          <button type="button" class="btn closebtn" id="closeAlertoverlay" onclick="off()">Закрыть подсказку</button>
          <div id="alertoverlay"></div>
        </div>
        <!-- <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script> -->
      </body>
      </html>
      <?php
      require('modal.php');
      ?>
    <?php else:?>
      <script>window.location="login.php";</script>

    <?php endif;?>
