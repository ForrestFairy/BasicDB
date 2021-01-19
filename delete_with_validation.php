<html>
    <head>
        <meta chaset = "utf-8">
        <style type = "text/css">
            td {border: 1px solid black;}
            th {border: 2px solid black;}
        </style>
        <title>DELETE BOOK</title>
</head>

<body>

<button onclick="window.location.href = 'index.html'">Go back home</button>
<br>

<?php 

  require 'connect.php';

  function validationCheck() {
    global $msg;
    global $conn;
    $msg = "Book successfully deleted from your Books table.";

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

    return true;
  }

    if (isset($_POST['id']))
      
  {
    $id     = assign_data($conn, 'id');
    
    $validationPassed = validationCheck();

    if ($validationPassed) {
      $query    = "DELETE FROM Books WHERE id = " . "'$id'";

      $result   = $conn->query($query);
      if (!$result) echo "<br><br>DELETE failed: $query<br>" .
	
      $conn->error . "<br><br>";
    }
  }
  ?>

  <form action="  " method="post">
  
    Book id <input type="text" name="id"> <br><br>
      
    <input type="submit" value="DELETE RECORD">

    <br>

    <p><?php if (isset($msg))
    {
      echo "<p><em>$msg</em><p>";
    }?></p>
    
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