jQuery(document).foundation();

jQuery(function($) {

  $('#platillos > div').not(':first').hide();
  $('#filtrar .menu li:first-child').addClass('active');

  $('#filtrar .menu a').on('click', function() {
    $('#filtrar .menu li').removeClass('active');
    $(this).parent().addClass('active');
    var enlace = $(this).attr('href');
    $('#platillos > div').hide();
    $(enlace).fadeIn();
    return false;
  });

  var fecha = new Date();
  var hora = fecha.getHours();
  if(hora <= 10) {
    var comida = "desayunar";
  }else if(hora >= 11 && hora <=17 ) {
    var comida = "comer";
  } else {
    var comida = "cenar";
  }


  jQuery.ajax({
    url: admin_url.ajax_url,
    type: 'post',
    data: {
      action : 'recetas_'+comida
    }
  }).done(function(response){
      $('#hora').append('<em>'+comida+'</em>');
      $.each(response, function(index, object) {
        console.log(object);
        var plato_hora = '<div class="medium-4 small-12 columns">' +
                         object.imagen +
                         '<div class="contenido">' +
                         '<h3 class="text-center">'+
                         '<a href="'+object.link+'">'+
                         object.nombre+'</h3>' +
                         '</a>'+
                         '</div>'+
                         '</div>';

                $('#por-hora').append(plato_hora);
      });
  });
});
