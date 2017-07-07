/* ==============================================
						jQuery
=============================================== */
$(document).ready(function () {
	
	// Contact From
	$('#contactform').submit(function(){
	
		var action = $(this).attr('action');
		
		$("#state-message").slideUp(750,function() {
		$('#state-message').hide();
		
		$.post(action, { 
			name: $('#name').val(),
			email: $('#email').val(),
			message: $('#message').val()
		},
			function(data){
				document.getElementById('state-message').innerHTML = data;
				$('#state-message').slideDown('slow');
				$('#contactform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled'); 
				if(data.match('success') != null) $('#contactform').slideUp('slow');
			}
		);
		});
		return false; 
	});
	
	// Portfolio initialize
	Grid.init();

	//$('body').scrollspy({ target: '.navbar', offset : 52 })
	
	// Sticky Navbar
	$('.navbar').waypoint('sticky');
	
	// Smooth Scroll
	$('.navbar .local, .navbar-brand, #scrolldown .local').click(function(e){
		$('html,body').scrollTo(this.hash, this.hash);
		e.preventDefault();
	});
	// Testimonial Carousel
	$('.testimonial-box').carousel({
		interval: 5000
	});
	
	// Home ScrollDown
	function runScrollDown() {
		var downSpeed = 700;
		$('#scrolldown1').fadeIn(downSpeed).delay(0).fadeOut(downSpeed);
		$('#scrolldown2').delay(500).fadeIn(downSpeed).delay(0).fadeOut(downSpeed);
		$('#scrolldown3').delay(700).fadeIn(downSpeed).delay(0).fadeOut(downSpeed, runScrollDown);
	}
	runScrollDown();

});
/* ==============================================
						Google Map
=============================================== */
function initialize() {
	var mapProp = {
  		center:new google.maps.LatLng(36.810496,10.146093), // <- Your LatLng
  		zoom:16,
		scrollwheel: false,
  		mapTypeId:google.maps.MapTypeId.ROADMAP
  	};
	var map = new google.maps.Map(document.getElementById("map"),mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);