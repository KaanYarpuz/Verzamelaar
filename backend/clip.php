<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Game Clips</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-semibold mb-4">Welcome to Sneakers Showcase</h1>
    <p class="mb-4">Check out these awesome sneakers:</p>
    <div class="video-container">
        <?php
        include 'database.php';

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
                <div class="bg-white p-4 rounded shadow items">
                    <h2 class="text-xl font-semibold mb-2"><?php echo $title; ?></h2>
                    <p class="mb-2">Description: <?php echo $description; ?></p>
                    <p class="mb-2">Created by: <?php echo $creator; ?></p>
                    <p class="mb-2">Price: $<?php echo $price; ?></p>
                    <button onclick="addToCart('<?php echo $title; ?>', <?php echo $price; ?>)" class="bg-blue-500 text-white px-3 py-2 rounded cursor-pointer">Add to Cart</button>
                    <div class="aspect-ratio-16/9">
                        <img src="<?php echo $videoPath; ?>" alt="<?php echo $title; ?>" class="w-full h-auto" style="max-width: 100%; height: auto;">
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

    <div class="cart-container">
        <div class="p-4">
            <h1 class="text-xl font-semibold mb-2">Shopping Cart</h1>
            <ul class="listCard space-y-2"></ul>
            <div class="checkout flex justify-between items-center">
                <div class="total font-semibold">Total: $0.00</div>
                <button onclick="saveCartToDatabase()" class="bg-green-500 text-white px-3 py-2 rounded cursor-pointer">Bestel</button>
                <button onclick="deleteCart()" class="closeShop bg-red-500 text-white px-3 py-2 rounded cursor-pointer">Verwijder alles</button>
            </div>
        </div>
    </div>
</div>
<script src="cart.js"></script>
</body>
</html>
