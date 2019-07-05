<?php
$URI =  $_SERVER['REQUEST_URI'];
$ROOT = basename(dirname(dirname(__FILE__)));
echo (($URI != "/{$ROOT}/Main/home") || ($URI != "/{$ROOT}/Main/home") ? '' : '</div>'); ?>
<div class="breakFooter"></div>
<footer class="mainFooter">
    <nav>
        <a href="../Main/contact">Contact Us</a> &middot;
        <a href="tel:12054702541">205.470.2541</a> &middot;
        <a href="mailto:elijah@kinetic.com">elijah@kinetic.com</a>
    </nav>
    <p>&copy; Copywright 2019, ElijahTheRose</p>
    <div class="breakClear"></div>
</footer>