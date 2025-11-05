<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kronic Kustoms - Order Now</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body { background-color: #333333; color: #EDEDED; font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; align-items: center; min-height: 100vh; justify-content: flex-start; }
        nav { background-color: #4A4A4A; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; width: 100%; position: fixed; top: 0; z-index: 1000; }
        .logo-container { display: flex; align-items: center; margin-left: 25px; }
        .logo { height: 160px; margin-right: 10px; }
        .logo-text { font-size: 1.5em; font-weight: bold; color: #FF0000; margin: 0; }
        .nav-links { display: flex; align-items: center; margin-right: 25px; }
        .nav-links a { color: #EDEDED; text-decoration: none; margin: 0 15px; }
        .nav-links a:hover { color: #FF0000; }
        header { padding: 50px 20px; background-color: #333333; width: 100%; box-sizing: border-box; text-align: center; margin-top: 80px; }
        h1 { font-size: 2.5em; margin: 0; color: #FF0000; }
        main { padding: 40px 20px 160px; text-align: center; max-width: 1200px; margin: 0 auto; }
        h2 { color: #FF0000; margin-bottom: 15px; }
        p { line-height: 1.6; margin-bottom: 20px; }
        .order-section { margin-bottom: 100px; }
        .form-container { max-width: 600px; margin: 0 auto 40px; text-align: left; background: #444; padding: 25px; border-radius: 8px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 12px; margin-bottom: 15px; background: #555; border: 1px solid #777; color: #EDEDED; border-radius: 4px; box-sizing: border-box; }
        .checkbox-container { display: flex; align-items: center; margin: 15px 0; }
        .checkbox-container input[type="checkbox"] { width: auto; margin-right: 10px; margin-bottom: 0; }
        .shipping-section { background: #555; padding: 15px; border-radius: 6px; margin: 20px 0; opacity: 0.6; }
        .shipping-section h4 { color: #FF0000; margin-top: 0; margin-bottom: 15px; }
        .price-breakdown { background: #555; padding: 15px; border-radius: 6px; margin: 20px 0; font-family: monospace; font-size: 1.1em; }
        .price-line { display: flex; justify-content: space-between; margin: 8px 0; }
        .price-total { border-top: 1px solid #777; padding-top: 8px; font-weight: bold; color: #FF0000; }
        .stripe-button { background: #FF0000; color: #fff; border: none; padding: 14px 28px; font-size: 1.2em; cursor: pointer; border-radius: 6px; margin-top: 10px; width: 100%; }
        .stripe-button:hover { background: #cc0000; }
        .stripe-button:disabled { background: #666; cursor: not-allowed; }
        .result-message { margin-top: 15px; font-weight: bold; min-height: 20px; color: #00ff00; }
        footer { background-color: #4A4A4A; padding: 20px; margin-top: auto; width: 100%; color: #EDEDED; position: fixed; bottom: 0; text-align: center; }
        footer a { color: #FF0000; text-decoration: none; }
    </style>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="{{ asset('KK Logo 02 NB.png') }}" alt="Kronic Kustoms Logo" class="logo">
            <span class="logo-text">Kronic Kustoms™</span>
        </div>
        <div class="nav-links">
            <a href="index.html">Home</a>
            <a href="product.html">Product</a>
            <a href="{{ route('ordernow') }}">Order Now</a>
            <a href="retailers.html">Retailers</a>
            <a href="contact.html">Contact</a>
        </div>
    </nav>

    <header>
        <h1>The all new Kronic Kustoms Slant Back Edge Topper</h1>
    </header>

    <main>
        <!-- FULL ORDER SECTION -->
        <section class="order-section">
            <h2>Order Your Arizona Topper</h2>
            <p>Ready to upgrade your Jeep Gladiator with the 2025 KK Edge Topper? Limited available, so order now!</p>

            <div class="form-container">
                <form id="payment-form">
                    <input type="hidden" name="order_type" value="full">
                    <h4 style="color: #FF0000; margin-top: 0;">Billing Address</h4>
                    
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone">

                    <label for="address-line1">Address *</label>
                    <input type="text" id="address-line1" name="billing_address_line1" required>

                    <label for="address-unit">Unit (If applicable)</label>
                    <input type="text" id="address-unit" name="billing_address_unit">

                    <label for="address-city">City *</label>
                    <input type="text" id="address-city" name="billing_city" required>

                    <label for="address-state">State *</label>
                    <input type="text" id="address-state" name="billing_state" required>

                    <label for="address-zip">Zip Code *</label>
                    <input type="text" id="address-zip" name="billing_zip" required>

                    <div class="checkbox-container">
                        <input type="checkbox" id="same-as-billing" checked>
                        <label for="same-as-billing" style="font-weight: normal; margin-bottom: 0;">Shipping address is the same as billing address</label>
                    </div>

                    <div class="shipping-section" id="shipping-section">
                        <h4>Shipping Address</h4>
                        <label for="ship-name">Full Name</label>
                        <input type="text" id="ship-name" name="shipping_name">
                        <label for="ship-address-line1">Address</label>
                        <input type="text" id="ship-address-line1" name="shipping_address_line1">
                        <label for="ship-address-unit">Unit (If applicable)</label>
                        <input type="text" id="ship-address-unit" name="shipping_address_unit">
                        <label for="ship-address-city">City</label>
                        <input type="text" id="ship-address-city" name="shipping_city">
                        <label for="ship-address-state">State</label>
                        <input type="text" id="ship-address-state" name="shipping_state">
                        <label for="ship-address-zip">Zip Code</label>
                        <input type="text" id="ship-address-zip" name="shipping_zip">
                    </div>

                    <label for="quantity">Number of Units *</label>
                    <select id="quantity" name="quantity" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>d
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>

                    <label for="comments">Comments</label>
                    <textarea id="comments" name="comments" rows="3"></textarea>

                    <div class="price-breakdown" id="price-breakdown-full">
                        <div class="price-line"><span>Price:</span> <span id="price-full">${{ number_format($settings['product_price'], 2) }}</span></div>
                        <div class="price-line"><span>Tax:</span> <span id="tax-full">$0.00</span></div>
                        <div class="price-line"><span>Shipping:</span> <span id="shipping-full">${{ number_format($settings['shipping_cost'], 2) }}</span></div>
                        <div class="price-line price-total"><span>Total:</span> <span id="total-full">$0.00</span></div>
                    </div>

                    <button type="submit" class="stripe-button" id="submit-full">ORDER NOW</button>
                    <div class="result-message" id="result-full"></div>
                </form>
            </div>
        </section>

        <!-- PRE-ORDER SECTION -->
        <section>
            <h2>Pre-Order Your Arizona Topper</h2>
            <p>You can also reserve Your KK Edge Topper with a {{ $settings['deposit_percentage'] }}% deposit and pay the Rest When it Is Ready To Ship to you. Cancellations are subject to a {{ $settings['deposit_percentage'] }}% cancellation fee.</p>
            <p>Fill out the form below to place your order. You'll receive confirmation of the order, and we will contact you for more details when your order is ready to ship.</p>

            <div class="form-container">
                <form id="payment-form-deposit">
                    <input type="hidden" name="order_type" value="deposit">
                    <h4 style="color: #FF0000; margin-top: 0;">Billing Address</h4>
                    
                    <label for="name-deposit">Full Name *</label>
                    <input type="text" id="name-deposit" name="name" required>

                    <label for="email-deposit">Email *</label>
                    <input type="email" id="email-deposit" name="email" required>

                    <label for="phone-deposit">Phone</label>
                    <input type="tel" id="phone-deposit" name="phone">

                    <label for="address-line1-deposit">Address *</label>
                    <input type="text" id="address-line1-deposit" name="billing_address_line1" required>

                    <label for="address-unit-deposit">Unit (If applicable)</label>
                    <input type="text" id="address-unit-deposit" name="billing_address_unit">

                    <label for="address-city-deposit">City *</label>
                    <input type="text" id="address-city-deposit" name="billing_city" required>

                    <label for="address-state-deposit">State *</label>
                    <input type="text" id="address-state-deposit" name="billing_state" required>

                    <label for="address-zip-deposit">Zip Code *</label>
                    <input type="text" id="address-zip-deposit" name="billing_zip" required>

                    <div class="checkbox-container">
                        <input type="checkbox" id="same-as-billing-deposit" checked>
                        <label for="same-as-billing-deposit" style="font-weight: normal; margin-bottom: 0;">Shipping address is the same as billing address</label>
                    </div>

                    <div class="shipping-section" id="shipping-section-deposit">
                        <h4>Shipping Address</h4>
                        <label for="ship-name-deposit">Full Name</label>
                        <input type="text" id="ship-name-deposit" name="shipping_name">
                        <label for="ship-address-line1-deposit">Address</label>
                        <input type="text" id="ship-address-line1-deposit" name="shipping_address_line1">
                        <label for="ship-address-unit-deposit">Unit (If applicable)</label>
                        <input type="text" id="ship-address-unit-deposit" name="shipping_address_unit">
                        <label for="ship-address-city-deposit">City</label>
                        <input type="text" id="ship-address-city-deposit" name="shipping_city">
                        <label for="ship-address-state-deposit">State</label>
                        <input type="text" id="ship-address-state-deposit" name="shipping_state">
                        <label for="ship-address-zip-deposit">Zip Code</label>
                        <input type="text" id="ship-address-zip-deposit" name="shipping_zip">
                    </div>

                    <label for="quantity-deposit">Number of Units *</label>
                    <select id="quantity-deposit" name="quantity" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>

                    <label for="comments-deposit">Comments</label>
                    <textarea id="comments-deposit" name="comments" rows="3"></textarea>

                    <div class="price-breakdown" id="price-breakdown-deposit">
                        <div class="price-line"><span>Deposit ({{ $settings['deposit_percentage'] }}%):</span> <span id="price-deposit">$0.00</span></div>
                        <div class="price-line"><span>Tax:</span> <span id="tax-deposit">$0.00</span></div>
                        <div class="price-line"><span>Shipping:</span> <span id="shipping-deposit">${{ number_format($settings['shipping_cost'], 2) }}</span></div>
                        <div class="price-line price-total"><span>Total:</span> <span id="total-deposit">$0.00</span></div>
                    </div>

                    <button type="submit" class="stripe-button" id="submit-deposit">RESERVE NOW</button>
                    <div class="result-message" id="result-deposit"></div>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2025 Kronic Kustoms™. Arizona-registered trademark. All rights reserved. Product design pending U.S. copyright.</p>
    </footer>

    <script>
        // Load settings from API
        let settings = {
            product_price: {{ $settings['product_price'] }},
            tax_rate: {{ $settings['tax_rate'] }},
            shipping_cost: {{ $settings['shipping_cost'] }},
            deposit_percentage: {{ $settings['deposit_percentage'] }}
        };

        // TEST KEY
        const stripe = Stripe('pk_test_51OfWznD1yKdjrRmw34231a2kiJISezAFKriXAWYXPtHdWe6FOetppIZo6OIJ2YGLKhQNpGOH9JyqVyC0Yqq29EMV00Y9p2CxYE');

        const PRICE_FULL = 'price_1SN5ggD1yKdjrRmwcuO4S1rH';
        const PRICE_DEPOSIT = 'price_1SN5ihD1yKdjrRmwR3oRNZf0';

        // Price update function using dynamic settings
        const updatePrice = (quantity, isDeposit) => {
            const basePrice = settings.product_price;
            const depositPercentage = settings.deposit_percentage / 100;
            const taxRate = settings.tax_rate / 100;
            const shipping = settings.shipping_cost;
            
            const base = isDeposit ? (basePrice * depositPercentage) : basePrice;
            const subtotal = base * quantity;
            const tax = subtotal * taxRate;
            const total = subtotal + tax + shipping;
            const id = isDeposit ? 'deposit' : 'full';
            
            document.getElementById(`price-${id}`).textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById(`tax-${id}`).textContent = `$${tax.toFixed(2)}`;
            document.getElementById(`shipping-${id}`).textContent = `$${shipping.toFixed(2)}`;
            document.getElementById(`total-${id}`).textContent = `$${total.toFixed(2)}`;
        };

        // Initialize prices on page load
        updatePrice(1, false);
        updatePrice(1, true);
        
        // Add event listeners for quantity changes
        document.getElementById('quantity').addEventListener('change', e => updatePrice(parseInt(e.target.value), false));
        document.getElementById('quantity-deposit').addEventListener('change', e => updatePrice(parseInt(e.target.value), true));

        // Same as billing functionality
        ['','deposit'].forEach(prefix => {
            const checkbox = document.getElementById(`same-as-billing${prefix ? '-' + prefix : ''}`);
            const section = document.getElementById(`shipping-section${prefix ? '-' + prefix : ''}`);
            const copy = () => {
                if (checkbox.checked) {
                    ['name', 'address-line1', 'address-unit', 'address-city', 'address-state', 'address-zip'].forEach(f => {
                        const b = document.getElementById(f + (prefix ? '-' + prefix : ''));
                        const s = document.getElementById(`ship-${f}` + (prefix ? '-' + prefix : ''));
                        if (b && s) s.value = b.value;
                    });
                    section.style.opacity = '0.6';
                } else {
                    section.style.opacity = '1';
                }
            };
            checkbox.addEventListener('change', copy);
            copy();
        });

        // Submit handler - First saves order data, then proceeds to Stripe
        const submitForm = async (e, isDeposit) => {
            e.preventDefault();
            const formId = isDeposit ? 'deposit' : 'full';
            const form = document.getElementById(`payment-form${isDeposit ? '-deposit' : ''}`);
            const btn = document.getElementById(`submit-${formId}`);
            const result = document.getElementById(`result-${formId}`);
            btn.disabled = true;
            result.style.color = '#EDEDED';
            result.textContent = 'Saving order...';

            try {
                // Collect form data
                const formData = new FormData(form);
                
                // Handle same-as-billing checkbox
                const sameAsBilling = document.getElementById(`same-as-billing${isDeposit ? '-deposit' : ''}`).checked;
                if (sameAsBilling) {
                    // Copy billing address to shipping
                    formData.set('shipping_name', formData.get('name'));
                    formData.set('shipping_address_line1', formData.get('billing_address_line1'));
                    formData.set('shipping_address_unit', formData.get('billing_address_unit') || '');
                    formData.set('shipping_city', formData.get('billing_city'));
                    formData.set('shipping_state', formData.get('billing_state'));
                    formData.set('shipping_zip', formData.get('billing_zip'));
                }

                // Debug: Log form data
                console.log('Submitting order:', {
                    order_type: formData.get('order_type'),
                    name: formData.get('name'),
                    email: formData.get('email'),
                    quantity: formData.get('quantity')
                });

                // Save order to database first
                const saveResponse = await fetch('{{ route("order.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                        // Don't set Content-Type when using FormData - browser sets it automatically with boundary
                    },
                    body: formData
                });

                // Get response text first to check if it's JSON
                const responseText = await saveResponse.text();
                let saveData;
                
                try {
                    saveData = JSON.parse(responseText);
                    console.log('Server response:', saveData);
                } catch (jsonError) {
                    // If response is not JSON, it's likely an HTML error page
                    console.error('Non-JSON response received:', responseText.substring(0, 500));
                    console.error('Response status:', saveResponse.status);
                    throw new Error('Server returned an error. Please check the console for details and try again.');
                }
                
                if (!saveResponse.ok || !saveData.success) {
                    // Handle validation errors
                    let errorMessage = saveData.message || 'Failed to save order';
                    if (saveData.errors) {
                        const errorList = Object.values(saveData.errors).flat().join(', ');
                        errorMessage = errorList || errorMessage;
                    } else if (saveData.error) {
                        errorMessage = saveData.error;
                    }
                    console.error('Order save failed:', errorMessage);
                    throw new Error(errorMessage);
                }

                console.log('Order saved successfully:', saveData.order_id);
                result.style.color = '#00FF00';
                result.textContent = 'Order saved. Proceeding to payment...';

                // After order is saved, proceed with Stripe checkout
                const quantity = parseInt(formData.get('quantity'));
                const email = formData.get('email');
                const priceId = isDeposit ? PRICE_DEPOSIT : PRICE_FULL;

                // Create Stripe checkout session
                const sessionResponse = await fetch('{{ route("order.createSession") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ 
                        priceId, 
                        quantity: quantity, 
                        email,
                        order_id: saveData.order_id 
                    })
                });

                // Get response text first to check if it's JSON
                const sessionResponseText = await sessionResponse.text();
                let sessionData;
                
                try {
                    sessionData = JSON.parse(sessionResponseText);
                    console.log('Stripe session response:', sessionData);
                } catch (jsonError) {
                    console.error('Non-JSON response from Stripe session:', sessionResponseText.substring(0, 500));
                    throw new Error('Failed to create payment session. Please try again.');
                }

                if (!sessionResponse.ok || !sessionData.success) {
                    throw new Error(sessionData.error || 'Failed to create payment session. Please try again.');
                }

                const { error: stripeError } = await stripe.redirectToCheckout({ sessionId: sessionData.sessionId });
                if (stripeError) throw new Error(stripeError.message || 'Stripe checkout error');

            } catch (err) {
                console.error('Form submission error:', err);
                result.style.color = '#FF0000';
                result.textContent = err.message || 'Error occurred. Please try again.';
                btn.disabled = false;
            }
        };

        document.getElementById('payment-form').addEventListener('submit', e => submitForm(e, false));
        document.getElementById('payment-form-deposit').addEventListener('submit', e => submitForm(e, true));

        // Success message
        if (new URLSearchParams(window.location.search).get('success') === 'true') {
            document.querySelectorAll('.result-message').forEach(el => el.textContent = 'Payment successful! We will contact you soon.');
        }
    </script>
</body>
</html>

