$(function () {
    var tabDo = '';
    if (IsPC()) {
        tabDo = 'click';
    } else {
        tabDo = 'touchend';
    }

    //返回按钮的绑定
    $('.my_back').on(tabDo, function () {
        gobackview();
    });

    //购买按钮的绑定
    $("#buybuttom").on(tabDo, function () {
        $('body').append('<div class="weui-mask weui-mask--visible"></div>');
        var url=$("#buybuttom").attr("data-url");
        var mytype=$('input:radio[name="buyUser"]:checked').val();
        var paytype=$('input:radio[name="payStyle"]:checked').val();
        $.post(url,{type:mytype,paytype:paytype},function(data){
            checkLogin(data);
            setTimeout(function () {
                $(".weui-mask").remove();
            }, 4000);

            if(data[0]==3){
                window.location.href=data[1];
            }else{
                respond(data);
            }


        });

    });

    //购买充值的绑定
    $("#chongzhi").on(tabDo, function () {
        $('body').append('<div class="weui-mask weui-mask--visible"></div>');
        var url=$(this).attr("data-url");
        var jine=$('#chongzhijine').val();
        $.post(url,{jine:jine},function(data){
            checkLogin(data);




            setTimeout(function () {
                $(".weui-mask").remove();
            }, 2000);

            if(data[0]==1){
                window.location.href=data[1];
            }else{
                respond(data);
            }


        });

    });

    $('#task_danjia,#task_num').bind('input propertychange', function() {

        $("#task_sum").val(($("#task_num").val()*$("#task_danjia").val()).toFixed(2))

    });

    //插入任务的绑定
    $("#insertTask").on(tabDo, function () {

        $('body').append('<div class="weui-mask weui-mask--visible"></div>');
        var url=$(this).attr("data-url");
        var toUrl=$(this).attr("data-tourl");

        var that=this;
        $.post(url,$("#tasktijiao").serialize(),function(data){
            $(".weui-mask").remove();
            checkLogin(data);
            respond(data);
            if(data[0]==1){
                //跳转走,去支付
                alert(data[1]);
                window.location.href =toUrl+"?id="+data[2];
            }else{

            }

        });

    });

    //插入任务的支付
    $("#zhifuTask").on(tabDo, function () {

        $('body').append('<div class="weui-mask weui-mask--visible"></div>');
        var url=$(this).attr("data-url");
        var toUrl=$(this).attr("data-tourl");
        var mytype=$('input:radio[name="zhifutype"]:checked').val();
        var oid=$(this).attr("data-oid");

        var that=this;
        $.post(url,{type:mytype,oid:oid},function(data){
            $(".weui-mask").remove();
            checkLogin(data);
            respond(data);
            if(data[0]==1){
                alert(data[1]);
                window.location.href =toUrl;
            }else{
            }
        });
    });

    //领取任务
    $("#getTask").on(tabDo, function () {

        $('body').append('<div class="weui-mask weui-mask--visible"></div>');
        var url=$(this).attr("data-url");

        var id=$(this).attr("data-id");

        var that=this;
        $.post(url,{id:id},function(data){
            $(".weui-mask").remove();
            checkLogin(data);
            respond(data);

        });
    });

    //提交任务
    $("#tijiaoTask").on(tabDo, function () {

        $('body').append('<div class="weui-mask weui-mask--visible"></div>');
        var id=$(this).attr("data-id");
        var img=$("#tijiaoimg").val();
        var url=$(this).attr("data-url");

        var that=this;
        $.post(url,{id:id,img:img},function(data){
            $(".weui-mask").remove();
            checkLogin(data);
            respond(data);

        });
    });


    //未开放的功能提示
    $("#weikaifang").on(tabDo, function () {
        alert(2);
      //  $.toast("暂未开放", "forbidden");

    });



    //提示框
    $.MsgBox = {
        Alert: function (title, msg) {
            GenerateHtml("alert", title, msg);
            btnOk();  //alert只是弹出消息，因此没必要用到回调函数callback
            btnNo();
        },
        Confirm: function (title, msg, callback) {
            GenerateHtml("confirm", title, msg);
            btnOk(callback);
            btnNo();
        }
    }
    //生成Html
    var GenerateHtml = function (type, title, msg) {
        var _html = "";
        _html += '<div id="mb_box"></div><div id="mb_con"><span id="mb_tit">' + title + '</span>';
        _html += '<a id="mb_ico">x</a><div id="mb_msg">' + msg + '</div><div id="mb_btnbox">';
        if (type == "alert") {
            _html += '<input id="mb_btn_ok" type="button" value="确定" />';
        }
        if (type == "confirm") {
            _html += '<input id="mb_btn_ok" type="button" value="确定" />';
            _html += '<input id="mb_btn_no" type="button" value="取消" />';
        }
        _html += '</div></div>';
        //必须先将_html添加到body，再设置Css样式
        $("body").append(_html);
        //生成Css
        GenerateCss();
    }

    //生成Css
    var GenerateCss = function () {
        $("#mb_box").css({ width: '100%', height: '100%', zIndex: '99999', position: 'fixed',
            filter: 'Alpha(opacity=60)', backgroundColor: 'black', top: '0', left: '0', opacity: '0.6'
        });
        $("#mb_con").css({ zIndex: '999999', width: '74%', position: 'fixed',
            backgroundColor: 'White', borderRadius: '5px','margin':'0 auto;'
        });
        $("#mb_tit").css({ display: 'block', fontSize: '14px', color: '#444', padding: '10px 15px',
            backgroundColor: '#fff', borderRadius: '5px 5px 0 0',
            borderBottom: '1px solid #EEEEF0', fontWeight: 'bold'
        });
        $("#mb_msg").css({ padding: '20px', lineHeight: '20px',
            borderBottom: '1px solid #EEEEF0', fontSize: '13px',color:'#000000'
        });
        $("#mb_ico").css({ display: 'none', position: 'absolute', right: '10px', top: '9px',
            border: '1px solid Gray', width: '18px', height: '18px', textAlign: 'center',
            lineHeight: '16px', cursor: 'pointer',color:'#000000', borderRadius: '12px', fontFamily: '微软雅黑'
        });
        $("#mb_btnbox").css({ margin: '15px 0 10px 0', textAlign: 'center' });
        $("#mb_btn_ok,#mb_btn_no").css({ width: '85px', height: '30px', color: 'white', border: 'none' ,'border-radius':'2px','-webkit-appearance':'none'});
        $("#mb_btn_ok").css({ backgroundColor: '#1FB920' });
        $("#mb_btn_no").css({ backgroundColor: 'gray', marginLeft: '20px' });
        //右上角关闭按钮hover样式
        $("#mb_ico").hover(function () {
            $(this).css({ backgroundColor: 'Red', color: 'White' });
        }, function () {
            $(this).css({ backgroundColor: '#DDD', color: 'black' });
        });
        var _widht = document.documentElement.clientWidth;  //屏幕宽
        var _height = document.documentElement.clientHeight; //屏幕高
        var boxWidth = $("#mb_con").width();
        var boxHeight = $("#mb_con").height();
        //让提示框居中
        $("#mb_con").css({ top: (_height - boxHeight) / 2 + "px", left: (_widht - boxWidth) / 2 + "px" });
    }
    //确定按钮事件
    var btnOk = function (callback) {
        $("#mb_btn_ok").click(function () {
            $("#mb_box,#mb_con").remove();
            if (typeof (callback) == 'function') {
                callback();
            }
        });
    }
    //取消按钮事件
    var btnNo = function () {
        $("#mb_btn_no,#mb_ico").click(function () {
            $("#mb_box,#mb_con").remove();
        });
    }

    //调用示例
    //$.MsgBox.Alert("消息", "哈哈，添加成功！");

    //function test() {
    //alert("你点击了确定,进行了修改");
    //}
    //也可以传方法名 test
    //$("#update").bind("click", function () {
    //$.MsgBox.Confirm("温馨提示", "确定要进行修改吗？", test);
    //});
})

function gobackview() {
    history.go(-1); //后退1页

}
function IsPC(){
    var userAgentInfo = navigator.userAgent;
    var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod");
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }
    }
    return flag;
}

function checkLogin(data){
    if(data[0]==9 ){
        $.MsgBox.Alert("消息", data[1]);
        return false;
    }
}

//通用返回提示消息
function respond(data){
    if(data[0]==1){
        $.MsgBox.Alert("消息", data[1]);

    }else if(data[0]==2){
        $.MsgBox.Alert("消息", data[1]);
    }else{
        $.MsgBox.Alert("消息", '异常出错');
    }
}

function registerUserCode(url,tUrl) {
    $.post(url,$("#registerUser").serialize(),function(data){
        checkLogin(data);
        respond(data);
        if(data[0]==1){
            alert(data[1]);
            //判断是苹果还是安卓
            if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {  //判断iPhone|iPad|iPod|iOS
                //alert(navigator.userAgent);
                window.location.href ="https://fir.im/hsgq";

            } else if (/(Android)/i.test(navigator.userAgent)) {   //判断Android
                //alert(navigator.userAgent);
                window.location.href ="https://fir.im/jx18";
            } else {  //pc

                window.location.href ="https://fir.im/jx18";
            };

             //window.location.href=tUrl;
        }

    });
}


function changeCode() {
    var that = document.getElementById('code_img');
    that.src = that.src + '&' + Math.random();

}
function gettxyzm(url){
    $("#gettxyzmb").html('正在发送');

    $.get(url,function(data) {
        checkLogin(data);
        respond(data);
        $("#gettxyzmb").html('');
    });


}

function insertTixian(url) {
    $.post(url,$('#tixian').serialize(),function(data){
        checkLogin(data);
        respond(data);
        if(data[0]==1){
            //alert(data[1]);
           // setTimeout("location.reload()",1000);
        }
    });
}