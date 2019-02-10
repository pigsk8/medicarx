
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {

    /**Data Tables */
    /**dt list consultas admin */
    $('#dt').DataTable({
        "order": [0, 'desc'],
        "language": {
            "lengthMenu": "Mostrar _MENU_ consultas",
            "zeroRecords": "No encontrada",
            "info": "mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados",
            "infoFiltered": "(filtrado de _MAX_ consultas)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    /**dt welcome page (paciente,medico) */
    $('#dt-pendientes').DataTable({
        "order": [0, 'desc'],
        "language": {
            "lengthMenu": "Mostrar _MENU_ consultas",
            "zeroRecords": "No encontrada",
            "info": "mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados",
            "infoFiltered": "(filtrado de _MAX_ consultas)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('#dt-revisadas').DataTable({
        "order": [0, 'desc'],
        "language": {
            "lengthMenu": "Mostrar _MENU_ consultas",
            "zeroRecords": "No encontrada",
            "info": "mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados",
            "infoFiltered": "(filtrado de _MAX_ consultas)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    /**dt list usuarios*/
    $('#dt-user').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ usuarios",
            "zeroRecords": "No encontrado",
            "info": "mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados",
            "infoFiltered": "(filtrado de _MAX_ usuarios)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });


    /**  Select Dropdown Search*/
    $('.selectpicker').selectpicker();
    $('.filter-option-inner-inner').addClass('text-capitalize');

    /** Progres Bar Upload File Consulta */

    var inputFile = $('#img-rad');

    inputFile.change(function(){
        $('#name-file').html(inputFile.val());
    });

    function validate(formData, jqForm, options) {
        var form = jqForm[0];
        if (!form.file.value) {
            alert('File not found');
            return false;
        }
    }

    (function() {

        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');
    
        $('#form-upload-file').ajaxForm({
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = 'Espere, Guardando';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                var msj='';
                if(xhr.status == 422){
                    for(var i in xhr.responseJSON){  
                        console.log()
                        for(var j in xhr.responseJSON[i]){
                            msj=msj+'<p>'+xhr.responseJSON[i][j]+'</p>';
                        }
                    }
                    status.html('<div class="alert alert-danger">'+msj+'</div>');
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                    inputFile.val(''); 
                    $('#name-file').html(inputFile.val());
                }else if(xhr.status == 200){
                    status.html('<div class="alert alert-success">Consulta creada</div>');
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                    inputFile.val(''); 
                    $('#name-file').html(inputFile.val());
                }else{
                    status.html('<div class="alert alert-danger">Error desconocido, actualiza e intenta de nuevo</div>');
                }
            }
        });

    })();
});

