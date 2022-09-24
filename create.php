
 <link rel="stylesheet" href="style.css">
<?php
include 'databaseConnect.php'; 
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $naam = isset($_POST['naam']) ? $_POST['naam'] : '';
    $klas = isset($_POST['klas']) ? $_POST['klas'] : '';
    $mins = isset($_POST['aantal min']) ? $_POST['aantal min'] : '';
    $reden = isset($_POST['reden']) ? $_POST['reden'] : '';

    // Insert new record into the studenten table
    $stmt = $pdo->prepare('INSERT INTO studenten VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $naam, $klas, $mins, $reden]);
    // Output message
    $msg = 'Created Successfully!';
}

$dbhost = 'localhost';
$dbname = 'myphpcrud';
$dbusername = 'root';
$dbpassword = '';

$link = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

$statement = $link->prepare('INSERT INTO testtable (name, lastname, age)
    VALUES (:fname, :sname, :age)');

$statement->execute([
    'fname' => 'Bob',
    'sname' => 'Desaunois',
    'age' => '18',
]);

//  if ($aantalMin < 0) {
//     return "Vul een geldige tijd in!";
//  }

?>

 <nav>
    <a href="read.php">Studenten</a>
    <a href="index.php">Home page</a>
 </nav>

<div class="create">
<h1>Create</h1>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <label for="naam">Naam</label>
        <input type="text" name="naam" placeholder="John Doe" id="naam">
        <label for="klas">Klas</label>
        <input type="text" name="klas" placeholder="4c" id="klas">
        <label for="reden">Reden</label>
        <input type="text" name="reden" placeholder="reden" id="reden">
        <label for="aantal min">Min te laat</label>
        <input type="number" name="aantal min" placeholder="min laat" id="aantal min">
        <input type="submit" class="add-student" value="Zet student erbij"></input>
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>