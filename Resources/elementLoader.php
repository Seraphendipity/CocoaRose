<?php
// NOTE:
// getImgById(accepts ID, grabs img from SQL)
// getImg(accepts associative array of img data)
// getImgElement( loads in getImg with a modal/flipper )
// getArticleElement()
// CONSIDER
//  1. Making Generic Get function
//  2. Asking for SQL row instead of ID

getImgById ($id, $bClickable=false) {
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
    echo ($bClickable ? '<input type="image"' : '<img ' );    
    echo "
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
}

function getImg( int $uid = 0, int $groupId = 0 ) {
    //Group ID <= -1: decorative image, non-modal
    //Group ID == 0: no meaningful group
    //Group ID >=  1: Group with all images of that number.
    //All extra pararms are extra classes to add.

    require_once("../Resources/db_functions.php");
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


function createImageElement( int $uid = 0, int $groupId = 0 ) {
    //Group ID <= -1: decorative image, non-modal
    //Group ID == 0: no meaningful group
    //Group ID >=  1: Group with all images of that number.
    //All extra pararms are extra classes to add.

    require_once("../Resources/db_functions.php");
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


function createArticleElement( $arcData, int $groupId = 0, $figClasses = '' ) {
    //Group ID <= -1: decorative image, non-modal
    //Group ID == 0: no meaningful group
    //Group ID >=  1: Group with all images of that number.
    //All extra pararms are extra classes to add.

    $classes = '';

    $classes .= 'modalElementMain flipperFrontContent btnEditMw';
    $classes .= ($groupId >= 1) ? ' modalGroup' : '';
    if($arcData !== false) {
        
    $bActive = $arcData['bActive'];
    if ($bActive == '1') {
        $title = $arcData['title'];
        $subtitle = $arcData['subtitle'];
        $author = $arcData['author'];
        $mainImgId = $arcData['mainImgId'];
        $scheme = $arcData['scheme'];
        $colors = $arcData['colors'];
        $contentMd = $arcData['contentMd'];
        $contentHtml = $arcData['contentHtml'];
        $dateTaken = $arcData['dateTaken'];
        $datePosted = $arcData['datePosted'];
        "<article class=\"modalElement modalElementArticle flipper{$figClasses}\">
            <div class=\"flipperContainer\">
                <div class=\"flipperFront\">";
                    getImgById($mainImgId, true);

        echo "
                    <article>
                        <header>
                            <h2 class=\"\">{$title}</h2>
                            <h3 class=\"\">{$subtitle}</h3>
                        </header>
                        <div class=\"articleContent\">{$contentHtml}</div>
                    </article>
                    <button class=\"modalElementFrontBtn\" disabled=\"false\">
                        <i class=\"glyphicon glyphicon-question-sign\"></i>
                    </button>
                </div>
                <div class=\"flipperBack\">
                    <button class=\"modalElementBackBtn\" disabled=\"true\">
                        <i class=\"glyphicon glyphicon-file\"></i>
                    </button>
                    <ul>
                        <li>Title: <figcaption>{$title}</figcaption></li>
                        <li>Subtitle: <p>{$subtitle}</p></li>
                        <li>Scheme: <p>{$scheme}</p></li>
                        <li>Colors: <p>{$colors}</p></li>
                        <li>Cite: <a tabindex=\"-1\" href=\"{$cite}\">{$author}</a></li>
                        <li>Date Created: <time datetime=\"{$dateTaken}\">{$dateTaken}</time></li>
                        <li>Date Posted: <time datetime=\"{$datePosted}\">{$datePosted}</time></li>
                    </ul>
                </div>
            </div>
        </article>";
    }
    }

}



?>