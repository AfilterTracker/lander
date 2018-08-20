function changeSelectPack(TT){

  TT.closest('.item').addClass('active').siblings().removeClass('active');
  $('body').find('.js_changer').removeClass('active');
  TT.addClass('active');
   $('.change-package-selector [value="' + TT.attr('data-package-id') + '"]').prop("selected", "selected");
  
if(typeof set_package_prices == 'function'){
        set_package_prices(TT.attr('data-package-id'));
            
      }



}


$(document).ready(function(){


  
if(typeof set_package_prices == 'function'){
        set_package_prices(3);
            
      }




  $('.js_changer').on('touchend, click', function(){
    var TT = $(this);

    changeSelectPack(TT);
  if(TT.attr('data-package-id') != 3){
      $('html, body').animate({scrollTop: $('.js_scrollForm').offset().top }, 300);
    }

    

    $('.js_scrollForm').addClass('active');
    setTimeout(function(){ $('.js_scrollForm').removeClass('active');},1000)

  });

  $('select.change-package-selector').on('change', function() {


    changeSelectPack($('.js_changer[data-package-id='+this.value+']'));

  




  });

  
 $('.toform').on('touchend, click', function(e){

    e.preventDefault();
    $('.body').hide();
    $('.hidden-window').fadeIn();
     $('html, body').animate({scrollTop: 0 }, 300);
     return false;
 });

//$(document).mouseup(function (e){ // событие клика по веб-документу
//    var div = $(".containerz"); // тут указываем ID элемента
//    if (!div.is(e.target) // если клик был не по нашему блоку
//        && div.has(e.target).length === 0) { // и не по его дочерним элементам
//      $('.hidden-window').hide(); // скрываем его
//      $('body').css('overflow', 'auto');
//    }
//  });

  
});
