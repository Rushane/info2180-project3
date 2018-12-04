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

/*$adminPassword = password_filter('password123');
$adminPassword = mysql_real_escape_string($adminPassword);
$adminDate = date_filter();
$adminDate = mysql_real_escape_string($adminDate);*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pword = $_SESSION['userinfo']['password'];
    $email = $_SESSION['userinfo']['email'];
    
    $fname = name_filter($_POST["fname"]);
    $lname = name_filter($_POST["lname"]);
    $pword =  password_filter($_POST["password"]);
    $tphone= phone_filter($_POST["tele"]);
    $email = email_filter($_POST["email"]);
    $date_joined = date_filter();
    
    $adminPassword = password_filter('password123');
    
    $query = "INSERT INTO Users (`firstname`, `lastname`, `password`, `telephone`, `email`, `date_joined`) VALUES('Job', 'Dickenson', '$adminPassword',
    '876-555-5555', 'admin@hireme.com', '$date_joined')";
    
    $conn->exec($query);
    
    // returns true if all of variables are set and returns false if any of the values are null
    if(isset($fname) && isset($lname) && isset($pword) && ($tphone) && ($email) && ($date_joined)){ 
        $sql = 'INSERT INTO `Users`(firstname, lastname, password, telephone, email, date_joined) VALUES("' . $fname  .'","' .$lname .'","' . $pword .'",
        "' . $tphone .'","' . $email .'","' . $date_joined .'");';
        
        $conn->exec($sql);
        echo 'User added';
    }
    
}

function name_filter($name) { // sanitizes string 
        $newstr = trim($input); // removes whitespace
        $newstr = filter_var($name, FILTER_SANITIZE_STRING); // remove all HTML tags from a string
        //$newstr = htmlspecialchars($newstr);
        return $newstr;
}

function email_filter($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Remove all illegal characters from email

    //if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) { 
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validate e-mail
        echo "Invalid email";
        return null; //email is not a valid email address
    } else {
        return $email; // email is a valid email address
    }
}

function date_filter() {
    date_default_timezone_set('America/Jamaica');
    $date = date('d/m/Y');
    //$date = date('Y/m/d');
    
    //$date = "01/02/0000";
    /*$date = date_parse($name); // or date_parse_from_format("dd/mm/YYYY", $date);
    if (checkdate($date['month'], $date['day'], $date['year'])) {
            return name_filter($date); // Valid Date
    }
    else {
        echo "Invalid date";
        return null;
    }*/
    return $date;
}

function phone_filter($name) {
    if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $name)) { // evaluate if it is of the format 000-000-0000
        return name_filter($name); // phone number is valid
    } else {
        echo "Invalid phone number: must be of the format 000-000-0000";
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
        //return name_filter($name);
        //$hash_pword = md5($name);
        
        $hash_pword = password_hash($name, PASSWORD_BCRYPT);
        return $hash_pword;
    }
}