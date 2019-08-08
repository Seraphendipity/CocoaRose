<?php require_once "../Resources/head-js.php"; ?>
<script src="../Scripts/modalWindow.js"></script>
<script src="../Scripts/flipper.js"></script>
<script>$(window).ready( function() {
   var imgMW = new ImageModalWindow();
});</script>
</head>
<body>
    <?php require_once "../Resources/image-loader.php"; 
          require_once "../Resources/nav.php"; 
          require_once "../Resources/modalWindow/mW-images.html";
    ?>
    <div class="breakHeader"></div>
    <div class="main">

    <div class="toolbar"><button class="btnAddImg"><i class="glyphicon glyphicon-plus"></i></button></div>

    <?php 
    // require "../Resources/head";
    $table = 'images';



    // $postsPerPage = 20;
    $data = db_selectData($table);
    foreach($data as $row)  {
        getImg($row[0], 1, 'arcBlock');
    }
    ?>
    <div class="breakClear"></div></div>
    </div>


    
<?php require "../Resources/foot-common.php";?>
<!-- style='background-image: url(../Images/{$file[1]});' -->