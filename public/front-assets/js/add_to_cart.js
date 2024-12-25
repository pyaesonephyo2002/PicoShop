// console.log('add-to-cart.js loaded successfully');

$(document).ready(function () {
    // Load initial data and cart count
    getData();
    updateCartCount();

    // Function to load data from localStorage and display it in the table
    function getData() {
        let itemsString = localStorage.getItem('shops');
        if (itemsString) {
            let itemsArray = JSON.parse(itemsString);
            let data = '';
            let j = 1;
            let total = 0;

            $.each(itemsArray, function (i, v) {
                // Calculate discounted price and total
                let discountedPrice = Math.round(v.price - (v.price * v.discount / 100));
                let itemTotal = discountedPrice * v.qty;
                total += itemTotal;

                data += `<tr>
                    <td>${j++}</td>
                    <td>${v.name}</td>
                    <td><img src="${v.image}" width="50"></td>
                    <td>${v.price}</td>
                    <td>${v.discount}%</td>
                    <td>
                        <div class="item-quantity">
                            <button class="btn-decrement" data-id="${v.id}">-</button>
                            <input type="number" class="qty-input" data-id="${v.id}" value="${v.qty}" min="1">
                            <button class="btn-increment" data-id="${v.id}">+</button>
                        </div>
                    </td>
                    <td>${itemTotal}</td>
                </tr>`;
            });

            // Append total row
            data += `<tr>
                <td colspan="6"><strong>Total</strong></td>
                <td><strong>${total}</strong></td>
            </tr>`;

            $('#tbody').html(data);

            // Attach event listeners for quantity adjustment
            attachQuantityListeners();
        }
    }

    // Function to update cart count in the UI
    function updateCartCount() {
        let itemsString = localStorage.getItem('shops');
        let cartCount = 0;

        if (itemsString) {
            let itemsArray = JSON.parse(itemsString);
            cartCount = itemsArray.reduce((sum, item) => sum + parseInt(item.qty), 0); // Sum up quantities
        }

        $('#cart-count').text(cartCount); // Update cart count
    }

    // Add item to cart and update UI
    $('.addToCart').click(function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let price = $(this).data('price');
        let discount = $(this).data('discount');
        let image = $(this).data('image');
        let qty = $('.qty').val();

        let items = {
            id: id,
            name: name,
            price: price,
            discount: discount,
            image: image,
            qty: qty
        };

        let itemsString = localStorage.getItem('shops');
        let itemsArray;

        if (itemsString == null) {
            itemsArray = [];
        } else {
            itemsArray = JSON.parse(itemsString);
        }

        let status = false;

        // Check if the item already exists in the cart
        $.each(itemsArray, function (i, v) {
            if (v.id == id) {
                v.qty = Number(v.qty) + Number(qty);
                status = true;
            }
        });

        // If item is new, add it to the array
        if (status == false) {
            itemsArray.push(items);
        }

        // Save the updated cart to localStorage
        let itemsData = JSON.stringify(itemsArray);
        localStorage.setItem('shops', itemsData);

        // Update UI
        getData();
        updateCartCount();
    });

    // Attach quantity increment and decrement event listeners
    function attachQuantityListeners() {
        $('.btn-increment').click(function () {
            let id = $(this).data('id');
            let input = $(`.qty-input[data-id="${id}"]`);
            input.val(parseInt(input.val()) + 1);
            updateCartQuantity(id, parseInt(input.val()));
        });

        $('.btn-decrement').click(function () {
            let id = $(this).data('id');
            let input = $(`.qty-input[data-id="${id}"]`);
            if (parseInt(input.val()) > 1) {
                input.val(parseInt(input.val()) - 1);
                updateCartQuantity(id, parseInt(input.val()));
            }
        });

        $('.qty-input').change(function () {
            let id = $(this).data('id');
            let qty = parseInt($(this).val());
            if (qty >= 1) {
                updateCartQuantity(id, qty);
            }
        });
    }

    // Update cart quantity and save to localStorage
    function updateCartQuantity(id, qty) {
        let itemsString = localStorage.getItem('shops');
        if (itemsString) {
            let itemsArray = JSON.parse(itemsString);

            // Update quantity for the specific item
            $.each(itemsArray, function (i, v) {
                if (v.id == id) {
                    v.qty = qty;
                }
            });

            // Save updated cart back to localStorage
            localStorage.setItem('shops', JSON.stringify(itemsArray));

            // Update UI
            getData();
            updateCartCount();
        }
    }
});
