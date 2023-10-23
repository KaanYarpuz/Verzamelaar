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
        // File uploaded successfully, insert data into the database using prepared statements
        $title = $_POST["title"];
        $description = $_POST["description"];
        $creator = $_POST["creator"];
        $price = $_POST["price"];

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO videos (title, description, creator, price, video_path)
                VALUES (?, ?, ?, ?, ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sssis", $title, $description, $creator, $price, $videoPath);

        if ($stmt->execute()) {
            header('Location: clip.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error uploading the video.";
    }

    // Close the database connection
    $conn->close();
}
?>
