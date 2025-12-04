<?php
//This requires a bit more working on
// Collect exam scores
$score1 = $_POST['score1'];
$score2 = $_POST['score2'];
$score3 = $_POST['score3'];

// Arithmetic operations
$average = ($score1 + $score2 + $score3) / 3;
$percentage = (($score1 + $score2 + $score3) / 300) * 100;

// Subject failure count
$subjects = $_POST['subject'];
$failCount = 0;

foreach ($subjects as $s) {
    if ($s < 50) {
        $failCount++;
    }
}

// Determine pass/fail
$status = ($average >= 50) ? "Pass" : "Fail";

// Honor roll condition
$honorRoll = ($average > 90 && ($score1 > 95 || $score2 > 95 || $score3 > 95));

// Output results
echo "<h2>Grading Results</h2>";
echo "Average Score: " . number_format($average, 2) . "<br>";
echo "Percentage: " . number_format($percentage, 2) . "%<br>";
echo "Result: <strong>$status</strong><br>";

if ($honorRoll) {
    echo "<p><strong>Congratulations! You qualify for the Honor Roll.</strong></p>";
}

if ($failCount > 2) {
    echo "<p style='color:red;'><strong>Warning: Student is placed on academic probation.</strong></p>";
}
?>
