<?php
require_once '../connect.php';
 if(isset($_POST["data_id"]))
 {

 	$beans = R::getAll('SELECT catalog.id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE catalog.id=?', [$_POST["data_id"]]);

      foreach($beans as $row)
 {
      echo json_encode($row);
 }
}
 ?>