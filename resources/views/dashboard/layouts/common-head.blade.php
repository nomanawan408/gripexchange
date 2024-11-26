<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
<link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
<title>
    MNA Cap
</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Fonts and icons -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- Nucleo Icons -->
<link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Custom Styles -->
<style>
    .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #25D366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 1000;
    }
    .whatsapp-float i {
        margin-top: 16px;
    }
    .whatsapp-float:hover {
        text-decoration: none;
        color: #FFF;
        background-color: #128C7E;
    }
    .text-muted {
    color: #6c757d !important;
}
</style>

{{-- PUSHER ADD ON  --}}


<!-- Pusher -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('bba3c138a6a9d253bef1', {
        cluster: 'us3'
        });
        var channel = pusher.subscribe('admin-notifications');
        // Bind events to the channel
        channel.bind('deposit-created', function(data) {
            showNotification('Deposit Request', `A withdrawal request of `);
        });

        channel.bind('withdrawal-requested', function(data) {
            showNotification('Withdrawal Request', `A withdrawal request of `);
        });

        channel.bind('currency-exchange', function(data) {
            // showNotification('Currency Exchange', `${data.user} exchanged ${data.deposit.amount} ${data.deposit.from_currency} to ${data.to_currency}.`);
            showNotification('Currency Exchange', `successful`);
        });

        channel.bind('internal-transfer', function(data) {
            // showNotification('Internal Transfer', `${data.user} transferred ${data.deposit.amount} ${data.deposit.currency} to ${data.receiver}.`);
            showNotification('Internal Transfer', `sd`);
        });

        // Function to display notifications dynamically
        function showNotification(title, message) {
            var toastHTML = `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-primary text-light">
                <strong class="me-auto">${title}</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                ${message}
                </div>
            </div>`;

            // Append the toast HTML to the toast container
            document.getElementById('toast-container').innerHTML += toastHTML;

            // Initialize and show the toast
            var toastElement = document.querySelector('.toast:last-child');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
        </script>


{{-- PUSHER ADD ON  --}}