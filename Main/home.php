<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../Style/common.css">
    <link rel="stylesheet" type="text/css" href="../Style/home.css">
</head>
<body>
    <!-- TODO: add Title stuff onto Picture, optimize img, change pic -->
    <header id="photoIntro">
        <!-- The Photo intro is the top-most picture that greets the user -->
        <picture>
            <img class="imgHome" src="../Images/img-0000-HQ-FriendsAtTheZoo.jpg" alt="" height="800" width="1000">
        </picture>
    </header>
    <?php require "../Resources/nav.php" ?>
    <!--_______________________________________________________
    _ _  _ ___ ____ ____ 
    | |\ |  |  |__/ |  | 
    | | \|  |  |  \ |__| 
    ________________________________________________________-->
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
    <h2>Archive</h2> <!-- TODO: Put inside section tag -->
    <section id="archivePeek"> <?php 
        require('../Resources/fileRead.php');
        $postsPerPage = 5;
        $id = 0; //post index/id
        $filename = "../Archive/arc-".$id.".html";
        while ( file_exists($filename) && ($id < $postsPerPage) ) {
            $header = get_arc_meta($filename);    
            $content = file_get_contents($filename);

            echo <<<POST
            <div class='homeArcBlock'>
                <a class='homeArcBlockLink' href="../Archive/arc-model.php?id={$id}" style='background-image: url(../Images/{$header["bg-img"]});'></a>
                <header class="homeArcBlockHeader">
                    <h3 class="homeArcBlockHeaderTitle">{$header["title"]}</h3>
                    <p class="homeArcBlockHeaderSubtitle">{$header["subtitle"]}
                    <span class="homeArcBlockHeaderSubtitleDate"></span>
                    </p>
                </header>
POST;
            echo '<section class="homeArcBlockSummary"><p>';
                echo $content; //TODO: This is too much data, need to dynamically grab first lines only, or drop down more...
            echo "<a href='../Archive/arc-model.php?id={$id}'>...[READ MORE]</a></p></section>";
            echo '</div>';

            $id++;
            $filename = "../Archive/arc-".$id.".html";

        }
    ?></section><hr/>
    
    <!--_______________________________________________________
    ___  _  _ ____ ___ ____ ____ 
    |__] |__| |  |  |  |  | [__  
    |    |  | |__|  |  |__| ___] 
    ________________________________________________________-->
    <!-- Second sampling, dynamically pulls photos to display -->
    <section id="photoPeek"><?php 
        echo '<h2>Images</h2>';
        $id = 0; //post index/id
        $imgsPerPage = 6;
        $imgArr = array_slice(scandir('../Images/'), 2);
        while ( ($id < sizeof($imgArr)) && ($id < $imgsPerPage) ) {
            echo <<<POST
            <div class='arcBlock imgBlock' style="background-image: url(../Images/{$imgArr[$id]});">
            <!-- <img src="../Images/{$imgArr[$id]}"></img> -->
            </div>
POST;
            $id++; 
        }
        ?><div class="breakClear"></div></section>
    <!--________________________________________________-->

    <?php require "../Resources/footer.php";?>
</body>