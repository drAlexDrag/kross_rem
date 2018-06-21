<form class="navbar-form navbar-right"  method="post" action="catalog_select.php" name="form_poisk" id="form_poisk">
      <div class="form-group">
      <select class="form-control" size="1" name="param_poisk" id="param_poisk">
        <option   value="id" style="display: none" id="id_catalog">ID Абонента</option>
    <option selected  value="sub" checked>Абонент</option>
    <option  value="vnutr" >Телефон</option>
      </select><div class="input-group">
        <input style="min-width: 30vw" type="text" class="form-control"  name="log_n_tel" id="log_n_tel" placeholder="Строка поиска...">
      <div class="input-group-btn">
      <button class="btn btn-default" type="submit" id="poisk_spr"><i class="glyphicon glyphicon-search"></i></button>
    </div></div>
    </div>
    </form>