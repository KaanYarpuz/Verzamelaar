 let shoppingCart = [];

    function addToCart(title, price) {
    // Combine items with the same title
    let found = false;
    shoppingCart.forEach(item => {
    if (item.title === title) {
    item.price += price;
    found = true;
}
});
    if (!found) {
    shoppingCart.push({ title, price });
}

    updateCartDisplay();
}

    function updateCartDisplay() {
    const cartList = document.querySelector(".listCard");
    const totalDiv = document.querySelector(".total");

    cartList.innerHTML = "";

    let total = 0;
    shoppingCart.forEach(item => {
    const li = document.createElement("li");
    li.textContent = `${item.title} - $${item.price.toFixed(2)}`;
    cartList.appendChild(li);
    total += item.price;
});

    totalDiv.textContent = `Total: $${total.toFixed(2)}`;
}

    function saveCartToDatabase() {
    // Check if the shopping cart is not empty
    if (shoppingCart.length === 0) {
    alert("Your cart is empty. Add items to save.");
    return;
}

    const cartName = prompt("Vul je naam in:");

    if (cartName) {
    const data = {
    cartName,
    items: shoppingCart
};

    fetch('save_cart.php', {
    method: 'POST',
    headers: {
    'Content-Type': 'application/json'
},
    body: JSON.stringify(data)
})
    .then(response => response.json())
    .then(result => {
    if (result.success) {
    alert("Cart saved successfully.");
    shoppingCart = [];
    updateCartDisplay();
} else {
    alert("Error saving the cart. Please try again.");
}
})
    .catch(error => {
    console.error(error);
    alert("An error occurred while saving the cart.");
});
}
}

    function deleteCart() {
    shoppingCart = [];
    updateCartDisplay();
}