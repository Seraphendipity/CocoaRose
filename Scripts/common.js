// function HelloWorld() {
//    this.innerHTML = "noooo";
// }

$(window).ready( function() {
    imgLightbox();
});

//document.documentElement is for other browsers
// function arcShrinkTitle() {
//     btn = document.getElementsByClassName("arcHeaderBtn")[0];
//     btn.style.width = '7em';
//     btn.style.fontSize = '2em';
//     btn.style.color = "#111"
//     btn.style.backgroundColor = '#DDD';
//     btn.style.opacity = '0.2';
//     btn.style.top = '6vh';
// }

// function dynamicOpacity(elem) {
//     scrollTop = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
//     scrollBot = screen.height + scrollTop;
//     opacBPTop = 100; // Opacity Breakpoint Top, where the text should begin fading
//     opacBPBot = 250; // Opacity Breakpoint Bottom, where the text (from bottom of screen) will be fully visible
//     opacBPOffset = 50; // Opacity Breakpoint Offset, causing fading a bit before the header and nav
//     elem.style.opacity = Math.min( (elem.offsetTop - scrollTop - opacBPOffset)/opacBPTop, (scrollBot - elem.offsetTop - (opacBPOffset*2))/opacBPBot );
//     // elem.innerHTML = (scrollBot - elem.offsetTop - opacBPOffset)/opacBPBot; //scrollTop; DEBUG

// }

// window.onscroll = function() {arcScrollEffect()}; // calls scroll function on scrolling
// function arcScrollEffect() {
//     img = document.getElementsByClassName("arcHeaderImg")[0];
//     sect = document.getElementsByClassName("textPoem")[0];
//     min = 50;
//     lastChild = sect.children[sect.children.length-1];
//     max = lastChild.offsetHeight + lastChild.offsetTop;
//     scrollTop = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
//     // scrollHeight = document.body.scrollHeight;
//     scrollBot = screen.height + scrollTop;
//     if (scrollTop > min && scrollTop < max) {
//         arcShrinkTitle();
//         img.style.opacity = 0.3;
//         img.style.filter = 'blur(4px)';
//     // } else if ( (document.body.scrollTop > min || document.documentElement.scrollTop > min) &&
//     //             (document.body.scrollTop < max || document.documentElement.scrollTop < max) ) {
//     //     img.style.opacity = 1;
//     } else {
//         // At page top
//         img.style.filter = 'initial'
//         img.style.opacity = 1;
//     }
//     for(i=0; i < sect.children.length; i++) {
//         for(j=0; j < sect.children[i].children.length; j++) {
//             dynamicOpacity(sect.children[i].children[j]);
//     }
// }
// }
function arcPageLoader() {
    // Makes end div extend one page down past last content
    sect = document.getElementsByClassName("textPoem")[0];
    firstContentTop = document.getElementsByClassName("textPoem")[0].offsetTop;
    lastContentTop = sect.children[sect.children.length-1].offsetTop;
    lastContentHeight = sect.children[sect.children.length-1].offsetHeight;
    document.getElementsByClassName("endBreak")[0].style.height = ((lastContentTop + lastContentHeight - firstContentTop) + screen.height) + 'px';
}


function imgLightbox() {
    $('.flipper .imgBtnMeta').click(function() {
        $(this).parent().parent().addClass('imgFlipped');
        $(this).parent().parent().find('.imgBtnPic').attr('disabled', false);
        $(this).attr('disabled', true);

    });
    // Could tie into one button, but then it goes to left top corner and contextuality...
    // (remove class glyphicon-question-sign, add glyphicon-image-sign, reverseY(180))
    $('.flipper .imgBtnPic').click(function() {
        $(this).parent().parent().removeClass('imgFlipped');
        $(this).parent().parent().find('.imgBtnMeta').attr('disabled', false);
        $(this).attr('disabled', true);
    });



    $('img.modalImg').click(function() {
        //$('.modalImgActive').removeClass('modalImgActive');
        //$(this).addClass('modalImgActive');
        openModalWindow(this);
    });

    //TODO: add arrow keys functionality
    $('.modalWindowBtnFwd').click(function() {
        modalImgNext(1);
    });

    $('.modalWindowBtnBck').click(function() {
        modalImgNext(-1);
    });

    $('.modalWindowBtnExt').click(function() {
        closeModalWindow();
    })
}

function openModalWindow(caller) {
    $(".modalWindow").addClass("modalWindowActive");
    gid = $(caller).attr('data-gid');
    if( (gid < 0) && (getModalGroup(gid).length >= 1) ) {
        $('.modalWindowBtn.hide').removeClass('hide');
    } else {
        $('.modalWindowBtnDir').addClass('hide');
    }
    $('.modalWindowImg').attr('src', $(caller).attr('src'));
}

function closeModalWindow() {
    $(".modalWindow").removeClass("modalWindowActive");
}

function getModalGroup(gid) {
    return $('.modalImg[data-gid="'+gid+'"]');
}

function modalImgNext (n) {
    modalImg = $(this).siblings('.modalWindowImg'); //could also $(.modalImgActive)
    selectedImg = $('.modalImg[data-uid="'+modalImg.attr('data-uid')+'"]'); 
    modalGroup = getModalGroup(selectedImg.attr('data-gid'));

    idx = modalGroup.findIndex(selectedImg);
    len = modalGroup.length
    if(idx+n >= len) {
        idx += n-len;
    } else if (idx+n < 0) {
        idx += len;
    } else {
        idx += n;
    }
    modalImg.attr('src', modalGroup[idx].attr('src'));
    //selectedImg.parents('.imgFigure').nex;
}

