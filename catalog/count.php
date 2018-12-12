<?require_once '../connect.php'; // подключаем скрипт
// Получаем IP-адрес посетителя и сохраняем текущую дату
$visitor_ip = $_SERVER['REMOTE_ADDR'];
// print_r($visitor_ip);
$date = date("Y-m-d");

// Узнаем, были ли посещения за сегодня
$res = R::getAll( 'SELECT id FROM visits WHERE date=?', [$date] );
// Если сегодня еще не было посещений
// print_r($res);
if ($res==null){
    R::exec('DELETE FROM ips');// Очищаем таблицу ips
    $ip_address = R::dispense('ips');
    $ip_address->ip_address = $visitor_ip;
    R::store($ip_address);// Заносим в базу IP-адрес текущего посетителя
    $res_count = R::dispense('visits');
    $res_count->date = $date;
    $res_count->hosts = 1;
    $res_count->views = 1;
    R::store($res_count);// Заносим в базу дату посещения и устанавливаем кол-во просмотров и уник. посещений в значение 1
}

// Если посещения сегодня уже были
else {
    $current_ip = R::getAll( 'SELECT id FROM ips WHERE ip_address=?', [$visitor_ip] );
    // Проверяем, есть ли уже в базе IP-адрес, с которого происходит обращение
    if (($current_ip) != null) {// Если такой IP-адрес уже сегодня был (т.е. это не уникальный посетитель)
        R::exec("UPDATE visits SET views=views+1 WHERE date='".$date."'");// Добавляем для текущей даты +1 просмотр (хит)
    } else {// Если сегодня такого IP-адреса еще не было (т.е. это уникальный посетитель)
        $ip_address = R::dispense('ips');
    $ip_address->ip_address = $visitor_ip;
    R::store($ip_address); // Заносим в базу IP-адрес этого посетителя  

        R::exec("UPDATE visits SET hosts=hosts+1,views=views+1 WHERE date='".$date."'"); // Добавляем в базу +1 уникального посетителя (хост) и +1 просмотр (хит)
    }
    
}
?>