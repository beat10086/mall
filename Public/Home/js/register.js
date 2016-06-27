$('#form input').focus(function() {
    $(this).siblings('.tips').show();
    $(this).addClass('input-focus');
});
$('#form input').blur(function() {
    $(this).siblings('.tips').hide();
    $(this).removeClass('input-focus');
});
$('#username').blur(function() {
    var _val = $(this).val(),
            _test = /^[a-z0-9](?:\w|-){3,19}$/i.test(_val);
    if (_test) {
        $.post(
                control + '/checkUserExist.html',
                {"username": _val}, function(data) {
            if (data == "1") {
                $(this).parent('td').addClass('error');
            } else {
                $(this).siblings('b').addClass('success');
            }
        }, 'text');
    } else {
        $(this).parent('td').addClass('error');
    }
});
$('.captcha').click(function() {
    $('#captcha').attr('src', control + '/captcha/num/' + Math.random());
    return false;
});
$('#email').blur(function() {
    var email = $(this).val(),
            _this = $(this);
    $.post(control + '/checkEmail',
            {"email": email},
    function(data) {
        if (data.status) {
            _this.parent('td').addClass('error');
            _this.next().html('对不起，Email已经存在！').show();
        } else {
            _this.parent('td').removeClass('error');
            _this.next().html('请输入常用的邮箱，将用来找回密码、接收订单通知等！');
        }
    }, 'JSON'
            )
});