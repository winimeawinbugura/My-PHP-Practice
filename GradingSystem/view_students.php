<?php
$conn = new mysqli("localhost", "root", "", "grading_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM students");

echo "<h2>Stored Student Results</h2>";
echo "<table border='1' cellpadding='8'>
        <tr>
            <th>ID</th>
            <th>Scores</th>
            <th>Average</th>
            <th>Percentage</th>
            <th>Failures</th>
            <th>Status</th>
            <th>Honor Roll</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['score1']}, {$row['score2']}, {$row['score3']}</td>
            <td>{$row['average']}</td>
            <td>{$row['percentage']}%</td>
            <td>{$row['fail_count']}</td>
            <td>{$row['status']}</td>
            <td>" . ($row['honor_roll'] ? "Yes" : "No") . "</td>
        </tr>";
}

echo "</table>";

$conn->close();
?>
