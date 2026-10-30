<?php
include 'connection.php';

$query = "SELECT * FROM students ORDER BY id DESC";
$result = mysqli_query($connection, $query);

$count_query = mysqli_query($connection, "SELECT COUNT(*) AS total FROM students");
$count_data = mysqli_fetch_assoc($count_query);
$total_students = $count_data['total'];

$course_query = mysqli_query($connection, "SELECT COUNT(DISTINCT course) AS total FROM students");
$course_data = mysqli_fetch_assoc($course_query);
$total_courses = $course_data['total'];

$year_query = mysqli_query($connection, "SELECT COUNT(DISTINCT year_level) AS total FROM students");
$year_data = mysqli_fetch_assoc($year_query);
$total_year_levels = $year_data['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarSync | Dashboard</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>

<div class="dashboard">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">S</div>
            <div>
                <h2>ScholarSync</h2>
                <span>STUDENT MANAGEMENT</span>
            </div>
        </div>

        <p class="menu-label">MAIN MENU</p>

        <a href="index.php" class="nav-link active">
            <span class="nav-icon">▦</span>
            Dashboard
        </a>

        <a href="addstudent.php" class="nav-link">
            <span class="nav-icon">＋</span>
            Add Student
        </a>

        <div class="sidebar-bottom">
            <div class="sidebar-note">
                <span class="note-icon">✦</span>
                <strong>Stay Organized!</strong>
                <p>Manage your student records in one place.</p>
            </div>
            <span class="sidebar-footer">ScholarSync © 2026</span>
        </div>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <div>
                <span class="breadcrumb">Pages / Dashboard</span>
                <h1>Dashboard</h1>
            </div>

            <div class="admin-profile">
                <div class="profile-avatar">A</div>
                <div>
                    <strong>Administrator</strong>
                    <span>System Manager</span>
                </div>
            </div>
        </header>

        <section class="welcome-banner">
            <div>
                <span class="welcome-tag">WELCOME TO SCHOLARSYNC</span>
                <h2>Manage Your Students<br>Smarter and Easier.</h2>
                <p>Keep student information organized, updated, and accessible.</p>
                <a href="addstudent.php" class="banner-button">
                    + Add New Student
                </a>
            </div>

            <div class="banner-decoration">✦</div>
        </section>

        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-top">
                    <span>Total Students</span>
                    <div class="stat-icon blue">♙</div>
                </div>
                <h2><?php echo $total_students; ?></h2>
                <p>Registered student records</p>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span>Total Courses</span>
                    <div class="stat-icon purple">▤</div>
                </div>
                <h2><?php echo $total_courses; ?></h2>
                <p>Different courses recorded</p>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span>Year Levels</span>
                    <div class="stat-icon orange">⌂</div>
                </div>
                <h2><?php echo $total_year_levels; ?></h2>
                <p>Year levels represented</p>
            </div>

        </section>

        <section class="table-section">

            <div class="table-heading">
                <div>
                    <h2>Student Directory</h2>
                    <p>View and manage all registered students.</p>
                </div>

                <a href="addstudent.php" class="add-button">
                    + Add Student
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>STUDENT NAME</th>
                            <th>COURSE</th>
                            <th>YEAR LEVEL</th>
                            <th>EMAIL ADDRESS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0) { ?>

                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td>
                                    <span class="id-badge">
                                        #<?php echo $row['id']; ?>
                                    </span>
                                </td>

                                <td>
                                    <strong class="student-name">
                                        <?php echo htmlspecialchars($row['student_name']); ?>
                                    </strong>
                                </td>

                                <td><?php echo htmlspecialchars($row['course']); ?></td>

                                <td>
                                    <span class="year-badge">
                                        Year <?php echo $row['year_level']; ?>
                                    </span>
                                </td>

                                <td class="email-text">
                                    <?php echo htmlspecialchars($row['email']); ?>
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="edit.php?id=<?php echo $row['id']; ?>"
                                           class="edit-button">Edit</a>

                                        <a href="delete.php?id=<?php echo $row['id']; ?>"
                                           class="delete-button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>

                        <?php } else { ?>

                            <tr>
                                <td colspan="6" class="empty-message">
                                    <div class="empty-icon">♙</div>
                                    <strong>No students yet</strong>
                                    <p>Click "Add Student" to create your first record.</p>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                Showing <?php echo $total_students; ?> student record(s)
            </div>

        </section>

        <footer class="page-footer">
            © 2026 ScholarSync. Student Records, Organized Smarter.
        </footer>

    </main>
</div>

</body>
</html>