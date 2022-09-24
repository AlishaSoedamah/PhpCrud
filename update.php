<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include 'databaseConnect.php';
    $pdo = pdo_connect_mysql();
    $msg = '';
    // Check if the contact id exists, for example update.php?id=1 will get the student with the id of 1
    if (isset($_GET['id'])) {
        if (!empty($_POST)) {
            // This part is similar to the create.php, but instead we update a record and not insert
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $naam = isset($_POST['naam']) ? $_POST['naam'] : '';
            $klas = isset($_POST['klas']) ? $_POST['klas'] : '';
            $aantal = isset($_POST['aantal']) ? $_POST['aantal'] : '';
            $reden = isset($_POST['reden']) ? $_POST['reden'] : '';
            // Update the record
            $stmt = $pdo->prepare('UPDATE studenten SET id = ?, naam = ?, klas = ?, aantal = ?, reden = ? WHERE id = ?');
            $stmt->execute([$id, $naam, $klas, $aantal, $reden, $_GET['id']]);
            $msg = 'Updated Successfully!';
        }
        // Get the contact from the contacts table
        $stmt = $pdo->prepare('SELECT * FROM studenten WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$student) {
            exit('Contact doesn\'t exist with that ID!');
        }
    } else {
        exit('No ID specified!');
    }

 ?>
 <nav>
    <a href="read.php">Studenten</a>
    <a href="index.php">Home page</a>
 </nav>

<div class="flex-center">
<h1>Update</h1>
    <form class="update" action="update.php?id=<?= $student['id'] ?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="26" value="<?= $student['id'] ?>" id="id">
        <label for="naam">Naam</label>
        <input type="text" name="naam" value="<?= $student['naam'] ?>" id="id">
        <label for="klas">Klas</label>
        <input type="text" name="klas" value="<?= $student['klas'] ?>" id="klas">
        <label for="reden">Reden</label>
        <input type="text" name="reden" value="<?= $student['reden'] ?>" id="reden">
        <label for="aantal">Min te laat</label>
        <input type="number" name="aantal" value="<?= $student['aantal'] ?>" placeholder="Min te laat" id="aantal">
        <input class="add-student" type="submit" value="Update deze student">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>
</body>
</html>