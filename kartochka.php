<?php
require 'connect.php';
$searchString=$_POST['searchString'];
$output='';
$outputnumber='';
$outputname='';
$outputtype='';
$countrows=1;
// $aaa;
// $areaQuery = R::getAll('SELECT area_name FROM area');
//   foreach($areaQuery as $row)
//  {
//   $areaaaa=$row['area_name'];
//   if($areaaaa==$aaa){break;}
    $beans = R::getAll('SELECT krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, krossdata.sub_id, sub.sub_name, sub.id, type.type_name, krossdata.comment, area.area_name
FROM krossdata
INNER JOIN sub ON krossdata.sub_id = sub.id
INNER JOIN type ON krossdata.type_id = type.id
INNER JOIN area ON krossdata.area_id = area.id
INNER JOIN raspred ON krossdata.raspred_id = raspred.id
WHERE  krossdata.number=? ORDER BY area.area_name, raspred.raspred_name', [$searchString]);
$aaa=$areaaaa;
$output.='<form class="form-horizontal well">';
foreach($beans as $row)
 {
  if ($outputnumber!=null){
    break;
  }
  $outputnumber=''.$row["number"].'';
  // print($output);
  // echo("\n");
 }
  foreach($beans as $row)
 {
  if ($outputname!=null){
    break;
  }
  $outputname.=''.$row["sub_name"].'';
  // print($output);
  // echo("\n");
 }
$output.='<legend>Номер: '.$outputnumber.' '.$outputname.'</legend>';


// <div class="row">
//           <div class="col-sm-12">
//   <div class="form-group">
//     <label class="control-label col-sm-1" for="namesub">Абонент</label>
//     <div class="col-sm-11"> 
//       <textarea class="form-control" id="namesub" disabled>';
   
//       foreach($beans as $row)
//  {
//   if ($outputname!=null){
//     break;
//   }
//   $outputname.=''.$row["sub_name"].'';
//   // print($output);
//   // echo("\n");
//  }
// // $output.=$outputname;
// $output.=$outputname.'</textarea>
// </div>
//   </div>
// </div>  

// </div>

        $output.='<div class="row">

        <div class="col-sm-4">
  <div class="form-group">
    <label class="control-label col-sm-3" for="raspredin">Рапределение</label>
    <div class="col-sm-9">
      <textarea class="form-control" id="raspredin" rows="6" disabled>';             
      foreach($beans as $row)
 {
  $output.=''.$row["area_name"].' : '.$row["raspred_name"].' : '.$row["data"].'&#13;&#10;';
  // print($output);
  // echo("\n");
  $countrows++;
 }
 echo('<p id="countrows" hidden>'.$countrows.'</p>');
 $output.='</textarea>
    </div>
  </div>
</div>';

// <div class="col-sm-2">
//   <div class="form-group">
//     <label class="control-label col-sm-3" for="typename">Тип линии</label>
//     <div class="col-sm-9">
//       <textarea class="form-control" id="typename" disabled>';             
//       foreach($beans as $row)
//  {
//     if ($outputtype!=null){
//     break;
//   }
//   $outputtype.=''.$row["type_name"].'';
//   // print($output);
//   // echo("\n");

//  }

//  $output.=$outputtype.'</textarea>
//     </div>
//   </div>
// </div>

$output.='<div class="col-sm-8">
  <div class="form-group">
    <label class="control-label col-sm-2" for="comment">Коментарии</label>
    <div class="col-sm-10"> 
      <textarea class="form-control" id="comment" rows="6" disabled>';
   
      foreach($beans as $row)
 {
  // if ($outputcomment!=null){
  //   break;
  // }
  $output.=''.$row["comment"].'&#13;&#10;';

 }
$output.='</textarea>
</div>
</div>
</div>
</div>';
$strlong=strlen($searchString);
$catalogBeans=R::getAll('SELECT catalog.id, catalog.sub_id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
WHERE vnutr=? AND length(catalog.vnutr)=?
ORDER BY catalog.id', [$searchString, $strlong]);
if($catalogBeans!=null){
  $output.='<legend>Информация по справочнику</legend>';
} else{
$output.='<legend>В справочнике отсутствует</legend>';
}
$output.='<div class="row">
<div class="col-sm-6">
  <div class="form-group">
    <label class="control-label col-sm-1" for="unit">Управление</label>
    <div class="col-sm-11"> 
      <textarea class="form-control" id="unit"  disabled>';
   
      foreach($catalogBeans as $row)
 {
  // if ($outputcomment!=null){
  //   break;
  // }
  $output.=''.$row["unit_name"].'&#13;&#10;';

 }
$output.='</textarea>
</div>
</div>
</div>';
$output.='<div class="col-sm-6">
  <div class="form-group">
    <label class="control-label col-sm-1" for="unit">Отдел/Бюро</label>
    <div class="col-sm-11"> 
      <textarea class="form-control" id="unit"  disabled>';
   
      foreach($catalogBeans as $row)
 {
  // if ($outputcomment!=null){
  //   break;
  // }
  $output.=''.$row["department_name"].'&#13;&#10;';

 }
$output.='</textarea>
</div>
</div>
</div>
</div>';


$output.='<div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>

</form>';
// if ($beans==null){$output='';}
echo($output);
// }
?>
<script type="text/javascript">
  // $('#raspredin').attr('rows', ($('#countrows').text()));
</script>