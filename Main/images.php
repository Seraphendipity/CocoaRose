<?php require_once("../Resources/head-js.php"); ?>
<?php require_once("../Resources/image-loader.php"); ?>

</head>
<body>
    <div class="breakHeader"></div>

    

    <div class="toolbar"><button class="btnAddImg"><i class="glyphicon glyphicon-plus"></i></button></div>

    <?php 
    // require "../Resources/head";
    require "../Resources/nav.php";
    $table = 'images';



    // $postsPerPage = 20;
    $data = db_selectData($table);
    foreach($data as $row)  {
        getImg($row[0], 1, 'arcBlock');
    }
    ?>
    <div class="breakClear"></div></div>
    


    
<?php require "../Resources/foot-common.php";?>
<!-- style='background-image: url(../Images/{$file[1]});' -->