<html>
    <head>
        <meta chaset = "utf-8">
        <style type = "text/css">
            td {border: 1px solid black;}
            th {border: 2px solid black;}
        </style>
        <title>UPDATE BOOK</title>
</head>

<body>

<button onclick="window.location.href = 'index.html'">Go back home</button>
<br>

<?php 

  require 'connect.php';

  function validationCheck () {
    global $msg;
    global $conn;
    $msg = "Book successfully updated.";

    if (empty($_POST['id'])) 
    {
      $msg = "Please enter book id";
      return false;
    }

    $id = $_POST['id'];
    $query = "SELECT id FROM Books WHERE id = " . "'$id'";

    $result = $conn->query($query);

    if (mysqli_num_rows($result) < 1) 
    {
      $msg = "This book id does not exist in your Books table.";
      return false;
    }

    if (empty($_POST['title']))
    {
        $msg = "Please enter your book title";
        return false;
    }
    else if (strlen($_POST['title']) > 60)
    {
        $msg = "Your book title is too long";
        return false;
    }

    if (empty($_POST['author']))
    {
        $msg = "Please enter author name";
        return false;
    }
    else if (strlen($_POST['author']) > 20) 
    {
        $msg = "Author name is too long";
        return false;
    }

    if (empty($_POST['genre'])) 
    {
        $msg = "Please enter book genre";
        return false;
    }
    else if (strlen($_POST['genre']) > 30)
    {
        $msg = "Book genre is too long";
        return false;
    }

    if (empty($_POST['ISBN']))
    {
        $msg = "Please enter ISBN number";
        return false;
    }

    $ISBN = $_POST['ISBN'];

    $query = "SELECT ISBN FROM Books WHERE ISBN = " . "'$ISBN'";

    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0) 
    {
        $msg = "The ISBN already exists in databse.";
        return false;
    }

    if (is_numeric($ISBN) == false) 
    {
        $msg = "ISBN must be a number.";
        return false;
    }

    if (strlen($ISBN) != 13) {
        $msg = "ISBN is 13 digits long";
        return false;
    }

    if ($ISBN < 0) {
        $msg = "ISBN should be a positive number";
        return false;
    }

    return true;
  }

    if (isset($_POST['id']) &&
        isset($_POST['title']) &&
        isset($_POST['author']) &&
        isset($_POST['genre']) &&
        isset($_POST['ISBN']))
		
      
  {
    $id     = assign_data($conn, 'id');
    $title  = assign_data($conn, 'title');
    $author = assign_data($conn, 'author');
    $genre = assign_data($conn, 'genre');
    $ISBN = assign_data($conn, 'ISBN');
    
    $validationPassed = validationCheck();

    if ($validationPassed) {
        $query = "UPDATE Books SET title = " . "'$title'" . 
            ", author = " . "'$author'" . ", genre = " . "'$genre'" . ", ISBN = " . "'$ISBN'" . " WHERE id = " . "'$id'";
	
      $result   = $conn->query($query);
      if (!$result) echo "<br><br>UPDATE failed: $query<br>" .
      
        $conn->error . "<br><br>";
    }
  }

?>

  <form action="  " method="post">
  
    Book id <input type="text" name="id"> <br><br>
    New title <input type="text" name="title"> <br><br>
    New author name <input type="text" name="author"> <br><br>
    New book genre <input type="text" name="genre"> <br><br>
    Updated book ISBN <input type="text" name="ISBN"> <br><br>

    <input type="submit" value="UPDATE RECORD">
	
    <br>

    <p><?php if (isset($msg))
    {
        echo "<p><em>$msg</em></p>"; 
    }
    ?></p>

   </form>

<?php
  
  
  function assign_data($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
  
  
  $query  = "SELECT * FROM Books";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
?>
    <b>Here is your Books list</b>
  <table>
      <tr>
          <th>Book id</th>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>ISBN</th>
      </tr>
<?php
    if ($result -> num_rows > 0) {
        echo "The books list:<br><br>";
        while ($row = $result -> fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["title"]."</td>";
            echo "<td>".$row["author"]."</td>";
            echo "<td>".$row["genre"]."</td>";
            echo "<td>".$row["ISBN"]."</td>";
            echo "</tr>";
        }
    }
    else {
        echo "0 results";
    }
?>

</table>
</body>
</html>