$(window).ready( function() {
    mwInit();
});

function mwInit() {
    initiateModalWindow();

    $(".inputImg").change(function(){
        readURL(this);
    });

    $('img.modalImg').click(function() {
        //$('.modalImgActive').removeClass('modalImgActive');
        //$(this).addClass('modalImgActive');
        openModalWindow(this, 2);
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

    $('.btnAddImg').click(function() {
        openModalWindow(this, 1);
    });
}

function mwReset() {
    $('.modalWindowImg').attr('src', '');
    $('.modalWindowMeta input:not([type=submit])').attr('value', '');
    $('.inputImg').val(null);
    $('.modalWindow .hide').removeClass('hide');
    
}

function mwOpen(caller, actionLvl) {
    $(".modalWindow").addClass("modalWindowActive");

    if (actionLvl == 0) {
        //Only View Img
        $('.submitImg').addClass('hide');
    } else if (actionLvl == 1) {
        //Add a New Img
        $('.modalWindowBtnDir').addClass('hide');
        $('.modalWindowMeta .labelID').addClass('hide');
        $('.submitImg').attr('value', 'Add Image');
    } else if (actionLvl == 2) {
        //Edit an img
        $('.submitImg').attr('value', 'Edit Image')
        gid = $(caller).attr('data-gid');
        if( (gid < 0) && (getModalGroup(gid).size() > 1) ) {
            $('.modalWindowBtn.hide').removeClass('hide');
        } else {
            $('.modalWindowBtnDir').addClass('hide');
        }
        arrVals = $('.modalWindowMeta form').find('input:not([type="submit"])');
        for(i=0; i < arrVals.length; i++) {
            elem = arrVals.get(i);
            name = $(elem).attr('name'); result = '';
            if(caller.hasAttribute(name)) {
                result = $(caller).attr(name);
            } else if (caller.hasAttribute('data-'+name) ) {
                result = $(caller).attr('data-'+name);
            } else {

            }

            $(elem).attr('value', result);
        }
        $('.modalWindowImg').attr('src', $(caller).attr('src'));
    } else {
        alert('Unknown openModalWindow ActionLvl call.');
    }
}

function mwAdd() {

}

function mwEdit () {

}

function mwClose() {
    $(".modalWindow").removeClass("modalWindowActive");
    resetModalWindow();
}

function getModalGroup(gid) {
    return $('.modalImgGroup[data-gid="'+gid+'"]');
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

function readURL(input) {
    // CREDIT: https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
    // I couldnt figure this out, and still have trouble with the JS FileReader Object
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('.modalWindowImg').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
