<?php

// Connect to the database (replace with your database credentials)
$conn = new mysqli("localhost", "contact", "9O4?3p0ky", "Database89530");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch video data from the database
$sql = "SELECT title, description, creator, price, video_path FROM videos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Generate HTML for each video
        echo '<div class="bg-white p-4 rounded shadow">';
        echo '<h2 class="text-xl font-semibold mb-2">' . $row["title"] . '</h2>';
        echo '<p class="mb-2">Description: ' . $row["description"] . '</p>';
        echo '<p class="mb-2">Created by: ' . $row["creator"] . '</p>';
        echo '<p class="mb-2">Price: $' . number_format($row["price"], 2) . '</p>';
        echo '<div class="aspect-ratio-16/9">';
        echo '<iframe class="w-full h-full" src="' . $row["video_path"] . '" frameborder="0" allowfullscreen></iframe>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No videos found.";
}

// Close the database connection
$conn->close();

