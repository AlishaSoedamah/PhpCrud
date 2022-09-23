<?php include 'databaseConnect.php'; ?>
<link rel="stylesheet" href="style.css">

<nav>
    <a href="read.php">Studenten</a>
    <a href="index.php">Home page</a>
</nav>
<div class="delete-page">
    <h1>Weet je dit zeker?</h1>
    <h2>Let op: deze actie kan niet meer ongedaan worden.</h2>
    <!-- neem id van de student en verwijder die in de database-->
    <a class="delete" href="#">Ja, ik wil deze student verwijderen!</a>
    
</div>