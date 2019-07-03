<!DOCTYPE html>

<head>
    <meta>
    <script></script>
    <link rel="stylesheet" type="text/css" href="../Style/common.css">
</head>

<body>
    <?php include "../Resources/nav.php" ?>
    <header id="photoIntro">
        <!-- The Photo intro is the top-most picture that greets the user -->
        <picture>
            <img class="imgHome" src="../Images/img-0000-HQ-FriendsAtTheZoo.jpg" alt="" height="800" width="1000">
        </picture>
    </header>

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
    <h2>Archive</h2>
    <section id="archivePeek">
        <!-- First sampling, dynamically pulls archive data to display -->
        <!-- Properties: If mobile, pic on left and some text; if on PC,
             alternates picture side -->
    <?php 
    $id = 0; //post index/id
    $postsPerPage = 5;
    require "../Resources/fileRead.php";
    while ( file_exists("../Archive/arc-".$id.".txt") && ($id < $postsPerPage) ) {
        $file = fileRead($id, 15);
        // echo $file[0];
echo <<<POST
    <div class='homeArcBlock'>
        <a class='homeArcBlockLink' href="../Archive/arc-model.php?id={$id}" style='background-image: url(../Images/{$file[1]});'></a>
        <header class="homeArcBlockHeader">
            <h3 class="homeArcBlockHeaderTitle">{$file[0]}</h3>
            <p class="homeArcBlockHeaderSubtitle">{$file[2]}
            <span class="homeArcBlockHeaderSubtitleDate"></span>
            </p>
        </header>
POST;
    echo '<section class="homeArcBlockSummary"><p>';
        $i = 0;
        while( isset($file[3][$i]) ) {
            echo "{$file[3][$i]}";
            $i++;
        }   
    echo "<a href='../Archive/arc-model.php?id={$id}'>...[READ MORE]</a></p></section>";
    echo '</div>';

    $id++;}
    ?>
    </section><hr/>
    


    <section id="photoPeek">
    <h2>Images</h2>
    <!-- Second sampling, dynamically pulls photos to display -->
    <?php 
    // require "../Resources/head.php";
    $id = 0; //post index/id
    $imgsPerPage = 6;
    $pics = array_slice(scandir('../Images/'), 2);
    $j = 0;
    while ( ($j < sizeof($pics) ) && ($id < $imgsPerPage) ) {
echo <<<POST
    <div class='arcBlock imgBlock' style="background-image: url(../Images/{$pics[$id]});">
       <!-- <img src="../Images/{$pics[$id]}"></img> -->
    </div>
POST;
    $id++; $j++;}
    ?>
    <div class="breakClear"></div>
    </section>
    <?php require "../Resources/footer.php";?>
</body>