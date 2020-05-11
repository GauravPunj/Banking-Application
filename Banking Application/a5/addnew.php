<?php
// This is my original work and it shall not be used anywhere else without my written permission.
// This file receives POST parameters for an existing item and updates it in the database.
include "connect.php";
/**
 *
 */
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
    body {
    width: 8in;
    height: 6in;
    border-style: solid;
    border-width: 5px;
    background-image: url("tile.jpg");
    background-repeat: repeat;
    background-size: cover;
    font-family: "Times New Roman", sans-serif;
    font-weight: bold;
    font-size: 18pt;
    }
    input[type=text] { 
        background-color: rgb(230, 186, 173); 
        height:25px; 
        font-size:20px; 
        border-radius:10px; 
        margin-top: 20px;
                    }
    input[type=password] { 
        background-color: rgb(173, 200, 230); 
        height:25px; 
        font-size:20px; 
        border-radius:10px; 
        margin-top: 20px;
                    }
   
    input[type=number] { 
        background-color: rgb(230, 212, 173); 
        height:25px; 
        font-size:20px;
        border-radius:10px; 
        margin-top: 20px;
            }



    input[type=submit]{
        background-color: rgb(236, 142, 78);
        height:40px; 
        width: 2in;
        font-size:30px; 
        border-radius:10px; 
        margin-top: 0.2in;;
        margin-left: 2.5in;
        float: left;
    }

    p{
        display: inline-block;
    }


    h1{
        position:relative;
    }

    h2{
        position:relative;
        color:red;
    }
    h3{
        position:relative;
        margin-top: 0.2in;
        color:red;
    }
    #main{
		display: inline-block;
		width: 7in;
		height: 3in;
		margin-left:0.1in;
		border-width: 4px;
		border-style: solid;
		border-color:red blue green blue;
        padding-left: 0.1in;
    }
    #target{
        display: inline-block;
		width: 7in;
		height: 4in;
		margin-left:0.1in;
		border-width: 4px;
		border-style: solid;
		border-color:red blue green blue;
        padding-left: 0.1in;



    }
    </style>
</head>

<body>
    <?php
        echo "<h1>Register new bank employee</h1>";
        echo "<a href='menu.php'>back</a>";
        echo "<div id='main'>
        <h1 id='message' class='heading'>Customer Service Login!!</h1>
        <form id='mainform' method='post'>
          
          Enter login Id to be created: <input type='text' id='loginid' name='loginid' maxlength='20'  size=20px placeholder='login id' required autofocus><br>
         Enter Password of your choice:<input type='Password' id='password' name='password' size=20px maxlength='20' placeholder='Password' required autofocus><br> 
         Re-enter your password:<input type='Password' id='repassword' name='repassword' size=20px maxlength='20' placeholder='Re-enter Password' required autofocus><br> 

           <input type='submit' id='addnewuser' value='Add'onclick='check()'>
           
        </form>
              </div>";

              $user = filter_input(INPUT_POST, "loginid", FILTER_SANITIZE_STRING);
              $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);
              $repassword = filter_input(INPUT_POST,"repassword",FILTER_SANITIZE_STRING);

              if($password!==$repassword){
                $message = "password re-entered doesn't match";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo"<h2>Failed attempt- password mismatch</h2>";
              }
              else{

            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                $message = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo"<h3>weak password</h3>";
                        }
                        else{
                echo "<h3>Strong password</h3>";
                $insert = "INSERT INTO login (userid,password) Values(?,?)";
                $params = [$user,$password];
                $stmt = $dbh -> prepare($insert);
                $stmt -> execute($params);
                echo"User id created";
                            }
                        }

            

    ?>
</body>

</html>