$(document).ready(function () {

    /**Control Tools Visor */
    // $('.control-zoom').click(function(){
    //     if($(this).hasClass('btn-info')){
    //         $(this).removeClass('btn-info');
    //         $(this).closest('.content-img').find('.figure').removeClass('img-control-zoom');
    //     }else{
    //         $(this).addClass('btn-info');
    //         $(this).closest('.content-img').find('.figure').addClass('img-control-zoom');
    //         $('.img-control-zoom')
    //         .append('<div class="photo"></div>')
    //         .children('.photo').css({'background-image': 'url('+ $(this).closest('.content-img').find('.figure').attr('data-image') +')'});
    //     }

    $('.control').click(function(){
        var typeControl = $(this).attr('data-control');
        var figureRad = $(this).closest('.content-img').find('figure');
        var imgRad = $(this).closest('.content-img').find('img');
        if(typeControl=='control-invert'){
            controlInvert($(this),imgRad);
        }else if(typeControl=='control-pan'){
            controlPan($(this),figureRad,imgRad);
        }
    });

    function controlInvert(button, imgRad){
        button.toggleClass('btn-info');
        imgRad.toggleClass('control-invert');
    }

    function controlPan(button, figureRad, imgRad){
        button.toggleClass('btn-info');
        // figureRad.toggleClass('simple-pan');
        imgRad.toggleClass('pan-image');
        figureRad.simplePan({
            centerImage: false,
            css: {
                height: 'auto',
                width: '100%'
            },
        });
    }


    // });
    // /**Zoom */
    // $(document).on('mouseover', '.img-control-zoom', function() {
    //     console.log('mouseover');
    //     $(this).children('.photo').css({'transform': 'scale(2.4)'}); 
    // });

    // $(document).on('mouseout', '.img-control-zoom', function(){
    //     console.log('mouseout');
    //     $(this).children('.photo').css({'transform': 'scale(1)'});
    // });

    // $(document).on('mousemove', '.img-control-zoom', function(e){
    //     console.log('mousemove');
    //     $(this).children('.photo').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
    // });

});