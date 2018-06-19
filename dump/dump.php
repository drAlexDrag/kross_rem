<?php
exec('mysqldump --user=dron --password=port2100 --host=localhost kross > ' . date('Y-m-d') . '.sql');
// print_r(phpinfo());
?>