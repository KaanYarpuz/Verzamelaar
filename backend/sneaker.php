<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneaker Showcase</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="bg-gray-100">
    <nav class="text-white py-4" style="background-color: #b21031">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Sneakers Showcase</h1>
            <ul class="flex space-x-4">
                <li><a href="../index.html">Home</a></li>
                <li><a href="sneaker.php">Sneakers</a></li>
                <li><a href="../add.html">Toevoegen</a></li>
                <li><a href="../verwijder.html">Verwijderen</a></li>
            </ul>
        </div>
    </nav>

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
                    $id = $row["id"];
                    ?>
                    <div class="bg-white p-4 rounded shadow items">
                        <h2 class="text-xl font-semibold mb-2">
                            <?php echo $title; ?>
                        </h2>
                        <p class="mb-2">Description:
                            <?php echo $description; ?>
                        </p>
                        <p class="mb-2">Gemaakt door:
                            <?php echo $creator; ?>
                        </p>
                        <p class="mb-2">Prijs: $
                            <?php echo $price; ?>
                        </p>
                        <p class="mb-2">ID van het product:
                            <?php echo $id; ?>
                        </p>
                        <button onclick="addToCart('<?php echo $title; ?>', <?php echo $price; ?>)"
                                style="background-color: #b21031; color: #fff;" class="px-3 py-2 rounded cursor-pointer">Voeg toe</button>
                        <div class="aspect-ratio-16/9">
                            <img src="<?php echo $videoPath; ?>" alt="<?php echo $title; ?>" class="w-full h-auto"
                                style="max-width: 100%; height: auto;">
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No videos found.";
            }
            $conn->close();
            ?>
        </div>

        <div class="cart-container">
            <div class="p-4">
                <h1 class="text-xl font-semibold mb-2">Shopping Cart</h1>
                <ul class="listCard space-y-2"></ul>
                <div class="checkout flex justify-between items-center">
                    <div class="total font-semibold">Total: $0.00</div>
                    <button onclick="saveCartToDatabase()"
                        class="bg-green-500 text-white px-3 py-2 rounded cursor-pointer">Bestel</button>
                    <button onclick="deleteCart()"
                        class="closeShop bg-red-500 text-white px-3 py-2 rounded cursor-pointer">Verwijder
                        alles</button>
                </div>
            </div>
        </div>
    </div>

    <div class="wave-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#b21031" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,224C384,235,480,245,576,245.3C672,245,768,235,864,213.3C960,192,1056,160,1152,154.7C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    <script src="cart.js"></script>
</body>

</html>