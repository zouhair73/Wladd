<?php   
define('DB_NAME', 'whitelist');
define('DB_USER', 'Test');
define('DB_PASSWORD', 'HAHA123456789');
define('DB_HOST', '%');
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
{
    whitelist($_POST["steamhex"]);
}
function whitelist($steamhex)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $steamhex = mysqli_real_escape_string($conn, $steamhex);

    $whitelistquery = "INSERT INTO whitelist (identifier)
    VALUES ('$steamhex')";
    
    if ($conn->query($whitelistquery) === TRUE) {
        $message = "Vous êtes maintenant sur la liste blanche et pouvez vous connecter!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        echo "Error: " . $whitelistquery . "<br>" . $conn->error;
    }  
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Whitelist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <style>
    body {
      background-color: black;
    }
    input[type=text] {
      color: white;
    }
h1 {
  color: white;
  font-size: 40px !important;
}
*{
  font-family: "Impact" !important;
}
</style>
</head>
<body>
<center>
<h1> Entre Steam HEX pour rejoindre le serveur </h1>
<div class="container">
        <div class="z-depth-1 grey darken-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 5px solid #2962ff; border-radius: 20px !important;">

          <form class="col s12" method="post" action="whitelist.php">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input type='text' name='steamhex' id='steamhex' placeholder="HEX" />
                <label for='steamhex'>Steam HEX</label>
              </div>
            </div>
            <br />
            <center>
              <div class='row'>
                <input type="submit" class='col s12 btn btn-large waves-effect red' style="border-radius: 20px !important;" name="someAction" value="GO" />
              </div>
            </center>
          </form>
        </div>
      </div>
</center>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>
</html>