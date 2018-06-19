<form  class="form-horizontal" method="post" action="" name="formPoiskCatalog" id="formPoiskCatalog">
<div class="col-md-2">
<select class="form-control" size="1" name="paramPoisk">
<option   value="id"  id="id_catalog">ID Записи в каталоге</option>
    <option  value="sub" checked>Абонент</option>
    <option selected value="vnutr" >Номер телефона</option>
    <!--option  value="city" >Городской</option-->
   </select>
</div>
<div class="col-md-10">
    <div class="input-group">
<input class="form-control" rows="1" cols="25" type="text" name="searchString" id="searchString" placeholder="Строка поиска..." >
<div class="input-group-btn">
        <button class="btn btn-default" type="submit" id="poiskCatalog">Поиск</button>
      </div>
<!-- <input class="btn btn-default" type="submit" value="Поиск" id="poiskCatalog" /> -->
</div></div>
</form>