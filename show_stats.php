<?//require_once 'connect.php'; // подключаем скрипт
// Указываем кодировку, в которой будет получена информация из базы
// Извлекаем статистику по текущей дате (переменная date попадает сюда из файла count.php, который, в свою очередь, подключается в каждом из 4 обычных файлов)
$date = date("Y-m-d");
$stats = "";
$res = R::getAll('SELECT views, hosts, downloads FROM visits WHERE date=?', [$date]);

 foreach($res as $row)
  {
$stats='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <center><div class="employees">
                    <p class="counter-count">'.$row['views'].'</p>
                    <p class="employee-p">Просмотров</p>
                </div></center>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <center><div class="employees">
                    <p class="counter-count">'.$row['hosts'].'</p>
                    <p class="employee-p">Уникальные</p>
                </div></center>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <center><div class="employees">
                    <p class="counter-count">'.$row['downloads'].'</p>
                    <p class="employee-p">Скачано</p>
                </div></center>
            </div>';
}
echo($stats);
?>