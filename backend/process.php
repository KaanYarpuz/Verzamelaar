<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database (replace with your database credentials)
    $conn = new mysqli("localhost", "contact", "9O4?3p0ky", "Database89530");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle file upload
    $videoDirectory = "uploads/"; // Create a directory for uploaded videos
    $videoPath = $videoDirectory . basename($_FILES["video"]["name"]);

    if (move_uploaded_file($_FILES["video"]["tmp_name"], $videoPath)) {
        // File uploaded successfully, insert data into the database
        $title = $_POST["title"];
        $description = $_POST["description"];
        $creator = $_POST["creator"];
        $price = $_POST["price"];

        $sql = "INSERT INTO videos (title, description, creator, price, video_path)
                VALUES ('$title', '$description', '$creator', $price, '$videoPath')";

        if ($conn->query($sql) === TRUE) {
            echo "Video added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the video.";
    }

    // Close the database connection
    $conn->close();
}
?>
