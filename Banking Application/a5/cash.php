<?php
/**
 * This page will have a form asking bank official to enter customer id , cash amount to be transacted, Whether add or
 * reduce button and post the parameters in transactions.php file.
 * 
 */
session_start();
$access = isset($_SESSION["userid"]);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <style>
    body {
    width: 8in;
    height: 8in;
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
    input[type=color] { 
        background-color: rgb(230, 212, 173); 
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
        height:50px; 
        width: 2in;
        font-size:44px; 
        border-radius:10px; 
        margin-top: 0.2in;;
        margin-left: 0.5in;
        float: left;
    }

    input[type= button]{
        background-color: rgb(238, 255, 0);
        height:50px; 
        width: 2in;
        font-size:20px; 
        border-radius:10px; 
        margin-top: 0.02in;;
        margin-left: 0.5in;
        position: relative;
    }
    p{
        display: inline-block;
    }

    #game{
        position: absolute;
        float: top;
    }
    #game.h1{
        position:relative;
    }
    #main{
		display: inline-block;
		width: 7in;
		height: 5.6in;
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
    if ($access) {
        echo "<h1>You Are HERE!</h1>";
        echo "<a href='menu.php'>back</a>";
        echo "<div id='main'>
        <h1 id='message' class='heading'>Customer Service Login!!</h1>
        <form id='mainform' method='post' action='transaction.php'>

           Customer id:<input type='Number' id='customerid' name='customerid' size=20px placeholder='Customer id' required autofocus><br>
           Transaction Amount:<input type='Number' id='amount' name='amount' size=20px placeholder='Transaction Amount' required autofocus><br> 
           <input type='Submit' id='addbalancebutton' value='add' name='add'>
           <input type='Submit' id='reducebalancebutton' value='withdraw' name='withdraw'>
        </form>
              </div>";
           echo"<span id='target'>
                    <table id='table'border = 10px><tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Customer Id</th>
                      <th>Address</th>
                      <th>Phone Number</th>
                      <th>Balance</th>
              </tr>
                      </table>
      </span>";
    }
    else {
        echo "<h1>Not Logged in. Access denied.</h1>";
    }
    ?>
</body>

</html>