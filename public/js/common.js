//页面计算问题
function setRootSize() {
	var deviceWidth = document.documentElement.clientWidth; 
	if(deviceWidth>750){deviceWidth = 750;}  
	document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
}
setRootSize();
window.addEventListener('resize', function () {
    setRootSize();
}, false);
$(document).ready(function(){
	setRootSize();
});

///首页banner效果 - 本效果由昆明天度网络IRIS原创制作
function indexBanner(boxid,sumid,sname,_go,_speed,numid,nname,nhover,lastid,nextid){
	var startX,startY,endX,endY,startPos;//定义判断变量
	var _box = $(boxid);
	var _sum = $(sumid);
	var _arr = _sum.find(sname);
	var _length = _arr.length;
	var _numbox = $(numid);
	var _index = 1;//起始应该为索引1
	var _bool = true;

	_sum.append(_arr.eq(0).clone());
	_sum.prepend(_arr.eq(_length-1).clone());
	_arr = _sum.find(sname);
	_box.css({"overflow":"hidden"});
	_sum.css({"position":"relative","left":"0"});
	_arr.css({"display":"block","float":"left"});

	//数字切换
	var _numstr = "";
	for(var i=0;i<_length;i++){
		var thenum = i+1;
		_numstr += "<"+nname+">"+thenum+"</"+nname+">";
	}
	_numbox.html(_numstr);
	var _num = _numbox.find(nname);
	_num.eq(_index-1).addClass(nhover);

	//计算宽度
	var _width = _box.width();
	var _sumwidth = (_length+2)*_width;
	var _resize = function(){
		_width = _box.width();
		_sumwidth = (_length+2)*_width;
		_arr.width(_width);
		_sum.width(_sumwidth);
		var _move = -_width * _index;
		_sum.css("left",_move+"px");
	};
	_resize();
	$(window).resize(function(){_resize();});

	var movego = function(){
		if(_sum.is(":animated")){_sum.stop(true,true);}
		var _move = -_width * _index;
		_sum.animate({left:_move+"px"},_go,function(){
			if(_index > _length){
				_index = 1;
			}
			if(_index <= 0){
				_index = _length;
			}
			_move = -_width * _index;
			_sum.css("left",_move+"px");
			_num.eq(_index-1).addClass(nhover).siblings().removeClass(nhover);
			_bool = true;
		});
	};

	var nextImg = function(){
		if(_bool){
			_bool = false;
			_index++;
			movego();
		}
	};

	var lastImg = function(){
		if(_bool){
			_bool = false;
			_index--;
			movego();
		}
	};

	var cartoon = setInterval(nextImg,_speed);

	var _move01,_move02;//用于触碰体验增加数值
	var touchStart = function(event){
		clearInterval(cartoon);
		var touch = event.originalEvent.touches[0];
		endX = 0;
		endY = 0;
		startPos = +new Date;
		startX = touch.pageX;
		startY = touch.pageY;
		_move01 = -_width * _index;//获取当前位置
	};
	var touchMove = function(event){
		var touch = event.originalEvent.touches[0];
		var endPos = {x:startX-touch.pageX,y:startY-touch.pageY};
		var isScrolling = Math.abs(endPos.x)< Math.abs(endPos.y) ? 1:0;//isScrolling为1时，表示纵向滑动，0为横向滑动
		if(isScrolling === 0){
			event.preventDefault();//这里很重要！！！
			endX = (startX-touch.pageX);
			//endY = (startY-touch.pageY);
			_move02 = _move01 - endX;
			_sum.css("left",_move02+"px");
		}
	};
	var touchEnd = function(event){
		if(endX <= 100 && endX >= -100){ movego(); }
		if(endX > 100){ nextImg(); }
		if(endX < -100){ lastImg(); }
		cartoon = setInterval(nextImg,_speed);
	};

	_box.bind("touchstart",touchStart);
	_box.bind("touchmove",touchMove);
	_box.bind("touchend",touchEnd);

	_num.click(function(){
		_index = $(this).index() + 1;//因为头部多出来一个
		movego();
	});

	if(lastid != ""){
		$(lastid).click(function(){ lastImg(); });
	}
	if(nextid != ""){
		$(nextid).click(function(){ nextImg(); });
	}

}//该方法结束

//移动端图片列表放大查看-辅助用滑动事件添加
function imgOneShow_move(boxid,_length,_index){
	var startX,startY,endX,endY,startPos,_bool=true,_go=300,_width=$(window).width();//定义判断变量
	var _box = $("#"+boxid);
	var _sum = _box.find("ul");
	
	var movego = function(){
		if(_index >= _length){
				_index = _length - 1;
			}
			if(_index <= 0){
				_index = 0;
			}
		if(_sum.is(":animated")){_sum.stop(true,true);}
		var _move = -_width * _index;
		_sum.animate({left:_move+"px"},_go,function(){
			_bool = true;
		});
	};

	var nextImg = function(){
		if(_bool){
			_bool = false;
			_index++;
			movego();
		}
	};

	var lastImg = function(){
		if(_bool){
			_bool = false;
			_index--;
			movego();
		}
	};

	var _move01,_move02;//用于触碰体验增加数值
	var touchStart = function(event){
		var touch = event.originalEvent.touches[0];
		endX = 0;
		endY = 0;
		startPos = +new Date;
		startX = touch.pageX;
		startY = touch.pageY;
		_move01 = -_width * _index;//获取当前位置
		_move02 = _move01;//初始化变化值
	};
	var touchMove = function(event){
		event.preventDefault();//这里很重要！！！
		var touch = event.originalEvent.touches[0];
		var endPos = {x:startX-touch.pageX,y:startY-touch.pageY};
		var isScrolling = Math.abs(endPos.x)< Math.abs(endPos.y) ? 1:0;//isScrolling为1时，表示纵向滑动，0为横向滑动
		if(isScrolling === 0){
			endX = (startX-touch.pageX);
			//endY = (startY-touch.pageY);
			_move02 = _move01 - endX;
			_sum.css("left",_move02+"px");
		}
	};
	var touchEnd = function(event){
		if(endX <= 100 && endX >= -100){ movego(); }
		if(endX > 100){ nextImg(); }
		if(endX < -100){ lastImg(); }
	};

	_box.bind("touchstart",touchStart);
	_box.bind("touchmove",touchMove);
	_box.bind("touchend",touchEnd);
}
//移动端图片列表放大查看
function imgOneShow(myid,_zindex){
    var _name = $(myid).get(0).tagName;
	var _id = "myimgone";
	var _onearr = $(myid).parent().find(_name);
	var _length = _onearr.length;
	var _sumwidth = _length * $(window).width();
	var _index = $(myid).index();
	var _sumleft = -$(window).width() * _index;
	var _imgtext = '';
	//alert(_onearr.eq(0).css("background-image").split("\"")[1]);
	for(var i=0;i<_length;i++){
		_imgtext += '<li style="float:left;height:100%;line-height:'+$(window).height()+'px;width:'+$(window).width()+'px;"><div onclick="$(this).parent().parent().parent().remove();" style="position:absolute;width:100%; height:100%; left:0; top:0;"></div><img src="'+_onearr.eq(i).attr("_src")+'" style="display:inline-block;vertical-align:middle;width:100%;" /></li>';
	}
	var _html = '<aside id="'+_id+'" style="z-index:'+_zindex+'; position:fixed; width:100%; height:100%; left:0; top:0; overflow:hidden;">'
		+'<div style="background:rgba(0,0,0,0.6);position:fixed; width:100%; height:100%; left:0; top:0;"></div>'
		+'<span style="position:fixed;right:3%; top:2%; color:#000;z-index:5;display:inline-block;background:rgba(255,255,255,0.7); padding:0 10px; line-height:20px; border-radius:10px; font-size:14px;" onclick="$(this).parent().remove();">X 关闭</span>'
		+'<ul style="position:relative;left:'+_sumleft+'px;height:100%;width:'+_sumwidth+'px;overflow:hidden;">'+_imgtext+'</ul>'
		+'</aside>';
	$("body").append(_html);
	imgOneShow_move(_id,_length,_index);
}

//评价星星效果
function reviewsStar(myid,_hover,_score){
	var _obj = $(myid);
	var _box = _obj.parent();
	var _arr = _box.find(_obj.get(0).tagName);
	var _length = _arr.length;
	var _index = _obj.index();
	_arr.removeClass(_hover);
	for(var i=0;i<=_index;i++){
		_arr.eq(i).addClass(_hover);
		}
	_index++;
	_box.find(_score).html(_index+"分");
}

//横向滑动选项卡
function slidingCheckTit(_index,boxid,sumid,_name,_hover){
	var _outwidth,_sumwidth,_indexleft,_maxleft,_left,startX,startY,endX,endY,startPos;
	var _box = $(boxid);
	var _sum = _box.find(sumid);
	var _arr = _sum.find(_name);
	var _length = _arr.length;
	_arr.eq(_index).addClass(_hover).siblings().removeClass(_hover);
	_arr.css({"padding":"0","margin":"0","float":"left"});
	
	var _sumsize = function(){
		_sumwidth = 0;
		_indexleft = 0;
		_left = 0;
		for(var i=0;i<_length;i++){
			_sumwidth += _arr.eq(i).width();
			if(i < _index){
				_indexleft -= _arr.eq(i).width();
				}
			}
		_maxleft = _outwidth - _sumwidth;
		_sum.width(_sumwidth*1.5);
		//判断位置
		if(_sumwidth > _outwidth){
			_left = _indexleft + (_outwidth/2) - (_arr.eq(_index).width()/2);
			if(_left > 0){ _left = 0; }
			if(_maxleft > _left){ _left = _maxleft;}
			}
		_sum.css("left",_left+"px");
	};
	
	var _starSize = function(){
		_outwidth = $(window).width();
		_box.width(_outwidth);
		_sumsize();
	};
	_starSize();
	$(window).resize(function(){ _starSize(); });
	
	var _move01,_move02;//用于触碰体验增加数值
	var touchStart = function(event){
		var touch = event.originalEvent.touches[0];
		endX = 0;
		endY = 0;
		startPos = +new Date;
		startX = touch.pageX;
		startY = touch.pageY;
		_move01 = _left;//获取当前位置
		_move02 = 0;
	};
	var touchMove = function(event){
		var touch = event.originalEvent.touches[0];
		var endPos = {x:startX-touch.pageX,y:startY-touch.pageY};
		var isScrolling = Math.abs(endPos.x)< Math.abs(endPos.y) ? 1:0;//isScrolling为1时，表示纵向滑动，0为横向滑动
		if(isScrolling === 0){
			event.preventDefault();//这里很重要！！！
			endX = (startX-touch.pageX);
			//endY = (startY-touch.pageY);
			_move02 = _move01 - endX;
			_sum.css("left",_move02+"px");
		}
	};
	var touchEnd = function(event){
		_left = _move02;
		if(_left > 0){ _left = 0; }
		if(_maxleft > _left){ _left = _maxleft;}
		_sum.animate({"left":_left+"px"},300);
	};

	_box.bind("touchstart",touchStart);
	_box.bind("touchmove",touchMove);
	_box.bind("touchend",touchEnd);
}

//选项卡部分
function menuCheckShow(menuid,mname,sumid,sname,_hover,_starnum){
	var _menu = $("#"+menuid).find(mname);
	var _arr = $("#"+sumid).find(sname);
	var _index = _starnum;
	_menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
	_arr.eq(_index).css("display","block").siblings().css("display","none");
	_menu.hover(function(){
		_index = $(this).index();
		_menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
	_arr.eq(_index).css("display","block").siblings().css("display","none");
		});
	_menu.click(function(){
		_index = $(this).index();
		_menu.eq(_index).addClass(_hover).siblings().removeClass(_hover);
	_arr.eq(_index).css("display","block").siblings().css("display","none");
		});
}

//多选、全选按钮-多用于购物车
function myCarCheckbox(liname,lihover,sumname,sumhover){
	var _arr = $(liname);
	var _sum = $(sumname);
	
	_arr.click(function(){
		var _nowlength = $(liname+' input:not(:checked)').length;
		if($(this).find("input").is(":checked")){
			$(this).find("input").prop("checked",false);
			$(this).removeClass(lihover);
			_sum.removeClass(sumhover);
			_sum.find("input").prop("checked",false);
			}else{
				$(this).find("input").prop("checked",true);
				$(this).addClass(lihover);
				if($(liname+' input:checked').length == _arr.length){
					_sum.addClass(sumhover);
					_sum.find("input").prop("checked",true);
					}
				}
		});
	_sum.click(function(){
		if($(this).find("input").is(":checked")){
			_arr.find("input").prop("checked",false);
			_arr.removeClass(lihover);
			$(this).find("input").prop("checked",false);
			$(this).removeClass(sumhover);
			}else{
				_arr.find("input").prop("checked",true);
				_arr.addClass(lihover);
				$(this).find("input").prop("checked",true);
				$(this).addClass(sumhover);
				}
		});
}

//点击或滑动关闭当前弹窗
function winCloseMyWin(boxid){
	var _arr = $(boxid);
	_arr.click(function(){
		$(this).parent().fadeOut(200);
	});
	var touchStart = function(event){
		var touch = event.originalEvent.touches[0];
		$(this).parent().fadeOut(200);
	};
	_arr.bind("touchstart",touchStart);
}



