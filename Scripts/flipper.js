$(window).ready( function() {
    flipperInit();
});

function flipperInit() {
    $('.flipper .imgBtnMeta').click(function() {
        var container = $(this).parent().parent();
        container.find('.flipperBack [tabindex="-1"]').attr('tabindex', '0');
        container.find('.flipperFront [tabindex="0"]').attr('tabindex', '-1');
        container.addClass('imgFlipped');
        container.find('.imgBtnPic').attr('disabled', false);
        $(this).attr('disabled', true);

    });

    $('.flipper .imgBtnPic').click(function() {
        var container = $(this).parent().parent();
        container.find('.flipperFront [tabindex="-1"]').attr('tabindex', '0');
        container.find('.flipperBack [tabindex="0"]').attr('tabindex', '-1');
        container.removeClass('imgFlipped');
        container.find('.imgBtnMeta').attr('disabled', false);
        $(this).attr('disabled', true);
    });
}