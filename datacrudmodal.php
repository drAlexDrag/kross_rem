<div id='dataCrudModal' class='modal fade'>
<!-- Форма редактирования данных-->
  <div class='modal-dialog' style='position: relative; width: 95%; margin: 10px;'>
   <div class='modal-content'>
    <div class='modal-header'>
     <button type='button' class='close' data-dismiss='modal'>&times;</button>
     <h4 class='modal-title' id='dataCrudTitle'></h4>
   </div>



   <div class="modal-body row">
     <div class="col-sm-10" style="border-right: 5px solid #ccc;">
      <form method="post" id="dataCrudForm" class="form-horizontal">

       <div class="form-group">
        <label class="control-label col-sm-2">Данные:</label>
        <div class="col-sm-10">
          <input type="text" name="dataKross" id="dataKross" class="form-control verification autoClear" tabindex="1" data-original-title="" title="">
        </div>
        <div id="dataList"></div>
      </div>

      <div class="form-group">
       <label class="control-label col-sm-2">Распределение:</label>
       <div class="col-sm-10">
        <input type="text" name="dataRaspred" id="dataRaspred" data-table="raspred" data-input="#dataRaspred" class="form-control autoListData" tabindex="2" data-original-title="" title="">

        <!-- <div id="result"></div> -->
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Номер:</label>
      <div class="col-sm-10">
        <input type="text" name="dataNumber" id="dataNumber" class="form-control autoClear" tabindex="3" data-original-title="" title="">
      </div>
      <div id="numberList"></div>
    </div>

    <div class="form-group">
     <label class="control-label col-sm-2">Имя:</label>
     <div class="col-sm-10">
       <input type="text" name="dataSub" id="dataSub" data-table="sub" class="form-control autoListData" tabindex="4" data-original-title="" title="">
     </div>
   </div>

   <div class="form-group">
    <label class="control-label col-sm-2">Тип:</label>
    <div class="col-sm-10">
      <input type="text" name="dataType" id="dataType" data-table="type" class="form-control autoListData" tabindex="5" data-original-title="" title="">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">Комментарии:</label>
    <div class="col-sm-10">
      <input type="text" name="dataComment" id="dataComment" class="form-control autoClear" tabindex="6" data-original-title="" title="">
    </div>
  </div>

  <input hidden type="text" name="previousSubId" id="previousSubId">
  <input hidden type="text" name="areaName" id="areaName">
  <input hidden type="text" name="areaId" id="areaId">
  <input hidden type="text" name="dataId" id="dataId">
  <input hidden type="text" name="dataName" id="dataName">
  <input hidden type="text" name="subId" id="subId">
  <input hidden type="text" name="loginName" id="loginName">
  <input hidden class="id" type="text" name="raspredId" id="raspredId">
  <input hidden class="id" type="text" name="typeId" id="typeId">
  <!-- <input type='text' name='datasubupdate' id='datasubupdate' readonly/> -->

</form></div>

<div class="col-sm-2">
  <button type="button" class="btn btn-success btn-block" onclick="dataExecute()" name="buttonDataExecute" id="buttonDataExecute">Обновить</button>
  <button type="button" class="btn btn-danger btn-block" onclick="dataClear()" name="buttonDataClear" id="buttonDataClear">Очистить</button>
  <button type="button" class="btn btn-warning btn-block" onclick="pereKross()" name="buttonPereKross" id="buttonPereKross">Перекроссировать<br>Скопировать</button>
</div>

</div>

<!-- <hr> -->
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
</div>

</div></div></div>