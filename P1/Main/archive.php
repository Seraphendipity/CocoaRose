<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../style/common.css">
</head>
<body>
    <?php 
    // require "../Resources/head";
    require "../Resources/nav.php";
    echo '<div class="breakHeader"></div>';

    $id = 0; //post index/id
    $postsPerPage = 10;
    require "../Resources/fileRead.php";
    while ( file_exists("../Archive/arc-".$id.".txt") && ($id < $postsPerPage) ) {
        $file = fileRead($id, 5);
        // echo $file[0];
echo <<<POST
    <div class='arcBlock' style='background-image: url(../Images/{$file[1]});'>
        <a class='arcBlockLink' href="../Archive/arc-model?id={$id}">
        <header class="arcBlockHeader">
            <h2 class="arcBlockHeaderTitle">{$file[0]}</h2>
            <!--<p class="arcBlockHeaderSubtitle">{$file[2]}
                <span class="arcBlockHeaderSubtitleDate"></span>
            </p>-->
        </header>
        
       <!-- <section class="arcBlockSummary">
            <p>{$file[3][0]}</p>
        </section> -->
        </a>
    </div>
POST;
    $id++;}
    ?>
    <div class="breakClear"></div>

    <?php require "../Resources/footer.php";?>
</body>