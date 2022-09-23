 <link rel="stylesheet" href="style.css">
 <?php include 'databaseConnect.php'; 

     // Validate name
     $input_name = trim($_POST["name"]);
     if(empty($input_name)){
         $name_err = "Please enter a name.";
     } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
         $name_err = "Please enter a valid name.";
     } else{
         $name = $input_name;
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
        <label for="reden">Min te laat</label>
        <input type="number" name="min" placeholder="min te laat" id="min">
        <button class="add-student" href="/">Update deze student</button>
    </form>
</div>