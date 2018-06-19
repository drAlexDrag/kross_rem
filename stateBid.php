<?php
require_once 'connect.php';
if(isset($_POST["idbid"]))
{

  $bid=R::getAll('SELECT * FROM bid WHERE id=?', [$_POST["idbid"]]);

  foreach($bid as $row)
  {
    echo json_encode($row);
  }
}
else if(isset($_POST["stateidbid"]))
{
$data=$_POST;
$bid = R::load( 'bid', $data["stateidbid"] ); //reloads our data
$bid->state=$data['state'];
$bid->commentbid=$data['commentbid'];
R::store($bid);
$bid=R::getAll('SELECT * FROM bid WHERE id=?', [$data["stateidbid"]]);

  foreach($bid as $row)
  {
    echo json_encode($row);
  }
}
?>