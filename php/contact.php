
<?php
$conn = mysqli_connect("localhost", "root", "", "velocity_motors");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($fullname) || empty($email) || empty($subject) || empty($message)) {
        die("Please fill all required fields.");
    }

    $sql = "INSERT INTO contacts (fullname, email, subject, message)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $subject, $message);

    if (mysqli_stmt_execute($stmt)) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
