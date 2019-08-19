<?php 
// NavArr[x][y] -->
    //x: refers to which link-button is being referenced (0 is home)
    //y: what property is being referenced:
        //0: name (as seen on navbar by user)
        //1: relative link
        //2: glyph name (only the part after glyphicon glyphicon-)
        //3: Calculated, is it the current site (in hindsight not necessary at all, oh well; TODO: optimize;)
        //4: Boolean, does it need to be right adjusted
$URI =  '../Main/'.explode('.', basename($_SERVER['SCRIPT_FILENAME']))[0];
$NavArr = Array(
    array("Home","../Main/home", "home", "", false),
    array("Archive","../Main/archive", "folder-open", "", false),
    array("Images","../Main/images", "picture", "", false),
    array("Contact","../Main/contact", "question-sign", "", true),
    array("DB Control","../Main/db-control", "hdd", "", true)
);

echo '<nav class="site">';
$i=0;
while(isset($NavArr[$i][0])) {
    $NavArr[$i][3] = ($NavArr[$i][1] == $URI) ? "currSite" : "";
    echo '<a href="'.$NavArr[$i][1].'" class="'.$NavArr[$i][3].' '.($NavArr[$i][4]?'NavFloatRight':'').'"><div><i class="glyphicon glyphicon-'.$NavArr[$i][2].'"></i><br><p>'.$NavArr[$i][0].'</p></div></a>';
    $i++;
}
echo '</nav>';
echo (($URI != "/Main/home") || ($URI != "/Main/home") ? '' : '<div class="main">'); 

//LEGACY
// <a href="../Main/home.php"><div><i class="glyphicon glyphicon-home"></i><br><p>Home</p></div></a>
// <a href="../Main/archive.php"><div><i class="glyphicon glyphicon-folder-open"></i><br><p>Archive</p></div></a>
// <a href="../Main/photos.php"><div><i class="glyphicon glyphicon-picture"></i><br><p>Images</p></div></a>
// <a href="../Main/contact.php" class="NavFloatRight"><div><i class="glyphicon glyphicon-question-sign"></i><br><p>Contact</p></div></a>