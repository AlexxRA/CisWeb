var botones = false;
var confirmacion = false;

$(document).ready(function() {
    let dataTable = $('#lookup').DataTable( {

        "language":	{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },

        "processing": true,
        "serverSide": true,
        "ajax":{
            url :"ajax_grid_data.php", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
                $(".lookup-error").html("");
                $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#lookup_processing").css("display","none");

            }
        },
        "columns" : [
            {"data": 15},
            {"data": 7},
            {"data": 2},
            {"data": 1},
            {"data": 10},
            {"data": 14},
            {name: 'botones', "data": 16, 'orderable' : false}
        ],
        createdRow: function (row) {
            $(row).addClass('data');
        }
    } );

    $('body #lookup tbody').on('click', 'a', function(){
        botones=true;
    });

    $('#lookup tbody').on('click', 'tr.data', function () {
        if(!botones){
            let filaDeLaTabla = $(this);
            let filaComplementaria = dataTable.row(filaDeLaTabla);

            if (filaComplementaria.child.isShown() ) { // La fila complementaria está abierta y se cierra.
                filaComplementaria.child.hide();
            }
            else { // La fila complementaria está cerrada y se abre.
                filaComplementaria.child(formatearSalidaDeDatosComplementarios(filaComplementaria.data())).show();
            }
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }

        }
        if(!confirmacion) {
            botones = false;
        }
    });

    $('#lookup tbody').on('mouseover', 'tr', function () {
        let filaDeLaTabla = $(this);
        filaDeLaTabla.css("cursor","pointer");

    });

    function formatearSalidaDeDatosComplementarios (filaDelDataSet ) {
        var cadenaDeRetorno = '';
        cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
        cadenaDeRetorno +='<tbody>';
        cadenaDeRetorno += '<tr><td>Dirección: ' + filaDelDataSet[4]+'</td>';
        cadenaDeRetorno += '<td>Orientación: ' + filaDelDataSet[5]+'</td>';
        cadenaDeRetorno += '<td>Inclinación: ' + filaDelDataSet[6]+'</td>';
        cadenaDeRetorno += '<td>Dirección MAC: ' + filaDelDataSet[20]+'</td>';
        cadenaDeRetorno += '</tr>';
        cadenaDeRetorno += '</tbody>';
        cadenaDeRetorno += '</table>';

        cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
        cadenaDeRetorno +='<tbody>';
        cadenaDeRetorno += '<tr><td>Numero de serie: ' + filaDelDataSet[0]+'</td>';
        cadenaDeRetorno += '<td>ID Device: ' + filaDelDataSet[9]+'</td>';
        cadenaDeRetorno += '<td>Numero: ' + filaDelDataSet[3]+'</td>';
        cadenaDeRetorno += '<td>VLAN: ' + filaDelDataSet[21]+'</td></tr>';
        cadenaDeRetorno += '</tbody>';
        cadenaDeRetorno += '</table>';

        cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
        cadenaDeRetorno +='<tbody>';
        cadenaDeRetorno += '<tr><td>Recording server: ' + filaDelDataSet[8]+'</td>';
        cadenaDeRetorno += '<td>VMS: ' + filaDelDataSet[11]+'</td>';
        cadenaDeRetorno += '<td>Usuario: ' + filaDelDataSet[12]+'</td>';
        cadenaDeRetorno += '<td>Contraseña: ' + filaDelDataSet[13]+'</td></tr>';
        cadenaDeRetorno += '</tbody>';
        cadenaDeRetorno += '</table>';

        if(filaDelDataSet[17]){
            cadenaDeRetorno += '<table class="table bg-light">';
            cadenaDeRetorno +='<tbody>';
            cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
            cadenaDeRetorno += '<tr><td>' + filaDelDataSet[17]+'</td>';
            cadenaDeRetorno += '<td>Por: ' + filaDelDataSet[18]+'</td>';
            cadenaDeRetorno += '<td>Fecha: ' + filaDelDataSet[19]+'</td>';
            cadenaDeRetorno += '</tr></tbody>';
            cadenaDeRetorno += '</table>';
        }
        else{
            cadenaDeRetorno += '<table class="table bg-light">';
            cadenaDeRetorno +='<tbody>';
            cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
            cadenaDeRetorno += '<tr><td>No hay comentarios</td>';
            cadenaDeRetorno += '</tr></tbody>';
            cadenaDeRetorno += '</table>';
        }
        cadenaDeRetorno+='<a href="../Busqueda/search.php?id_pmi='+filaDelDataSet[15]+'"  title="Ir a la información del PMI" class="btn btn-outline-primary btn-sm mr-1" role="button"> Informacion de PMI</a>';

        return cadenaDeRetorno;
    }
} );

function confirmarEliminar(){
    if(confirm('Estas seguro de elimar la camara?')){
        confirmacion=true;
        return true;
    }
    else{
        confirmacion=false;
        console.log(confirmacion);
        return false;
    }
}



