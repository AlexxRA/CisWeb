var botones = false;

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
            {"data": 16},
            {"data": 8},
            {"data": 3},
            {"data": 1},
            {"data": 11},
            {"data": 15},
            {name: 'botones', "data": 17, 'orderable' : false}
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
    });

    $('#lookup tbody').on('mouseover', 'tr', function () {
        let filaDeLaTabla = $(this);
        filaDeLaTabla.css("cursor","pointer");

    });

    function formatearSalidaDeDatosComplementarios (filaDelDataSet ) {
        var cadenaDeRetorno = '';
        cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
        cadenaDeRetorno +='<tbody>';
        cadenaDeRetorno += '<tr><td>Dirección: ' + filaDelDataSet[5]+'</td>';
        cadenaDeRetorno += '<td>Orientación: ' + filaDelDataSet[6]+'</td>';
        cadenaDeRetorno += '<td>Inclinación: ' + filaDelDataSet[7]+'</td>';
        cadenaDeRetorno += '</tr>';
        cadenaDeRetorno += '</tbody>';
        cadenaDeRetorno += '</table>';

        cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
        cadenaDeRetorno +='<tbody>';
        cadenaDeRetorno += '<tr><td>Numero de serie: ' + filaDelDataSet[0]+'</td>';
        cadenaDeRetorno += '<td>ID: ' + filaDelDataSet[2]+'</td>';
        cadenaDeRetorno += '<td>ID Device: ' + filaDelDataSet[10]+'</td>';
        cadenaDeRetorno += '<td>Numero: ' + filaDelDataSet[4]+'</td></tr>';
        cadenaDeRetorno += '</tbody>';
        cadenaDeRetorno += '</table>';

        cadenaDeRetorno += '<table class="p-3 mb-2 bg-light text-dark mx-auto col-md-12">';
        cadenaDeRetorno +='<tbody>';
        cadenaDeRetorno += '<tr><td>Recording server: ' + filaDelDataSet[9]+'</td>';
        cadenaDeRetorno += '<td>VMS: ' + filaDelDataSet[12]+'</td>';
        cadenaDeRetorno += '<td>Usuario: ' + filaDelDataSet[13]+'</td>';
        cadenaDeRetorno += '<td>Contraseña: ' + filaDelDataSet[14]+'</td></tr>';
        cadenaDeRetorno += '</tbody>';
        cadenaDeRetorno += '</table>';

        if(filaDelDataSet[18]){
            cadenaDeRetorno += '<table class="table bg-light">';
            cadenaDeRetorno +='<tbody>';
            cadenaDeRetorno += '<tr><h6>Comentarios</h6></tr>';
            cadenaDeRetorno += '<tr><td>' + filaDelDataSet[18]+'</td>';
            cadenaDeRetorno += '<td>Por: ' + filaDelDataSet[19]+'</td>';
            cadenaDeRetorno += '<td>Fecha: ' + filaDelDataSet[20]+'</td>';
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
        cadenaDeRetorno+='<a href="../Busqueda/search.php?id_pmi='+filaDelDataSet[16]+'"  title="Ir a la información del PMI" class="btn btn-outline-primary btn-sm mr-1" role="button"> Informacion de PMI</a>';

        return cadenaDeRetorno;
    }
} );



