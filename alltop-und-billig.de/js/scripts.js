/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

     var dd = jQuery('.vticker').easyTicker({
        direction: 'up',
        easing: 'easeInOutBack',
        speed: 'slow',
        interval: 5000,
        height: '1739px',
        visible: 10,
        mousePause: 1,
        controls: {
        up: '.up',
        down: '.down',
        toggle: '.toggle',
        stopText: 'Stop !!!'
        }
     }).data('easyTicker');

     cc = 1;
     $('.aa').click(function(){
        $('.vticker ul').append('<li>' + cc + ' Triangles can be made easily using CSS also without any images. This trick requires only div tags and some</li>');
        cc++;
     });

jQuery(document).ready(function(){
     $('.vis').click(function(){
        dd.options['visible'] = 3;
     });

     $('.visall').click(function(){
        dd.stop();
        dd.options['visible'] = 0 ;
        dd.start();
     });
            jQuery('input[name=os0]').click(function(){
                    jQuery('input[name=hosted_button_id]').val(jQuery(this).val());
            });
});

 var zoom = jQuery('#zoom_01').elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 0,
                    zoomWindowFadeOut: 0
                    }); 

