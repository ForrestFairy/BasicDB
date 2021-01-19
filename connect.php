<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Connect to database</title>
    </head>

    <body>
        <?php 
            $hn = // credentials
            $db = // credentials
            $un = // credentials
            $pw = // credentials

            $conn = new mysqli($hn, $un, $pw, $db);

            if ($conn -> connect_error)
                { 
                    die($conn -> connect_error);
                    echo '<br>';
                    echo 'Unfortnately you could not be connected to the databsae please check you have the correct credentials';
                }
            else {
                echo '<br>';
                echo 'You have connected to the database successfully <br><br>';

            };
            ?>
    </body>