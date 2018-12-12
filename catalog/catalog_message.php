<?php
//catalog_message.php
require_once '../connect.php';
if(!empty($_POST))
{
      $output = '';
      $message = '';
      $ip_message =$_POST["ip_message"];
      $data_message =$_POST["data_message"];
      $data_id =$_POST["data_id"];
      $data_sub =$_POST["data_sub"];
      $data_vnutr =$_POST["data_vnutr"];
      $data_city=$_POST["data_city"];
      $data_unit=$_POST["data_unit"];
      $data_department=$_POST["data_department"];
      $data_cabinet=$_POST["data_cabinet"];
      $data_filial=$_POST["data_filial"];

      $message=R::dispense('message');
      $message->ip_message=$ip_message;
      $message->id_catalog=$data_id;
      $message->sub=$data_sub;
      $message->vnutr=$data_vnutr;
      $message->city=$data_city;
      $message->unit=$data_unit;
      $message->department=$data_department;
      $message->cabinet=$data_cabinet;
      $message->filial=$data_filial;
      $message->message=$data_message;
      $message->state=0;
      R::store($message);

}
?>