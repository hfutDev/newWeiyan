$(document).ready(function(){
    var startX,startY,endX,endY
    var scrollTopVal=0; //左右滑动请自行修改
    var win_height = $(window).height();
    //假定接受手指触摸事件的Dom对象id是"touchBox"
    document.getElementById("scroll_page").addEventListener("touchstart", touchStart, false);
    document.getElementById("scroll_page").addEventListener("touchmove", touchMove, false);
    document.getElementById("scroll_page").addEventListener("touchend", touchEnd, false);
    //里面getElementByIdx_x 中 x_x 是新浪自己加的，用的时候请去掉
    function touchStart(event){
     var touch = event.touches[0];
     startY = touch.pageY;
     // console.log(startY);
    }

    function touchMove(event){
        var touch = event.touches[0];
        endY = (startY-touch.pageY);
        if(endY > 150){
            // $("#scroll_page").scrollTop(scrollTopVal+$(window).height()-endY);
            // console.log('endY')
        }
        // console.log(touch.pageY);
        // if(scrollTopVal==0){
        //     $("#scroll_page").scrollTop((endY+100));
        // }else{
        //     $("#scroll_page").scrollTop(scrollTopVal+endY+100);
        // }
        // location.hash='.main_sixiang' ;
        // $("#scroll_page").scrollTop();
    }

    function touchEnd(event){
        scrollTopVal=$("#scroll_page").scrollTop();
        console.log(endY);
        if(endY > 150){
            $("#scroll_page").scrollTop(scrollTopVal+$(window).height()-endY);
            console.log('touchEnd : ' + scrollTopVal + ' --- ' + endY + ' --- ');
        }
    }
});