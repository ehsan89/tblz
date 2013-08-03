function replaceCheckables(){
	jQuery(':checkbox').each(function(){
		if (jQuery(this).siblings('.checkbox').length == 0){
			jQuery(this).hide();
			var html = '<span>';
		    html += jQuery('<div>').append(jQuery(this).clone()).html();
			html += '<span class="checkbox" onclick="jQuery(this).siblings(\':checkbox\').prop(\'checked\', !jQuery(this).siblings(\':checkbox\').is(\':checked\'));"></span>';
		    html += '</span>';
			jQuery(this).replaceWith(html);
		}
	});

	jQuery(':radio').each(function(){
		if (jQuery(this).siblings('.radio').length == 0){
			jQuery(this).hide();
			var html = '<span>';
		    html += jQuery('<div>').append(jQuery(this).clone()).html();
			html += '<span class="radio" onclick="jQuery(this).siblings(\':radio\').prop(\'checked\', !jQuery(this).siblings(\':radio\').is(\':checked\'));"><span></span></span>';
		    html += '</span>';
			jQuery(this).replaceWith(html);
		}
	});
}
