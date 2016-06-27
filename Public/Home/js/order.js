/*
 * order.js Encoding:UTF-8
 * Description:
 * 2013-3-1 zhangbo1248@163.com
 * Copyright (C) 2011 zhangbo
 */
$('#address-list label').click(function() {
    var _radio = $(this).children('input');
//    if (_radio.attr('checked')) {
//        _radio.attr('checked', false);
//    }
    if (!_radio.attr('checked')) {
        _radio.attr('checked', true);
    }
    $(this).children('span').each(function() {
        var id = '#' + $(this).attr('to'),
                _text = $(this).text();
        if (id == '#city' || id == '#province' || id == '#district') {
            _text = $(this).attr('val');
        }

        $(id).val(_text);
    });
    return false;
});