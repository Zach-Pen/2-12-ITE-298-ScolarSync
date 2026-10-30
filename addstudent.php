<?php
include 'connection.php';

if (isset($_POST['submit'])) {

    $student_name = $_POST['student_name'];
    $course = $_POST['course'];
    $year_level = $_POST['year_level'];
    $email = $_POST['email'];

    $stmt = mysqli_prepare($connection,
        "INSERT INTO students (student_name, course, year_level, email)
         VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param(
        $stmt, "ssis",
        $student_name, $course, $year_level, $email
    );

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ScholarSync | Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>ScholarSync</h1>
    <p>Student Records, Organized Smarter.</p>

    <h2>Add New Student</h2>

    <form method="POST">

        <label>Student Name</label>
        <input type="text" name="student_name" placeholder="Enter student name" required>

        <label>Course</label>
        <input type="text" name="course" placeholder="Enter course" required>

        <label>Year Level</label>
        <input type="number" name="year_level" placeholder="Enter year level" min="1" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter email address" required>

        <button type="submit" name="submit">Save Student</button>

        <a href="index.php" class="back-btn">← Back to Dashboard</a>

    </form>

</div>

</body>
</html>