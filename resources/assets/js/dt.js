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

});