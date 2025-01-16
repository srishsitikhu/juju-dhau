document.addEventListener('DOMContentLoaded', function () {
    const cartRows = document.querySelectorAll('.cart-list tbody tr');
    let cartSubtotal = document.getElementById('cart-subtotal');
    let cartTotal = document.getElementById('cart-total');
    
    cartRows.forEach(row => {
        const minusBtn = row.querySelector('.minus-btn');
        const plusBtn = row.querySelector('.plus-btn');
        const productLiterSpan = row.querySelector('.product-liter span');
        
        // Ensure optionName is valid
        const optionName = productLiterSpan ? parseFloat(productLiterSpan.textContent.trim()) : 1; // Default to 1 if not found
        const quantityInput = row.querySelector('.quantity-input');
        const price = parseFloat(row.dataset.price) || 0; // Ensure price is extracted as a number and default to 0 if invalid
        const subtotalElement = row.querySelector('.subtotal-value');
  
        // Function to update the totals for each row
        function updateTotals() {
            if (!quantityInput) return; // Skip updating if quantity input is not found
            const quantity = parseInt(quantityInput.value);
            
            if (isNaN(quantity) || quantity <= 0) return; // Skip updating if quantity is invalid
            
            const subtotal = price * quantity * optionName;
            subtotalElement.textContent = subtotal.toFixed(2); // Update subtotal for the product
            calculateGrandTotal(); // Recalculate the overall total
        }
  
        // Function to calculate the grand total
        function calculateGrandTotal() {
            let total = 0;
            cartRows.forEach(r => {
                const quantityInputElement = r.querySelector('.quantity-input');
                const qty = quantityInputElement ? parseInt(quantityInputElement.value) : 0;
                const baseprice = parseFloat(r.dataset.price) || 0; // Ensure baseprice is extracted as a number and default to 0 if invalid
                const optionElement = r.querySelector('.product-liter span');
                const optionMultiplier = optionElement ? parseFloat(optionElement.textContent.trim()) : 1;
  
                if (isNaN(qty) || isNaN(baseprice) || isNaN(optionMultiplier)) return;
                
                total += qty * baseprice * optionMultiplier; // Calculate total with option multiplier
            });
            cartSubtotal.textContent = total.toFixed(2); // Update subtotal
            cartTotal.textContent = total.toFixed(2); // Update total
        }
  
        // Add event listeners for the minus button to decrease quantity
        if (minusBtn) {
            minusBtn.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantityInput.value = --quantity;
                    updateTotals(); // Update totals after change
                }
            });
        }
  
        // Add event listeners for the plus button to increase quantity
        if (plusBtn) {
            plusBtn.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                if (quantity < 10) {
                    quantityInput.value = ++quantity;
                    updateTotals(); // Update totals after change
                }
            });
        }
  
        // Add event listener for manual quantity input change
        if (quantityInput) {
            quantityInput.addEventListener('change', () => {
                const quantity = parseInt(quantityInput.value);
                if (quantity >= 1 && quantity <= 10) {
                    updateTotals(); // Update totals after change
                } else {
                    quantityInput.value = 1; // Set quantity to 1 if out of valid range
                    updateTotals();
                }
            });
        }
        // Initial calculation for each row
        updateTotals();
    });
});
