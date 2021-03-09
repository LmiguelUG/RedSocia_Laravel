
var url = 'http://morogram.com.devel';

window.addEventListener("load", function () {

$('.btn-like').css('cursor','pointer');
$('.btn-dislike').css('cursor','pointer');

/********************************** BOTON LIKE ********************************/
    function like() {
    /****************************** EVENTO CLICK ******************************/
    $('.btn-like').unbind('click').click( function () {

          $(this).addClass('btn-dislike').removeClass('btn-like') // REMUEVO Y AGG CLASES
          $(this).attr('src', '/img/hearts-red.png')              // ESTABLEZCO RUTA DE NUEVA IMAGEN (DISLIKE)

          $.ajax({
              url: url+'/like/'+$(this).data('id'),
              type: 'GET',
              success: function (response){
                console.log(response);
              }
          });

          dislike();
          })
    }
    like();


/********************************** BOTON disLIKE *****************************/
    function dislike() {
    $('.btn-dislike').unbind('click').click( function () {

            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', '/img/hearts-gray.png');

            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function (response){
                  console.log(response);
                }
            });

            like();
            })
    }
    dislike();

});
