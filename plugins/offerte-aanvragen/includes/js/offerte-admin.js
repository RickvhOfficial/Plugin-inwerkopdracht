document.addEventListener('DOMContentLoaded', function () {

    const dropdowns = document.querySelectorAll('.offerte-status-select');
    const messageContainer = document.getElementById('offerte-message-container');

    dropdowns.forEach(function (dropdown) {

        dropdown.addEventListener('change', function () {

            const offerteId = this.dataset.offerteId;
            const nieuweStatus = this.value;

            const formData = new FormData();
            formData.append('action', 'update_offerte_status');
            formData.append('offerte_id', offerteId);
            formData.append('nieuwe_status', nieuweStatus);
            formData.append('nonce', OfferteAjax.nonce);

            fetch(ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {

                showMessage(data.data.message, data.success);

            });

        });

    });

    function showMessage(text, success) {

        const message = document.createElement('div');

        message.className = success
            ? 'notice notice-success'
            : 'notice notice-error';

        message.innerHTML = '<p>' + text + '</p>';

        messageContainer.appendChild(message);

        setTimeout(function () {
            message.remove();
        }, 3000);

    }

});