$(document).ready(function(){

	//hide shop block
	$("#shops_main").hide();

	$("#link_one_offers").click(function(){
		$(this).addClass( "active" );
		$("#link_two_shops").removeClass( "active" );
		$("#offers_main").show();
		$("#shops_main").hide();
	});
	$("#link_two_shops").click(function(){
		$(this).addClass( "active" );
		$("#link_one_offers").removeClass( "active" );
		$("#offers_main").hide();
		$("#shops_main").show();
	});


});