<!DOCTYPE html>
<html>
<head>
    <title>Paiement PayPal | BookShare</title>
</head>
<body>
    
    <div id="paypal-button-container"></div>

    <script src="https://www.paypal.com/sdk/js?client-id=AYldw19cQNFJdjySILD4oN098dtU7lEfLBnbRrS4SkY-9uVIFHjuA8QHgv5zeF98OVIuua3YuDPfiySY&currency=USD"></script>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '10.00'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Redirect vers une page de succès en PHP
                    window.location.href = "success.php?name=" + details.payer.name.given_name;
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
