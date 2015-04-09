jQuery(function($) {
			var iPagerCount=$(".pager").length;
			var iPageNumber=0;
			var aTop=[0,800,1600,2400,3200,4000,4600];
			var sTop=$(window).scrollTop();
			if(sTop>=aTop[0]&&sTop<aTop[1]){iPageNumber=0;}
			if(sTop>=aTop[1]&&sTop<aTop[2]){iPageNumber=1;}
			if(sTop>=aTop[2]&&sTop<aTop[3]){iPageNumber=2;}
			if(sTop>=aTop[3]&&sTop<aTop[4]){iPageNumber=3;}
			if(sTop>=aTop[4]&&sTop<aTop[5]){iPageNumber=4;}
			if(sTop>=aTop[5]&&sTop<aTop[6]){iPageNumber=5;}
			if(sTop>=aTop[6]){iPageNumber=6;}
			
			//美化浏览器的滚动条
			$("html").niceScroll({
				touchbehavior:false,cursorcolor:"#0966ce",cursoropacitymax:1,cursorwidth:8,horizrailenabled:true,cursorborderradius:5,autohidemode:true,background:'none',cursorborder:'solid 1px #0966ce'
			});
			
			//滑动滚动条翻屏效果
			$("html,body").bind("mousewheel",function(event,intDelta){
					var $this=$(this),
					timeoutId=$(this).data('timeoutId');
					if(timeoutId){
						clearTimeout(timeoutId);
					}
					$this.data('timeoutId',setTimeout(function(){
							intDelta>0?pageUp():pageDown();$this.removeData('timeoutId');$this=null;
						},150));
					return false;
				});
			
			function pageUp(){
				iPageNumber=iPageNumber<=0?0:iPageNumber-1;slide(aTop[iPageNumber]);
			}
			function pageDown(){
				iPageNumber=iPageNumber>=iPagerCount-1?iPageNumber:iPageNumber+1;slide(aTop[iPageNumber]);
			}	
			function slide(length){
				$("body,html").stop().animate({scrollTop:length},800,'easeOutExpo');
			}
			
			//扩展动画
			$.extend($.easing,{
					easeOutExpo:function(e,f,a,h,g){
						return(f==g)?a+h:h*(-Math.pow(2,-10*f/g)+1)+a
					},easeOutBounce:function(x,t,b,c,d){
					if((t/=d)<(1/2.75)){
						return c*(7.5625*t*t)+b;
					}else if(t<(2/2.75)){
						return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;
					}else if(t<(2.5/2.75)){
						return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;
					}else{
						return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;
					}
				}
			});
		});