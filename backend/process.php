<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'database.php';

    $videoDirectory = "uploads/";
    $videoPath = $videoDirectory . basename($_FILES["video"]["name"]);

    if (move_uploaded_file($_FILES["video"]["tmp_name"], $videoPath)) {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $creator = $_POST["creator"];
        $price = $_POST["price"];

        $sql = "INSERT INTO videos (title, description, creator, price, video_path)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssis", $title, $description, $creator, $price, $videoPath);

        if ($stmt->execute()) {
            header('Location: sneaker.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading the video.";
    }

    $conn->close();
}
?>