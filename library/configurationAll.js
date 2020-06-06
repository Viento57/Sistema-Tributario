let nombre = $("#codUsuario").text();
let oficina = $("#usuario").text();
let area = $("#area").val();
let DNI = $("#DNI").val();



$(document).ready(
    listar
);

function listar() {
    $('#example').DataTable( {
        "ajax":{
            "method":"POST",
            "url": "CRUD_items.php",
            "data":{
                all:"all"
            }
        },
        "columns":
        [
            {"data":"codigoPatrimonial"},
            {"data":"cuentaContable"},
            {"data":"denominacion"},
            {"data":"marca"},
            {"data":"modelo"},
            {"data":"placa"},
            {"data":"tipo"},
            {"data":"color"},
            {"data":"serie"},
            {"data":"dimensiones"},
            {"data":"otros"},
            {"data":"estado"},
            {"data": "ordenCompra"},
            {"data":"fechaAlta"},
            {"data":"precio"},
            {"data":"nombre"}
        ],
        dom: 'Bfrtip',
        buttons: [
            {extend:'copy', text:'copiar', title: ""},
             'csv',
            { 
              extend:'excel',
              title: "Reporte general de bienes" ,
              filename: "Reporte general de bienes"
            },
             {extend:'print',
              title: oficina,
              text:'Imprimir' ,
              filename: oficina,
              message: "<table class='table'><tbody><tr><th></th><td></td><td></td><td rowspan='3'><img src='data:image/bmp;base64,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'></td><td><h1>Reporte general de bienes</h1></td></tr></table>"
            }
        ],
        language: idiomaEspaniol
    } );
}
var idiomaEspaniol = { 	
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "No se encontraron resultados...",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {	"sFirst": "Primero",
                    "sLast": "último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente", 		"sSortDescending": ": Activar para ordenar la columna de manera descendente" 	} }
