(function($) {
    "use strict";
    $('.stm-margin__position-val').on('change', function() {
        var marginParamContainer = $(this).closest('.stm-margin'),
            marginVal = '';

        marginParamContainer.find('.stm-margin__position-val').each(function() {
            var marginPositionVal = $(this).val(),
                marginPosition = $(this).data('stm-margin-position');

            if( marginPositionVal ) {
                marginVal += 'margin-' + marginPosition + ':' + marginPositionVal + ';';
            }
        });

        marginParamContainer.find('.stm-margin__val').val(marginVal);
    });

    $('.stm-margin').each(function() {
        var paramContainer = $(this);
        var marginVal = $(this).find('.stm-margin__val').val();

        if( marginVal ) {
            var marginPositionVal = marginVal.split(';');

            $.each(marginPositionVal, function(index,value) {
                var splitVal = value.split(':');
                var splitMarginVal = splitVal[1];
                var splitMarginPosition = splitVal[0].split('-');
                var splitPosition = splitMarginPosition[1];

                paramContainer.find('.stm-margin__position-val').each(function() {
                    var marginPosition = $(this).data('stm-margin-position');

                    if( marginPosition === splitPosition ) {
                        $(this).val(splitMarginVal);
                    }
                });


            });
        }
    });
})(jQuery);