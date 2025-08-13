<script>
    document.getElementById("year").innerHTML = new Date().getFullYear();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script  src="{{ asset('assets/js/vendor/jquery-3.7.1.min.js') }}"></script>
<script  src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script  src="{{ asset('assets/js/vendor/owl.carousel.min.js') }}"></script>
<script  src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
<script  src="{{ asset('assets/js/vendor/swiper-bundle.min.js') }}"></script>
<script  src="{{ asset('assets/js/vendor/countdownTimer.js') }}"></script>
<script  src="{{ asset('assets/js/vendor/infiniteslidev2.js') }}"></script>
<script  src="{{ asset('assets/js/vendor/nouislider.js') }}"></script>
<script src="{{ asset('assets/js/vendor/smoothscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.zoom.min.js') }}"></script>

<!-- Main Custom -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    function showFlashMessage(message, type = 'success') {
        const container = document.getElementById('flash-container');
        const alert = document.createElement('div');
        alert.className = `alert alert-${type}`;
        alert.style.cssText = `
        transition: opacity 0.5s ease;
        opacity: 1;
        text-align: center;
        border: 1px solid green;
        margin-bottom: 10px;
        min-width: 100%;
        max-width: 300px;`;
        alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close float-end" onclick="this.parentElement.remove()"></button>`;

        container.appendChild(alert);

        // Fermeture automatique après 5 secondes
        setTimeout(() => {
            alert.style.opacity = 0;
            setTimeout(() => alert.remove(), 500);
        }, 1000);

        // Rechargement après 72 secondes (70s + 0.5s + marge)
        setTimeout(() => {
            location.reload();
        }, 1250);
    }
</script>
<!-- Script ajout du produit au panier -->
<script>
    $(document).ready(function () {
        $('#addcart').on('click', function (e) {
            e.preventDefault();

            let productId = $('#id').val();
            let quantity = $('#quantity').val();

            $.ajax({
                url: "{{ route('add.cart') }}", // remplace par ta vraie route
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId,
                    quantity: quantity
                },
                success: function (response) {
                    showFlashMessage(response.message, 'success');
                },
                error: function (xhr, status, error) {
                    console.error('Erreur AJAX :', error);
                    console.error('Détails :', xhr.responseText);
                    alert('Erreur interne : voir la console');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#deleteProduct').on('click', function (e) {
            e.preventDefault();
            let productId = $('#id').val();
            console.log(productId);

            $.ajax({
                url: "{{ route('delete.product') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId,
                },
                success: function (response) {
                    showFlashMessage(response.message, 'success');
                },
                error: function (xhr, status, error) {
                    console.error('Erreur AJAX :', error);
                    console.error('Détails :', xhr.responseText);
                    alert('Erreur interne : voir la console');
                }
            });
        });
    });
</script>

<script>
    function updateQuantity(event, productId) {
        let quantity = event.target.value;
        console.log(quantity)
        fetch(`/update_quantity/${productId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: quantity })
        })
            .then(response => response.json())
            .then(data => {
                document.getElementById(`subtotal_${productId}`).innerText = data.newSubtotal + " Fr CFA";
            })
            .catch(error => console.error("Erreur:", error));
    }
</script>




