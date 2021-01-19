<?php
    require 'connect.php';

    $query = " CREATE TABLE Books  (
               id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
               title VARCHAR (255) NOT NULL,
               author VARCHAR (255) NOT NULL,
               genre VARCHAR (255) NOT NULL,
               ISBN BIGINT UNSIGNED NOT NULL
                )";

    $result = $conn -> query($query);

    if (!$result) {
        die ($conn -> error);
        echo '<br> Your Query failed';
    }
    else {
        echo '<br> Your table has been created';
    }

    $conn -> close();
?>