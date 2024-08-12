<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="submit.css">
</head>
<body>
    <h1>Student Profile</h1>
    <form action="update.php" method="post" id="profileForm">
        <div class="form-group">
            <label for="studentName">Student Name:</label>
            <input type="text" name="studentName" id="studentName">
        </div>
        <div class="form-group">
            <label for="rollNo">Roll No.:</label>
            <input type="text" name="rollNo" id="rollNo" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="branch">Branch:</label>
            <select name="branch" id="branch">
                <option value="">Select Branch</option>
                <option value="CSE">Computer Science Engineering</option>
                <option value="CSD">Computer Science and Data Science</option>
                <option value="IT">Information Technology</option>
                <option value="ECE">Electronics & Communication Engineering</option>
                <option value="MECH">Mechanical Engineering</option>
                <option value="CIVIL">Civil Engineering</option>
            </select>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <input type="radio" name="gender" id="male" value="Male">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" value="Female">
            <label for="female">Female</label>
        </div>
        <div class="form-group">
            <label for="tenthMarks">10th Marks (%):</label>
            <input type="number" name="tenthMarks" id="tenthMarks" min="0" max="100">
        </div>
        <div class="form-group">
            <label for="interMarks">Intermediate Marks (%):</label>
            <input type="number" name="interMarks" id="interMarks" min="0" max="100">
        </div>
        <div class="form-group">
            <label for="backlogs">Backlogs:</label>
            <input type="number" name="backlogs" id="backlogs" min="0">
        </div>
        <div class="form-group">
            <label for="cgpa">CGPA:</label>
            <input type="number" name="cgpa" id="cgpa" step="0.01" min="0" max="10">
        </div>
        <div class="form-group">
            <label for="percentage">B.Tech Percentage:</label>
            <input type="number" name="percentage" id="percentage" step="0.01" min="0" max="100">
        </div>
        <div class="form-group">
            <label for="jobs">Job:</label>
            <input type="text" name="jobs" id="jobs">
        </div>
        <div class="form-group">
            <label for="internship">Internship:</label>
            <input type="text" name="internship" id="internship">
        </div>
        <div class="form-group">
            <label for="specialtraining">Special Training:</label>
            <input type="text" name="specialtraining" id="specialtraining">
        </div>
        <div class="form-group">
            <label for="pega">PEGA Certification:</label>
            <select name="pega" id="pega">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="task">TASK:</label>
            <select name="task" id="task">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="apt">APT:</label>
            <select name="apt" id="apt">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <button type="submit">Update Profile</button>
    </form>
    <script src="script.js"></script>
</body>
</html>
