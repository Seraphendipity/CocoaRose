// $(window).ready( function() {
//     var mw = new ModalWindow();
// });

class ModalWindow {
    
    constructor() {
        this.mw = $('.modalWindow');   //Modal Window
        this.me = {};        //Modal Element (current)
        this.values = [];    //me's data values
        this.initialize(this);
    }

    initialize() {
        var that = this;

        //TODO: add arrow keys functionality
        $('.modalWindowBtnFwd').click(function() {
            that.loadNext(1);
        });

        $('.modalWindowBtnBck').click(function() {
            that.loadPrevious(1);
        });

        $('.modalWindowBtnExt').click(function() {
            that.close();
        });

        $('.btnAddMw').click(function() {
            that.open(2);
        });

        $('.btnEditMw').click(function() {
            that.open(3, this);
        });
    }



    open(actionLvl, caller = '') {
        this.me = $(caller);
        this.mw.addClass("modalWindowActive");

        if (actionLvl == 1) {
            //Only View Img
            this.mw.find('.submit').addClass('hide');
        } else if (actionLvl == 2) {
            //Add a New Img
            this.mw.find('.submit').attr('value', 'Add');
            $('.modalWindowBtnDir').addClass('hide');
            $('.modalWindowMeta .labelID').addClass('hide');
        } else if (actionLvl == 3) {
            //Edit an img
            this.mw.find('.submit').attr('value', 'Edit');
            var gid = this.me.find('.modalElementMain').attr('data-gid');
            if( (gid > 0) && (this.getGroupByID(gid).length > 1) ) {
                // $('.modalWindowBtn.hide').removeClass('hide');
            } else {
                $('.modalWindowBtnDir').addClass('hide');
            }
            this.load(this.me);
        } else {
            console.log('Unknown mwOpen ActionLvl call, programming error.');
        }
    }

    close() {
        this.mw.removeClass("modalWindowActive");
        this.reset();
    }

    reset() {
        this.mw.find('.modalWindowMeta input:not([type=submit])').attr('value', '');
        this.mw.find('hide').removeClass('hide');
    }

    load() {
        var mainElem = this.me.find('.modalElementMain')
        if (mainElem.length > 0) {
            var attributes = $('.modalWindowMeta form').find('input:not([type="submit"])');
            for(var i=0; i < attributes.length; i++) {
                var elem = attributes.get(i);
                var name = $(elem).attr('name'); 
                var value = '';
                if( typeof mainElem.attr(name) !== typeof undefined && mainElem.attr(name) !== false ) {
                    value = mainElem.attr(name);
                } else if ( typeof mainElem.attr('data-'+name) != typeof undefined && mainElem.attr('data-'+name) != false ) {
                    value = mainElem.attr('data-'+name);
                } 
                this.values[name] = value;
                $(elem).attr('value', value);  
            }
            this.values['gid'] = mainElem.attr('data-gid');
        } else {
            console.log("Modal Element with uid"+id+"cannot be found.");
            console.log(this.me);
        }
    }

    loadNext(n = 1) {
        var group = this.getGroupByID(this.values.gid);
        console.log(group);
        console.log(group.index(this.me.find('.modalElementMain')));
        var idx = group.index(this.me.find('.modalElementMain'));
        if (idx == -1) {
            console.log('Programming Error, could not find this ('+
            this.me+') in its group ('+group+')');
        } else {
            // selectedImg = $('.modalImg[data-uid="'+modalImg.attr('data-uid')+'"]'); 
            // modalGroup = getModalGroup(selectedImg.attr('data-gid'));
            var len = group.length
            if(idx+n >= len) {
                idx += n-len;
            } else if (idx+n < 0) {
                idx += len;
            } else {
                idx += n;
            }
            this.me = $(group.get(idx));
            this.load();
        }
    }

    loadPrevious(n = 1) {
        this.loadNext(-n);
    }

    getGroupByID(gid) {
        return $('.modalElement .modalElementMain[data-gid="'+gid+'"]');
    }

}

class ImageModalWindow extends ModalWindow {

    constructor() {
        super();
    }

    initialize(that) {
        super.initialize();
        
        $('.modalElementImage').click(function() {
            that.open(3, this);
        });
    }
    // modalImgNext (n) {
    //     modalImg = $(this).siblings('.modalWindowImg'); //could also $(.modalImgActive)
    //     selectedImg = $('.modalImg[data-uid="'+modalImg.attr('data-uid')+'"]'); 
    //     modalGroup = getModalGroup(selectedImg.attr('data-gid'));

    //     idx = modalGroup.findIndex(selectedImg);
    //     len = modalGroup.length
    //     if(idx+n >= len) {
    //         idx += n-len;
    //     } else if (idx+n < 0) {
    //         idx += len;
    //     } else {
    //         idx += n;
    //     }
    //     modalImg.attr('src', modalGroup[idx].attr('src'));
    //     //selectedImg.parents('.imgFigure').nex;
    // }
}

// class BlogModalWindow extends ModalWindow {

// // }

// // $('.modalWindowImg').attr('src', '');
// // $('.inputImg').val(null);
// $('.modalWindowImage').attr('src', $(caller).attr('src'));
// modalImg.attr('src', modalGroup[idx].attr('src'));

// readURL(input) {
//     // CREDIT: https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
//     // I couldnt figure this out, and still have trouble with the JS FileReader Object
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
        
//         reader.onload = function (e) {
//             $('.modalWindowImg').attr('src', e.target.result);
//         }
        
//         reader.readAsDataURL(input.files[0]);
//     }
// }

// $(".inputImg").change(function(){
//     readURL(this);
// });

// $('img.modalImg').click(function() {
//     //$('.modalImgActive').removeClass('modalImgActive');
//     //$(this).addClass('modalImgActive');
//     mwOpen(this, 2);
// });