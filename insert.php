<?php


 if($_SERVER['REQUEST_METHOD']==="POST")
{
    if(empty($_POST['fname'])){
        echo"<h1 stlye='colour:red'>First name Field Empty</h1>";
    }

     if(empty($_POST['lname'])){
        echo"<h1 stlye='colour:red'>last name Field Empty</h1>";
    }

     if(empty($_POST['gender'])){
        echo"<h1 stlye='colour:red'>Gender Field Empty</h1>";
    }

    if(empty($_POST['re'])){
        echo"<h1 stlye='colour:red'>Religion Field Empty</h1>";
    }
    if(empty($_POST['birthday'])){
        echo"<h1 stlye='colour:red'>Birthday Field Empty</h1>";
    }

    if(empty($_POST['email'])){
        echo"<h1 stlye='colour:red'>Email Field Empty</h1>";
    }

    if(empty($_POST['username'])){
        echo"<h1 stlye='colour:red'>Username Field Empty</h1>";
    }

    if(empty($_POST['password'])){
        echo"<h1 stlye='colour:red'>password Field Empty</h1>";
    }
}



if (isset($_POST['submit'])){
//elseif($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['fname']) && isset($_POST['lname']) &&
        isset($_POST['gender']) && isset($_POST['birthday']) &&
        isset($_POST['username']) && isset($_POST['password']) &&
        isset($_POST['paddress']) && isset($_POST['ppaddress']) &&
        isset($_POST['phone']) && isset($_POST['re'])&& isset($_POST['email'])) {


         $fname = $_POST['fname'];
        $lname = $_POST['lname'];
         $email = $_POST['email'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $paddress = $_POST['paddress'];
        $ppaddress = $_POST['ppaddress'];
        $phone = $_POST['phone'];
        $re = $_POST['re'];
        //$phoneCode = $_POST['phoneCode'];
        //$phone = $_POST['phone'];
        //$host = "localhost";
        //$dbUsername = "root";
        //$dbPassword = "";
        //$dbName = "test";
        $conn = new mysqli("localhost","root","12345","wtk");
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT username FROM users WHERE username = ? LIMIT 1";
            $Insert = "INSERT INTO users(fname,lname,gender,birthday,re,paddress,ppaddress,phone,email,username, password) VALUES (?, ?,?,?,?,?,?,?,?,?,?)"; 
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($resultUsername);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt -> bind_param("sssssssssss", $fname, $lname, $gender, $birthday, $re, $paddress, $ppaddress, $phone, $email, $username, $password);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    
    else {
       
        echo "All field are required.";
        die();
    }
}

else {
    echo "Submit button is not set";
}
?>