<div id="add_data_Modal" class="modal fade">
  <div class="modal-dialog modal-lg">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title"><p>Запрос на изменение информации в справочнике</p><p>Внесите необходимые изменения и отправте запрос</p></h4>
   </div>
   <div class="modal-body">
     <form method="post" id="message_form">

      <input hidden name="data_id" id="data_id"  />

      <label>Абонент</label>
      <input type="text" name="data_sub" id="data_sub" class="form-control"/>

      <label>Внутренний</label>
      <input type="text" name="data_vnutr" id="data_vnutr" class="form-control"/>

      <!--label>Городской</label>
      <input type="text" name="data_city" id="data_city" class="form-control"/-->

      <label>Управление</label>
      <input type="text" name="data_unit" id="data_unit" class="form-control"/>

      <label>Отдел/Бюро</label>
      <input type="text" name="data_department" id="data_department" class="form-control"/>

      <label>Кабинет</label>
      <input type="text" name="data_cabinet" id="data_cabinet" class="form-control"/>

      <label>Филиал</label>
      <input type="text" name="data_filial" id="data_filial" class="form-control"/>

      <label >Сообщение</label>
      <textarea name="data_message" id="data_message" class="form-control" placeholder="Укажите номер телефона для обратной связи и какие изменения необходимо внести"></textarea>

                            <input hidden name="ip_message" id="ip_message"  value="<?php echo ($ip.'---'.$hostname);?>"/>
                          </div>
                          <div class="modal-footer">
                           <div class="col-sm-6" style="text-align:left;"><input type="submit" name="insert_massage" id="insert_message" value="Отправить запрос" class="btn btn-success" /></div>
                           <div class="col-sm-6" style="text-align:right;"><button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button></div>
                         </div>
                       </form>
                     </div>
                   </div>
                 </div>
               </body>
               </html>