<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Game Clips</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">
    <h1 class="text-3xl font-semibold mb-4">Welcome to Video Game Clips</h1>
    <p class="mb-4">Check out these awesome video game clips:</p>

    <!-- Video Gallery -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
        // Connect to the database (replace with your database credentials)
        $conn = new mysqli("localhost", "contact", "9O4?3p0ky", "Database89530");

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        // Fetch video data from the database
        $sql = "SELECT * FROM videos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $title = $row["title"];
        $description = $row["description"];
        $creator = $row["creator"];
        $price = $row["price"];
        $videoPath = $row["video_path"];
        ?>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-2"><?php echo $title; ?></h2>
            <p class="mb-2">Description: <?php echo $description; ?></p>
            <p class="mb-2">Created by: <?php echo $creator; ?></p>
            <p class="mb-2">Price: $<?php echo $price; ?></p>
            <div class="aspect-ratio-16/9">
                <iframe class="w-full h-full" src="<?php echo $videoPath; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <?php
            }
        } else {
            echo "No videos found.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- Shopping Cart -->
    <div class="fixed bottom-4 right-4">
        <div class="card bg-white p-4 rounded shadow">
            <h1 class="text-xl font-semibold mb-2">Shopping Cart</h1>
            <ul class="listCard mb-4"></ul>
            <div class="checkout flex justify-between items-center">
                <div class="total font-semibold">Total: $0.00</div>
                <div class="closeShop bg-red-500 text-white px-3 py-2 rounded cursor-pointer">Close</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
