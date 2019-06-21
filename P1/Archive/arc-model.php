<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../Scripts/common.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/common.css">
</head>

<body onload="arcPageLoader()">
    <nav class="site">
        <!-- Navbar: sticky, Semi-transparent(?), and slightly animated -->
        <a href="../home.html"><div><i class="glyphicon glyphicon-home"></i><br><p>Home</p></div></a>
        <a href="../archive.html"><div><i class="glyphicon glyphicon-folder-open"></i><br><p>Archive</p></div></a>
        <a href="../Photos/photos.html"><div><i class="glyphicon glyphicon-picture"></i><br><p>Photos</p></div></a>
        <a href="../contact.html" class="NavFloatRight"><div><i class="glyphicon glyphicon-question-sign"></i><br><p>Contact</p></div></a>
    </nav>
    <header>
        <div class="arcHeaderImg bgImg" style="background-image: url('../Photos/img-0001-HQ-SingularRedPinkRose.jpg');"></div> <!-- CSS has img -->
        <!-- <div class="arcHeaderImg bgImg"></div> CSS has img -->
        <button class="arcHeaderBtn" onclick="arcShrinkTitle()">The Flower</button> <!-- Redundant? -->
        <!-- <img src="../Photos/img-0001-HQ-SingularRedPinkRose.jpg" alt="" height="500" width="1000"> -->
    </header>
    <div class="pageBreak"></div>
    <h2>Why do we like flowers...</h2>
    <section class="textPoem">
        <?php
            
            $fo = fopen("arc-0.txt", "r");
            echo '<p>';
            $s; $EOL = "\n"; $EOLCR = "\r\n"; $bNewLine;
            while (!feof($fo)) {
                $s = fgets($fo, 512);
                $bNewLine = ($s == $EOL) || ($s == $EOLCR);
                echo ( $bNewLine ? '</p><p>' : '<span>' ).$s.'</span>';
            }


            // $fo = fopen("arc-0.txt", "r");
            // $s; $EOL = "\n"; $EOLCR = "\r\n"; $bAlt = false; $lineLimit = 100;
            // while (!feof($fo)) {
            //     echo '<p'.($bAlt ? ' class="textAlt"' : '').'>';
            //     $s = fgets($fo, 512);
            //     if ( ($s == $EOL) || ($s == $EOLCR) ) {
            //         $bAlt = !$bAlt;
            //     }
            //     echo $s;
            //     echo '</p>';
            // }
            
        ?>
       
    </section>
    <div class="endBreak"></div>


    <!-- Footer: contact info, links to contact page, etc. -->
    <footer>

    </footer>
</body>