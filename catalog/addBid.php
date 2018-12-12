<?php
//catalog_message.php
require_once '../connect.php';
if(!empty($_POST))
{
      $output = '';
      $message = '';
      $phone =$_POST["phone"];
      $bidmessage =$_POST["bidMessage"];
      $phoneobr =$_POST["phoneObr"];
      $ipmessagebid =$_POST["ip_messageBid"];


      $bid=R::dispense('bid');
      $bid->phone=$phone;
      $bid->bidmessage=$bidmessage;
      $bid->phoneobr=$phoneobr;
      $bid->ipmessagebid=$ipmessagebid;
      $bid->state="Открыта";

      R::store($bid);

      $getinsertID=R::getinsertID();

      echo '<div class="alert alert-info" role="alert">Заявка зарегестрированаю. № Заявки : '.$getinsertID.'</div>';

}
?>