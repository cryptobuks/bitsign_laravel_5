$('#email-submit-btn').click(function(){
    
    var email = $('#input-email').val();

    if(email == ''){
    	  $('#alert-msg').html('<div class="alert alert-success" role="alert">Please specify an email address</div>');
    } else {
    	$.ajax({
		   url : '/home/register',
		   type: "POST",
		   data: { email:email },
		   beforeSend: function(){
		     $('#input-email').val('');
		     $('#alert-msg').html('');
		     $('#reg-modal-body').html('<div class="alert alert-success" role="alert">Email is being is sent</div>');
		   },
		   complete: function(){
		     
		   },
		   success: function(res) {   
		      $('#alert-msg').html('');
		      $('#reg-modal-body').html('<div class="alert alert-success" role="alert">Thank you for joining Bitsign</div>');
		   }
	 	}); 
   	  }	
});

$('.close-reg-modal').click(function () {
    var html = '<div id="alert-msg"></div><p>Please Enter your email address</p><input id="input-email" class="form-control" placeholder="Your Email *" required="" type="email">';
    $('#reg-modal-body').html(html);
})