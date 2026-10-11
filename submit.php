<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $conn->real_escape_string($_POST['name'] ?? '');

    $dob_day = $_POST['dob-day'] ?? '';
    $dob_month = $_POST['dob-month'] ?? '';
    $dob_year = $_POST['dob-year'] ?? '';
    $dob = $dob_day . '-' . $dob_month . '-' . $dob_year;

    $phone = $conn->real_escape_string($_POST['phone'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $password = password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT);
    $gender = $conn->real_escape_string($_POST['gender'] ?? '');
    $address = $conn->real_escape_string($_POST['address'] ?? '');
    $city = $conn->real_escape_string($_POST['city'] ?? '');
    $pincode = $conn->real_escape_string($_POST['pincode'] ?? '');
    $state = $conn->real_escape_string($_POST['state'] ?? '');
    $country = $conn->real_escape_string($_POST['country'] ?? '');
    $language = $conn->real_escape_string($_POST['language'] ?? '');

    $board_10 = $conn->real_escape_string($_POST['board_10'] ?? '');
    $pct_10 = $conn->real_escape_string($_POST['pct_10'] ?? '');
    $year_10 = $conn->real_escape_string($_POST['year_10'] ?? '');

    $board_12 = $conn->real_escape_string($_POST['board_12'] ?? '');
    $pct_12 = $conn->real_escape_string($_POST['pct_12'] ?? '');
    $year_12 = $conn->real_escape_string($_POST['year_12'] ?? '');

    $course = $conn->real_escape_string($_POST['course'] ?? '');
    $branch = $conn->real_escape_string($_POST['branch'] ?? '');

    $sql = "INSERT INTO students (
        name, dob, phone, email, password, gender, address,
        city, pincode, state, country, language,
        board_10, pct_10, year_10,
        board_12, pct_12, year_12,
        course, branch
    ) VALUES (
        '$name', '$dob', '$phone', '$email', '$password', '$gender', '$address',
        '$city', '$pincode', '$state', '$country', '$language',
        '$board_10', '$pct_10', '$year_10',
        '$board_12', '$pct_12', '$year_12',
        '$course', '$branch'
    )";

    if ($conn->query($sql) === TRUE) {
echo '
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Successful</title>
<style>
* {
box-sizing: border-box;
}
body {
margin: 0;
min-height: 100vh;
display: flex;
justify-content: center;
align-items: center;
padding: 20px;
font-family: Arial, sans-serif;
background: linear-gradient(135deg, #dbeafe, #e0e7ff);
}
.success-card {
background: white;
max-width: 450px;
width: 100%;
padding: 40px 25px;
border-radius: 18px;
text-align: center;
box-shadow: 0 10px 30px rgba(0,0,0,0.12);
}
.check {
width: 75px;
height: 75px;
line-height: 75px;
margin: 0 auto 20px;
border-radius: 50%;
background: #dcfce7;
color: #15803d;
font-size: 42px;
}
h1 {
color: #166534;
font-size: 27px;
}
p {
color: #555;
line-height: 1.6;
}
a {
display: inline-block;
margin-top: 15px;
padding: 13px 24px;
background: #2563eb;
color: white;
text-decoration: none;
border-radius: 8px;
font-weight: bold;
}
a:hover {
background: #1d4ed8;
}
</style>
</head>
<body>
<div class="success-card">
<div class="check">✓</div>
<h1>Registration Successful!</h1>
<p>Your student details have been saved successfully.</p>
<a href="index.html">Back to Form</a>
</div>
</body>
</html>';
}else {
        echo "<h3 style='color:red;'>Error: " . $conn->error . "</h3>";
    }

    $conn->close();

} else {
    echo "Invalid Request!";
}

?>