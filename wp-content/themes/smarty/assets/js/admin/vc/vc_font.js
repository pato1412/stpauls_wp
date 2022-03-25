(function($) {
    "use strict";
    $('.stm-font__option-val').on('change', function() {
        var paramContainer = $(this).closest('.stm-font'),
            paramVal = '';

        paramContainer.find('.stm-font__option-val').each(function() {
            var paramOptVal = $(this).val(),
                paramOpt = $(this).data('stm-param-option');

            if( paramOptVal ) {
                paramVal += paramOpt + ':' + paramOptVal + ';';
            }
        });

        paramContainer.find('.stm-font__val').val(paramVal);
    });

    $('.stm-font').each(function() {
        var paramContainer = $(this);
        var paramVal = paramContainer.find('.stm-font__val').val();

        if( paramVal ) {
            var paramOpt = paramVal.split(';');

            $.each(paramOpt, function(index,value) {
                var paramOptSplit = value.split(':'),
                    paramOptName = paramOptSplit[0],
                    paramOptVal = paramOptSplit[1];

                paramContainer.find('.stm-font__option-val').each(function() {
                    var thisParamOpt = $(this).data('stm-param-option');

                    if( thisParamOpt === paramOptName ) {
                        $(this).val(paramOptVal);
                    }
                });


            });
        }
    });
})(jQuery);