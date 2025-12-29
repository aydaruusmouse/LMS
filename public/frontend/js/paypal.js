window.paypal_sdk
    .Buttons({
        onApprove: async (data, actions) => {
            const order = await actions.order.capture();

            let method = "POST";
            if (window.is_wallet == 1)
            {
                window.url = window.base_url + `/user/recharge-wallet?trx_id=${trx_id}&amount=${amount}&type=wallet`;
            }
            else if(window.token)
            {
                window.url = window.base_url + "/api/complete-order?trx_id=" + window.trx_id + "&token=" + window.token+"&payment_mode=api";
            }
            else{
                window.url = window.base_url + "/user/complete-order?trx_id=" + window.trx_id;
            }
            data.amount = window.amount;
            data.payment_type = "paypal";
            data.order = order;
            data.token = window.token;

            $.ajax({
                method: method,
                url: window.url,
                data: data,
                success: function (response) {
                    if (response.error) {
                        toastr.error(response.error);
                    } else {
                        toastr.success(response.success);
                        window.location.href = response.url;
                    }
                },
            });
        },

        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [
                    {
                        amount: {
                            value: parseFloat(window.amount).toFixed(2),
                            currency_code: "USD",
                        },
                    },
                ],
            });
        },
        onError: (err) => {
            alert("Error");
        },
    })
    .render("#paypal-button-container");
