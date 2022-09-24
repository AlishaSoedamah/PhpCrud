<link rel="stylesheet" href="style.css">
 <?php include 'databaseConnect.php'; 
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE contacts SET id = ?, name = ?, email = ?, phone = ?, title = ?, created = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone, $title, $created, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
        // Get the contact from the contacts table
        $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
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

<div class="update">
<h1>Update</h1>
    <form class="update" from="update.php" action="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <label for="naam">Naam</label>
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="reden">Reden</label>
        <input type="text" name="reden" placeholder="reden" id="reden">
        <label for="min">Min te laat</label>
        <input type="number" name="min" placeholder="min te laat" id="min">
        <button class="add-student" href="/">Update deze student</button>
    </form>
</div>