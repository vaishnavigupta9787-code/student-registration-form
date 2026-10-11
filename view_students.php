<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed.");
}

$conn->set_charset("utf8mb4");

$sql = "SELECT id, name, dob, phone, email, gender, city, course, branch
        FROM students ORDER BY id DESC";

$result = $conn->query($sql);
?><!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <style>
        * { box-sizing: border-box; }    body {
        margin: 0;
        padding: 25px;
        font-family: Arial, sans-serif;
        background: #eef2ff;
        color: #1f2937;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 20px #00000012;
    }

    h1 { text-align: center; color: #2563eb; }

    .table-wrap { overflow-x: auto; }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        border: 1px solid #e5e7eb;
        text-align: left;
        white-space: nowrap;
    }

    th { background: #2563eb; color: white; }
    tr:nth-child(even) { background: #f8fafc; }

    .back {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 18px;
        background: #2563eb;
        color: white;
        text-decoration: none;
        border-radius: 6px;
    }

    .empty { text-align: center; padding: 20px; }
</style>

</head>
<body>
<div class="container">
    <h1>Registered Students</h1><?php if ($result && $result->num_rows > 0): ?>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>City</th>
                    <th>Course</th>
                    <th>Branch</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                <?php foreach ($row as $value): ?>
                    <td><?= htmlspecialchars((string)($value ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                <?php endforeach; ?>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="empty">No student records found.</p>
<?php endif; ?>

<a class="back" href="index.html">Back to Registration Form</a>

</div>
</body>
</html>
<?php $conn->close(); ?>