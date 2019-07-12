<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../Style/common.css">
</head>
<body>
    <?php 
    // require "../Resources/head";
    require "../Resources/nav.php";?>
    <div class="breakHeader"></div>

<div class="centeredBox">
    <h2>Contact Us</h2>
    <p>Have a question? Want to suggest something? Contact the site owner.</p>
    <form action="../Resources/contactFormHandler.php" method="post" id="contactForm">
        <h3>Name</h3>
        <input type="text" name="name" class="form formText" ></input>
        <h3>Email</h3>
        <input type="email" name="email" class="form formEmail"></input>
        <h3>Phone</h3>
        <input type="tel" name="phone" class="form formTel"></input>
        <h3>Subject</h3>      
        <!-- <input type="text" name="subject"  class="form formEmail"></input> -->
        <select name="subject"  class="form formEmail">
            <option>Question</option>
            <option>Suggestion</option>
            <option>Criticism\Feedback</option>
            <option>Business</option>
            <option>Other</option>
        </select>
        <h3>Message</h3>      
        <!-- <input type="textfield" name="message"></input> -->
        <textarea name="message" form="contactForm" class="formTextarea"></textarea><br/>
        <input type="submit" class="formSubmit"></input>
    </form>
</div>

<?php require "../Resources/footer.php";?>

</body>
<!-- style='background-image: url(../Images/{$file[1]});' -->