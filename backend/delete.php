<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'database.php';

    $id = $_POST["id"];

    $sql = "DELETE FROM videos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: sneaker.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
