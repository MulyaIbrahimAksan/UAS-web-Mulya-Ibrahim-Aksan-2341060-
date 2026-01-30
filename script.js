
document.addEventListener('DOMContentLoaded', () => {
    const qtyInputs = document.querySelectorAll('.qty-input');
    if (!qtyInputs.length) return;

    function updateTotals() {
        let total = 0;
        qtyInputs.forEach(input => {
            const price = parseInt(input.dataset.price, 10);
            const qty = parseInt(input.value, 10) || 0;
            const subtotal = price * qty;

            const subtotalCell = input.closest('tr').querySelector('.subtotal');
            subtotalCell.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

            total += subtotal;
        });

        const totalCell = document.getElementById('total');
        if (totalCell) {
            totalCell.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    }

    qtyInputs.forEach(input => {
        input.addEventListener('input', updateTotals);
    });
});
