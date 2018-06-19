<?php
require "connect.php";//параметры соединения; ?>


<!-- <p><a href="?interval=1">За сегодня</a></p>
<p><a href="?interval=7">За последнюю неделю</a></p> -->

<div class="table-responsive">
           <table class="table table-bordered table-hover header-fixed table-fixed">
            <h2>Статистика просмотров справочника</h2>
           <thead>
                <tr>
                    <th>Дата</th>
                     <th>Уникальные</th>
                     <th>Просмотров</th>
                     <th>Скачиваний</th>

                </tr>
                </thead>
                <tbody>

<?php
// Если в массиве GET есть элемент interval (т.е. был клик по одной из ссылок выше)
// if ($_GET['interval'])
// {
	$interval =7; //$_GET['interval'];

    // Если в качестве параметра передано не число
    if (!is_numeric ($interval))
    {
        echo '<p><b>Недопустимый параметр!</b></p>';
    }

    // Указываем кодировку, в которой будет получена информация из базы
    // @mysqli_query ($db, 'set character_set_results = "utf8"');

    // Получаем из базы данные, отсортировав их по дате в обратном порядке в количестве interval штук
	// $res = mysqli_query($db, "SELECT * FROM `visits` ORDER BY `date` DESC LIMIT $interval");
    $res = R::getAll('SELECT * FROM visits ORDER BY date DESC LIMIT '.$interval.'');

    // Формируем вывод строк таблицы в цикле
  foreach($res as $row)
  {
     echo '<tr>
              <td style="border: 1px solid silver;">' . $row['date'] . '</td>
              <td style="border: 1px solid silver;">' . $row['hosts'] . '</td>
              <td style="border: 1px solid silver;">' . $row['views'] . '</td>
              <td style="border: 1px solid silver;">' . $row['downloads'] . '</td>
          </tr>';
  }

// }
?>

</tbody></table></div>
