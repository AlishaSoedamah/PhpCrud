<link rel="stylesheet" href="style.css">
<?php include 'databaseConnect.php'; 
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}

?>

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