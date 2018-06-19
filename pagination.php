<?php
$output .= "<div class='row'><div class='col-md-8'><span><ul class='pagination' style='padding-left: 0px'>";//Insert padding-left 0px

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $output .= "<li p='1' class='active'><a p='1' class='page-link' href='#'>В начало</a></li>";
} else if ($first_btn) {
    $output .= "<li p='1' class='inactive'><a p='1' class='page-link' href='#'>В начало</a></li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $output .= "<li p=".$pre." class='active'><a p=".$pre." class='page-link' href='#'>Предыдущая</a></li>";
} else if ($previous_btn) {
    $output .= "<li class='inactive'><a p=".$pre." class='page-link' href='#'>Предыдущая</a></li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $output .= "<li p=".$i."  class='active'><a p=".$i." class='page-link' href='#''>{$i}</a></li>";
    else
        $output .= "<li p=".$i." class='page-item'><a p=".$i." class='page-link' href='#'>{$i} <span class='sr-only'>(current)</span></a></li>";

}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $output .= "<li p=".$nex." class='active'><a p=".$nex." class='page-link' href='#'>Следующая</a></li>";
} else if ($next_btn) {
    $output .= "<li class='inactive'><a p=".$nex." class='page-link' href='#'>Следующая</a></li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $output .= "<li p=".$no_of_paginations." class='active'><a p=".$no_of_paginations." class='page-link' href='#'>Последняя</a></li>";
} else if ($last_btn) {
    $output .= "<li p=".$no_of_paginations." class='inactive'><a p=".$no_of_paginations." class='page-link' href='#'>Последняя</a></li>";
}
// $goto = "<input type='text' class='goto' size='1' style='margin-top:10px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Перейти'/></span>";
  $total_string = "<div class='col-md-2' style='margin-top:25px'><span class='total' a=".$no_of_paginations.">Страница <b>" . $cur_page . "</b> из <b>".$no_of_paginations."</b></span></div>";
$goto = '<div class="col-md-2" style="margin-top:20px">
    <div class="input-group">

      <input type="text" class="form-control goto"  name="searchString" id="searchString">
      <div class="input-group-btn">
        <button class="btn btn-default go_button" type="submit" id="go_btn">Перейти</button>
      </div>
    </div>
  </div>';
$output = $output . "</ul></span></div>" . $goto . $total_string . "</div>";  // Content for pagination
?>