<?php
$output .= "<div class='pagination'><span><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $output .= "<li p='1' class='active'>В начало</li>";
} else if ($first_btn) {
    $output .= "<li p='1' class='inactive'>В начало</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $output .= "<li p=".$pre." class='active'>Предыдущая</li>";
} else if ($previous_btn) {
    $output .= "<li class='inactive'>Предыдущая</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $output .= "<li p=".$i." style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
    else
        $output .= "<li p=".$i." class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $output .= "<li p=".$nex." class='active'>Следующая</li>";
} else if ($next_btn) {
    $output .= "<li class='inactive'>Следующая</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $output .= "<li p=".$no_of_paginations." class='active'>Последняя</li>";
} else if ($last_btn) {
    $output .= "<li p=".$no_of_paginations." class='inactive'>Последняя</li>";
}
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Перейти'/></span>";
$total_string = "<span class='total' a=".$no_of_paginations.">Страница <b>" . $cur_page . "</b> из <b>".$no_of_paginations."</b>";
$output = $output . "</ul></span>" . $goto . $total_string . "</div>";  // Content for pagination
?>