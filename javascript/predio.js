$(document).ready(function(){
    readCont();
});

$("#findCont").on("keyup", fillDataCont);

function escoger(id, nombre, dni){
    $("#nombCont_").val(nombre);
    $("#idCont_").val(id);
    $("#DNICont_").val(dni);
}

function readCont(){
    let usuario = "usuario";
    $.ajax({
        url : "CRUD_predio.php",
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
        url : "CRUD_predio.php",
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
    let conf = confirm("seguro de borrar el registro?");
    $("#loader").css("display", "inline");
    if(conf){
        $.ajax({
            url : "CRUD_predio.php", 
            type : "post", 
            data:{
                id_del : id_del
            },
            success : function(){
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


function validarFecha(){
    let date = $("#anioPred").val();
    let now = new Date();
    let fechan = new Date(date);
    let anio_nac = parseInt(fechan.getFullYear());
    let mes_nac =parseInt(fechan.getMonth()); 
    let anio_act = parseInt(now.getFullYear());

    console.log(mes_nac);
    if(anio_act - anio_nac >= 0){
        dateValid = true;
    }else{
        dateValid = false;
    }
    return dateValid;
}


function addPredio(){
    let estadoPred = $('#estadoPred').val();
    let tipoPred = $('#tipoPred').val();
    let usoPred = $('#usoPred').val();
    let condPropPred = $('#condPred').val();
    let porcenPred = $('#porPred').val();
    let area = $('#areaPred').val();
    let valor = $('#valorPred').val();
    let idCont_ = $("#idCont_").val();
    
    let anioPred = $("#anioPred").val();
    let materialPred = $("#materialPred").val();
    let porCon = $("#porCon").val();
    let dir = $("#DirPred").val();//esto esta en predio
    $("#loader").css("display", "inline");
    
    if(validarFecha()){

        if(idCont_ != "" && estadoPred != "" && tipoPred != "" && usoPred != "" && valor !=""){
            $.ajax({
                url: 'CRUD_predio.php',
                type: 'post',
                data:{
                    estadoPred:estadoPred,
                    tipoPred: tipoPred,
                    usoPred: usoPred,
                    condPropPred:condPropPred,
                    porcenPred: porcenPred,
                    area: area,
                    valor: valor,
                    idCont_: idCont_,
                    anioPred: anioPred,
                    materialPred: materialPred,
                    porCon: porCon,
                    dir: dir
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
    }else{
        alert("Fecha no valida !!!");
    }
    
    $("#loader").css("display", "none");
}

function getContDetails(id){
    $('#userIdUpd').val(id);
    $.post("CRUD_predio.php",{
        id : id
    },
    function(data, status){
        console.log(data);
        var user = JSON.parse(data);
        console.log(user);
        $('#estadoPredUpd').val(user.EstadoPred);
        $('#tipoPredUpd').val(user.TipoPred);
        $('#usoPredUpd').val(user.UsoPred);
        $('#condPredUpd').val(user.condPropPred);
        $('#porPredUpd').val(user.porcenPropPred);
        $('#areaPredUpd').val(user.areaM2Pred);
        $('#valorPredUpd').val(user.valorTerreno);
    });
    $("#addContUpd").modal("show");
}


function updatePredDetails(){
    let estadoPredUpd = $('#estadoPredUpd').val();
    let tipoPredUpd = $('#tipoPredUpd').val();
    let usoPredUpd = $('#usoPredUpd').val();
    let condPredUpd = $('#condPredUpd').val();
    let porPredUpd = $('#porPredUpd').val();
    let areaPredUpd = $('#areaPredUpd').val();
    let valorPredUpd = $('#valorPredUpd').val();
    let userIdUpd = $('#userIdUpd').val();
    $("#loader").css("display", "inline");

    $.post(
        "CRUD_predio.php",
        {
            estadoPredUpd: estadoPredUpd,
            tipoPredUpd: tipoPredUpd,
            usoPredUpd: usoPredUpd, 
            condPredUpd: condPredUpd,
            porPredUpd: porPredUpd,
            areaPredUpd: areaPredUpd,
            valorPredUpd: valorPredUpd,
            userIdUpd: userIdUpd
        },
        function(data, status){
            console.log(data);
            readCont();
        }
    );
    $("#loader").css("display", "none");
}
