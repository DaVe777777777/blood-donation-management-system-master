<?php


session_start();
if(empty($_SESSION['admin_username'])) {
    header('location: admin_login.php');
    exit;
}
if(!empty($_SESSION['admin_username']))
{
    $username = $_SESSION['admin_username'];
}


include 'connection.php';

    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM users WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record deleted successfully!'); window.location.href = 'donor.php';</script>";

        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    $conn->close();
?>