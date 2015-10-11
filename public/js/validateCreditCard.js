/**
 * Created by jimmykovacevic on 10/10/2015.
 */
$('#creditCard').validateCreditCard(function(result)
{
    if (result.valid) {
        $('#creditCard').css("background-color","#CCFFCC");
        $('#submit-btn').prop('disabled', false);
    } else {
        $('#creditCard').css("background-color","#FF8C8C");
        $('#submit-btn').prop('disabled', true);
    }
});