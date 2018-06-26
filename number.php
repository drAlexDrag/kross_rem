<?php
require 'connect.php';
?>

<!-- <div class="numberphone"> -->
  <form class="navbar-form navbar-left numberphone">
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#container_k">Показать карточку абонента</button>
  <div class="form-group">
<?php
$phonetype=$_POST["phonetype"];
$output = '';
$number=R::getCol('SELECT number_name FROM '.$phonetype.' ORDER BY number_name');
$numOfnumber = R::count( ''.$phonetype.'' );
$output = '<select class="form-control" style="min-width: 20vw" name="numberli" id="numberli" onchange="numberlive()">';

 foreach ($number as $row => $number ){
  // $output .= '<option value="'.$row.'" >'.$number.'</option><br>';
  $output .= '<option value="'.$row.'" >'.$number.'</option><br>';
 }
$output .= '</select>';
echo $output;
echo('<p id="numOfnumber" hidden>'.$numOfnumber.'</p>');
    ?>
  </div>
<div class="form-group">
      <button style="width: 100px; text-align: left;" class="btn btn-default" type="button"><span class="glyphicon glyphicon-arrow-up" id="numcountup"></span></button>
      <!-- <span style="width: 100px; text-align: center;" class="glyphicon glyphicon-more" id="more"></span> -->
      <button style="width: 100px; text-align: left;" class="btn btn-default" type="button"><span class="glyphicon glyphicon-arrow-down" id="numcountdown"></span></button>
</div>
<!-- <span class="badge" id="numcount"></span> -->

  </form>
<!-- </div> -->



<script type="text/javascript">
	(function ($) {
  $('.numberphone .btn:first-of-type').on('click', function() {
    $('#numberli').val( parseInt($('#numberli').val(), 10) + 1);
    if (($('#numberli').val())===null){$('#numberli').val("0");}
    // $('#numcountdown').text($('#numberli').val());
    // $('#numcountup').text($('#numberli').val());
    // $('#more').text($('#numberli').val());
    numberlive();
  });
  $('.numberphone .btn:last-of-type').on('click', function() {
    $('#numberli').val( parseInt($('#numberli').val(), 10) - 1);
    // alert($('#numOfnumber').text()-1);
    if (($('#numberli').val())===null){$('#numberli').val(($('#numOfnumber').text())-1);}
    // $('#numcountdown').text($('#numberli').val());
    // $('#numcountup').text($('#numberli').val());
    // $('#more').text($('#numberli').val());
    numberlive();
  });
})(jQuery);
</script>