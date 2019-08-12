<?php
function getImg( int $uid = 0, int $groupId = 0 ) {
    //Group ID <= -1: decorative image, non-modal
    //Group ID == 0: no meaningful group
    //Group ID >=  1: Group with all images of that number.
    //All extra pararms are extra classes to add.
    require_once 'db_functions.php';
    $classes = ' '; $figClasses = ' ';


    $bSemanticImg = ($groupId >= 0);
    $classes .= ($bSemanticImg) ? 'modalElementMain flipperFrontContent btnEditMw ' : '';
    $classes .= ($groupId >= 1) ? 'modalGroup' : '';
    foreach (array_slice(func_get_args(),2) as $class) {
        if($bSemanticImg) {
            $figClasses .= $class.' ';
        } else {
            $classes .= $class.' ';
        }
    }
    $imgData = db_selectDataByID('images', $uid);
    if($imgData !== false) {

    $bActive = $imgData['bActive'];
    if ($bActive == '1') {
        $src = '../Images/'.$imgData['id'].'.'.$imgData['filename'];
        $width = $imgData['width']; //TODO: widthOpt and widthHd
        $height = $imgData['height']; //TODO: heightOpt and heightHd
        $alt = $imgData['alt'];
        $title = $imgData['title'];
        $cite = $imgData['cite'];
        $author = $imgData['author'];
        $date = $imgData['dateTaken'];
        echo ($bSemanticImg) ? 
        "<figure class=\"modalElement modalElementImage imgFigure flipper{$figClasses}\">
            <div class=\"flipperContainer\">
                <div class=\"flipperFront\">" : '';
        echo        "<input type=\"image\" 
                        src=\"{$src}\" 
                        alt=\"{$alt}\"  
                        title=\"{$title}\"  
                        width=\"{$width}\"
                        height=\"{$height}\"
                        class=\"{$classes}\"
                        data-id=\"{$uid}\"
                        data-gid=\"{$groupId}\"
                        data-cite=\"{$cite}\"
                        data-author=\"{$author}\"
                        data-date=\"{$date}\"
                        tabindex=\"0\">
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
                        <li>CITE: <a tabindex=\"-1\" href=\"{$cite}\">{$author}</a></li>
                        <li>DATE: <time datetime=\"{$date}\">{$date}</time></li>
                        <li>DESC: <figcaption>{$title}</figcaption></li>
                    </ul>
                </div>
            </div>
        </figure>" 
            : '';
    }
    }

}
?>