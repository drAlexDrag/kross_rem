<form class="form-horizontal"  method="post" action="catalog_select.php" name="form_poisk" id="form_poisk"><!-- <div class="row"> -->
	<div class="col-md-2">
      <select class="form-control" size="1" name="param_poisk" id="param_poisk">
        <option   value="id" style="display: none" id="id_catalog">ID Абонента</option>
		<option selected  value="sub" checked>Абонент</option>
		<option  value="vnutr" >Телефон</option><!--option  value="city" >Городской</option-->
      </select>
    </div>

  <div class="col-md-10">
    <div class="input-group">

      <input type="text" class="form-control"  name="log_n_tel" id="log_n_tel" placeholder="Строка поиска...">
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit" id="poisk_spr">Поиск</button>
      </div>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 --><!-- </div> -->
</form>