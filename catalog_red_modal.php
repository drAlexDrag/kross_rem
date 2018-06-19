<div id="catalog_red_Modal" class="modal fade">
  <div class="modal-dialog" style='position: relative; width: 95%; '>
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title" id="modal_title_catalog" style="color:blue"></h4>
   </div>
   <div class="modal-body row">
    <div class="col-sm-10" style="border-right: 5px solid #ccc;">
     <form method="post" id="catalog_red_form" class='form-horizontal'>

      <div class='form-group'>
        <label class="control-label col-sm-2">ID:</label>
        <div class="col-sm-4">
          <input type="text" name="catalogId" id="catalogId"  class="form-control" readonly placeholder="Присваивается автоматически"/></div>

        <div class="input-group" style="padding-right: 15px;">
      <span class="input-group-addon"><!-- <i class="glyphicon glyphicon-eye-open" id="eyeVisibility"></i> -->Видимость абонента в справочнике</span>
      <select class="form-control" size="1" name="catalogVisibility" id="catalogVisibility" onchange="eyeVisibility(this.value)">
            <!-- <option selected disabled>Видимость абонента в справочнике</option> -->
            <option value="1">Видим</option>
            <option  value="0" >Не видим</option>
          </select>
    </div>
      </div>

      <div class='form-group'>
        <label class="control-label col-sm-2">Абонент:</label>
        <div class="col-sm-10">
          <input type="text" name="catalogSub" id="catalogSub" class="form-control autoListData" data-table="sub"  data-sql="sub_name" data-nameid='sub_id' data-id="#catalogSub"/>

        </div>
      </div>

      <div class='form-group'>
        <label class="control-label col-sm-2">Телефон:</label>
        <div class="col-sm-10">
          <input type="text" name="catalogVnutr" id="catalogVnutr" class="form-control"/>
        </div>
        <div id='vnutrList'></div>
      </div>

<!--div class='form-group'>
<label class="control-label col-sm-3">Городской:</label>
<div class="col-sm-9">
<input type="text" name="catalogCity" id="catalogCity" class="form-control"/>
</div>
</div-->

<div class='form-group'>
  <label class="control-label col-sm-2">Управление:</label>
  <div class="col-sm-10">
    <input type="text" name="catalogUnit" id="catalogUnit" class="form-control autoListData" data-table="unit" data-sql="unit_name"  data-id="#catalogUnit"  data-nameid='unit_id' data-idname=""/>
  </div>
</div>                  

<div class='form-group'>
  <label class="control-label col-sm-2">Отдел/Бюро:</label>
  <div class="col-sm-10">
    <input type="text" name="catalogDepartment" id="catalogDepartment" class="form-control autoListData" data-table="department" data-sql="department_name" data-id="#catalogDepartment" data-nameid='department_id' data-idname=""/>
  </div>
</div>

<div class='form-group'>
  <label class="control-label col-sm-2">Кабинет:</label>
  <div class="col-sm-10">
    <input type="text" name="catalogCabinet" id="catalogCabinet" class="form-control" />
  </div>
</div>

<div class='form-group'>
  <label class="control-label col-sm-2">Филиал:</label>
  <div class="col-sm-10">
    <input type="text" name="catalogFilial" id="catalogFilial" class="form-control autoListData" data-table="filial"  data-sql="filial_name" data-id="#catalogFilial" data-nameid='filial_id' data-idname=""/>
  </div>
</div>

<input hidden name="login_idred" id="login_idred" />
<!-- <input   name="catalogId" id="catalogId"/> -->

<input hidden name='subIdUpdate' id='subIdUpdate' readonly />


                          <!--input type="checkbox" name="catalogVisibility" id="catalogVisibility" checked>Видимость абонента<br>
                            <input type="text" name="catalogVisibility" id="catalogVisibility" class="form-control"/-->



                          <!--label>Сообщение</label>
                          <textarea name="data_message" id="data_message" class="form-control" ></textarea>
                          <br /-->
                          <!--input hidden name="ip_message" id="ip_message"  value="<?php
$ip_address = $_SERVER["REMOTE_ADDR"];
$hostname = gethostbyaddr ($ip_address);
echo ("$ip_address: $hostname");
?>" /-->


</form></div>
<!--button type="button" name="delete_btn" id="delete_btn" class="btn btn-xs  btn-danger  btn_delete">Очистить</button-->
<div class="col-sm-2"><button type="button" class="btn btn-success btn-block" name="insert_update" id="insert_update" onclick="catalogCRUD()"  >Изменение</button></div>
<br><br>
<div class="col-sm-2"><button type="button" class="btn  btn-danger btn_delete btn-block" name="delete_btn_catalog" id="delete_btn_catalog" >Очистить<span class="glyphicon glyphicon-remove-sign"></span></button></div>

<!-- <div class="col-sm-2">
    <div class="btn-group">
      <button type="button" name="insert_update" id="insert_update" onclick="catalogCRUD()" class="btn btn-success" >Изменение</button>
    </div>
    <div class="btn-group">
      <button type="button" name="delete_btn_catalog" id="delete_btn_catalog" class="btn  btn-danger  btn_delete">Очистить<span class="glyphicon glyphicon-remove-sign"></span></button>
    </div>
  </div> -->

</div>
<hr>
<div class="modal-footer">
 <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
 </div
</div>
</div>
</div>


