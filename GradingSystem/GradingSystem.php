<?php

echo "===== SCHOOL GRADING SYSTEM =====\n\n";

// Loop to process grades for 5 students
for ($student = 1; $student <= 5; $student++) {

    echo "Processing Student $student:\n";

    // ---- INPUT: Three exam scores ----
    $score1 = (int) readline("Enter Score 1: ");
    $score2 = (int) readline("Enter Score 2: ");
    $score3 = (int) readline("Enter Score 3: ");

    // ---- 1. BASIC ARITHMETIC OPERATIONS ----

    // Calculate average
    $average = ($score1 + $score2 + $score3) / 3;

    // Calculate percentage out of 300 total marks
    $totalScore = $score1 + $score2 + $score3;
    $percentage = ($totalScore / 300) * 100;

    echo "Average Score: $average\n";
    echo "Percentage: $percentage%\n";

    // ---- Count failed subjects out of five ----
    echo "Enter marks for 5 subjects:\n";
    $failCount = 0;

    for ($i = 1; $i <= 5; $i++) {
        $subjectMark = (int) readline("Subject $i marks: ");

        if ($subjectMark < 50) {
            $failCount++;
        }
    }

    if ($failCount > 2) {
        echo "Warning: Student is placed on academic probation.\n";
    }

    // ---- 2. CONDITIONAL LOGIC ----

    // Pass/Fail based on average
    if ($average >= 50) {
        echo "Final Result: Pass\n";
    } else {
        echo "Final Result: Fail\n";
    }

    // Honor Roll qualification
    if ($average > 90 && ($score1 > 95 || $score2 > 95 || $score3 > 95)) {
        echo "Congratulations! The student qualifies for the Honor Roll.\n";
    }

    echo "------------------------------------------\n\n";
}

echo "===== END OF GRADING PROCESS =====\n";

?>
