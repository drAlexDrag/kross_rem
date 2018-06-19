<div id='add_zayvka_Modal' class='modal fade'>
      <div class='modal-dialog'>
           <div class='modal-content'>
                <div class='modal-header'>
                     <button type='button' class='close' data-dismiss='modal'>&times;</button>
                     <h4 class='modal-title'>Оформление/Редактирование заявки</h4>
                </div>
                <div class='modal-body'>
                     <form method='post' id='insert_zayvka_form'>
                          <label>Номер телефона</label>
                          <input type='text' name='z_number_modal' id='z_number_modal' class='form-control input-sm'  />
                          <br>
                          <!--label>Неисправность</label>
                           <select name='z_neispr_modal' id='z_neispr_modal' class='form-control input-sm'>
                               <option selected  value='sss' >Совсем X</option>
                               <option  value='nnn' >Не совсем X</option>
                          </select>
                          <br /-->
                          <label>Неисправность</label>
                          <textarea name='z_neispr_modal' id='z_neispr_modal' class='form-control input-sm'></textarea>
                          <br>

                           <label>Площадка</label>
                           <select name='z_area_id' id='z_area_id' class='form-control input-sm'>
                               <option selected  value='kross_data_tr' >Транзистор</option>
                               <option  value='kross_data_mion' >Мион</option>
                               <option  value='kross_data_dz' >Дзержинка</option>
                          </select>
                          <br>
                          <label>Статус заявки</label>
                          <select name='z_rez_modal' id='z_rez_modal' class='form-control input-sm'>
                               <option selected  value='В работе' >В работе</option>
                               <option  value='Закрыта' >Закрыта</option>
                          </select>
                          <br>

                          <input hidden name='zayvka_id' id='zayvka_id' />
                          <input hidden name='z_login_id' id='z_login_id' />
                          <input type='submit' name='insert_zayvka' id='insert_zayvka' value='Добавить заявку' class='btn btn-success' />
                     </form>
<!--button type='button' name='delete__zayvka' id='delete__zayvka' class='btn btn-xs  btn-danger  btn_delete'>Очистить</button-->
                </div>
                <div class='modal-footer'>
                     <button type='button' class='btn btn-default' data-dismiss='modal'>Закрыть</button>
                </div>
           </div>
      </div>
 </div>