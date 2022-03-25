(function($) {
    "use strict";
    $('.stm-css__option-val').on('change', function() {
        var paramContainer = $(this).closest('.stm-css'),
            paramVal = '';

        paramContainer.find('.stm-css__option-val').each(function() {
            var paramOptVal = $(this).val(),
                paramOpt = $(this).data('stm-param-option');

            if( paramOptVal ) {
                paramVal += paramOpt + ':' + paramOptVal + ';';
            }
        });

        paramContainer.find('.stm-css__style').val(paramVal);
    });

    $('.stm-css').each(function() {
        var paramContainer = $(this);
        var paramVal = paramContainer.find('.stm-css__style').val();

        if( paramVal ) {
            var paramOpt = paramVal.split(';');

            $.each(paramOpt, function(index,value) {
                var paramOptSplit = value.split(':'),
                    paramOptName = paramOptSplit[0],
                    paramOptVal = paramOptSplit[1];

                paramContainer.find('.stm-css__option-val').each(function() {
                    var thisParamOpt = $(this).data('stm-param-option');

                    if( thisParamOpt === paramOptName ) {
                        $(this).val(paramOptVal);
                    }
                });


            });
        }
    });
})(jQuery);