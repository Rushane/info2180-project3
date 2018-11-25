<?php

$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'HireMeDB';

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
  echo $e;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = name_filter($_POST["firstname"]);
    $lname = name_filter($_POST["lastname"]);
    $pword =  password_filter($_POST["pass_word"]);
    $tphone= phone_filter($_POST["telephone"]);
    $email = email_filter($_POST["e_mail"]);
    $date_joined = date_filter($_POST["date_joined"]);
    
    $hash_pword = md5($pword);
    
    // returns true if all of variables are set and returns false if any of the values are null
    if(isset($fname) && isset($lname) && isset($hash_pword) && ($tphone) && ($email) && ($date_joined)){ 
        $sql = "INSERT INTO Users(firstname, lastname, password, telephone, email, date_joined) VALUES('$fname', '$lname', '$hash_pword', '$tphone', 
               '$email', '$date_joined');";
        $conn->exec($sql);
        echo 'User added';
    }
    
}

function name_filter($name) { // sanitizes string 
        $newstr = filter_var($name, FILTER_SANITIZE_STRING); // remove all HTML tags from a string
        $newstr = trim($input); // removes whitespace
        //$newstr = htmlspecialchars($newstr);
        return $newstr;
}

function email_filter($name) {
    $email = filter_var($name, FILTER_SANITIZE_EMAIL); // Remove all illegal characters from email


    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) { // Validate e-mail
        return $email; // email is a valid email address
    } else {
        echo "Invalid email";
        return null; //email is not a valid email address
    }
}

function date_filter($name) {
    //$date = "01/02/0000";
    $date = date_parse($name); // or date_parse_from_format("dd/mm/YYYY", $date);
    if (checkdate($date['month'], $date['day'], $date['year'])) {
            return name_filter($date); // Valid Date
    }
    else {
        echo "Invalid date";
        return null;
    }
}

function phone_filter($name) {
    if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $name)) { // evaluate if it is of the format 000-000-0000
        return name_filter($name); // phone number is valid
    } else {
        echo "Invalid phone number: must be of the format - 000-000-0000";
        return null;
    }
}

function password_filter($name) {
    $uppercase = preg_match('@[A-Z]@', $name); // Must contain at least one uppercase character
    $lowercase = preg_match('@[a-z]@', $name); // Must contain at least one lowercase character
    $number    = preg_match('@[0-9]@', $name); // Must contain at least 1 number

    if(!$uppercase || !$lowercase || !$number || strlen($name) < 8) {
            echo "Invalid password";
            return null;
    } else {
        return name_filter(name);
    }
}