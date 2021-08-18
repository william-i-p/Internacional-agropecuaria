(function($){
"use strict";


 elementor.hooks.addAction("panel/open_editor/widget/htsliderpro-addons",function(panel,model,view){


    // After Change
    $("input:hidden[value='image_hidden_item']").parents('.elementor-control').prev().find('select').on('change',function(){
        if('1'==$(this).val()){
            $("input:hidden[value='hidden_item_selector']").parents(".elementor-control").prev().hide();
        }else{
            $("input:hidden[value='hidden_item_selector']").parents(".elementor-control").prev().show();
        }
    });

    // Default save value
    if( '1' == $("input:hidden[value='image_hidden_item']").parents('.elementor-control').prev().find('select').val() ){
        $("input:hidden[value='hidden_item_selector']").parents(".elementor-control").prev().hide();
    }else{
        $("input:hidden[value='hidden_item_selector']").parents(".elementor-control").prev().show();
    }



});



})(jQuery);