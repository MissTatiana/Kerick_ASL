$(document).ready(function() {

	
	$("#trans_date").datepicker();
	
	$("#edit_trans_date").datepicker();
	
	$("#inc_trans_date").datepicker();
	
	$("#raptorBtn").click(function(r) {
		$("#raptor").toggle();
		
		var audio = {};
        audio["hello"] = new Audio();
        audio["hello"].src = "http://www.shwiggie.com/media/ringtones/television/bugsbunny/frog-hellomybaby.mp3"
        audio["hello"].play();
        
        $("#stop").click(function(s) {
        	audio["hello"].pause();
        	$("#raptor").toggle();
        })
        
	})
	
});
	
