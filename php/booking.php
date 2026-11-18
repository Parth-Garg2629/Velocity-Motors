
<?php
$conn = mysqli_connect("localhost", "root", "", "velocity_motors");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $emailid = $_POST['emailid'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $car = $_POST['car'];
    $date = $_POST['date'];
    $message = $_POST['message'];

    if (empty($fullname) || empty($emailid) || empty($phone) || empty($car) || empty($date)) {
        die("Please fill all required fields.");
    }

    $sql = "INSERT INTO bookings (fullname, emailid, phone, gender, car, booking_date, message)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssssss", $fullname, $emailid, $phone, $gender, $car, $date, $message);

    if (mysqli_stmt_execute($stmt)) {
        echo "Booking submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
