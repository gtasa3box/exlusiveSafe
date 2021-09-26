$(function () {
    $("form input[type='radio']").change(function() {
        if ($('#elementary').is(":checked")){
            $('#protected').prop('disabled', true);
        }
        else {
            $('#protected').prop('disabled', false);
        }
    });
});

$(".phone_mask").mask("+7 (999) 999-9999");
