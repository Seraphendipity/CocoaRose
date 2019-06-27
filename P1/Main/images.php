<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../style/common.css">
</head>
<body>
    <?php 
    // require "../Resources/head.php";
    require "../Resources/nav.php";
    echo '<div class="headerBreak"></div>';
    echo '<div class="main">';

    $id = 0; //post index/id
    $postsPerPage = 20;
    require "../Resources/fileRead.php";
    $pics = array_slice(scandir('../Images/'), 2);
    $j = 0;
    while ( ($j < sizeof($pics)) && ($id < $postsPerPage) ) {
echo <<<POST
    <div class='arcBlock imgBlock' style="background-image: url(../Images/{$pics[$id]});">
       <!-- <img src="../Images/{$pics[$id]}"></img> -->
    </div>
POST;
    $id++;$j++;}
    ?>

    </div>
</body>
<!-- style='background-image: url(../Images/{$file[1]});' -->