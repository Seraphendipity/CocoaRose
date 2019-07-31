<?php require_once '../Resources/head-common.php'; ?>
</head>
<body>
    <?php require "../Resources/nav.php";?>
    <div class="breakHeader"></div>

<div class="centeredBox">
    <h2>Contact Us</h2>
    <p>Have a question? Want to suggest something? Contact the site owner.</p>
    <form action="../Resources/contactFormHandler.php" method="post" id="contactForm">
        <h3>Name</h3>
        <input type="text" name="name" class="form formText" >
        <h3>Email</h3>
        <input type="email" name="email" class="form formEmail">
        <h3>Phone</h3>
        <input type="tel" name="phone" class="form formTel">
        <h3>Subject</h3>      
        <!-- <input type="text" name="subject"  class="form formEmail"> -->
        <select name="subject"  class="form formEmail">
            <option>Question</option>
            <option>Suggestion</option>
            <option>Criticism\Feedback</option>
            <option>Business</option>
            <option>Other</option>
        </select>
        <h3>Message</h3>      
        <!-- <input type="textfield" name="message"> -->
        <textarea name="message" form="contactForm" class="formTextarea"></textarea><br/>
        <input type="submit" class="formSubmit">
    </form>
</div>

<?php require "../Resources/foot-common.php";?>

</body>
</html>
<!-- style='background-image: url(../Images/{$file[1]});' -->