$(document).ready(function(){
  if (($('#adm').text())!=1){
    $(".admin").remove();}
    var height=$(window).height();
    var width=$(window).width();
    $("#xxx").text(height+"/"+width);
    if(width<1200){
      $("#myNavbar").removeClass("myNavbar")
    }
    // alert("Высота:"+height+" Ширина:"+width);

    fetchData(1);
    count();
    $('#dataKross').tooltip({title: 'Данные<br><span class="colortext">Для обозначения рамок рекомендуется использовать символ <span>"R"</span></span>', container_p: ".modal-body", placement: "top", html: true});
    $('#dataRaspred').tooltip({title: "Выбираем тип распределения: <span class='colortext'>Входящие/Исходящие</span>", container_p: ".modal-body", placement: "top", html: true});
    $('#dataNumber').tooltip({title: "Номер <span class='colortext'>телефона</span>", container_p: ".modal-body", placement: "top", html: true});
    $('#dataSub').tooltip({title: "Выбрать <span class='colortext'>имя</span> из списка. Новое имя абонента можно добавить через меню БД>Абоненты. <span style='color:blue'>Для редактированя имени абонента необходимо перейти в соответствующее меню.</span>", container_p: ".modal-body", placement: "top", html: true});
    $('#dataType').tooltip({title: "Тип <span class='colortext'>связи</span> можно выбрать из списка", container_p: ".modal-body", placement: "top", html: true});
    $('#dataComment').tooltip({title: "Любая <span class='colortext'>полезная или не полезная информация</span>", container_p: ".modal-body", placement: "top", html: true});

    $('#catalogId').tooltip({title: "Присваивается <span class='colortext'>автоматически</span>", container_p: ".modal-body", placement: "top", html: true});
    $('#catalogVisibility').tooltip({title: "Видимость абонента в каталоге (будет ли доступна информация об абоненнте в справочнике).", container_p: ".modal-body", placement: "top", html: true});
    $('#catalogSub').tooltip({title: "Редактируем <span class='colortext'>имя</span> абонента в справочнике. Новое имя абонента можно добавить через меню БД>Абоненты.", container_p: ".modal-body", placement: "top", html: true});
    $('#catalogVnutr').tooltip({title: "Редактируем <span class='colortext'>номер телефона</span> абонента в справочнике", container_p: ".modal-body", placement: "top", html: true});
    $('#catalogCity').tooltip({title: "Редактируем <span class='colortext'>номер телефона</span> абонента в справочнике", container_p: ".modal-body", placement: "top", html: true});
    $('#catalogUnit').tooltip({title: "Редактируем <span class='colortext'>наименование управления</span> абонента в справочнике. Выбираем из имеющихся.<br>Новое управление можно добавить через меню БД>Управления.", container_p: ".modal-body", placement: "top", html: true});
    $('#catalogDepartment').tooltip({title: "Редактируем <span class='colortext'>наименование отдела или бюро</span> абонента в справочнике. Выбираем из имеющихся.<br>Новый Отдел/Бюро можно добавить через меню БД>Отдел/Бюро.", container_p: ".modal-body", placement: "top", html: true});
    $('#catalogCabinet').tooltip({title: "Редактируем <span class='colortext'>номер кабинета/помещения</span> абонента", container_p: ".modal-body", placement: "top", html: true});
    $('#catalogFilial').tooltip({title: "Редактируем <span class='colortext'>наименование филиала</span> абонента. Можно выбрать из имеющихся", container_p: ".modal-body", placement: "top", html: true});
    $('#insert_update').tooltip({title: "Подтвердить <span class='colortext'>изменение данных абонента</span>", container_p: ".modal-body", placement: "top", html: true});
    
    bidAlert();
    inactivityTime();


 });////////////////////

$(document).on('keyup', '#myInput',function(){

  var value = $(this).val().toLowerCase();
  $("#myTable tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});

function inactivityTime() {
  var t;
  window.onload = resetTimer;
    // DOM Events
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;

    function logout() {
      $.ajax({
        url: "logout.php",
        cache: false,
        success: function(html){
          $("body").html(html);
        }
      });
    }

    function resetTimer() {
      clearTimeout(t);
      t = setTimeout(logout, 1800000)
        // 1000 milisec = 1 sec
      }
    };


    var isCyrillic = function (text) {
      return /^[a-zA-Z0-9+-/_*]+$/i.test(text);
    }
// console.log(isCyrillic('P2')); //t
// console.log(isCyrillic('Р2')); //f

setInterval(bidAlert, 600000);
function bidAlert() {
  $.ajax({
    url: "countbid.php",
    cache: false,
    dataType:"html",
    success: function(data){
      if (data!=0) {
        $('#bidAlert').text(data);
            // $('#myBidAlert').modal('show');
            alertoverlay('<div class="alert alert-info">\
              В наличии имеются <span class="label label-danger" id="bidAlert">'+data+'</span>\
              заявки</strong> на ремонт телефона');
          }
        }
      });
}

//Pagination pagination.php
$(document).on('click', 'li.page-item, a.page-link',function(){
  var page = $(this).attr('p');
  var www =$('.headerPage').attr("data-www");
  console.log("pagin", www);
  if (www=="redaktorCatalog") {catalogEdit(page);} 
  else if (www=="logKross") {readLogData(page);}
  else if (www=="logCatalog") {readLogCatalog(page);}
  else {fetchData(page);}
});
$(document).on('click', '#go_btn',function(){
  var page = parseInt($('.goto').val());
  var no_of_pages = parseInt($('.total').attr('a'));
  if(page != 0 && page <= no_of_pages){
    var www =$('.headerPage').attr("data-www");
    console.log("pagin", www);
    if (www=="redaktorCatalog") {catalogEdit(page);} 
    else if (www=="logKross") {readLogData(page);}
    else if (www=="logCatalog") {readLogCatalog(page);}
    else{fetchData(page);}
  }else{
    alertoverlay('Введите номер между 1 и '+no_of_pages);
    $('.goto').val("").focus();
    return false;
  }
});
//Pagination END


function count() {
  $("#countbid").remove();
  $.ajax({
    url: "countbid.php",
    cache: false,
    dataType:"html",
    success: function(data){
      $("#counthref").append('<span class="badge" id="countbid">'+data+'</span>');

    }
  });
  $("#countmess").remove();
  $.ajax({
    url: "countMess.php",
    cache: false,
    dataType:"html",
    success: function(data){
      $("#counthrefmess").append('<span class="badge" id="countmess">'+data+'</span>');
    }
  });
}

    // setInterval(func, 60000);



//Вывод на печать
$(document).on('click', '#printt', function(){
 Popup($('.table-responsive').html());

});
//Вывод на печать
//Вывод на печать
function Popup(data)
{
  var mywindow = window.open('', 'my div', 'height=700,width=1200');
  mywindow.document.write('<html><head><title>Печать текущей страницы</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<div><h3>Кроссовый журнал</h3></div>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.print();
        mywindow.close();
        return true;
      }

//EXIT

function exitKross(data){
  if(confirm("Вы действительно хотите завершить работу?")){
    $.ajax({
      url: "logout.php",
      cache: false,
      success: function(html){
        $("body").html(html);
      }
    });
  }
}

function fetchData(page)//Загрузка начальной страницы
{
  $("#container_m").html("");
  $("#message_area").detach();
  $('#area').show();
  $('#top_content_right').show();
  $('#top_content_right2').show();
  $('#top_content').show();
  $('#top_bottom').show();
  var area=paramArea()[0];
  var areaId=paramArea()[1];
  // header='<nav class="navbar navbar-default">\
  // <div class="container-fluid">\
  // <div class="navbar-header">\
  // <a href="#"><h4>Поиск по данным '+area+'</h4></a>\
  // </div>\
  // <ul class="nav navbar-nav navbar-right">\
  // <li><a href="#" onclick="dataCRUD()">Добавить данные</a></li>\
  // </ul>\
  // </div>\
  // </nav>';
  // var header=$('#header_area').text();
  // header=header+' '+area;
  // console.log(header);
  var topnav='<ul class="nav navbar-nav"><li><a href="#" onclick="dataCRUD()">Добавить данные</a><li><ul>';
  $.ajax({
    url:"select.php",
    method:"POST",
    data:{area:area, page:page},
    dataType:"html",
    success:function(data)
    {
      $('#container_p').html(data);
      $("#container_k").html("");
      $('#topnav_right').html(topnav);
      $('#header_area').html(area);
    },
    error:function(data)
    {
      $('#top_header_left').html("Ошибка соединения");
    }
  });
  $.ajax({
    url: 'poisk_form.php',//Загрузка формы поиска
    success: function(data) {
      $('#poisk').html(data);
    }
  });
}

function paramArea(){
  var area = [("param_area", param_area.value), $('#param_area').find(':selected').attr('data-id')];
  console.log("ID площадки (id area)", area[1]);
  console.log("Кроссовый журнал-----", area[0]);
  return (area);
}

//работа с таблицами
function staCRUD(tablename, nameQ) {
  console.log("Работаем с таблицей", tablename);
  console.log("Работаем с таблицей", nameQ);
  var columnname=tablename+"_name";
  var name=nameQ;
  $("#buttonUpdate").hide();
  $("#buttonExecute").show();
  $('#staCrudForm')[0].reset();
  $("#result").remove();
  document.getElementById('staCrudTitle').innerHTML=("Работа с таблицей: "+name);
  document.getElementById("labelheader").innerHTML=("Выбранное значение будет обновлено:");
  document.getElementById("out").innerHTML='';
  $("#tablename").val(tablename);
  $("#columnname").val(columnname);
  $('#staCrudModal').modal('show');

  name_div = document.getElementById("outCrudModal").getAttribute("id");
  dataViewTable(name_div, tablename, columnname, name);
  $('#headername').val(name);
  document.getElementById("staAutoList").setAttribute('data-table', tablename);
  console.log("Атрибут data-table до: ", document.getElementById("staAutoList").getAttribute("data-table"));
  console.log("Начальная загрузка таблицы: ", tablename);
  console.log("Атрибут data-table после: ", document.getElementById("staAutoList").getAttribute("data-table"));
  console.log("Таблица", name);
  console.log("Имя столбца", columnname);
  console.log("Имя таблицы", tablename);
}

$(document).on('change', '#newValue', function () {
        var val = this.value|0; // to int
        
        if (this.checked) {
          document.getElementById("labelheader").innerHTML=("Набраное значение будет добавлено в таблицу:");
        } 
        else {
          document.getElementById("labelheader").innerHTML=("Выбранное значение будет обновлено:");
        }
      });

function staExecute() {
  event.preventDefault();
  if($('#staAutoList').val() == "")
  {
    alertoverlay("Не выбрано значение для обработки. Либо пустое значение");
  }
  else {
    if ($("#newValue").prop('checked')){
      $('#idname').val('');
    }
    $("#buttonExecute").show();
    var tablename = $('#tablename').val();
    var columnname = $('#columnname').val();
    var newvalue=$('#staAutoList').val();
    var name=$('#headername').val();
    var idname=$('#idname').val();
    var action="sta_execute";
    var login = $('#login').text();
    $.ajax({
     url:"staoperation.php",
     method:"POST",
     data:{login:login, action:action, tablename:tablename, columnname:columnname, newvalue:newvalue, name:name, idname:idname},
     success:function(data)
     {

       $('#newValue').prop('checked', false);
       document.getElementById("out").innerHTML="";
       $('#staAutoList').val("");
       $('#result').html(data);
       $('#myModal').modal('show');

     }
   });
  }
}

function closeMyModal(){
  $('#myModal').modal('hide');
}

function staDelete(){
  $('#staDeleteForm')[0].reset();
  document.getElementById("idLabelDelete").innerHTML='Id #:'+$("#idname").val()+'<br>'+$("#staAutoList").val();// id записи в таблице '+$('#headername').val()+' 
  document.getElementById("titleDelete").innerHTML='Информация будет удалена из таблицы <span class="label label-info">\
  '+$('#headername').val()+'</span>\
  <span class="label label-danger">Без возможности восстановления</span>';
  $('#myModalDelete').modal('show');
  var paramPoisk="sub_name";
  var searchString=$("#staAutoList").val();
  var tablename=$("#tablename").val();
  var columnname=$("#columnname").val();
  var action="sta_select";
  var login = $('#login').text();
  $.ajax({
    url:"staoperation.php",
    method:"POST",
    data:{login:login, action:action, searchString:searchString, tablename:tablename, columnname:columnname},
    dataType:"html",
    success:function(data){
      $("#outDelete").html(data);
    }
  });
  
}

function deleteEntry(){
  var idname=$("#idname").val();
  var tablename=$("#tablename").val();
  var columnname=$("#columnname").val();
  var action="sta_delete";
  var login = $('#login').text();
  $.ajax({
    url:"staoperation.php",
    method:"POST",
    data:{login:login, action:action, idname:idname, tablename:tablename, columnname:columnname},
    dataType:"html",
    success:function(data){
      $("#idLabelDelete").html(data);
      $("#outDelete").html('');
    }
  });
}

function closeMyModalDelete(){
  $('#myModalDelete').modal('hide');
  $('#staCrudModal').modal('hide');
}

function updateStaData(staname) {
  var nameselect=$(staname).text();
  var idname=staname.getAttribute('data-idname');
  var nametable=staname.getAttribute('data-nametable');
  $('#staAutoList').val(nameselect);
  $('#idname').val(idname);
  console.log('Имя выбранное из таблицы', idname, '-', nameselect);
  console.log('Таблица-----------------', nametable);
  
  document.getElementById("out").innerHTML="<p style='color: blue' id='xxx'>Обрабатываем значение : "+nameselect+"</p><p style='color: red'>"+idname+"</p>";
  var idvariable='#'+nametable+'Id';
  $(idvariable).val(idname);

}


//работа с таблицами //

//обработка таблицы krossdata
//MODAL Окно редактирования
$(document).on('click', '.edit_data', function(){
  $("#result").remove();
  $('#dataCrudForm')[0].reset();
  var login = $('#login').text();
  var data_id = $(this).data("idxxx");
  var area=$(this).data("idarea");
  var action="data_fetch";
  $.ajax({
   url:"dataoperation.php",
   method:"POST",    data:{data_id:data_id, area:area, action:action},
   dataType:"json",
   success:function(data){
    $('#dataCrudTitle').html("Редактируем данные №: "+data.data+" кросса "+area);
    $('#dataKross').val(data.data);
    $('#dataName').val(data.data);
    $('#dataKross').attr('disabled', true);
    $('#dataRaspred').val(data.raspred_name);
    $('#dataNumber').val(data.number);
    $('#dataSub').val(data.sub_name);
    $('#dataType').val(data.type_name);
    $('#dataComment').val(data.comment);
    $('#previousSubId').val(data.sub_id);
    $('#areaName').val(data.area_name);
    $('#dataId').val(data.id);
    $('#subId').val(data.sub_id);
    $('#raspredId').val(data.raspred_id);
    $('#typeId').val(data.type_id);
    $('#areaId').val(data.area_id);
    $('#loginName').val($('#login').text());
    $('#buttonDataExecute').text("Обновить");
    $('#buttonDataClear').text("Очистить");

    $("#numberList").text("");
    $("#dataList").text("");
    $("#buttonDataExecute").show();
    $("#buttonDataClear").show();
    $("#buttonPereKross").show();

    $('#dataCrudModal').modal('show');
    console.log("LogKross", "modal('show')");

  }
});
});
//
function dataCRUD() {
  var area=paramArea()[0];
  var areaId=paramArea()[1];
  $("#result").remove();
  $('#dataCrudForm')[0].reset();
  $('#insert').val("Вставить");
  $('#dataKross').attr('disabled', false);
  $('#areaName').val(area);
  $('#areaId').val(areaId);
  $('#loginName').val($('#login').text());
  $('#dataList').html("");
  $('#numberList').html("");
  $('#move_data_btn').hide();
  $('#delete_btn').hide();
  $('#dataCrudTitle').html("Добавить данные на "+area);
  $('#data_data').removeAttr('readonly');
  $('#buttonDataExecute').text("Вставить");
  $('#buttonDataClear').text("Очистить");
  $("#buttonDataExecute").show();
  $("#buttonDataClear").show();
  $("#buttonPereKross").hide();
  $('#dataCrudModal').modal('show');
  console.log("LogKross", area);
  console.log("LogKross", "insertNewData()");
}

function dataViewTable(name_div, tablename, columnname, name) {
  name_div='#'+name_div;
  $.ajax({
   url:"loadfetch.php",
   method:"POST",
   data:{tablename:tablename, columnname:columnname, name:name},
   success:function(data)
   {
    $('#result').html(data);
  }
});
}
function dataClear() {
  alertoverlay ();
  $("#closeAlertoverlay").hide();
  $.ajax({
    url: 'list_type.php',
    success: function(data) {
      $('#alertoverlay').html(data);
    }
  });
  

}
function confirmDataClear() {
  // var areaId=$("#areaId").val();
  // var dataId=$("#dataId").val();
  var x = document.getElementById("param_type");
  var selectTypeId=(x.options[x.selectedIndex].index)+1;
  var selectTypeName=(x.options[x.selectedIndex].text);
  var action="data_clear";
  $.ajax({
      // url: 'dataexecute.php',
      url: 'dataoperation.php',
      method:"POST",
      data:'&loginName='+$('#loginName').val()+'&dataId='+$('#dataId').val()+'&typeSelectId='+selectTypeId+'&typeSelectName='+selectTypeName+'&areaId='+$('#areaId').val()+'&action='+action,
      // data:$('#dataCrudForm').serialize()+'&action='+action,
      success: function(data) {
        off();
        $('#container_p').html(data);
        $('#dataCrudModal').modal('hide');
      }
    });
}
function dataExecute() {
  event.preventDefault();
  if($('#dataKross').val() == "")
  {
    alertoverlay("Введите данные");
  }
  else if($('#raspredId').val() == '')
  {
    alertoverlay("Выберите распределение");
  }
  else if($('#typeId').val() == '')
  {
    alertoverlay("Выберите тип");
  }
  else if($('#subId').val() == ''){
    alertoverlay("Выберите абонента. Если необходимое имя абонента отсутствует, добавте его через меню БД-->Абоненты");
  }
  else
  { 
    var action="data_execute";
    $.ajax({
      // url: 'dataexecute.php',
      url: 'dataoperation.php',
      method:"POST",
      data:$('#dataCrudForm').serialize()+'&action='+action,
      success: function(data) {
        $('#container_p').html(data);
        $('#dataCrudModal').modal('hide');
      }
    });}
  }

// Проверка на наличие номера// Данных
// checkData
$(document).on('keyup', '#dataKross', function(){
 var area=("param_area", param_area.value);
 if($(this).val().length>=3)
 {

  if(!isCyrillic($(this).val())){
    alertoverlay("Переключите язык ввода на Английский");
  }
  $("#closeAlertoverlay").show();
  var action="data_autosearch";
  $.ajax({
   url:"dataoperation.php",
   method:"POST",
   data:$('#dataCrudForm').serialize()+'&action='+action,
   success:function(data)
   {
    $('#dataList').fadeIn();
    $('#dataList').html(data);
    var element=document.getElementById('dangeralert');
    if(!element)
    {
      console.log("Можно добавить данные");
      $("#buttonDataExecute").show(1000);
      $("#buttonDataClear").show(1000);
    }else{
      console.log("Нельзя добавить данные");
      $("#buttonDataExecute").hide(1000);
      $("#buttonDataClear").hide(1000);
    }
  }
});
}else{
  $('#dataList').html("");
}
});

$(document).on('keyup', '#dataNumber', function(){
  var area=("param_area", param_area.value);
  if($(this).val().length==4 || $(this).val().length==7)
  {
    var querynumber = $(this).val();
    var action="data_autosearch";
    $.ajax({
     url:"dataoperation.php",
     method:"POST",
     data:{querynumber:querynumber, area:area, action:action},
     success:function(data)
     {
      $('#numberList').fadeIn();
      $('#numberList').html(data);
    }
  });
  } else{
    $('#numberList').html($(this).val().length);
  }
});
// обработка таблицы krossdata END




$(document).on('click', '.autoClear', function(){
  $('#result').remove();
});

$(document).on('click', '.autoListData', function(){
  var idinput=event.target.id;
  var tablename = event.target.dataset.table;
  var query = $(this).val();
  var columnname=tablename+"_name";
  idinput='#'+idinput;
  $('#result').remove();
  autoListData(tablename, idinput, query, columnname);
});


$(document).on('keyup', '.autoListData', function(){
  var idinput=event.target.id;
  var tablename = event.target.dataset.table;
  var query = $(this).val();
  var columnname=tablename+"_name";
  idinput='#'+idinput;
  autoListData(tablename, idinput, query, columnname);
});

function autoListData(tablename, idinput, query, columnname) {
  console.log("Какой инпут посылает запрос (событие onkeyup): ", idinput);
  console.log("Длинна запроса: ", query.length);
  console.log("Атрибут data-table после click: ", document.getElementById("staAutoList").getAttribute("data-table"));
  console.log("Поиск по таблице: ", tablename);
  console.log("Запрос: ", query);
  if(!$("div").is("#result")){
    $("<div id='result' style='height:300px;overflow-y:scroll;'></div>").insertAfter(idinput);
  }
  if((query.length)==0){
    console.log("Пустой запрос");

  }
  $.ajax({
   url:"loadfetch.php",
   method:"POST",
   data:{idinput:idinput, query:query, tablename:tablename, columnname:columnname},
   success:function(data)
   {
    $('#result').html(data);
    if ($("div").is("#alertInfo")){

      var idvariable='#'+tablename+'Id';
      $(idvariable).val('');
    }
    if ($("div").is("#resultreturt")){

      var idvariabl='#'+tablename+'Id';
      $(idvariabl).val('');
    }
  }
});
}

$(document).on('click', '.tablecolumn', function(){
  var value=(this.getAttribute("data-value"));
  var input=(this.getAttribute("data-idinput"));
  var idname=(this.getAttribute("data-idname"));
  $(input).val(value);
  $('#idname').val(idname);

});


//Поиск по данным

//Передаем параметры поиска из формы запроса к БД
//area--Площадка
//searchString---Строка поиска
//paramPoisk--Параметры поиска (Данные, Распределение, Телефон, Имя, Тип, Комментарии)
function poisk(){
  var searchString=$('#searchString').val();
  var paramPoisk =$('#paramPoisk').val();
  $.ajax({
    url:"poisk_select.php",
    method:"POST",
    data:{searchString:searchString, paramPoisk:paramPoisk},
    dataType:"text",
    success:function(data){
      $('#container_p').html(data);
    }
  });
}

$("form_poisk").on("submit", function(){
  poisk();
  return false;
});
$(document).on('click', '#select_poisk', function(){
  poisk();
  return false;
});
//DATA-NUMBER подгрузка из справочника???
$(document).on('click', '.data-number', function(){
  var searchString=$(this).data("idnumber");
  var paramPoisk ="number";
  $.ajax({
    url:"poisk_select.php",
    method:"POST",
    data:{searchString:searchString, paramPoisk:paramPoisk},
    dataType:"text",
    success:function(data){
      $('#container_p').html(data);
    }
  });
});
//DATA-NUMBER END
///DATA-NUMBER подгрузка из справочника???
$(document).on('click', '.data-name', function(){
  var searchString=$(this).data("idname");
  var paramPoisk ="sub_name";
  $.ajax({
    url:"poisk_select.php",
    method:"POST",
    data:{searchString:searchString, paramPoisk:paramPoisk},
    dataType:"text",
    success:function(data){
      $('#container_p').html(data);
    }
  });
});
//DATA-NUMBER END




/////////////////////////////Каталог///////////////////////////
//Редактор справочника
function catalogEdit(page)
{ 
  $('#container_m').html("");
  header='Редактировать справочник';
  // '<nav class="navbar navbar-default">\
  // <div class="container-fluid">\
  // <div class="navbar-header">\
  // <a href="#" data-www="redaktorCatalog" onclick="catalogEdit(1)" class="headerPage"><h4>Редактировать справочник</h4></a>\
  // </div>\
  // <ul class="nav navbar-nav navbar-right">\
  // <li><a href="#" name="catalog_red" id="catalog_red" data-toggle="modal" onclick="catalogAdd()">Добавить абонента</a></li>\
  // <li class="dropdown">\
  // <a class="dropdown-toggle" data-toggle="dropdown" href="#">Обратная связь\
  // <span class="caret"></span></a>\
  // <ul class="dropdown-menu">\
  // <li><a href="#" onclick="messageRead('+'0'+')" data-state="0">Новые сообщения</a></li>\
  // <li><a href="#" onclick="messageRead('+'1'+')" data-state="1">Обработанные сообщения</a></li>\
  // </ul>\
  // </li>\
  // </ul>\
  // </div>\
  // </nav>';
  var topnav='<ul class="nav navbar-nav">\
  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Обратная связь\
  <span class="caret"></span></a>\
  <ul class="dropdown-menu">\
  <li><a href="#" onclick="messageRead('+'0'+')" data-state="0">Новые сообщения</a></li>\
  <li><a href="#" onclick="messageRead('+'1'+')" data-state="1">Обработанные сообщения</a></li>\
  </ul></li><li><a href="#" name="catalog_red" id="catalog_red" data-toggle="modal" onclick="catalogAdd()">Добавить абонента</a></li>\
  </ul>';
  $.ajax({
    url:"catalogedit.php",
    method:"POST",
    data:{page:page},
    success:function(data){
     $('#container_p').html(data);
     $("#container_k").html("");
     $('#topnav_right').html(topnav);
     $('#header_area').html(header);

   }
 });

  $.ajax({
    url: 'catalog_search_form.php',
    success: function(data) {
      $('#poisk').html(data);
    }
  });

}


//Открыть справочник
function catalogOpen()
{ 
  window.open("/catalog/catalog.php");
}

// Поиск по справочнику
function poisk_spr(){
  var searchString =$("#searchString").val();
  var paramPoisk =("paramPoisk", formPoiskCatalog.paramPoisk.value);
  $.ajax({
   url:"catalog_select_red.php",
   method:"POST",
   data:{searchString:searchString, paramPoisk:paramPoisk},
   dataType:"text",
   success:function(data){
    $('#container_p').html(data);
  }
});
}

$("formPoiskCatalog").on("submit", function(){
  poisk_spr();
  return false;
});
$(document).on('click', '#poiskCatalog', function(){
  poisk_spr();
  return false;
});

//Редактировать абонента в СПРАВОЧНИКЕ
$(document).on('click', '.red_modal', function(){
  $('#catalog_red_form')[0].reset();
  $('#result').remove();

  document.getElementById('insert_update').innerHTML="Изменить";
  var subname=$(this).data("sub");
  document.getElementById('modal_title_catalog').innerHTML="Редактировать абонента:<br>"+subname;
  var data_id = $(this).data("id");
  var subid=$(this).data("subid");
  var action="catalog_fetch_red";
  $('#subidred').val(subid);
  $('#login_idred').val($('#login').text());
  $('#subIdUpdate').val(subid);
  $.ajax({
    url:"catalogoperation.php",
    method:"POST",
    data:{data_id:data_id, action:action},
    dataType:"json",
    success:function(data){
     $('#catalogId').val(data.id);
     $('#catalogSub').val(data.sub_name);
     $('#catalogVnutr').val(data.vnutr);
     $('#catalogCity').val(data.city);
     $('#catalogUnit').val(data.unit_name);
     $('#catalogDepartment').val(data.department_name);
     $('#catalogCabinet').val(data.cabinet);
     $('#catalogFilial').val(data.filial_name);
     $('#catalogVisibility').val(data.visibility);
     $('#catalogUnitidname').val(data.unit_id);
     $('#data_departmentidname').val(data.department_id);
     $('#data_filialidname').val(data.filial_id);
     $('#catalog_red_Modal').modal('show');
     console.log ("catalog_red_Modal", "ok");

   }
 });
});

//Добавить нового абонента в справочник
function catalogAdd() {

  $('#catalog_red_form')[0].reset();
  $('#result').remove();
  $('#login_idred').val($('#login').text());

  document.getElementById('insert_update').innerHTML="Добавить абонента";
  document.getElementById('modal_title_catalog').innerHTML="Добавить абонента";
  $('#catalog_red_Modal').modal('show');
}

$(document).on('click', '.catalogNumberAdd', function(){
  $('#catalog_red_form')[0].reset();
  $('#result').remove();
  $('#catalogVnutr').val($(this).data("number"));
  $('#catalogSub').val($(this).data("sub"));
  $('#login_idred').val($('#login').text());
  document.getElementById('insert_update').innerHTML="Добавить абонента";
  document.getElementById('modal_title_catalog').innerHTML="Добавить абонента";
  $('#catalog_red_Modal').modal('show');
});
function catalogCRUD() {
  event.preventDefault();
  if($('#catalogSub').val() == "")
  {
    alertoverlay("Введите имя абонента");
  }

  else
  {
    var action="catalog_update";
    $.ajax({
     url:"catalogoperation.php",
     method:"POST",
     data:$('#catalog_red_form').serialize()+'&action='+action,
     success:function(data){
       $('#catalog_red_form')[0].reset();
       $('#catalog_red_Modal').modal('hide');
       $('#container_p').html(data);
     }
   });
  }
}



/////////////////////ЧИТАЕМ ЛОГИ
function readLogData(page)
{ 
  $("#container_m").html("");
  header='Лог Кросса';
  // '<nav class="navbar navbar-default">\
  // <div class="container-fluid">\
  // <div class="navbar-header">\
  // <a href="#" data-www="logKross" class="headerPage"><h4>Лог Кросса</h4></a>\
  // </div>\
  // </div>\
  // </nav>';
  // poiskLog='<div class="form-group">\
  // <div class="input-group">\
  // <span class="input-group-addon">Поиск</span>\
  // <input type="text" name="search_logkross" id="search_logkross" placeholder="Поиск по логу кроссового журнала" class="form-control" />\
  // </div>\
  // </div>';
poiskLog='<form class="navbar-form navbar-left">\
  <div class="input-group" style="min-width: 50vw">\
    <input type="text" name="search_logkross" id="search_logkross" placeholder="Поиск по логу кроссового журнала" class="form-control" />\
    <div class="input-group-btn">\
      <button class="btn btn-default" type="submit">\
        <i class="glyphicon glyphicon-search"></i>\
      </button>\
    </div>\
  </div>\
</form>';


  $.ajax({
    url:"logkross.php",
    method:"POST",
    data:{page:page},
    success:function(data){
      $("#container_k").html("");
     $('#container_p').html(data);
     $('#topnav_right').html('');
     $('#header_area').html(header);
     $('#poisk').html(poiskLog);
   }
 });
}
function readLogCatalog(page)
{ 
  $("#container_m").html("");
  header='Лог Справочника';
  // '<nav class="navbar navbar-default">\
  // <div class="container-fluid">\
  // <div class="navbar-header">\
  // <a href="#" data-www="logCatalog" class="headerPage"><h4>Лог Справочника</h4></a>\
  // </div>\
  // </div>\
  // </nav>';
  // poiskLog='<div class="form-group">\
  // <div class="input-group">\
  // <span class="input-group-addon">Поиск</span>\
  // <input type="text" name="search_logcatalog" id="search_logcatalog" placeholder="Поиск по логу справочника" class="form-control" />\
  // </div>\
  // </div>';
poiskLog='<form class="navbar-form navbar-left">\
  <div class="input-group" style="min-width: 50vw">\
    <input type="text" name="search_logcatalog" id="search_logcatalog" placeholder="Поиск по логу справочника" class="form-control" />\
    <div class="input-group-btn">\
      <button class="btn btn-default" type="submit">\
        <i class="glyphicon glyphicon-search"></i>\
      </button>\
    </div>\
  </div>\
</form>';
  $.ajax({
    url:"logcatalog.php",
    method:"POST",
    data:{page:page},
    success:function(data){
      $("#container_k").html("");
     $('#container_p').html(data);
     $('#topnav_right').html('');
     $('#header_area').html(header);
     $('#poisk').html(poiskLog);
   }
 });



}

////Поиск текста на странице при помощи Jquery
$(document).on('keyup', '#search_logcatalog', function(){

  var query = $(this).val();
  $.ajax({
    url:"logcatalog.php",
    method:"POST",
    data:{query:query},
    success:function(data){
     $('#container_p').html(data);
     // $('#top_header_left').html(header);
     // $('#poisk').html(poiskLog);
   }
 });

});

$(document).on('keyup', '#search_logkross', function(){

  var query = $(this).val();
  $.ajax({
    url:"logkross.php",
    method:"POST",
    data:{query:query},
    success:function(data){
     $('#container_p').html(data);
     // $('#top_header_left').html(header);
     // $('#poisk').html(poiskLog);
   }
 });

});

////Поиск текста на странице при помощи Jquery
/////////////////////ЧИТАЕМ ЛОГИ END


//////////////Заявки
function readBid(page) {
  $("#container_m").html("");
  header='<nav class="navbar navbar-default">\
  <div class="container-fluid">\
  <div class="navbar-header">\
  <a href="#" data-www="bid" class="headerPage"><h4>Заявки</h4></a></div></div></nav>';
  poiskbid='<div class="form-group"><div class="input-group"><span class="input-group-addon">Поиск</span><input type="text" name="search_text" id="search_text" placeholder="Поиск заявки" class="form-control" /></div></div>';
  $.ajax({
    url:"bidselect.php",
    cache: false,
    method:"POST",
    data:{page:page},
    success:function(data){
     $('#container_p').html(data);

     $('#top_header_left').html(header);
     $('#poisk').html(poiskbid);
   }
 });
}

function stateBid(idbid) {
 $.ajax({
  url: "readBidModal.php",
  cache: false,
  success: function(html){
    $("body").append(html);
  }
});
 $.ajax({
  url: "stateBid.php",
  method:"POST",
  data:{idbid:idbid},
  dataType:"json",
  success: function(data){
    $('#stateidbid').val(data.id);
    $('#phone').val(data.phone);
    $('#bidMessage').val(data.bidmessage);
    $('#phoneObr').val(data.phoneobr);
    $('#statebid').val(data.state);
    $('#commentbid').val(data.commentbid);
    $('#titleReadBid').html('Заявка № : '+data.id+'. Зарегестрирована '+data.datemessage);
    $('#readBidModal').modal('show');
  }
});
}
function updateStateBid() {
  stateidbid=$('#stateidbid').val();
  state=$('#statebid').val();
  commentbid=$('#commentbid').val();
  $.ajax({
    url: "stateBid.php",
    method:"POST",
    data:{stateidbid:stateidbid, state:state, commentbid:commentbid},
    dataType:"json",
    success: function(data){
      $('#readBidModal').modal('hide');
      console.log("readBidModal---hide");
      readBid(1);
    }
  });

}

//////////////Заявки END
//Обработка сообщений обратной связи
//

function messageRead(state){
  $("#container_m").html("");
  var action="message_read";
  $.ajax({
   url:"messageoperation.php",
   method:"POST",
   dataType:"text",
   data:{state:state, action:action},
   success:function(data){

    $('#container_p').html(data);

  }
});
}
function closeMessageArea() {
  $('#message_area').remove();
}

$(document).on('click', '.select_message', function(){
  var searchString =$(this).data("id_catalog");
  console.log(searchString+'id абонента в каталоге');
var id_message =$(this).data("id_message");///?????
console.log(id_message+'id запроса');
var paramPoisk ="id";
var action="message_select";
$.ajax({
 url:"messageoperation.php",
 method:"POST",
 dataType:"text",
 data:{id_message:id_message, action:action},
 success:function(data){
  $('#container_m').html(data);
}
});
$.ajax({
 url:"catalog_select_red.php",
 method:"POST",
 dataType:"text",
 data:{searchString:searchString, paramPoisk:paramPoisk},
 success:function(data){
  $('#container_p').html(data);

}
});
});


$(document).on('click', '.btn_obr', function(){
 var data=$(this).data("id");
 if(confirm("Исправления внесены?"))
 {
  var action="message_update";
  $.ajax({

   url:"messageoperation.php",
   method:"POST",
   data:{data:data, action:action},
   dataType:"text",
   success:function(data){
    alertoverlay(data);
    $("#container_m").html("");
    var action="message_read";
    var state="0";

    $.ajax({

     url:"messageoperation.php",
     method:"POST",
     data:{state:state, action:action},
     dataType:"text",
     success:function(data){
      $('#container_p').html(data);

    }
  });
  }
});
}
});
//Обработка сообщений обратной связи END
//
//
//Статистика
function stats() {
  $("#container_m").html("");
  $.ajax({
    url: "show_allstats.php",
    cache: false,
    success: function(html){
      $("#container_p").html(html);
    }
  });
}
// Копия базы
function dump() {
 $.ajax({
  url: "/dump/dump_baza.php",
  cache: false,
  success: function(html){
    $("#container_p").html(html);
  }
});
}
//TOP Button
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";

  } else {
    document.getElementById("myBtn").style.display = "none";

  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  }



  function eyeVisibility(val) {
  //   if (val==1){
  //     $("#eyeVisibility").removeClass("glyphicon-eye-close");
  //     $("#eyeVisibility").addClass("glyphicon-eye-open");
  //   } else {
  //     $("#eyeVisibility").removeClass("glyphicon-eye-open");
  //   $("#eyeVisibility").addClass("glyphicon-eye-close");
  // }
}

function usersConfig() { 
  header='<nav class="navbar navbar-default">\
  <div class="container-fluid">\
  <div class="navbar-header">\
  <a href="#"  class="headerPage"><h4>Настройка userov</h4></a>\
  </div>\
  </div>\
  </nav>';
  $.ajax({
    url:"/usersconfig/users_show.php",
    success:function(data){
     $('#container_p').html(data);
     $('#top_header_left').html('');
   }
 });
}
function number(phonetype) {
   header='spisok-kartochka-test';
  $('#container_k').html("");
  $("#container_m").html("");
  $("#container_p").html("");
  $("#topnav_right").html('');
  // $('#top_header_left').html("");
  console.log("Таблица : "+phonetype);
  $.ajax({
    url:"number.php",
    method:"POST",
    data:{phonetype:phonetype},
    success:function(data){
     // $('#poisk').html(data);
     $('#header_area').html(header);
     $('#poisk').html(data);

     numberlive();
   }
 });
}

function numberlive() {
  var x = document.getElementById("numberli");
  var searchString=x.options[x.selectedIndex].text;
  console.log(x.options[x.selectedIndex].text+" : "+x.options[x.selectedIndex].index);
  var paramPoisk="number";
  console.log(searchString+" : "+paramPoisk);
  $("#container_m").html("");
  $("#topnav_right").html('');
  // $('#top_header_left').html("");
  $.ajax({
    url:"poisk_select.php",
    method:"POST",
    data:{searchString:searchString, paramPoisk:paramPoisk},
    dataType:"html",
    success:function(data){
     $('#container_p').html(data);
   }
 });
  $.ajax({
    url:"kartochka.php",
    method:"POST",
    data:{searchString:searchString, paramPoisk:paramPoisk},
    dataType:"html",
    success:function(data){
     $('#container_k').html(data);
   }
 });
}

function alertoverlay(helpalert) {
  // body...
  document.getElementById("alertoverlay").innerHTML = helpalert;
  document.getElementById("overlay").style.display = "block";
}
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("alertoverlay").innerHTML = "";
  document.getElementById("overlay").style.display = "none";
}


//Перекроссировка. Перенос номера с одних данных на другие
function pereKross() {
  // $("#pKdataKross").text($("#dataKross").va());
  var action="pereKross";
  $('#dataCrudModal').modal('hide');
  $.ajax({
    url:"perekross.php",
    method:"POST",
    data:$('#dataCrudForm').serialize()+'&action='+action,
    success:function(data){
      $('#container_p').html(data);
    }
  });
  // $('#container_p').load("perekross.php");
}

$(document).on('keyup', '#dataSearch', function(){
  var action="search_pereKross";
  var areaId=paramArea()[1];
  $.ajax({
    url:"perekross.php",
    method:"POST",
    data: {dataName:$('#dataSearch').val(), action:action, areaId:areaId},
    success:function(data){
      $('#pereKross').html(data);
    }
  });
});
function cPereKross(action) {
  var areaName=paramArea()[0];
  var areaId=paramArea()[1];
  var controlArea=document.getElementById("pereKrossIn").getAttribute("data-controlArea");
  if (controlArea!=areaId){
    alertoverlay("Выберите соответствующую площадку");
  }else{
    var dataIn=document.getElementById("pereKrossIn").getAttribute("data-dataid");
    var dataOut=document.getElementById("pereKrossOut").getAttribute("data-dataid");
    var dataSearch=$("#dataSearch").val();
    var action=action;
    $.ajax({
      url:"perekross.php",
      method:"POST",
      data: {dataIn:dataIn, dataOut:dataOut, action:action, dataSearch:dataSearch, areaName:areaName},
      success:function(data){
        $('#container_p').html(data);
      }
    });
  }
}
//Перекроссировка. Перенос номера с одних данных на другие
//
//


// Редактируем порядок отображения абонентов в справочнике
// 
// 
function catalogEditTree()
{ 
  window.open("/edittree/tcatalog.php");
}


// 
// 
// 
/**
             * Функция для отправки формы средствами Ajax
             * @author Дизайн студия ox2.ru
             **/
// function AjaxFormRequest(result_id,form_id,url) {
//   jQuery.ajax({
//                     url:     url, //Адрес подгружаемой страницы
//                     type:     "POST", //Тип запроса
//                     dataType: "html", //Тип данных
//                     data: jQuery("#"+form_id).serialize(),
//                     success: function(response) { //Если все нормально
//                       document.getElementById(result_id).innerHTML = response;
//                     },
//                 error: function(response) { //Если ошибка
//                   document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
//                 }

//               });
// }