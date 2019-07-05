<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../style/common.css">
</head>
<body>
    
    <?php 
    // require "../Resources/head";
    require "../Resources/nav.php";?>
    <div class="headerBreak"></div>
   
   <?php
    //FORM HANDLING
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $fo = fopen("../Database/contactEntries.csv", "a"); 
        $line = "{$name},{$email},{$phone},{$subject},{$message}\n";
        fwrite($fo, $line);
    fclose($fo);
    ?>


</body>
<!-- style='background-image: url(../Images/{$file[1]});' -->
