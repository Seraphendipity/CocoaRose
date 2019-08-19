$(window).ready( function() {
    flipperInit();
});

function flipperInit() {
    $('.flipper .flipperBtnMeta').click(function() {
        var container = $(this).parent().parent();
        container.find('.flipperBack [tabindex="-1"]').attr('tabindex', '0');
        container.find('.flipperFront [tabindex="0"]').attr('tabindex', '-1');
        container.addClass('imgFlipped');
        container.find('.flipperBtnImg').attr('disabled', false);
        $(this).attr('disabled', true);

    });

    $('.flipper .flipperBtnImg').click(function() {
        var container = $(this).parent().parent();
        container.find('.flipperFront [tabindex="-1"]').attr('tabindex', '0');
        container.find('.flipperBack [tabindex="0"]').attr('tabindex', '-1');
        container.removeClass('imgFlipped');
        container.find('.flipperBtnMeta').attr('disabled', false);
        $(this).attr('disabled', true);
    });
}