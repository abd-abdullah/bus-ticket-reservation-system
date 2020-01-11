$(document).ready(function(){
    // The error part where I would like to hide message after some seconds
    $(".error-message").delay(3200).fadeOut(300);

    // As like as error message
    $(".success-message").delay(3200).fadeOut(300);
});