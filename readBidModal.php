<div class="modal fade" id="readBidModal">
  <div class="modal-dialog" style='position: relative; width: 95%; margin: 10px;'>
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="titleReadBid"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="readbodyBid">
        <form method="post" id="readBidForm" class="form-horizontal">
         <div class="form-group">
          <label class="control-label col-sm-3">Номер телефона:</label>
          <div class="col-sm-9">
            <input type="text" name="phone" id="phone" class="form-control" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Неисправность:</label>
          <div class="col-sm-9">
            <textarea name="bidMessage" id="bidMessage" class="form-control" placeholder="Кратко опишите неисправность" readonly></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Номер телефона для связи:</label>
          <div class="col-sm-9">
            <input type="text" name="phoneObr" id="phoneObr" class="form-control" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Комментарии по выполнению заявки:</label>
          <div class="col-sm-9">
            <textarea name="commentbid" id="commentbid" class="form-control"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Статус заявки:</label>
          <div class="col-sm-9">
            <select class="form-control" size="1" name="statebid" id="statebid">
              <option  value="Открыта">Открыта</option>
              <option  value="В работе">В работе</option>
              <option  value="Закрыта" >Закрыта</option>
            </select>
          </div>
        </div>

        <?php
        $ip=$_SERVER["REMOTE_ADDR"];
        $hostname = gethostbyaddr ($ip);
        ?>

        <input hidden type="text" name="ip_messageBid" id="ip_messageBid"  value="<?php echo ($ip.'---'.$hostname);?>">
        <input hidden  type="text" name="stateidbid" id="stateidbid">


        <button type="button" class="btn btn-primary" onclick="updateStateBid()">Обновить статус</button>
      </form>

    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
    </div>

  </div>
</div>
</div>