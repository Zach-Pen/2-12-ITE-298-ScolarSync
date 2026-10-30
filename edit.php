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

if (isset($_POST['update'])) {

    $student_name = $_POST['student_name'];
    $course = $_POST['course'];
    $year_level = $_POST['year_level'];
    $email = $_POST['email'];

    $stmt = mysqli_prepare($connection,
        "UPDATE students
         SET student_name = ?, course = ?, year_level = ?, email = ?
         WHERE id = ?");

    mysqli_stmt_bind_param(
        $stmt, "ssisi",
        $student_name, $course, $year_level, $email, $id
    );

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ScholarSync | Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>ScholarSync</h1>
    <p>Student Records, Organized Smarter.</p>

    <h2>Edit Student Information</h2>

    <form method="POST">

        <label>Student Name</label>
        <input type="text" name="student_name"
            value="<?php echo htmlspecialchars($student['student_name']); ?>" required>

        <label>Course</label>
        <input type="text" name="course"
            value="<?php echo htmlspecialchars($student['course']); ?>" required>

        <label>Year Level</label>
        <input type="number" name="year_level"
            value="<?php echo $student['year_level']; ?>" min="1" required>

        <label>Email</label>
        <input type="email" name="email"
            value="<?php echo htmlspecialchars($student['email']); ?>" required>

        <button type="submit" name="update">Update Student</button>

        <a href="index.php" class="back-btn">← Back to Dashboard</a>

    </form>

</div>

</body>
</html>