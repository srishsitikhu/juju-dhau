document.addEventListener('DOMContentLoaded', function () {
  const cartRows = document.querySelectorAll('.cart-list tbody tr');
  let cartSubtotal = document.getElementById('cart-subtotal');
  let cartTotal = document.getElementById('cart-total');

  cartRows.forEach(row => {
      const minusBtn = row.querySelector('.minus-btn');
      const plusBtn = row.querySelector('.plus-btn');
      const quantityInput = row.querySelector('.quantity-input');
      const price = parseFloat(row.dataset.price);
      const subtotalElement = row.querySelector('.subtotal-value');

      function updateTotals() {
          const quantity = parseInt(quantityInput.value);
          const subtotal = price * quantity;
          subtotalElement.textContent = subtotal.toFixed(2);
          calculateGrandTotal();
      }

      function calculateGrandTotal() {
          let total = 0;
          cartRows.forEach(r => {
              const qty = parseInt(r.querySelector('.quantity-input').value);
              const price = parseFloat(r.dataset.price);
              total += qty * price;
          });
          cartSubtotal.textContent = total.toFixed(2);
          cartTotal.textContent = total.toFixed(2);
      }

      minusBtn.addEventListener('click', () => {
          let quantity = parseInt(quantityInput.value);
          if (quantity > 1) {
              quantityInput.value = --quantity;
              updateTotals();
          }
      });

      plusBtn.addEventListener('click', () => {
          let quantity = parseInt(quantityInput.value);
          if (quantity < 10) {
              quantityInput.value = ++quantity;
              updateTotals();
          }
      });

      quantityInput.addEventListener('change', () => {
          const quantity = parseInt(quantityInput.value);
          if (quantity >= 1 && quantity <= 10) {
              updateTotals();
          } else {
              quantityInput.value = 1;
              updateTotals();
          }
      });
  });
});