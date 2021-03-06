$(function() {
  if($('input[name=address]').length) {
    var geo_suggest_count = 0,
    	$geo_tries_el = $('<input>', {type: 'hidden', name:'geo_suggest_count', value: 0}),
		$geo_suggest_hint_el = $('<input>', {type: 'hidden', name:'geo_suggest_hint_used', value: 0});

    $('form').each(function(i, item) {
		$geo_tries_el.clone().appendTo($(item));
		$geo_suggest_hint_el.clone().appendTo($(item));
    });

    $('input[name=address]').autocomplete({
    	delay: 350,
    	minLength: 5,
    	source: function(request, response) {
      		$.get('/api/geocode',
            	{search: request.term,
             	country_code: $('select[name=country_code]').val()},
                function(data){
        			response(data.objects);

                    geo_suggest_count++;
                    $('form > input[name="geo_suggest_count"]').each(function(i, item) {
                        $(item).val(geo_suggest_count);
                    });
      		});
    	},
		select: function( event, ui ) {
            $('form > input[name="geo_suggest_hint_used"]').each(function(i, item) {
				$(item).val(1);
            });
		}
  	})
  }
});
