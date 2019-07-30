<?php require_once("../Resources/head-js.php"); ?>
<?php require_once("../Resources/image-loader.php"); ?>

</head>
<body>
    <div class="breakHeader"></div>

    <div class="modalWindow">
        <div class="centeredBox">
            <header></header>
            <div class="modalWindowImgContainer">
                <img class="modalWindowImg">
                <button class="modalWindowBtn modalWindowBtnExt">
                    <i class="glyphicon glyphicon-remove"></i></button>
                <button class="modalWindowBtn modalWindowBtnDir modalWindowBtnBck">
                    <i class="glyphicon glyphicon-menu-left"></i></button>
                <button class="modalWindowBtn modalWindowBtnDir modalWindowBtnFwd">
                    <i class="glyphicon glyphicon-menu-right"></i></button>
            </div>
            <div class="modalWindowMeta">
            </div>
        </div>
    </div>

    <?php 
    // require "../Resources/head";
    require "../Resources/nav.php";
    echo '
    ';

    $id = 0; //post index/id
    $postsPerPage = 20;
    $pics = array_slice(scandir('../Images/'), 2);
    $j = 0;
    while ( ($j < sizeof($pics)) && ($id < $postsPerPage) ) {
        getImg($id);
/*echo <<<POST
    
    <div class='arcBlock imgBlock' style="background-image: url(../Images/{$pics[$id]});">
       <!-- <img src="../Images/{$pics[$id]}"></img> -->
    </div>
POST;*/
    $id++;$j++;}
    ?>
    <div class="breakClear"></div></div>
    
<?php require "../Resources/footer.php";?>
<!-- style='background-image: url(../Images/{$file[1]});' -->