require([
    "jquery",
    "jquery/ui"
], function($){
    setTimeout(function(){
        $('input[name="general[slider_image]"]').attr('name', 'slider_image');
   }, 3000);
});

