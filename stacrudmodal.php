 <div id='staCrudModal' class='mymodal fade'>
  <div class='mymodal-dialog'>
   <div class='mymodal-content'>
    <div class='mymodal-header'>
     <button type='button' class='close' data-dismiss='modal'>&times;</button>
     <h4 class='mymodal-title' id='staCrudTitle'></h4>
   </div>

   <div class='mymodal-body row'>
    <div class="col-sm-10" style="border-right: 5px solid #ccc;">
     <form  method="post" id="staCrudForm" class="form-horizontal">


      <div class='form-group autoList' id="autoListClass">
       <div class="col-sm-6"><label class="control-label " id="labelheader"></label></div>
          
          <div class="col-sm-6">
            <input type="checkbox" name="operation" id="newValue"> Добавить как новое
          </div>
        </div><hr>
        <div class="col-sm-12" id="out" style="color: blue"></div>

        <div class='form-group'>
  <div class="col-sm-12">
          <input type='text' name='staAutoList' id='staAutoList' data-table='asd'  class='form-control input-sm autoListData' placeholder="Поиск по id или имени..."/>
        </div>
</div>

<div class='form-group' id="outCrudModal"><!-- <div class="col-sm-12" id="out"></div> --></div>




<div class='form-group'>
  <div class="col-sm-6">
        <input hidden id='tablename' />
        <input hidden id='columnname' />
        <input hidden id='headername' />
        <input hidden id='idname' />
      </div>
    </div>
      </form></div>
    

  

      <div class="col-sm-2">
      <button type='button' class='btn btn-success btn-block' onclick="staExecute()" id="buttonExecute">Обработать</button>
      
      <button type='button' class='btn btn-danger btn-block' onclick="staDelete()" id="buttonDelete">Удалить</button>

</div>
</div>

  <div class='mymodal-footer'>
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
   </div>
 </div>
</div>




</div>



<!-- Modal -->
<div class="mymodal modal fade" id="myModalDelete" role="dialog">
  <div class="mymodal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titleDelete"></h4>
      </div>
      <div class="modal-body row">
        <div class="col-sm-10" style="border-right: 5px solid #ccc;">
        <form  method="post" id="staDeleteForm" class="form-horizontal">
          
           <div class="col-sm alert alert-info" id="idLabelDelete"></div>
          <div class="col-sm" id="outDelete"></div>

        </form></div>
      
      <div class="col-sm-2">
        <button type='button' class='btn btn-danger btn-block' onclick="deleteEntry()" id="deleteEntry">Точно удалить?</button>
      </div>

</div>
        <div class="modal-footer">
      <button type="button" class="btn btn-default" onclick="closeMyModalDelete()">Закрыть</button>
      </div>
    </div>

  </div>
</div>