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
 <?php include 'databaseConnect.php'; 
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the student id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $naam = isset($_POST['naam']) ? $_POST['naam'] : '';
        $klas = isset($_POST['klas']) ? $_POST['klas'] : '';
        $mins = isset($_POST['aantal']) ? $_POST['aantal'] : '';
        $reden = isset($_POST['reden']) ? $_POST['reden'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE studenten SET id = ?, naam = ?, klas = ?, mins = ?, reden = ? WHERE id = ?');
        $stmt->execute([$id, $naam, $klas, $mins, $reden, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
        // Get the student from the studenten table
        $stmt = $pdo->prepare('SELECT * FROM studenten WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$contact) {
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
    <form class="update" from="update.php" action="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <label for="naam">Naam</label>
        <input type="text" name="naam" placeholder="your name" value="auto" id="id">
        <label for="klas">Klas</label>
        <input type="text" name="klas" placeholder="4c" id="klas">
        <label for="reden">Reden</label>
        <input type="text" name="reden" placeholder="reden" id="reden">
        <label for="min">Min te laat</label>
        <input type="number" name="min" placeholder="min te laat" id="min">
        <button class="add-student" href="/">Update deze student</button>
    </form>
</div>
</body>
</html>