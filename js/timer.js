// set limits of Count Down Timer
var timeLimit = 60; // In seconds

// Count down timer
$(function(){
	$("#s_timer").countdowntimer({
		seconds : timeLimit,
        size : "xl"
	});
});

// Session destroy for transaction
setTimeout(function() { window.location.href = "helper/clear_transaction.php"; }, timeLimit * 1000);
