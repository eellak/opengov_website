(function($){
	$(document).ready(function(){

		var validator = $("#submit-idea-form").validate({
			rules: {
				title: {
					required: true,
					minlength: 3
				},
				uname: {
					required: true,
					minlength: 3
				},
				usurname: {
					required: true,
					minlength: 3
				},
				uemail: {
					email: true,
					required: true
				},
				description: {
					required: true,
					minlength: 10
				},
				ideafile: {
				  extension: "pdf|ppt|doc|pptx|docx|odt"
				}
			},
			messages: {
				title: {
					required: " Απαιτείται!",
					minlength: "  Τουλάχιστον 3 χαρακτήρες!"
				},
				uname: {
					required: " Απαιτείται!",
					minlength: "  Τουλάχιστον 3 χαρακτήρες!"
				},
				usurname: {
					required: " Απαιτείται!",
					minlength: "  Τουλάχιστον 3 χαρακτήρες!"
				},
				uemail: {
					email: "Καταχωρίστε ένα ορθό email!",
					required: " Απαιτείται!"
				},
				description: {
					required: " Απαιτείται!",
					minlength: "  Τουλάχιστον 10 χαρακτήρες!"
				},
				ideafile: {
				  extension: " Μη αποδεκτός τύπος αρχείου!"
				}
			}
		});
		
	});
})(jQuery);