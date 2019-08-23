<?php require_once('../Resources/head-common.php'); ?>
    <link rel="stylesheet" type="text/css" href="../Style/CSS/home.css">
    <meta name="description" content="Introductory page for CocoaRose site.">
    <meta name="keywords" content="blog,pictures,flowers,Elijah,Rose,Cocoa">
</head>
<body>
    <!-- TODO: add Title stuff onto Picture, optimize img, change pic -->
    <header class="homePageHeader">
        <picture>
            <img class="homePageHeaderImg" src="../Images/img-0000-HQ-FriendsAtTheZoo.jpg" alt="" height="800" width="1000">
        </picture>
        <!-- The Photo intro is the top-most picture that greets the user -->
        <div class="homePageHeaderText">
            <h1 class="homePageHeaderTitle">Cocoa<wbr>Rose</h1>
            <h2 class="homePageHeaderSubtitle">A blogging &amp; picture site for me and my beloved little sis.</h2>
        </div>
    </header>
    <?php require_once "../Resources/nav.php"; 
        require_once "../Resources/elementLoader.php"; 
    ?>
    <!--_______________________________________________________
    _ _  _ ___ ____ ____ 
    | |\ |  |  |__/ |  | 
    | | \|  |  |  \ |__| 
    ________________________________________________________-->
    <div class="main">
    <section id="textIntro">
        <!-- This text introduces the user to the site. Nothing fancy. -->
        <h2>Creating Somethingness...</h2>
        <p>Once upon a time there was a boy that was original and different...</p>
        <p><a href="https://tvtropes.org/pmwiki/pmwiki.php/Main/WellThisIsNotThatTrope">This is not that boy.</a> Elijah Tristan Rose is 
        your average college kid barely making his way through college whilst studying
        Electrical Engineering, namely software development.</p>
        <p>In pursuit of that effort, he is creating a mini-blog site to test his
            web development skills under the tutelege of master web ninjas at 
        <a href="https://www.kinetic.com/">Kinetic Communications</a>. He's added some <a href="../Main/archive.php">
        corny blog posts</a> and <a href="../Main/images.php">pictures</a> from his "friend", 
        <a href="../Main/people.php#CocoaBean">Cocoa Bean</a>, so be sure to navigate around the site and
        laugh at the poorly optimized superfluous effects. Read the <a href="../Main/people.php">
        People's page</a> for more information on Elijah.
        </p>
    </section>
    <hr/>

    <!--_______________________________________________________
    ____ ____ ____ _  _ _ _  _ ____ 
    |__| |__/ |    |__| | |  | |___ 
    |  | |  \ |___ |  | |  \/  |___ 
    ________________________________________________________-->
    <!-- First sampling, dynamically pulls archive data to display -->
    <!-- Properties: If mobile, pic on left and some text; if on PC,
         alternates picture side -->
        <section id="archivePeek">  
            <h2>Archive</h2>
            <?php
                $postsPerPage = 6;
                $table = 'articles';
                $data = db_selectData($table);
                foreach ($data as $i => $row) {
                    if(!$row['bActive']) {
                        unset($data[$i]);
                    } 
                }
                $len = (sizeof($data) > $postsPerPage) ? $postsPerPage : sizeof($data);
                $randData = array_rand($data, $len);
                shuffle($randData);
                foreach($randData as $i)  {
                    echo createArticleElement($data[$i], 1, 'articleBar');
                }
                ?>
                <div class="breakClear"></div></section>
                        <?php
//         require('../Resources/fileRead.php');
//         $postsPerPage = 5;
//         $id = 0; //post index/id
//         $filename = "../Archive/arc-".$id.".html";
//         while ( file_exists($filename) && ($id < $postsPerPage) ) {
//             $header = get_arc_meta($filename);    
//             $content = file_get_contents($filename);

//             echo <<<POST
//             <div class='homeArcBlock'>
//                 <a class='homeArcBlockLink' href="../Main/archive?id={$id}" style='background-image: url(../Images/{$header["bg-img"]});'></a>
//                 <header class="homeArcBlockHeader">
//                     <h3 class="homeArcBlockHeaderTitle">{$header["title"]}</h3>
//                     <p class="homeArcBlockHeaderSubtitle">{$header["subtitle"]}
//                     <span class="homeArcBlockHeaderSubtitleDate"></span>
//                     </p>
//                 </header>
// POST;
//             echo '<section class="homeArcBlockSummary"><p>';
//                 echo $content; //TODO: This is too much data, need to dynamically grab first lines only, or drop down more...
//             echo "<a href='../Main/archive?id={$id}'>...[READ MORE]</a></p></section>";
//             echo '</div>';

//             $id++;
//             $filename = "../Archive/arc-".$id.".html";

        //}
    ?></section><hr/>
    
    <!--_______________________________________________________
    ___  _  _ ____ ___ ____ ____ 
    |__] |__| |  |  |  |  | [__  
    |    |  | |__|  |  |__| ___] 
    ________________________________________________________-->
    <!-- Second sampling, dynamically pulls photos to display -->
    <section id="photoPeek"><?php 

        echo '<h2>Images</h2>';
        $postsPerPage = 6;
        $table = 'images';
        $data = db_selectData($table);
        foreach ($data as $i => $row) {
            if(!$row['bActive']) {
                unset($data[$i]);
            } 
        }
        $len = (sizeof($data) > $postsPerPage) ? $postsPerPage : sizeof($data);
        $randData = array_rand($data, $len);
        foreach($randData as $i)  {
            echo createImageElement($data[$i], 1, '');
        }
        ?><div class="breakClear"></div></section>
    <!--________________________________________________-->

</div>
<?php require_once "../Resources/foot-common.php";?>