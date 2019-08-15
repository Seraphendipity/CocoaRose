// $(window).ready( function() {
//     var imgMw = new ImageModalWindow();
// });

function attrGet (elem, attr, value) {
    if (typeof xar !== typeof undefined && xar !== false) {
        elem.attr(attr, value);
        return true;
    } else {
        return false;
    }
}

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

        this.mw.keydown(function(e) {
            var elem = $(':focus');
            if (
                elem.is('input[type="text"]') ||
                elem.is('input[type="number"]') ||
                elem.is('input[type="radio"]') ||
                elem.is('textarea')
            ) {
                //do nothing
            } else {
                switch (e.which) {
                    case 37:    //Left
                        that.loadPrevious(1);
                        break;
                    case 38:    //Top
                        //$("html, body").animate({scrollTop: 0}, "slow");
                        break;
                    case 39:    //Right
                        that.loadNext(1);
                        break;
                    case 40:    //Down
                        that.close();
                        break;
                    default: return;
                }
                e.preventDefault();

            }
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
            that.open(3, $(this).parents('.modalElement'));
        });
    }



    open(actionLvl, caller = '') {
        this.me = $(caller);
        this.mw.addClass("modalWindowActive");
        this.mw.find('.modalWindowBtnExt').focus();

        if (actionLvl == 1) {
            //Only View Img
            this.mw.find('.submitChange').addClass('hide');
            this.mw.find('.submitDelete').addClass('hide');
        } else if (actionLvl == 2) {
            //Add a New Img
            this.mw.find('.submitChange').attr('value', 'Add');
            this.mw.find('.submitChange').addClass('submitOneBtn');
            this.mw.find('.submitDelete').addClass('hide');
            $('.modalWindowBtnDir').addClass('hide');
            $('.modalWindowMeta .labelID').addClass('hide');
        } else if (actionLvl == 3) {
            //Edit an img
            this.mw.find('.submitChange').attr('value', 'Edit');
            this.mw.find('.submitDelete').attr('value', 'Delete');
            $('.modalWindowMeta input[name="id"]').attr('readonly', 'true');
            $('.modalWindowMeta .hideOnEdit').addClass('hide');
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
        // this.mw.children('.centeredBox').animate({left: "-40%"}, "slow");
        this.mw.removeClass("modalWindowActive");
        this.reset();
    }

    reset() {
        this.mw.find('.modalWindowMeta input:not([type=submit])').val('');
        this.mw.find('.hide').removeClass('hide');
        this.mw.find('[readonly]').attr('readonly', false);
        this.mw.find('.submitOneBtn').removeClass('submitOneBtn');

    }

    load() {
        var mainElem = this.me.find('.modalElementMain');
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
        if (group.length > 1) {
            var idx = group.index(this.me.find('.modalElementMain'));
            // selectedImg = $('.modalImg[data-uid="'+modalImg.attr('data-uid')+'"]');
            // modalGroup = getModalGroup(selectedImg.attr('data-gid'));
            var len = group.length
            if(idx+n >= len) {
                idx += n-len;
            } else if (idx+n < 0) {
                idx += len+n;
            } else {
                idx += n;
            }
            this.me = $(group.get(idx)).parents('.modalElement');
            this.load();
        } else {
            console.log("Invalid ID.");
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
        this.mwImg = this.mw.find('.modalWindowMainImg');
        this.mwFileInput = this.mw.find('form [type="file"]');
    }

    initialize() {
        super.initialize();
        var that = this;
        this.mw.find('form [type="file"]').change(function() {
            that.readURL(this);
        });
    }

    open(actionLvl, caller = '') {
        super.open(actionLvl, caller);
        if (actionLvl == 1) {
            //Only View Img
        } else if (actionLvl == 2) {
            //Add a New Img
            this.mw.find('.submitChange').attr('value', 'Add Image');
        } else if (actionLvl == 3) {
            //Edit an img
            this.mw.find('.submitChange').attr('value', 'Edit Image');
            this.mw.find('.submitDelete').attr('value', 'Delete Image');
        }
    }

    reset () {
        super.reset();
        this.mwImg.attr('src', '');
        this.mwFileInput.attr('src', '');
    }

    load() {
        super.load();
        if (this.values.src !== false) {
            this.mwImg.attr('src', this.values.src);
        }
    }

    readURL(input) {
        // CREDIT: https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
        // I couldnt figure this out, and still have trouble with the JS FileReader Object
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.modalWindowMainImg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
}

        // super.load();
        // this.values.fileSrc = attrGet(this.me.find('.modalElementMain'), 'src');
        // if (this.values.fileSrc !== false) {
        //     this.mwImg = this.mw.find('.modalWindowImage');
        //     mwImg.attr('src', this.values.fileSrc);
        // }
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

class ArticleModalWindow extends ModalWindow {
    constructor() {
        super();
        this.mwImg = this.mw.find('.mainImgShow');
    }

    initialize() {
        super.initialize();
        var that = this;
        this.mw.find('form [name="mainImgId"]').change(function() {
            that.loadImageById(this.val(), '.mainImgShow');
        });
    }

    open(actionLvl, caller = '') {
        super.open(actionLvl, caller);
        if (actionLvl == 1) {
            //Only View Img
        } else if (actionLvl == 2) {
            //Add a New Img
            this.mw.find('.submitChange').attr('value', 'Add Article');
        } else if (actionLvl == 3) {
            //Edit an img
            this.mw.find('.submitChange').attr('value', 'Edit Article');
            this.mw.find('.submitDelete').attr('value', 'Delete Article');
        }
    }

    reset () {
        super.reset();
        this.mwImg.attr('src', '');
        this.mwImg.attr('alt', '');
        this.mwImg.attr('title', '');
        this.mwImg.attr('width', '');
        this.mwImg.attr('height', '');
    }

    load() {
        super.load();
        if (this.values.mainImgId !== false) {
            this.mwImg.attr('src', this.values.mainImgId);
        }
    }

    readURL(input) {
        // CREDIT: https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
        // I couldnt figure this out, and still have trouble with the JS FileReader Object
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.modalWindowMainImg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    loadImageById($imgId, $imgDisplayLocation) {
        // Checks if Image exists in local copy first...

        // Or retrieves image from server by $imgId, if it exists...


        // Then displays it in $imgDisplayLocation
        $imgTag = `

        `;
    }
}

// $('.modalWindowImg').attr('src', '');
// $('.inputImg').val(null);
// $('.modalWindowImage').attr('src', $(caller).attr('src'));
// modalImg.attr('src', modalGroup[idx].attr('src'));


// $(".inputImg").change(function(){
//     readURL(this);
// });

// $('img.modalImg').click(function() {
//     $('.modalImgActive').removeClass('modalImgActive');
//     $(this).addClass('modalImgActive');
//     mwOpen(this, 2);
// });