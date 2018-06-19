<?php
require 'connect.php'; // подключаем скрипт
$output = '';
 if($_POST['page'])
{
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 25; // Per page
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

/* Total Count */

$count=R::count('catalog');

$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
 $output = '';
$beans = R::getAll('SELECT catalog.id, catalog.sub_id, catalog.unit_id, catalog.department_id, catalog.filial_id, sub.sub_name, catalog.vnutr, catalog.city, unit.unit_name, department.department_name, catalog.cabinet, filial.filial_name, catalog.visibility
FROM catalog
INNER JOIN sub ON catalog.sub_id = sub.id
INNER JOIN unit ON catalog.unit_id = unit.id
INNER JOIN department ON catalog.department_id = department.id
INNER JOIN filial ON catalog.filial_id = filial.id
ORDER BY id  LIMIT ?, ?', [ $start, $per_page ]);
 include('pagination.php');
    $output .= '
      <div class="table-responsive" id="catalog_table">
           <table class="table table-bordered table-hover header-fixed table-fixed" >
           <thead>
                <tr>
                     <th>ID</th>
                     <th>Абонент</th>
                     <th>Внутренний</th>
                     <!--th>Городской</th-->
                     <th>Управление</th>
                     <th>Отдел/Бюро</th>
                     <th>Кабинет</th>
                     <th>Филиал</th>
                </tr>
                </thead>';
foreach($beans as $row)
 {
            if (($row["visibility"])=="1"){
           $output .= '
                <tbody><tr>
                     <td  class="red_modal edit_catalog" data-sub="'.$row["sub_name"].'" data-id="'.$row["id"].'" data-www="tooltip" data-subid="'.$row["sub_id"].'">'.$row["id"].'<span class="glyphicon glyphicon-edit"></span></td>
                     <td  data-sub="'.$row["sub_name"].'" data-subid="'.$row["sub_id"].'" data-catalogid="'.$row["id"].'">'.$row["sub_name"].'</td>
                     <td class="data-number" data-idnumber="'.$row["vnutr"].'">'.$row["vnutr"].'<span class="glyphicon glyphicon-search"></span></td>
                     <!--td>'.$row["city"].'</td-->
                     <td>'.$row["unit_name"].'</td>
                     <td>'.$row["department_name"].'</td>
                     <td>'.$row["cabinet"].'</td>
                     <td>'.$row["filial_name"].'</td>

                </tr>
           ';
         }
         else{$output .= '
                <tbody><tr style="background:  #FF4500;">
                     <td  class="red_modal edit_catalog" data-sub="'.$row["sub_name"].'" data-id="'.$row["id"].'" data-www="tooltip" data-subid="'.$row["sub_id"].'">'.$row["id"].'<span class="glyphicon glyphicon-edit"></span></td>
                     <td  data-sub="'.$row["sub_name"].'" data-subid="'.$row["sub_id"].'" data-catalogid="'.$row["id"].'">'.$row["sub_name"].'</td>
                     <td class="data-number" data-idnumber="'.$row["vnutr"].'">'.$row["vnutr"].' <span class="glyphicon glyphicon-search"></span></td>
                     <!--td>'.$row["city"].'</td-->
                     <td>'.$row["unit_name"].'</td>
                     <td>'.$row["department_name"].'</td>
                     <td>'.$row["cabinet"].'</td>
                     <td>'.$row["filial_name"].'</td>

                </tr>
           ';}
 }

 
  $output .= '</table>
      </div>';
 echo $output;
}
 ?>
    <script>
//  localStorage.setItem('count_mes', '<?php echo $_SESSION['count_mes'];?>');
//   var count_mes=localStorage.getItem('count_mes');
//    $("#top_content_right").html("<pre>Необработанных запросов <span class='badge'>"+count_mes+"</span></pre>");
// </script>