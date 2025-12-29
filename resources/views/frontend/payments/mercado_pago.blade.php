<html>
<head>
    <title>Mercadopago Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
<div class="mp-container" style="display: none;"></div>
<br>
<br>


<script>
    // Agrega credenciales de SDK
    const mp = new MercadoPago("{{ setting('mercadopago_key') }}", {
        locale: "en-US",
        advancedFraudPrevention: true,
    });

    // Inicializa el checkout
    const checkout = mp.checkout({

        preference: {
            id: '{{ $preference->id }}',
        },
        autoOpen: true,
        render: {
            container: ".mp-container", // Indica el nombre de la clase donde se mostrará el botón de pago
            label: "Pagar", // Cambia el texto del botón de pago (opcional)
        },
    });

</script>
</body>
</html>
