$(function() {
	$(".mouse-click").click(function() {
		
    $('html,body').animate({
        scrollTop: $(".content-section").offset().top},
        'slow');
    });
	$('#testimonial').owlCarousel({
    loop:true,
	margin:0,
    nav:true,
	dots: true,
	autoplay:true,
	navText: ["<img src='assets/images/prev.png' width='35' height='35'>","<img src='assets/images/next.png' width='35' height='35'>"],
    responsive:{
        0:{
            items:1
        },
        768:{
            items:1
        },
        1024:{
            items:1
        }
     }
	});
$(function(){
    windowheight();
});
$(function() {
	$('.height').matchHeight();
});
});
function windowheight(){
 $('.banner').css({'height':$(window).height()-46+'px'});
 $(window).resize(function(){
  $('.banner').css({'height':$(window).height()-46+'px'});
 });
}
$(document).ready(function() {
   $('.video-bg').hide();
   var vid = document.getElementById("video"); 
    $("#play-video").click(function () {
     vid.play(); 
    setTimeout(function(){ 
	      $(".video-bg").show();
		  }, 300);
    });
	$(".video-close").click(function () {
/* 		video.currentTime = 0
    video.play(); */
	 vid.load();
    setTimeout(function(){ 
	      $(".video-bg").hide();
		  }, 300);
				
    });

});