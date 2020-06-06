$(document).ready(function(){
    readPays();
});

function readPays(){
    $.ajax({
        url: "pagos.php",
        type: 'post',
        data:{
            pays: "pays"
        },
        success: function(data, status){
            $("#table-pagos").html(data);
        }
    });
}

function addPay(){
    $.ajax({
        url: "pagos.php",
        type: 'post',
        data:{
            pay: "pay"
        },
        success: function(data, status){
            $("#response").html(data);
            readPays();
        }
    });
}