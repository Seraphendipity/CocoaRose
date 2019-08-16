<?php require_once("../Resources/head-js.php"); ?>
<script src="../Scripts/modalWindow.js"></script>
<script>$(window).ready( function() {
    var imgMW = new ArticleModalWindow();
 });</script>
<!-- <script src="../Scripts/arcScrollEffects.js"></script> -->
</head>
    <?php
    $id = isset($_GET["id"]) ? $_GET["id"] : $id = NULL ;
    if (isset($id) && is_numeric($id)) {
        /*_________________
        ___  ____ ____ ___ 
        |__] |  | [__   |  
        |    |__| ___]  |  
        __________________*/        
        echo '<body class="arc" onload="arcPageLoader()">';
        require "../Resources/nav.php";

        $filename = "../Archive/arc-".$id.".html";

        if(!isset($id)) {
            echo "<p>No id index value to compare, please contact 
            elijahtrose@gmail.com.</p>";
        } else if ( ! file_exists($filename) ) {
            echo "<p>Invalid ID Number, index out of bounds, please contact 
            elijahtrose@gmail.com.</p>";
        } else {
            //PRINT PAGE___________________________________
                $header = get_arc_meta($filename);    //Grabs Header and Pic Info
                $content = file_get_contents($filename);

                echo '<header>',
                    '<div class="arcHeaderImg bgImg" style="background-image: 
                        url(../Images/'.$header["bg-img"].');"></div>',
                    '<button class="arcHeaderBtn" onclick="arcShrinkTitle()">'
                        .$header["title"].'</button>',
                    '</header> <div class="breakPage"></div>',
                    '<section class="textPoem"><h2>'.$header["subtitle"].'</h2><p>';
                    echo $content;
                echo '</section><div class="endBreak"></div>';
            //_____________________________________________
        }

    } else {
        /*______________________________
        _    _ ____ ___ _ _  _ ____ ____ 
        |    | [__   |  | |\ | | __ [__  
        |___ | ___]  |  | | \| |__] ___] 
        _______________________________*/
        echo '<body>';
        require_once "../Resources/elementLoader.php";
        require_once "../Resources/nav.php";
        require_once '../Resources/modalWindow/mW-article.html';
        echo '<div class="breakHeader"></div>';
        echo '<div class="main">';
        $table = 'articles';
        $data = db_selectData($table);
        foreach( $data as $row ) {
            echo createArticleElement($row, 1, 'articleCard'); 
            // INACCURACY: makes 2 sql calls, one is unnecessary
            // Possible Fix: pass $row to function, grab associative array
            //  with db_selectData
        }

        echo '<div class="breakClear"></div></div>';
    }
    echo '
    <div class="toolbar"><button class="btnAddArticle btnAddMw"><i class="glyphicon glyphicon-plus"></i></button>
    <div class="breakClear"></div></div>
    ';
    require_once "../Resources/foot-common.php";


    
?>


<!-- PregMatch WI{}: the ### are added to make sure these comments work correctly -->
<!-- $fo = "../Archive/arc-".$id.".html";
                $s; $EOL = "\n"; $EOLCR = "\r\n"; $bNewLine; $header = array();
                $content = file_get_contents($fo); $BOC; $EOC; //Beginning of Comment, End of Comment
                $BOC;

                if ( preg_match( '/<!###--(\s+)var(\s)arcMeta/',$content, $BOC) === 1 ) {
                    if ( preg_match( '/<!###--/',$content, $EOC) === 1 ) {
                        $header = json_decode( substr($content, $BOC[0]+4, $EOC[0]-1) );
                        echo "<p>Hello There; BOC: ".$BOC."; EOC: ".$EOC[0]."</p>";
                        echo var_dump($header);
                    }

                } -->


                <!--         echo '<body>';
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
            <a class='arcBlockLink' href="../Main/archive?id={$id}">
            <header class="arcBlockHeader">
                <h2 class="arcBlockHeaderTitle">{$file[0]}</h2>
                <p class="arcBlockHeaderSubtitle">{$file[2]}
                    <span class="arcBlockHeaderSubtitleDate"></span>
                </p>
            </header>
            
             <section class="arcBlockSummary">
                 <p>{$file[3][0]}</p>
             </section> 
             </a>
         </div>
 POST;
         $id++;}
         echo '<div class="breakClear"></div>';
         
     
         require "../Resources/footer.php";
         echo '</body>';
     } -->

<!-- 
     $id = 0; //post index/id
        $postsPerPage = 10;
        $filename = "../Archive/arc-".$id.".html";

        //ARCHIVE BLOCK____________________________________
        while ( file_exists($filename) && ($id < $postsPerPage) ) {
            $header = get_arc_meta($filename);
            
            echo <<<POST
            <div class='arcBlock' style='background-image: url(../Images/{$header["bg-img"]});'>
                <a class='arcBlockLink' href="../Main/archive?id={$id}">
                <header class="arcBlockHeader">
                    <h2 class="arcBlockHeaderTitle">{$header["title"]}</h2>
                    <!--<p class="arcBlockHeaderSubtitle">{$header["subtitle"]}
                        <span class="arcBlockHeaderSubtitleDate"></span>
                    </p> ->
                </header>
                </a>
            </div>
POST;

            $id++;
            $filename = "../Archive/arc-".$id.".html";
        }
        //_________________________________________________ -->

        <!-- function get_arc_meta($filename) {
        $header;
        $content = file_get_contents($filename);
        $BOC = strpos($content, "<!- var arcMeta"); // Beginning of Comment
        $EOC = strpos($content, "->");              // End of Comment
        if ( ($BOC !== false) && ($EOC !== false) ) {
            $x = substr($content, $BOC+16, $EOC-16 ); //TODO: WHY -16?? Soft-code
            $header = json_decode($x, true);
        }
        return($header);
    } -->