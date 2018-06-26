<?php  require_once 'connect.php';?>
<!-- <form class="navbar-form"  method="post" action="poisk_select.php">
	<div class="col-md-2">
      <select class="form-control" size="1" name="paramPoisk" id="paramPoisk">
        <option  value="data" >Данные</option>
        <option  selected  value="number">Телефон</option>
        <option  value="sub_name" >Имя</option>
      </select>
    </div>

  <div class="col-md-10">
    <div class="input-group">

      <input type="text" class="form-control"  name="searchString" id="searchString" placeholder="Строка поиска...">
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit" id="select_poisk">Поиск</button>
      </div>
    </div>
  </div>
</form> -->


<!--     <form class="navbar-form navbar-left" method="post" action="poisk_select.php">
      <div class="form-group">
        <select class="form-control" size="1" name="paramPoisk" id="paramPoisk">
        <option  value="data" >Данные</option>
        <option  selected  value="number">Телефон</option>
        <option  value="sub_name" >Имя</option>
      </select>
      </div>
      <div class="form-group">
        <input type="text" class="form-control"  name="searchString" id="searchString" placeholder="Строка поиска...">
      </div>
      <button class="btn btn-default" type="submit" id="select_poisk">Поиск</button>
    </form> -->

    <form class="navbar-form navbar-left" method="post" action="poisk_select.php">
      <div class="form-group">
        <select class="form-control" size="1" name="paramPoisk" id="paramPoisk">
        <option  value="data" >Данные</option>
        <option  selected  value="number">Телефон</option>
        <option  value="sub_name" >Имя</option>
      </select>
      </div>

  <div class="input-group">
    <input type="text" class="form-control" style="min-width: 50vw"  name="searchString" id="searchString" placeholder="Строка поиска...">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit" id="select_poisk">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>