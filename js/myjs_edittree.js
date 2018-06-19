$(document).ready(function(){
  loadData();
});
function unitCatalog(aaa){
 var unit_name = aaa.name;
 var article = document.getElementById(unit_name);
 $.ajax({
  url:"/edittree/tcatalog_unit.php",
  method:"POST",
  data:{unit_name:unit_name},
  success:function(data){
   $('#container_p').html(data);
 }
});
}
function departmentCatalog(ddd){
  var departmentCatalog = ddd.id;
  var article = document.getElementById(departmentCatalog);
  var department_id = article.id;
  var department_name = article.dataset.depname;;
  var unit_name = article.dataset.name;
  var unit_id = article.dataset.unitid;;
  console.log(department_id);
  $.ajax({
    url:"/edittree/tcatalog_department.php",
    method:"POST",
    data:{department_id:department_id, department_name:department_name, unit_name:unit_name, unit_id:unit_id},
    success:function(data){
     $('#container_p').html(data);
   }
 });
}
function loadData()
{
 $.ajax({
  url:"/edittree/tcatalog_phone.php",
  success:function(data){
    $('#container_p').html(data);
  }
});
}
//UP
$(document).on('click', '.updown', function(){
  var sd=$(this).attr("id");
  var rbId = parseInt(sd.replace(/\D+/g,""));
  var postarray=($(this).data("post"));
  var action=($(this).data('action'));
  var id=($(this).data("id"));
  var unit_name = $(this).data("name");
  var unit_id = $(this).data("unitid");
  var department_id = $(this).data("depid");
  var department_name = $(this).data("depname");
  var unitdep= $(this).data("unitdep");
  $.ajax({
    url:"/edittree/updown.php",
    method:"POST",
    data:{id:id, action:action},
    success:function(data){
      if (unitdep=="dep"){
        $.ajax({
          url:"/edittree/tcatalog_department.php",
          method:"POST",
          data:{department_id:department_id, department_name:department_name, unit_name:unit_name, unit_id:unit_id},
          success:function(data){
           $('#container_p').html(data);
           rbSelect(rbId);
         }
       });
      }
      else {
        $.ajax({
          url:"/edittree/tcatalog_unit.php",
          method:"POST",
          data:{unit_name:unit_name},
          success:function(data){
           $('#container_p').html(data);
           rbSelect(rbId);
         }
       });}
      }
    });
});
function rbSelect(rb) {
  var rbId = rb;
  updown = '.updown'+rbId;
  $('.updown').hide();
  $(updown).show();
  document.getElementById(rbId).checked = true;
}