$(document).ready(function () {
    $payment_method = -1;
    $('#OrderPaymentMethod').change(function () {
        $payment_method = $('#OrderPaymentMethod').val();
        //console.log($payment_method);
        if ($payment_method >= 0) {
            $('#list_banking').removeClass('hidden');
            if ($payment_method == 2) {
                $('#card_charging').removeClass('hidden');
            }else{
                $('#card_charging').addClass('hidden');
            }
        } else {
            $('#list_banking').addClass('hidden');
            $('#card_charging').addClass('hidden');
        }
    });
    //console.log($payment_method);

});

