<?php
$conn = new mysqli("localhost", "root", "", "grading_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$score1 = $_POST['score1'];
$score2 = $_POST['score2'];
$score3 = $_POST['score3'];

$average = ($score1 + $score2 + $score3) / 3;
$percentage = (($score1 + $score2 + $score3) / 300) * 100;

$subjects = $_POST["subject"];
$failCount = 0;

foreach ($subjects as $s) {
    if ($s < 50) {
        $failCount++;
    }
}

$status = ($average >= 50) ? "Pass" : "Fail";
$honorRoll = ($average > 90 && ($score1 > 95 || $score2 > 95 || $score3 > 95)) ? 1 : 0;

$sql = "INSERT INTO students (score1, score2, score3, average, percentage, fail_count, status, honor_roll)
        VALUES ('$score1', '$score2', '$score3', '$average', '$percentage', '$failCount', '$status', '$honorRoll')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Data Saved Successfully!</h2>";
    echo "<a href='view_students.php'>View All Students</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
