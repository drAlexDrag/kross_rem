<?php  require_once 'connect.php';?>
<form class="form-horizontal"  method="post" action="poisk_select.php"><!-- <div class="row"> -->
	<div class="col-md-2">
      <select class="form-control" size="1" name="paramPoisk" id="paramPoisk">
        <option  value="data" >Данные</option>
        <option  selected  value="number">Телефон</option>
        <option  value="sub_name" >Имя</option>
      </select>
    </div>

  <div class="col-md-10">
    <div class="input-group">

      <input type="text" class="form-control"  name="searchString" id="searchString">
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit" id="select_poisk">Поиск</button>
      </div>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 --><!-- </div> -->
</form>