<?require_once 'connect.php'; // подключаем скрипт
$date = date("Y-m-d");
R::exec("UPDATE visits SET downloads=downloads+1 WHERE date='".$date."'");
?>