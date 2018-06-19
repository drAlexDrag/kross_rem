<?php
//Database connection by using PHP PDO
$username = 'dron';
$password = 'port2100';
$connection = new PDO( 'mysql:host=localhost;dbname=kross', $username, $password ); // Create Object of PDO class by connecting to Mysql database

if(isset($_POST["action"])) //Check value of $_POST["action"] variable value is set to not
{
 //For Load All Data
 if($_POST["action"] == "Load") 
 {
  $statement = $connection->prepare("SELECT * FROM users ORDER BY id DESC");
  $statement->execute();
  $result = $statement->fetchAll();
  $output = '';
  $output .= '
   <table class="table table-bordered">
    <tr>
     <th width="20%">ID</th>
     <th width="30%">Login</th>
     <th width="10%">Password hash</th>
     <th width="10%">Date of registration</th>
     <th width="10%">Admin</th>
     <th width="10%">Изменить</th>
     <th width="10%">Удалить</th>
    </tr>
  ';
  if($statement->rowCount() > 0)
  {
   foreach($result as $row)
   {
    $output .= '
    <tr>
     <td>'.$row["id"].'</td>
     <td>'.$row["login"].'</td>
     <td>'.$row["password"].'</td>
     <td>'.$row["reg_date"].'</td>
     <td>'.$row["admin"].'</td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button></td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button></td>
    </tr>
    ';
   }
  }
  else
  {
   $output .= '
    <tr>
     <td align="center">Data not Found</td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }

 //This code for Create new Records
 if($_POST["action"] == "Create")
 {
  $statement = $connection->prepare("
   INSERT INTO users (login, password, admin) 
   VALUES (:login, :password, :admin)
  ");
  $result = $statement->execute(
   array(
    ':login' => $_POST["login"],
    ':password' => md5($_POST["password"]),
    ':admin' => $_POST["useradmin"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }

 //This Code is for fetch single customer data for display on Modal
 if($_POST["action"] == "Select")
 {
  $output = array();
  $statement = $connection->prepare(
   "SELECT * FROM users 
   WHERE id = '".$_POST["id"]."' 
   LIMIT 1"
  );
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $output["login"] = $row["login"];
   $output["password"] = $row["password"];
  }
  echo json_encode($output);
 }

 if($_POST["action"] == "Update")
 {
  $statement = $connection->prepare(
   "UPDATE users 
   SET login = :login, password = :password 
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
    ':login' => $_POST["login"],
    ':password' => md5($_POST["password"]),
    ':id'   => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }

 if($_POST["action"] == "Delete")
 {
  $statement = $connection->prepare(
   "DELETE FROM users WHERE id = :id"
  );
  $result = $statement->execute(
   array(
    ':id' => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Deleted';
  }
 }

}

?>