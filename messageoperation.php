<?
require 'connect.php'; // подключаем скрипт
if($_POST["action"] == "message_read"){
$output = '';
if (isset($_POST["state"])) {
$state = $_POST["state"];
$message = R::getAll('SELECT * FROM message  WHERE state=? ORDER BY id DESC', [$state]);
}else{$message = R::getAll('SELECT * FROM message  WHERE state="0" ORDER BY id DESC');}
if ($state==1){
  $header='<h4>Обработанные запросы</h4>';
} else{$header='<h4>Запросы  на внесение изменений в справочник</h4>';}
$output .= '
<div class="table-responsive" >
'.$header.'
<table class="table table-bordered">
<thead>
<tr>
<th>id Запроса</th>
<th>Дата</th>
<!--th>ip_message</th-->
<!--th>ID Абонента</th-->
<th>Абонент</th>
<th>Внутренний</th>
<!--th>Городской</th-->
<th>Управление</th>
<th>Отдел/Бюро</th>
<th>Кабинет</th>
<th>Филиал</th>
<th>Сообщение</th>
<!--th>Обработано</th-->

</tr></thead>';

foreach($message as $row)
{
  $output .= '
  <tr>
  <td class="select_message" data-id_catalog="'.$row["id_catalog"].'" data-id_message="'.$row["id"].'">'.$row["id"].'<span class="glyphicon glyphicon-search"></span></td>
  <td>'.$row["date"].'</td>
  <!--td>'.$row["ip_message"].'</td-->
  <!--td>'.$row["id_catalog"].'</td-->
  <td>'.$row["sub"].'</td>
  <td>'.$row["vnutr"].'</td>
  <!--td>'.$row["city"].'</td-->
  <td>'.$row["unit"].'</td>
  <td>'.$row["department"].'</td>
  <td>'.$row["cabinet"].'</td>
  <td>'.$row["filial"].'</td>
  <td>'.$row["message"].'</td>
  <!--td><button type="button" name="btn_obr" id="btn_obr" class="btn btn-xs btn-success btn_obr btn-block" data-id="'.$row["id"].'">Готово</button></td-->
  </tr>
  ';
}

{
  if ($message==null){$output=''; $output='<br><div class="alert alert-info">
  <strong>Info!</strong>Нет необработанных запросов</div>';}
}
$output .= '</table>
</div>';
echo $output;
}


if($_POST["action"] == "message_update") {
   $data = $_POST["data"];
 $beans=R::exec( "UPDATE message SET state='1' WHERE id='".$data."'" );

 if ($beans!=null){
  echo 'Данные Обновлены';
 }
}


if($_POST["action"] == "message_select"){
  $id_message=$_POST["id_message"];
if (isset($_POST["id_message"])) {
 $output = '';
 // $sql =( "SELECT * FROM message  WHERE id=".$id_message."");
 $message = R::getAll('SELECT * FROM message  WHERE id=?', [$id_message]);
 // $result = mysqli_query($connect, $sql);
 $output .= '
 <div class="table-responsive" id="message_table">
 <table class="table table-bordered alert alert-info">
 <thead>
 <tr>
 <th hidden>id message</th>
 <th hidden>Дата</th>
 <th hidden>ip_message</th>
 <th>ID Абонента</th>
 <th>Абонент</th>
 <th>Внутренний</th>
 <!--th>Городской</th-->
 <th>Управление</th>
 <th>Отдел/Бюро</th>
 <th>Кабинет</th>
 <th>Филиал</th>

 </tr></thead>';

 foreach($message as $row)
 {
   $output .= '
   <tr>
   <td class="select_message" data-id_catalog="'.$row["id_catalog"].'"  data-id_message="'.$row["id"].'" style="background:  #CDC5BF" hidden>'.$row["id"].'</td>
   <td id="date_message" hidden>'.$row["date"].'</td>
   <td id="ip_message" hidden>'.$row["ip_message"].'</td>
   <td>'.$row["id_catalog"].'</td>
   <td>'.$row["sub"].'</td>
   <td>'.$row["vnutr"].'</td>
   <!--td>'.$row["city"].'</td-->
   <td>'.$row["unit"].'</td>
   <td>'.$row["department"].'</td>
   <td>'.$row["cabinet"].'</td>
   <td>'.$row["filial"].'</td>

   </tr>
   <div class="alert alert-info"><strong>Запрос на внесение изменений в справочник: </strong>№'.$row["id"].'<br><strong>Техническая информация: </strong>IP-'.$row["ip_message"].'<br><strong>Дата запроса : </strong>'.$row["date"].'<br><strong>Текст сообщения: </strong>'.$row["message"].'</div>
   <!--button type="button" name="btn_obr" id="btn_obr" class="btn btn-xs btn-success btn_obr btn-block" data-id="'.$row["id"].'">Готово</button--><hr>';
   
 //$output .= ' <script>$("#spr").html("<p>'.$row["date_message"].'</p>");</script>';

 }
 
 $output .= '</table>
 <button type="button" name="btn_obr" id="btn_obr" class="btn btn-xs btn-success btn_obr btn-block" data-id="'.$row["id"].'">Отметить, что ошибка исправлена</button>
 </div>';
 echo $output;
}
else{
 $output .= '
 <br><div class="alert alert-info">
 <strong>Info!</strong>Нет необработанных запросов</div>';
}
$output .= '</table>
</div>';
// echo $output;
}
?>