$(document).ready(function(){
  var height=$(window).height();
    var width=$(window).width();
    if(width<1200){
      $("#myNavbar").removeClass("myNavbar")
    }
  $('#myMessange').modal('show');
  // $('#data_sub').tooltip({title: "Редактируем <span>имя</span> абонента в справочнике", container: ".modal-body", placement: "top", html: true});
  // $('#data_vnutr').tooltip({title: "Редактируем <span>внутренние номера</span> абонента в справочнике. При наличии у абонента более одного номера, последующие номера добавляяются через запятую", container: ".modal-body", placement: "top", html: true});
  // $('#data_city').tooltip({title: "Редактируем <span>городские номера</span> абонента в справочнике. При наличии у абонента более одного номера, последующие номера добавляяются через запятую", container: ".modal-body", placement: "top", html: true});
  // $('#data_unit').tooltip({title: "Редактируем <span>наименование управление</span> абонента в справочнике", container: ".modal-body", placement: "top", html: true});
  // $('#data_department').tooltip({title: "Редактируем <span>наименование отдела или бюро</span> абонента в справочнике", container: ".modal-body", placement: "top", html: true});
  // $('#data_cabinet').tooltip({title: "Редактируем <span>номер кабинета/помещения</span> абонента", container: ".modal-body", placement: "top", html: true});
  // $('#data_filial').tooltip({title: "Редактируем <span>наименование филиала</span> абонента", container: ".modal-body", placement: "top", html: true});
  load_data(1);


  $(document).on('click', '#go_home', function(){
    load_data(1);
  });


  $(document).on('click', 'li.active',function(){
    var page = $(this).attr('p');
    load_data(page);
  });
  $(document).on('click', '#go_btn',function(){
    var page = parseInt($('.goto').val());
    var no_of_pages = parseInt($('.total').attr('a'));
    if(page != 0 && page <= no_of_pages){
      load_data(page);
    }else{
      alert('Enter a PAGE between 1 and '+no_of_pages);
      $('.goto').val("").focus();
      return false;
    }
  });

  $(document).on('click', '#home', function(){
    load_data(1);
  });
  $(document).on('click', '#spec', function(){
    window.open("112.php");
  });

//MODAL Окно обратной связи
$(document).on('click', '.feedback', function(){
 var data_id = $(this).data("catalogid");
 $.ajax({
  url:"/catalog/catalog_fetch.php",
  method:"POST",
  data:{data_id:data_id},
  dataType:"json",
  success:function(data){
    $('#data_id').val(data.id);
    $('#data_sub').val(data.sub_name);
    $('#data_vnutr').val(data.vnutr);
    $('#data_city').val(data.city);
    $('#data_unit').val(data.unit_name);
    $('#data_department').val(data.department_name);
    //document.getElementById("data_cabinet").placeholder="44444";
    $('#data_cabinet').val(data.cabinet);
    $('#data_filial').val(data.filial_name);
    $('#add_data_Modal').modal('show');
  }
});
});

$('#message_form').on("submit", function(event){
 event.preventDefault();

 $.ajax({
   url:"/catalog/catalog_message.php",
   method:"POST",
   data:$('#message_form').serialize(),
   beforeSend:function(){

    messalert= (("<h4>Заявка зарегистрирована и отправлена</h4><br>")
      +("message_form", data_sub.value)+"<br>"
      +("message_form", data_vnutr.value)+"<br>"
      +("message_form", data_unit.value)+"<br>"
      +("message_form", data_department.value)+"<br>"
      +("message_form", data_cabinet.value)+"<br>"
      +("message_form", data_filial.value)+"<br>"
      +("message_form", data_message.value)+"<br>"
      +"<div class='alert alert-info'>После проверки, информация будет обновлена</div>");
    myAlert(messalert);
  },

  success:function(data){
    $('#message_form')[0].reset();
    $('#add_data_Modal').modal('hide');
    $('#employee_table').html(data);
  }
});
});

function poisk_spr(){
  var log_n_tel =$("#log_n_tel").val();
  // var param_poisk =("param_poisk", form_poisk.param_poisk.value);
  $.ajax({
   url:"/catalog/catalog_select.php",
   method:"POST",
   data:{log_n_tel:log_n_tel},//, param_poisk:param_poisk},
   dataType:"text",
   success:function(data){
    $('#container_p').html(data);
  }});
}

$("form_poisk").on("submit", function(){
  poisk_spr();
  return false;
});
$(document).on('click', '#poisk_spr', function(){
  poisk_spr();
  return false;
});


$(document).on('click', '.unitcatalog', function(){
           // var unit_id = $(this).data("id");
           var unit_name = $(this).data("name");
           // console.log(unit_id);
           $.ajax({
            url:"/catalog/catalog_unit.php",
            method:"POST",
            data:{unit_name:unit_name},
                //dataType:"json",
                success:function(data){
                 $('#container_p').html(data);
               }
             });
         });

$(document).on('click', '.departmentcatalog', function(){
 var department_id = $(this).data("id");
 var department_name = $(this).data("name");
 var unit_name = $(this).data("unitname");
 var unit_id = $(this).data("unitid");
 console.log(department_id);
 $.ajax({
  url:"/catalog/catalog_department.php",
  method:"POST",
  data:{department_id:department_id, department_name:department_name, unit_name:unit_name, unit_id:unit_id},
                //dataType:"json",
                success:function(data){
                 $('#container_p').html(data);
               }
             });
});

$(document).on('click', '.sectorcatalog', function(){
 var sector_id = $(this).data("id");
 var sector_name = $(this).data("name");
 var department_id = $(this).data("depid");
 var department_name = $(this).data("depname");
 var unit_name = $(this).data("unitname");
 var unit_id = $(this).data("unitid");
 console.log(department_id);
 $.ajax({
  url:"/catalog/catalog_sector.php",
  method:"POST",
  data:{sector_id:sector_id, sector_name:sector_name, department_id:department_id, department_name:department_name, unit_name:unit_name, unit_id:unit_id},
                //dataType:"json",
                success:function(data){
                 $('#container_p').html(data);
               }
             });
});

});
function load_data(page)
{
 $.ajax({
  url:"/catalog/catalog_phone.php",
  method:"POST",
  data:{page:page},
  success:function(data){
    $('#container_p').html(data);

  }
});
 $.ajax({
  url: 'catalog_poisk.php',
  success: function(data) {
    $('#poisk').html(data);
  }
});
}
function loadData(page){
  $.ajax({
    url:"/catalog/catalog_phone.php",
    method:"POST",
    data:{page:page},
    success:function(data){
      $('#container_p').html(data);
    }
  });
  $.ajax({
    url: 'catalog_poisk.php',
    success: function(data) {
      $('#poisk').html(data);
    }
  });
}
function addBid() {
  $('#bidModal').remove();
  // body...
  // $( "bidModal.php" ).after( "#add_data_Modal" );
  $.ajax({
    url: "bidModal.php",
    cache: false,
    success: function(html){
      $("body").append(html);
        // $("body").html(html);
        $('#bidModal').modal('show');
      }
    });
  // $('#bidModal').modal('show');
}
function sendBid() {
  // body...
  $('#phone').val();
  $('#bidMessage').val();
  $('#phoneObr').val();
  event.preventDefault();
  if($('#phone').val() == "")
  {
    alert("Введите номер неисправного телефона");
  }
  else if($('#bidMessage').val() == '')
  {
    alert("Опишите неисправность");
  }
  else if($('#phoneObr').val() == '')
  {
    alert("Введите номер телефона для обратной связи");

  }
  else
  { 
    $.ajax({
      url: 'addBid.php',
      method:"POST",
      data:$('#addBidForm').serialize(),
      success: function(data) {
      // $('#container_p').html(data);
      // alert("Заявка зарегестрирована");
      $('#bodyBid').html(data);
      // $('#bidModal').modal('hide');
    }
  });
  }
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


  function countDownloads() {
    $.ajax({
      url: "countdownloads.php",
      cache: false,
      dataType:"html",
      success: function(data){


      }
    });

  }

  function myAlert(message){
    $('#myAlertBody').html(message);
    $('#myAlert').modal('show');
  }
