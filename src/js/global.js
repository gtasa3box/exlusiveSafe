$(function () {
    $("form input[type='radio']").change(function() {
        if ($('#metal').is(":checked")){
            $('#protected').prop('disabled', true);
        }
        else {
            $('#protected').prop('disabled', false);
        }
    });

    $("form input[type='radio']").change(function() {
        if ($('#elementary, #reliable').is(":checked")){
            $('#unprotected').prop('disabled', true);
        }
        else {
            $('#unprotected').prop('disabled', false);
        }
    });
});


$(".phone_mask").mask("+7 (999) 999-9999");
