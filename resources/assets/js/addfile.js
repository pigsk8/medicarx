$(document).ready(function () {

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