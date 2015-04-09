 

$(document).ready(function(){
    //修改分类页back按钮的追对位置
    $(".back").css({"left":$('.header').width() - $('.back_button').width()});
    var one_width = 100/$('.nav_mark').size() ;//宽度是百分比
    $('.nav_mark').each(function(i,n){
        $('.nav_mark:eq('+i+')').attr('style','width:'+one_width+'%;left:'+i*one_width+'%;');        
    });
    $('.nav_bg_move').css({'width':one_width+'%'});

});
//窗口改变时，随时检查页面的变化
var yu_timer;
$(window).resize(function() {
    clearTimeout(yu_timer);
    yu_timer = setTimeout(function() {
        $(".back").css({"left":$('.header').width() - $('.back_button').width()});    
    },40);
});

function getBack(){
//文章标题列表时，返回首页；文章显示时，返回列表页;默认显示文章标题
    if( $('#article').attr('hide') == 'true')
        window.location.href='/';
    else{
        $('#article').animate({
            zIndex:'0',
            left:'-100%'
        },function(){
                $('#article').attr('hide','true');
                $('#article').css('display','none'); 
        });
    }

}

//要获取二级栏目的id,从而根据id获取栏目下的文章列表
function getNav(jumpId){
    var nav_num = $('.nav_mark').size()
    $('#nav_bg').animate({
      left:(100*(jumpId-1)/nav_num)+'%' //这个要根据当前栏目和栏目个数来变化
    });
    //去掉隐藏前一个的list nav
    var beforeId = $('.active').attr('id');
    if(beforeId != jumpId){
        $('#'+beforeId).removeClass('active');
        $('#'+jumpId).addClass('active');
        $('#list_'+jumpId).css('display','block');

        $('#list_'+beforeId).animate({
            zIndex:'0',
            left:( beforeId > jumpId ? 100 : -100 ) + '%'
        });

        $('#list_'+jumpId).animate({
            zIndex:'1',
            left:'0'
        },function(){$('#list_'+beforeId).css('display','none');});
        
    }
 
}

//Ajax请求时，要获取文章的id
function getArticle(aid){
    // $('#class').attr('style','display:none;');
    $('#article').css('display','block');
    // $('#article').addClass('div_transition');
    //使用Ajax获取文章相关数据
    $.ajax({
        type : "get",
        url  : "/index/article",
        data: {aid:aid},
        dataType:"json",
        success : function(data, textStatus){
            var node = $('#article');
            $('.article_title span').html(data['title']);
            $('.article_info .from').html(data['from']);
            $('.article_info .author').html(data['author']);
            $('.article_info .pv').html(data['pv']);
            $('.article_content').html(data['content']);
        }
    });

    var nav_id = $('.active').attr('id');
    $('#list_'+nav_id).css('z-index','0')
    //动画效果，jQuery.animate功能
    $('#article').animate({
        zIndex:'1',
        left:0
    },function(){
        $('#article').attr('hide','false');
    })
    
}

//首页链接跳转时，传递参数，进入相应的栏目、使用不同的背景、改变栏目点击状态
//此函数在页面加载前进行！！！！
function getStatus(id){
    //change class.html background-image
    //slide to the nav
}



$(function(){
//do something ,for example add event.
})
 



 