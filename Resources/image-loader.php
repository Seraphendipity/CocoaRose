<?php
function getImg( int $uid = 0, int $groupId = 0 ) {
    //Group ID <= -1: decorative image, non-modal
    //Group ID == 0: no meaningful group
    //Group ID >=  1: Group with all images of that number.
    //All extra pararms are extra classes to add.
    require_once 'db_functions.php';
    $classes = '';

    foreach (array_slice(func_get_args(),2) as $class) {
        $classes .= $class.' ';
    }
    $bSemanticImg = ($groupId >= 0);
    $classes .= ($bSemanticImg) ? 'modalImg flipperFrontContent' : '';
    $classes .= ($groupId >= 1) ? 'modalImgGroup' : '';

    $imgData = db_selectDataByID('cocoarose', 'images', $uid);
    $src = '../images/'.$imgData['filenameOpt'];
    $width = $imgData['width']; //TODO: widthOpt and widthHd
    $height = $imgData['height']; //TODO: heightOpt and heightHd
    $alt = $imgData['alt'];
    $title = $imgData['title'];
    $cite = $imgData['cite'];
    $author = $imgData['author'];
    $date = $imgData['date'];
    echo ($bSemanticImg) ? 
    "<figure class=\"imgFigure flipper\">
        <div class=\"flipperContainer\">
            <div class=\"flipperFront\">" : '';
    echo        "<img 
                    src=\"{$src}\" 
                    alt=\"{$alt}\"  
                    title=\"{$title}\"  
                    width=\"{$width}\"
                    height=\"{$height}\"
                    class=\"{$classes}\"
                    data-uid=\"{$uid}\"
                    data-gid=\"{$groupId}\">
                ";
    echo ($bSemanticImg) ? "
                <button class=\"imgBtnMeta\">
                    <i class=\"glyphicon glyphicon-question-sign\" disabled=\"false\"></i>
                </button>
            </div>
            <div class=\"flipperBack\">
                <button class=\"imgBtnPic\" disabled=\"true\">
                    <i class=\"glyphicon glyphicon-picture\"></i>
                </button>
                <ul>
                    <li>CITE: <a href=\"{$cite}\">{$author}</a></li>
                    <li>DATE: <time datetime=\"{$date}\">{$date}</time></li>
                    <li>DESC: <figcaption>{$title}</figcaption></li>
                </ul>
            </div>
        </div>
    </figure>" 
        : '';
}
?>