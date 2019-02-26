(function ($) {

    $.fn.simplePan = function (options) {

        var settings = $.extend({
            css: {
                height: '500px',
                width: '600px'
            }
        }, options);

        return this.each(function (i, j) {
            var $this = $(j);
            // Find Image to pan
            var $img = $("img", $this);

            $this.addClass('simple-pan').css(settings.css);
            $img.addClass('pan-image').css({
                top: 0,
                left: 0
            });

            //Flags to map the position of the image
            $this.move = {
                status: false,
                oldX: 0,
                oldY: 0
            };

            //Set the flags and the starting co-ordinates on move down
            $this.on('mousedown', function (e) {
                $this.move.status = true;
                $this.move.oldX = (e.pageX - $img.offset().left);
                $this.move.oldY = (e.pageY - $img.offset().top);
                e.preventDefault();
            });
            //Reset the flags on mouse up
            $this.on('mouseup mouseout', function (e) {
                $this.move.status = false;
                $this.move.oldX = (e.pageX - $img.offset().left);
                $this.move.oldY = (e.pageY - $img.offset().top);
                e.preventDefault();
            });
            //Check the mouse button and move the image with respect to the cursor position
            $this.on('mousemove', function (e) {
                if ($this.move.status) {
                    //Update position based on drag
                    $img.css('left', parseInt($img.css('left')) + (e.pageX - $img.offset().left) - $this.move.oldX);
                    $img.css('top', parseInt($img.css('top')) + (e.pageY - $img.offset().top) - $this.move.oldY);
                }
                e.preventDefault();
            });
        });
    };
})(jQuery);