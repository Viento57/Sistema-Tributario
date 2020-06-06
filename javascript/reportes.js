$(document).ready(function(){
    readCont();
});
function readCont(){
    let usuario = "usuario";
    $.ajax({
        url : "CRUD_contribuyente.php",
        type:"post",
        data:{
            usuario: usuario,
            type: "rep"
        }, 
        success: function(data, status){
            $("#containerTableCont").html(data);
        }, 
        error: function(a, b, c){    
            $("#containerTableCont").html('<div class="alert alert-danger">Error no se puede encontrar la tabla:'+c+'</div>');
        }
    });
}
