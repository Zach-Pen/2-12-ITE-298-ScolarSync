<?php
include 'connection.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Invalid student ID.");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($connection, "SELECT * FROM students WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    die("Student not found.");
}

if (isset($_POST['confirm'])) {

    $stmt = mysqli_prepare($connection, "DELETE FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ScholarSync | Delete Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>ScholarSync</h1>
    <p>Student Records, Organized Smarter.</p>

    <h2>Delete Student</h2>

    <form method="POST">

        <p>
            Are you sure you want to delete
            <strong><?php echo htmlspecialchars($student['student_name']); ?></strong>?
        </p>

        <button type="submit" name="confirm">Yes, Delete Student</button>

        <a href="index.php" class="back-btn">Cancel</a>

    </form>

</div>

</body>
</html>