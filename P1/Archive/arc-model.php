<?php

echo '<!DOCTYPE html>';
require("../Resources/head.php");
echo '<body class="arc" onload="arcPageLoader()">';
require("../Resources/nav.php");

$id = $_GET["id"];
if(!isset($id)) {
    echo "<p>No id index value to compare, please contact 
    elijahtrose@gmail.com.</p>";
} else if ( ! file_exists("arc-".$id.".txt") ) {
    echo "<p>Invalid ID Number, index out of bounds, please contact 
    elijahtrose@gmail.com.</p>";
} else {
    $fo = fopen("arc-".$id.".txt", "r");
    $s; $EOL = "\n"; $EOLCR = "\r\n"; $bNewLine;
    $header = array();
    for ($i=0; $i < 3; $i++) {
        $header[$i] = fgets($fo,255);
    } //Title, Img, Subtitle
    echo '<header>',
        '<div class="arcHeaderImg bgImg" style="background-image: 
            url(../Images/'.$header[1].');"></div>',
        '<button class="arcHeaderBtn" onclick="arcShrinkTitle()">'
            .$header[0].'</button>',
        '</header> <div class="breakPage"></div>',
        '<section class="textPoem"><h2>'.$header[2].'</h2><p>';
    while (!feof($fo)) { 
        $s = fgets($fo, 512);
        $bNewLine = ($s == $EOL) || ($s == $EOLCR);
        echo ( $bNewLine ? '</p><p>' : '<span>' ).$s.'</span>';
    }
    echo '</section><div class="endBreak"></div>';
}
require("../Resources/footer.php");
echo '</body>';
            
?>