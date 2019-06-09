(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


$(function(){

	$('.tabitem').on('click', function(){

		$('.activetab').removeClass('activetab');
		$(this).addClass('activetab');

		var item = $('.activetab').index();
		$('.tabbody').hide();
		$('.tabbody').eq(item).show();

	});

	$('#busca').on('focus', function(){
		$(this).animate({
			width:'250px'
		}, 'fast');
	});

	$('#busca').on('blur', function(){
		if($(this).val() == '') {
			$(this).animate({
				width:'100px'
			}, 'fast');
		}

		setTimeout(function(){
			$('.searchresults').hide();
		}, 500);
	});

	$('#busca').on('keyup', function(){
		var datatype = $(this).attr('data-type');
		var q = $(this).val();

		if(datatype != '') {
			$.ajax({
				url:BASE_URL+'/ajax/'+datatype,
				type:'GET',
				data:{q:q},
				dataType:'json',
				success:function(json) {
					if( $('.searchresults').length == 0 ) {
						$('#busca').after('<div class="searchresults"></div>');
					}
					$('.searchresults').css('left', $('#busca').offset().left+'px');
					$('.searchresults').css('top', $('#busca').offset().top+$('#busca').height()+3+'px');

					var html = '';

					for(var i in json) {
						html += '<div class="si"><a href="'+json[i].link+'">'+json[i].name+'</a></div>';
					}

					$('.searchresults').html(html);
					$('.searchresults').show();
				}
			});
		}

	});

});







