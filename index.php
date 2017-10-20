<?php
require "helpers/logs.php";
server_log("pageload", "index.php");

session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>

        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
    <?php
    if(isset($_SESSION['user'])) {
        echo "You're logged in as: admin";
    } else {
        echo "<form method=\"post\" action=\"process.php\">";
        echo "<input name=\"user\" type=\"text\" placeholder=\"Username\"/>";
        echo "<input name=\"pass\" type=\"password\" placeholder=\"Password\"/>";
        echo "<div class=\"g-recaptcha\" data-sitekey=\"6Le62DIUAAAAAEq_RIgujxfwMrFSqF1fd4Ox7nd1\"></div>";
        echo "<input type=\"submit\" value=\"Login\"/>";
        echo "</form>";
    }
    ?>
    </body>
</html>