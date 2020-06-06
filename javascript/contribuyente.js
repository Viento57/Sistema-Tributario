$(document).ready(function(){
    readCont();
    var dateValid = true;
    $("#razonSocial").addClass("d-none");
});

function readCont(){
    let usuario = "usuario";
    $.ajax({
        url : "CRUD_contribuyente.php",
        type:"post",
        data:{
            usuario: usuario
        }, 
        success: function(data, status){
            console.log(data);
            $("#containerTableCont").html(data);
        }, 
        error: function(a, b, c){    
            $("#containerTableCont").html('<div class="alert alert-danger">Error no se puede encontrar la tabla:'+c+'</div>');
        },
        complete: function(a){
            console.log(a);
        }
    });
}

function validarFecha(){
    let date = $("#fechNaciCont").val();
    let now = new Date();
    let fechan = new Date(date);
    let anio_nac = parseInt(fechan.getFullYear());
    let mes_nac =parseInt(fechan.getMonth()); 
    let anio_act = parseInt(now.getFullYear());

    console.log(mes_nac);
    if(anio_act - anio_nac >= 18){
        dateValid = true;
    }else{
        dateValid = false;
    }
    return dateValid;
}

function deleteCont(id_del){
    console.log("algo");
    let conf = confirm("seguro de borrar el registro?");
    $("#loader").css("display", "inline");
    if(conf){
        $.ajax({
            url : "CRUD_contribuyente.php", 
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
$("#idTipoCont").on("change", ()=>{
    if($("#idTipoCont").val() == 1){
        $("#razonSocial").addClass("d-none");
    }
    if($("#idTipoCont").val() == 2){
        $("#razonSocial").removeClass("d-none");
    }
});
function addContribuyente(){

    let nombCont = $('#nombCont').val();
    let apelCont = $('#apelCont').val();
    let RazoSociCont = $('#RazoSociCont').val();
    let fechNaciCont = $('#fechNaciCont').val();
    let sexoCont = $('#sexoCont').val();
    let nacionalidadCont = $('#nacionalidadCont').val();
    let idTipoCont = $('#idTipoCont').val();
    let DNI = $('#DNI').val();
    let dirC = $("#dirC").val(); 
    let corC = $("#corC").val(); 
    console.log(typeof(DNI));
    console.log();
    $("#loader").css("display", "inline");
    if(DNI.length === 8){
        if(validarFecha()){
            if(nombCont != "" && apelCont != "" && fechNaciCont != "" && idTipoCont !=""){
                $.ajax({
                    url: 'CRUD_contribuyente.php',
                    type: 'post',
                    data:{
                        nombCont_add : nombCont,
                        apelCont : apelCont,
                        RazoSociCont: RazoSociCont,
                        fechNaciCont: fechNaciCont,
                        sexoCont : sexoCont,
                        nacionalidadCont : nacionalidadCont,
                        idTipoCont : idTipoCont,
                        DNI:DNI,
                        dirC: dirC,
                        corC : corC
                    },
                    success:function(data, status){
                        console.log(data);
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
            alert("Menor de edad, fecha no valida!!");
        }
    }else{
        alert("DNI incorrecto!!!!!");
    }
    $("#loader").css("display", "none");
}

function getContDetails(id){
    $('#userIdUpd').val(id);
    $.post("CRUD_contribuyente.php",{
        id : id
    },
    function(data, status){
        console.log(data);
        var user = JSON.parse(data);
        $("#nombContUpd").val(user.nombCont);
        $("#apelContUpd").val(user.apelCont);
        $("#RazoSociContUpd").val(user.RazoSociCont);
        $("#fechNaciContUpd").val(user.fechNaciCont);
        $("#sexoContUpd").val(user.sexoCont);
        $("#nacionalidadContUpd").val(user.nacionalidadCont);
        $("#idTipoContUpd").val(user.idTipoCont);
        $("#DNIUpd").val(user.DNI);
        $("#corContUpd").val(user.correo);
    });
    $("#addContUpd").modal("show");
}


function updateContDetails(){
    let nombCont = $('#nombContUpd').val();
    let apelCont = $('#apelContUpd').val();
    let RazoSociCont = $('#RazoSociContUpd').val();
    let fechNaciCont = $('#fechNaciContUpd').val();
    let sexoCont = $('#sexoContUpd').val();
    let nacionalidadCont = $('#nacionalidadContUpd').val();
    let idTipoCont = $('#idTipoContUpd').val();
    let idCont = $('#userIdUpd').val();
    let DNI = $('#DNIUpd').val();
    let cor = $("#corContUpd").val();
    if(DNI.length === 8){
        if(nombCont != "" && apelCont != "" && fechNaciCont != "" && idTipoCont !=""){
    $.post(
        "CRUD_contribuyente.php",
        {
            nombCont : nombCont,
            apelCont : apelCont,
            RazoSociCont: RazoSociCont,
            fechNaciCont: fechNaciCont,
            sexoCont : sexoCont,
            nacionalidadCont : nacionalidadCont,
            idTipoCont : idTipoCont,
            idCont : idCont,
            DNI: DNI,
            cor : cor
        },
        function(data, status){
           console.log(data);
           console.log(status);
            readCont();
        }
    );
}else{
    alert("Completa todos los campos!!! ");
}
}else{
alert("DNI incorrecto!!!!!");
}
}
