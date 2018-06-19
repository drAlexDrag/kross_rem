<div class="modal fade" id="bidModal">
  <div class="modal-dialog" style='position: relative; width: 95%; margin: 10px;'>
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Регистрация заявки на ремонт телефона</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="bodyBid">
        <form method="post" id="addBidForm" class="form-horizontal">
         <div class="form-group">
          <label class="control-label col-sm-3">Номер неисправного телефона:</label>
          <div class="col-sm-9">
            <input type="text" name="phone" id="phone" class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Неисправность:</label>
          <div class="col-sm-9">
            <textarea name="bidMessage" id="bidMessage" class="form-control" placeholder="Кратко опишите неисправность: шум, плохая слышимость......"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Номер телефона для связи:</label>
          <div class="col-sm-9">
            <input type="text" name="phoneObr" id="phoneObr" class="form-control">
          </div>
        </div>

        <?php
        $ip=$_SERVER["REMOTE_ADDR"];
        $hostname = gethostbyaddr ($ip);
        ?>

        <input hidden name="ip_messageBid" id="ip_messageBid"  value="<?php echo ($ip.'---'.$hostname);?>"/>


        <button type="submit" class="btn btn-primary" onclick="sendBid()">Зарегестрировать заявку</button>
      </form>

    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
    </div>

  </div>
</div>
</div>