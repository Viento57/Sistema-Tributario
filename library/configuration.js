$(document).ready(
    ()=>{
        listar();
        listar2();
    }
);

function listar() {
    let info = $("#codOficina").text();
    $('#reporte').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {extend:'copy', text:'copiar', title: ""},
             'csv',
            { 
              extend:'excel',
              title: "Reporte" ,
              filename: "Reporte"
            },
             {extend:'print',
              title: "Reporte",
              text:'Imprimir' ,
              filename: "Reporte"
              
            }
        ],
        language: idiomaEspaniol
    } );
}
function listar2() {
    $('#reporte2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {extend:'copy', text:'copiar', title: ""},
             'csv',
            { 
              extend:'excel',
              title: "Reporte de pagos trimestrales" ,
              filename: "Reporte"
            },
             {extend:'print',
              title: "Reporte de pagos trimestrales",
              text:'Imprimir' ,
              filename: "Reporte"
              
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
