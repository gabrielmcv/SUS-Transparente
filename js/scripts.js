// SEARCH
			$(document).ready(function(){
			$('input.typeahead').typeahead({
				name: 'typeahead',
				remote:'./search.php?key=%QUERY',
				limit : 5
			});
		});
		
var offset = { x: 0, y: 0 };

interact('.resize')
  .resizable({
    edges: { left: true, right: false, bottom: false, top: false }
  })
  .on('resizemove', function (event) {
    var target = event.target;

    // update the element's style
    target.style.width  = event.rect.width + 'px';
    target.style.height = event.rect.height + 'px';
	
	load();
	
  });		