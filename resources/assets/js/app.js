
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

    /** Agregar nuevas radiografías */

    $('.btn-add-file').click(function(event){
        event.preventDefault();

        $.get($(this).attr('data-route'), function(data, status){

            var list = "";
            data.forEach(element => {
                list += '<option value="'+ element.id +'" class="text-capitalize">'+element.descripcion+'</option>';
            });
    
            var content = `<div class="item-file">
    
                <div class="form-group">
                    <label>Subir imagen radiografica:</label>
                    <input type="file" class="form-control-file" name="img-rad[]">
                </div>
                <div class="form-group">
                    <label>Seleccione tipo de estudio:</label>
                    <select class="form-control text-capitalize" name="estudio[]">`
                    + list +
                    `</select>
                </div>
    
            </div>`;
    
            $('.multiple-file').append(content);
            $('.btn-remove-file').prop("disabled", false);
        });

    });

    /** Elimnar campo de archivo */

    $('.btn-remove-file').click(function(event){
        event.preventDefault();
        if($(".item-file").toArray().length>1){
            $(".item-file").last().remove();
            if($(".item-file").toArray().length==1){
                $('.btn-remove-file').prop("disabled", true);
            }
        }
    });
});

