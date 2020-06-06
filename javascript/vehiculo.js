$(document).ready(function(){
    readCont();
});

$("#findCont").on("keyup", fillDataCont);

function escoger(id, nombre){
    $("#nombCont_").val(nombre);
    $("#idCont_").val(id);
}

function readCont(){
    let usuario = "usuario";
    $.ajax({
        url : "CRUD_vehiculo.php",
        type:"post",
        data:{
            usuario: usuario
        }, 
        success: function(data, status){
            $("#containerTableCont").html(data);
        }, 
        error: function(a, b, c){    
            $("#containerTableCont").html('<div class="alert alert-danger">Error no se puede encontrar la tabla:'+c+'</div>');
        }
    });
}

function fillDataCont(){
    let nomCont = $("#findCont").val();

    $.ajax({
        url : "CRUD_vehiculo.php",
        type: 'post', 
        data:{
            nomCont: nomCont
        },
        success: function(data, status){
            $("#container_data_cont").html(data);
        }
    });
}

function deleteCont(id_del){
    $("#loader").css("display", "inline");
    let conf = confirm("seguro de borrar el registro?");
    if(conf){
        $.ajax({
            url : "CRUD_vehiculo.php", 
            type : "post", 
            data:{
                id_del : id_del
            },
            success : function(data, status){
                readCont();
            }, 
            error: function(a, b, c){
                $("#error").html('<div class="alert alert-danger">Algo salió mal :(. Código de error:'+c+'</div>');
            },
            complete: function(a, b){
                $("#loader").css("display", "none");
            }
        });
    }
    $("#loader").css("display", "none");
}

function addVehi(){
    $("#loader").css("display", "inline");
    let idCont_ = $('#idCont_').val();
    let b = $('#placaVehi').val();
    let c = $('#tarjVehi').val();
    let d = $('#numMotor').val();
    let e = $('#fechAd').val();
    let f = $('#orVehi').val();
    let g = $('#adqVehi').val();
    let h = $("#precVehi").val();
    let i = $("#impVehi").val();    
    if(idCont_ != "" && b != "" && c != "" && d != "" && e !=""){
        $.ajax({
            url: 'CRUD_vehiculo.php',
            type: 'post',
            data:{
                idCont_:idCont_,
                b:b,
                c:c,
                d:d,
                e:e,
                f:f,
                g:g,
                h:h,
                i:i
            },
            success:function(data, status){
                console.log(data);
                console.log(status);
                readCont();
            },
            error: function(a,b,c){
                $("#error").html('<div class="alert alert-danger">Algo salió mal :(. Código de error:'+c+'</div>');
            }
        });
    }else{
        alert("Completa todos los campos!!! ");
    }
    $("#loader").css("display", "none");
}

function getContDetails(id){
    $('#userIdUpd').val(id);
    $.post("CRUD_vehiculo.php",{
        id : id
    },
    function(data, status){
        
        var user = JSON.parse(data);
        console.log(user);
        $('#placaVehiUpd').val(user.numePlacaVehi);
        $('#tarjVehiUpd').val(user.numeTarjProp);
        $('#numMotorUpd').val(user.numeMotoVehi);
        $('#fechAdUpd').val(user.fechAdqui);
        $('#orVehiUpd').val(user.origenVehi);
        $('#adqVehiUpd').val(user.FormAdquVehi);
        $('#precVehiUpd').val(user.precioVehiSoles);
        $('#impVehiUpd').val(user.montoImpuesto);
    });
    $("#addContUpd").modal("show");
}


function updatePredDetails(){
    let a = $('#placaVehiUpd').val();
    let b = $('#tarjVehiUpd').val();
    let c = $('#numMotorUpd').val();
    let d = $('#fechAdUpd').val();
    let e = $('#orVehiUpd').val();
    let f = $('#adqVehiUpd').val();
    let g = $('#precVehiUpd').val();
    let h = $('#impVehiUpd').val();
    let i =$('#userIdUpd').val();
    $("#loader").css("display", "inline");
    $.post(
        "CRUD_vehiculo.php",
        {
            a:a,
            b:b,
            c:c,
            d:d,
            e:e,
            f:f,
            g:g,
            h:h,
            i:i
        },
        function(data, status){
            readCont();
        }
    );
    $("#loader").css("display", "none");
}
