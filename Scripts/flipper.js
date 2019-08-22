$(window).ready( function() {
    flipperInit();
});

function flipperInit() {
    $('.flipper .flipperFront .flipperBtn-js').click(function() {
        var container = $(this).parents('.flipperContainer');
        container.find('.flipperBack [tabindex="-1"]').attr('tabindex', '0');
        container.find('.flipperFront [tabindex="0"]').attr('tabindex', '-1');
        container.addClass('imgFlipped');
        container.find('.flipperBack .flipperBtnMenu').children().prop('disabled', false);
        $(this).parent().children().prop('disabled', true);

    });

    $('.flipper .flipperBack .flipperBtn-js').click(function() {
        var container = $(this).parents('.flipperContainer');
        container.find('.flipperFront [tabindex="-1"]').attr('tabindex', '0');
        container.find('.flipperBack [tabindex="0"]').attr('tabindex', '-1');
        container.removeClass('imgFlipped');
        container.find('.flipperFront .flipperBtnMenu').children().prop('disabled', false);
        $(this).parent().children().prop('disabled', true);
    });
}