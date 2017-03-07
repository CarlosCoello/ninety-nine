jQuery(document).ready(function($) {

  function find_page_number( element ) {
		element.find('span').remove();
		return parseInt( element.html() );
	}

  $(document).on( 'click', '.nav-links a', function( event ) {
	event.preventDefault();

  page = find_page_number( $(this).clone() );

	$.ajax({
		url: ajaxpagination.ajaxurl,
		type: 'post',
		data: {
			action: 'ajax_pagination',
      query_vars: ajaxpagination.query_vars,
			page: page
		},
		success: function( result ) {

      $('.index-posts').remove();
      $('.ninety-nine-pagination').remove();
      $('.ajax-response').addClass('ajax-height');
      $('.loading-pages').removeClass('hide');
      $('.loading-pages').addClass('animated infinite swing');
      setTimeout(function(){
        $('.loading-pages').addClass('hide');
        $('.loading-pages').removeClass('animated infinite swing');
        $('.ajax-response').removeClass('ajax-height');
        $('.loading-pages').removeClass('.loading-height');
      }, 2000);
      setTimeout(function(){
        $('.ajax-response').append( result ).find('.carousel.slide').carousel();
      }, 2000);

		}
	})
});

});
