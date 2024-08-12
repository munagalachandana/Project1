<?php
session_start();

// Replace with your secure database details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wadproject";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get questions from database
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}

if ($result->num_rows > 0) {
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            "id" => $row["id"],
            "question" => $row["question"],
            "options" => explode(",", $row["options"]),
            "answer" => $row["answer"],
        ];
    }
} else {
    echo "No questions found in database.";
}

// Check if form submitted and evaluate answers
if (isset($_POST["submit"])) {
    $score = 0;
    $totalQuestions = count($questions);

    foreach ($questions as $key => $question) {
        // Check if answer is submitted for this question
        if (isset($_POST["question_" . $question["id"]])) {
            if ($question["answer"] == $_POST["question_" . $question["id"]]) {
                $score++;
            }
        }
    }

    echo "<h2>Your Score: $score / $totalQuestions</h2>";
    $rollNo = $_SESSION['roll'];

    // Check if the student already has a result entry
    $checkResultSql = "SELECT attempts, marks FROM result WHERE rollNumber = '$rollNo'";
    $checkResult = $conn->query($checkResultSql);

    if ($checkResult === false) {
        die("Error: " . $conn->error);
    }

    if ($checkResult->num_rows > 0) {
        // Student has an entry, update it
        $row = $checkResult->fetch_assoc();
        $attempts = $row['attempts'] + 1;
        $highestMarks = max($score, $row['marks']);
        // Update highest marks and attempts, only update marks if the new score is higher
        if ($score > $row['marks']) {
            $updateResultSql = "UPDATE result SET marks = '$score', attempts = '$attempts' WHERE rollNumber = '$rollNo'";
        } else {
            $updateResultSql = "UPDATE result SET attempts = '$attempts' WHERE rollNumber = '$rollNo'";
        }
        if ($conn->query($updateResultSql) === false) {
            die("Error: " . $conn->error);
        }
    } else {
        // Student doesn't have an entry, create one
        $insertResultSql = "INSERT INTO result (rollNumber, marks, attempts) VALUES ('$rollNo', '$score', 1)";
        if ($conn->query($insertResultSql) === false) {
            die("Error: " . $conn->error);
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Test</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
<h1>MCQ Test</h1>
<?php if (isset($_POST["submit"])) : ?>
    <p>You have completed the test.</p>
<?php else : ?>
    <?php if (empty($questions)) : ?>
        <p>No questions found in database.</p>
    <?php else : ?>
        <form action="" method="post">
            <?php foreach ($questions as $key => $question) : ?>
                <p><?= ($key + 1) . ". " . $question["question"] ?></p>
                <?php foreach ($question["options"] as $option) : ?>
                    <label for="question_<?= $question["id"] . "_" . $option ?>">
                        <input type="radio" id="question_<?= $question["id"] . "_" . $option ?>" name="question_<?= $question["id"] ?>" value="<?= $option ?>">
                        <?= $option ?>
                    </label>
                    <br>
                <?php endforeach; ?>
                <hr>
            <?php endforeach; ?>
            <input type="submit" name="submit" value="Submit Test">
        </form>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
