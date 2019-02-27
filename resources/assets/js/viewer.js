$(document).ready(function () {

    /**Control Tools Visor */
    var degrees=0;

    $('.control').click(function(){
        var typeControl = $(this).attr('data-control');
        var figureRad = $(this).closest('.content-img').find('figure');
        var imgRad = $(this).closest('.content-img').find('img');
        var imgGlass = $(this).closest('.content-img').find('img');
        if(typeControl=='control-zoom'){
            $(this).toggleClass('btn-info');
            $(this).closest('.content-img').find('.control-zoom-bar').toggle();
        }else if(typeControl=='control-invert'){
            $(this).toggleClass('btn-info');
            controlInvert(imgRad);
        }else if(typeControl=='control-glass'){
            if($(this).hasClass('btn-info')){
                $(this).toggleClass('btn-info');
                $(this).closest('.content-img').find('.magnify_glass').hide();
                $(this).closest('.content-img').find('.magnify').data('jfMagnify').destroy();
            }else{
                $(this).toggleClass('btn-info');
                $(this).closest('.content-img').find('.magnify_glass').show();
                $(this).closest('.content-img').find('.magnify').jfMagnify();
            }
        }else if(typeControl=='control-pan'){
            $(this).toggleClass('btn-info');
            var figureContainer = $(this).closest('.content-img').find('.figure');
            var moveImg = $(this).closest('.content-img').find('.img-move');
            controlPan(figureContainer,moveImg);
        }else if(typeControl=='control-rotate-horizontal'){
            $(this).closest('.content-img').find('.img-flip-hor').toggleClass('flip-hor');
            // $(this).closest('.content-img').find('.glass-flip-hor').toggleClass('flip-hor');
        }else if(typeControl=='control-rotate-vertical'){
            $(this).closest('.content-img').find('.img-flip-vert').toggleClass('flip-vert');
            // $(this).closest('.content-img').find('.glass-flip-vert').toggleClass('flip-vert');
        }else if(typeControl=='control-rotate-left'){
            var side = 'left';
            var block = $(this).closest('.content-img').find('.img-rotate');
            var blockGlass = $(this).closest('.content-img').find('.glass-rotate');
            controlRotate(block,blockGlass,side);
        }else if(typeControl=='control-rotate-right'){
            var side = 'right';
            var block = $(this).closest('.content-img').find('.img-rotate');
            var blockGlass = $(this).closest('.content-img').find('.glass-rotate');
            controlRotate(block,blockGlass,side);
        }
    });

    $('.control-zoom').click(function(){
        $(this).closest('.content-img').find('.control-zoom').removeClass('btn-info');
        $(this).addClass('btn-info');
        var imgRad = $(this).closest('.content-img').find('img');
        var dataZoom = $(this).attr('data-zoom');
        imgRad.css('transform','scale('+dataZoom+')');
    });

    function controlInvert(imgRad){
        imgRad.toggleClass('control-invert');
    }

    function controlPan(figureContainer, imgMove){
        // figureRad.toggleClass('simple-pan');
        imgMove.toggleClass('pan-image');
        figureContainer.simplePan({
            centerImage: false,
            css: {
                height: 'auto',
                width: '100%'
            },
        });
    }

    function controlRotate(block,blockGlass,side){
        if(side=='left'){
            degrees -= 90;
        }else if(side=='right'){
            degrees += 90;
        }
        block.css('-ms-transform', 'rotate(' + degrees + 'deg)');
        block.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
        block.css('transform', 'rotate(' + degrees + 'deg)');
        blockGlass.css('-ms-transform', 'rotate(' + degrees + 'deg)');
        blockGlass.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
        blockGlass.css('transform', 'rotate(' + degrees + 'deg)');
    }



});