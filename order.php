


    <script>
        const cart = [];

        function addToCart() {
            const foodItemId = document.getElementById('foodItem').value;
            const quantity = document.getElementById('quantity').value;
            const location = document.getElementById('location').value;
            const phone = document.getElementById('phone').value; // Get phone number value
            const selectedOption = document.querySelector(`#foodItem option[value="${foodItemId}"]`);
            const foodItemName = selectedOption ? selectedOption.innerText.split(' - ')[0] : '';
            const foodItemPrice = selectedOption ? parseFloat(selectedOption.getAttribute('data-price')) : 0;

            if (!foodItemId || quantity <= 0 || !location || !phone) {
                alert('Please select a valid food item, quantity, location, and provide your phone number.');
                return;
            }

            const totalPrice = (foodItemPrice * quantity).toFixed(2);
            cart.push({ foodItem: foodItemName, quantity, price: foodItemPrice, totalPrice });

            // Store location and phone number in hidden fields
            document.getElementById('orderLocation').value = location;
            document.getElementById('orderPhone').value = phone;

            renderCart();
        }

        function renderCart() {
            const cartTableBody = document.getElementById('cartTable').querySelector('tbody');
            cartTableBody.innerHTML = '';

            let totalOrderPrice = 0;

            cart.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.foodItem}</td>
                    <td>${item.quantity}</td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>$${item.totalPrice}</td>
                    <td><button type="button" onclick="removeFromCart(${index})">Remove</button></td>
                `;
                cartTableBody.appendChild(row);
                totalOrderPrice += parseFloat(item.totalPrice);
            });

            const totalRow = document.createElement('tr');
            totalRow.innerHTML = `
                <td colspan="3"><strong>Total Price</strong></td>
                <td>$${totalOrderPrice.toFixed(2)}</td>
                <td></td>
            `;
            cartTableBody.appendChild(totalRow);

            document.getElementById('cartData').value = JSON.stringify(cart);
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            renderCart();
        }
    </script>
</body>
</html>
