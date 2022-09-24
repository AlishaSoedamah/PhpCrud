<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'databaseConnect.php'; 
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the students ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM studenten WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$student) {
        exit('Student doesn\'t exist with that ID!');
    }

    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM studenten WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = "<p>" . 'Je hebt de student verwijdert!' . "</p>";
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
<h2>Student #<?= $student['id'] ?></h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php else : ?>
        <p class="warn">Let op: als je <?= $student['naam'] ?> verwijdert kan deze actie niet ongedaan worden.</p>
        <div class="yesno">
            <a class="delete" href="delete.php?id=<?= $student['id'] ?>&confirm=yes">Ja</a>
            <a class="delete"  href="delete.php?id=<?= $student['id'] ?>&confirm=no">Nee</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
