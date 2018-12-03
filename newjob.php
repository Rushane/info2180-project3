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
  $title = name_filter($_POST["title"]);
  $description = name_filter($_POST["description"]);
  $category = name_filter($_POST["category"]);
  $compName = name_filter($_POST["companyName"]);
  $location = name_filter($_POST["jobLocation"]);
  $date = date_filter();
  
  // returns true if all of variables are set and returns false if any of the values are null
    if(isset($title) && isset($description) && isset($category) && isset($compName) && isset($location)){ 
        $sql = "INSERT INTO Jobs(job_title, job_description, category, company_name, company_location, date_posted) VALUES('$title', '$description', '$category', '$compName', 
               '$location', '$date');";
        $conn->exec($sql);
        echo 'Job added';
    }
}  

function name_filter($name) { // sanitizes string 
    $newstr = trim($input); // removes whitespace
    $newstr = filter_var($name, FILTER_SANITIZE_STRING); // remove all HTML tags from a string
    return $newstr;
}

function date_filter() {
    date_default_timezone_set('America/Jamaica');
    $date = date('d/m/Y');
    return $date;
}

