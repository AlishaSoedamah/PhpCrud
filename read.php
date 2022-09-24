<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'databaseConnect.php';

// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Number of records to show on each page
$records_per_page = 10;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM studenten ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$studenten = $stmt->fetchAll(PDO::FETCH_ASSOC);


$num_students = $pdo->query('SELECT COUNT(*) FROM studenten')->fetchColumn();
?>

<nav>
    <a href="read.php">Studenten</a>
    <a href="index.php">Home page</a>
</nav>
<div class="studenten-table">
            <h1>Overzicht studenten die te laat waren</h1>
            <table>
            <tr>
                <th>Id</th>
                <th>Naam student</th>
                <th>Klas</th>
                <th>Minuten te laat</th>
                <th>Reden te laat</th>
                <th>Verwijder</th>
                <th>Updaten</th>
            </tr>
            <?php foreach ($studenten as $student) : ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= $student['naam'] ?></td>
                <td><?= $student['klas'] ?></td>
                <td><?= $student['aantal min'] ?></td>
                <td><?= $student['reden'] ?></td>
                <td><a href="delete.php?id=<?= $student['id'] ?>" class="delete">Verwijder</a></td>
                <td><a href="update.php?id=<?= $student['id']?>" class="add-student">Updaten</a></td>
            </tr>
            <?php endforeach; ?>
            </table>
            <a href="create.php" class="add-student">Weer eentje te laat</a>
        </div>
</body>
</html>