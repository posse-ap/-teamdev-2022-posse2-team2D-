$(function(){
  $("#main").on("change", function(event){
    let id = $("#main").val();
    $.ajax({
      type: "POST",
      url: "getData.php",
      data: { "id" : id },
      dataType : "json"
    }).done(function(data){
      $("#return").append('<p>'+data.id+' : '+data.school+' : '+data.skill+'</p>');
    }).fail(function(XMLHttpRequest, status, e){
      alert(e);
    });
  });
});