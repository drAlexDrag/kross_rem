<!-- <form  class="form-horizontal" method="post" action="" name="formPoiskCatalog" id="formPoiskCatalog">
<div class="col-md-2">
<select class="form-control" size="1" name="paramPoisk">
<option   value="id"  id="id_catalog">ID Записи в каталоге</option>
    <option  value="sub" checked>Абонент</option>
    <option selected value="vnutr" >Номер телефона</option>
   </select>
</div>
<div class="col-md-10">
    <div class="input-group">
<input class="form-control" rows="1" cols="25" type="text" name="searchString" id="searchString" placeholder="Строка поиска..." >
<div class="input-group-btn">
        <button class="btn btn-default" type="submit" id="poiskCatalog">Поиск</button>
      </div>

</div></div>
</form> -->

<form class="navbar-form navbar-left" method="post" action="" name="formPoiskCatalog" id="formPoiskCatalog">
	<div class="form-group">
		<select class="form-control" size="1" name="paramPoisk">
			<option value="id"  id="id_catalog">ID Записи в каталоге</option>
			<option  value="sub" checked>Абонент</option>
			<option selected value="vnutr" >Номер телефона</option>
		</select>
	</div>
	<div class="input-group">
		<input class="form-control" style="min-width: 25vw" type="text" name="searchString" id="searchString" placeholder="Строка поиска..." >
		<div class="input-group-btn">
			<button class="btn btn-default" type="submit" id="poiskCatalog">
				<i class="glyphicon glyphicon-search"></i>
			</button>
		</div>
	</div>
</form>