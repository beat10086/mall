Date.prototype.format = function(format) {
    var date = {
        "M+": this.getMonth() + 1,
        "d+": this.getDate(),
        "h+": this.getHours(),
        "m+": this.getMinutes(),
        "s+": this.getSeconds(),
        "q+": Math.floor((this.getMonth() + 3) / 3),
        "S+": this.getMilliseconds()
    };
    if (/(y+)/i.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
    }
    for (var k in date) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1
                ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
        }
    }
    return format;
}
Date.prototype.timeAgo = function() {
    var now = new Date();
    now = now.getTime();
    var list = {h:'小时前', m:'分钟前', s:'秒前', n:'刚刚'};

    var timeDiff = now - this.getTime();
    if (timeDiff > 24*60*60*1000) {
        // 超过一天，显示具体日期
        return this.format('yyyy-MM-dd');
    } else if (timeDiff > 60*60*1000) {
        // 大于一小时，显示**小时前
        return Math.floor(timeDiff/(60*60*1000)) + list.h;
    } else if (timeDiff > 60*1000) {
        // 大于一分钟，显示**分钟前
        return Math.floor(timeDiff/(60*1000)) + list.m;
    } else if (timeDiff > 1000) {
        // 大于一秒，显示**秒前
        return Math.floor(timeDiff/1000) + list.s;
    } else {
        return list.n;
    }
}
