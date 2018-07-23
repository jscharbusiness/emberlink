$(window).on('load', function(){

	// Add smooth scrolling to all links
	$("a").on('click', function(event) {

	    // Make sure this.hash has a value before overriding default behavior
	    if (this.hash !== "") {
			// Prevent default anchor click behavior
			event.preventDefault();

			// Store hash
			var hash = this.hash;

			$('html, body').animate({

				scrollTop: $(hash).offset().top

			}, 500, function() {
			// window.location.hash = hash;
			});

	    }

	});

	$('.plan').on('click', function(e) {

		$(".plan").removeClass('active');

		$(this).addClass('active');

		$('#displayInfo').html($(this).html());
	});

	$("#submit").click(function(){

		var error = $("#error");
		var success = $("#success");

		$.ajax({
			type: "POST",
			url: "index.php?action=email",
			data: "&name=" + $("#name").val() + "&email=" + $("#email").val() + "&comments=" + $("#comments").val(),
			success: function(result) {

				if (result == "1") {

					error.hide();
					success.show();
					success.html("Thanks, I will get back to you soon!");

				} else if (result == "2") {

					error.show();
					success.hide();
					error.html("A name is required.");

					// $error = "A name is required.";

				} else if (result == "3") {

					error.show();
					success.hide();
					error.html("An email address is required.");

					// $error = "An email address is required.";

				} else if (result == "4") {

					error.show();
					success.hide();
					error.html("Please enter a valid email address.");

					// $error = "Please enter a valid email address.";

				} else if (result == "5") {

					error.show();
					success.hide();
					error.html("You don't want to send anything?");

					// $error = "You don't want to send anything?";

				} else {

					error.show();
					success.hide();
					error.html("Sorry, something went wrong! Please try again later!");

				}

			}
		});

	});
});