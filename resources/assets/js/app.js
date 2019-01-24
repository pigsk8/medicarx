
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {

    $('#dt').DataTable({
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

    $('#dt-pendientes').DataTable({
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


    $('.selectpicker').selectpicker();
    

    $('.filter-option-inner-inner').addClass('text-capitalize');
});

