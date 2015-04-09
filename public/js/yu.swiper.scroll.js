$(function(){
  var mySwiper = new Swiper('.swiper-container',{
    direction: 'vertical'
    ,loop: false
    ,onTransitionStart: function(swiper){
      // console.log(swiper.activeIndex);
      switch(swiper.activeIndex){
        case 0:             
          $('#menu-icon').css('background-color','#ff5669');
          break;
        case 1:             
          $('#menu-icon').css('background-color','#ff5669');
          break;
        case 2:             
          $('#menu-icon').css('background-color','#00a0e9');
          break;
        case 3:             
          $('#menu-icon').css('background-color','#ff8c2f');
          break;
        case 4:             
          $('#menu-icon').css('background-color','#007c44');
          break;
        case 5:             
          $('#menu-icon').css('background-color','#8fc31f');
          break;
        case 6:             
          $('#menu-icon').css('background-color','#b31a25');
          break;
        default:
          $('#menu-icon').css('background-color','#ff5669');
      }
      }
  });

  //页面滑动事件绑定
  $('.main_next').click(function(e){
    mySwiper.slideNext(false);
  });
  $('.nav_1').each(function(i,obj){
    $(obj).click(function(ev){
      mySwiper.slideTo(i+1);
    });
  });

 
 

});

 

 

