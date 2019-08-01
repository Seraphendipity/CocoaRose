$(window).ready( function() {
    flipperInit();
});

function flipperInit() {
    $('.flipper .imgBtnMeta').click(function() {
        $(this).parent().parent().addClass('imgFlipped');
        $(this).parent().parent().find('.imgBtnPic').attr('disabled', false);
        $(this).attr('disabled', true);

    });

    $('.flipper .imgBtnPic').click(function() {
        $(this).parent().parent().removeClass('imgFlipped');
        $(this).parent().parent().find('.imgBtnMeta').attr('disabled', false);
        $(this).attr('disabled', true);
    });
}