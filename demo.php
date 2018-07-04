<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML('<html>

Text of document...

<indexentry content="Buffalo" />Your text which refers to a buffalo, which 
you would like to see in the Index

...rest of document

<pagebreak />

<h2>Index</h2>

<indexinsert usedivletters="on" links="on" collation="en_US.utf8" 
    collation-group="English_United_States"/>

</html>');
$mpdf->WriteHTML('<div name="1b21">test internal</div>');

$mpdf->WriteHTML('<tocpagebreak />');

$mpdf->WriteHTML('<tocentry content="Chapter 1" />');
$mpdf->WriteHTML('Chapter 1 ...');$mpdf->WriteHTML('<a name="1b21">test internal</a>');

$mpdf->Output();
?>

