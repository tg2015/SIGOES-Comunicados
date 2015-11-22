jQuery(document).ready(function($) {

	function postTypeSupportsFeaturedImage() {
		return $.find('#postimagediv').length !== 0;
	}

	function lacksFeaturedImage() {
		return $('#postimagediv').find('img').length === 0;
	}

	function publishButtonIsPublishText() {
		return $('#publish').attr('name') === 'publish';
	}

	function disablePublishAndWarn() {
		createMessageAreaIfNeeded();
		$('#nofeature-message').addClass("error")
			.html('<p>'+objectL10n.jsWarningHtml+'</p>');
		$('#publish').attr('disabled','disabled');
		//alert('error');
		//jQuery(':input#publish').attr('value', '* No se Puede Publicar');
	}

	function clearWarningAndEnablePublish() {
		$('#nofeature-message').remove();
		$('#msjDestacada1').remove();
		$('#publish').removeAttr('disabled');
		//jQuery(':input#publish').attr('value', 'Publicar');

	}

	function createMessageAreaIfNeeded() {
		if ($('body').find("#nofeature-message").length === 0) {
			$('h2').after('<div id="nofeature-message"></div>');
	    }
	}

    function detectWarnFeaturedImage() {
		if (postTypeSupportsFeaturedImage()) {
			if (lacksFeaturedImage() && publishButtonIsPublishText()) {
				disablePublishAndWarn();
			} else {
				clearWarningAndEnablePublish();
			}
		}
	}

	detectWarnFeaturedImage();
	setInterval(detectWarnFeaturedImage, 3000);
});