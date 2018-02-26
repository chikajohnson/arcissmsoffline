$(document).ready(function(){

	$('.unread_messages').hide();
	
	var $notificications = $('.unread_messages');
	console.log($notificications);
	
	$(".js-notification-count").addClass("animated bounceInDown");
	
	//show popover
	$(".notifications").popover({
		html:true,
		content: function(){
		return $notificications.html();
		},
		placement:"bottom"
	});
	
		
	//dismiss popover when clicked outside
	$('html').on('mouseup', function(e) {
		if(!$(e.target).closest('.popover').length) {
			$('.popover').each(function(){
				$(this.previousSibling).popover('hide');
			});
		}
		});


	$('#upload_div').hide();
	$('#course-div').hide();
	// $('#inlet_panel').hide();

	$('#course-radio').click(function () {
		$('#course-div').show();
	});

	$('#all-courses').click(function () {
		$('#course-div').hide();
	});


	//#############################  send message page ###############################
	$('#all').show();
	$('#custom').hide();


	$('#all-radio').click(function () {
		$('#all').show();
		$('#custom').hide();
	});

	$('#some-radio').click(function () {
		$('#custom').show();
		$('#all').hide();
	});


	$('li').click(function()
	{
		this.css({"background-color": "yellow", "font-size": "200%"});
	});
	
});
