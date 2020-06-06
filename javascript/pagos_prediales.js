$(document).ready(function(){
    
});

const impuestoPredios = ()=>{
    let DNI = $("#busqueda_contribuyente").val();
    if(DNI != ""){
        $.ajax({
            url: "CRUD_pagoPredial.php",
            type: "post",
            data: {
                DNI: DNI
            },
            success: function(data, status){
                $("#dataCont").html(data);
            },
            error: function(a, b, c){
                   
            }
        });
    }else{
        alert("El formulario no puede estar vacio!!!");
    }
}

const realizarPago = ()=>{
    let anio = $("#year").text();
    let monto = $("#monto").text();
    let DNIp = $("#busqueda_contribuyente").val();
    const confirmarPago = confirm("Seguro que desea realizar el pago?");
    if(confirmarPago){
        if(anio != "" && monto != ""){
            $.ajax({
                url:'CRUD_pagoPredial.php',
                type: 'post',
                data:{
                    anio: anio,
                    monto:monto,
                    DNIp:DNIp
                },
                success: function(data, status){
                    console.log(data);
                    impuestoPredios();
                }
            });
        }else{
            alert("campos incompletos!!!!");
        }
    }else{

    }
}

const realizarTrim = ()=>{
    let anioT = $("#year").text();
    let montoT = $("#monto").text();
    let DNIpT = $("#busqueda_contribuyente").val();
    const confirmarPago = confirm("Seguro que desea realizar el pago?");
    if(confirmarPago){
        if(anioT != "" && montoT != ""){
            $.ajax({
                url:'CRUD_pagoPredial.php',
                type: 'post',
                data:{
                    anioT: anioT,
                    montoT:montoT,
                    DNIpT:DNIpT
                },
                success: function(data, status){
                    console.log(data);
                    impuestoPredios();
                }
            });
        }else{
            alert("campos incompletos!!!!");
        }
    }else{

    }
}

function realizarTrimPago(numPago){
    let anioTC = $("#year").text();
    let montoTC = $("#monto").text();
    let DNIpTC = $("#busqueda_contribuyente").val();
    const confirmarPago = confirm("Seguro que desea realizar el pago?");
    if(confirmarPago){
        if(anioTC != "" && montoTC != ""){
            $.ajax({
                url:'CRUD_pagoPredial.php',
                type: 'post',
                data:{
                    anioTC: anioTC,
                    montoTC:montoTC,
                    DNIpTC:DNIpTC,
                    numPago: numPago
                },
                success: function(data, status){
                    console.log(data);
                    impuestoPredios();
                }
            });
        }else{
            alert("campos incompletos!!!!");
        }
    }else{

    }
}

function cambiarFormPago(){
    $("#pagoUnico").toggleClass("d-none");
    $("#pagoCuotas").toggleClass("d-none");
}