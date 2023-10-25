<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'database.php';

    $data = json_decode(file_get_contents("php://input"));

    // Extract cart name and items
    $cartName = $data->cartName;
    $items = $data->items;


    $itemTitles = array();
    $totalPrice = 0;

    foreach ($items as $item) {
        $itemTitles[] = $item->title;
        $totalPrice += $item->price;
    }

    $itemTitlesString = implode(", ", $itemTitles);

    $stmt = $conn->prepare("INSERT INTO cart (cart_name, item_titles, total_price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $cartName, $itemTitlesString, $totalPrice);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
}
?>
