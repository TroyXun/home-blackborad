$(function () {
    initialize ();
    
    /** 定时刷新页面 */
    // setTimeout ('refreshPage ()', 600000);
    
    /** 时钟 */
    setInterval (updateTime, 1000);
    
    /** 定时更新倒计时 */
    setInterval (refreshDay, 30000);
    
    /** 定时更新笔记 */
    setInterval (refreshNote, 5000);
    
    setInterval (initialize, 600000);
    
    $('#time').click(function () {
        fullScreen ();
    });
});

function initialize () {
    updateTime ();
    refreshDay ();
    updateDayTime ();
    refreshNote ();
}

function updateTime () {
    var hours = new Date().getHours();
    var minutes = new Date().getMinutes();
    var seconds = new Date().getSeconds();
    if (hours < 10){
        hours = '0' + hours;
    }
    if (minutes < 10){
        minutes = '0' + minutes;
    }
    if (seconds < 10){
        seconds = '0' + seconds;
    }
    $('#time').html (hours + ':' + minutes + ':' + seconds);
}

function refreshDay () {
    $('.day').html ('');
    $.get('//home.itroy.cc/day/getAllContent',
        function (data, status) {
            for (var i = 0; i < data.length; i++) {
                var time = new Date (convertTimestamp (data[i]['timestamp']));
                var content = data[i]['content'].replace(RegExp ('\n', 'g'), '<br>');
                var id = data[i]['id'];
                $('.day').append ('<div class="day-item" day-id="' + id + '"><span class="day-text">距离 </span><span class="day-content">' + content + ' </span><span class="day-status">还有 </span><span class="day-time"></span></div>');
                updateDayTime (id, time);
            }
        }
    );
}

function refreshNote () {
    $('.note').html ('');
    $.get('//home.itroy.cc/note/getAllContent',
        function (data, status) {
            for (var i = 0; i < data.length; i++) {
                $('.note').append (data[i]['content'].replace(RegExp ('\n', 'g'), '<br>') + '<br>');
            }
        }
    );
}

function updateDayTime (id, time) {
    setInterval (function () {
        var nowTime = new Date();
        var leftTime = time - nowTime;
        console.log (time);
        if (leftTime < 0) {
            $('[day-id="' + id + '"] .day-status').html ('已过 ');
            leftTime = nowTime - time;
        } else {
            $('[day-id="' + id + '"] .day-status').html ('还有 ');
        }
        var days = parseInt (leftTime / 1000 / 60 / 60 / 24);
        var hours = parseInt (leftTime / 1000 / 60 / 60 % 24);
        var minutes = parseInt (leftTime / 1000 / 60 % 60);
        var seconds = parseInt (leftTime / 1000 % 60);
        if (days == 0) {
            days = '';
        }
        if (days == 1) {
            days = days + ' Day';
        }
        if (days > 1) {
            days = days + ' Days';
        }
        if (hours < 10){
            hours = '0' + hours;
        }
        if (minutes < 10){
            minutes = '0' + minutes;
        }
        if (seconds < 10){
            seconds = '0' + seconds;
        }
        
        $('[day-id="' + id + '"] .day-time').html (days + ' ' + hours + ':' + minutes + ':' + seconds);
    }, 1000);
}

function refreshPage () {
    window.location.reload();
}

function fullScreen() {
    if (document.body.requestFullscreen) {
        return document.body.requestFullScreen();
    } else if (document.body.webkitRequestFullScreen) {
        return document.body.webkitRequestFullScreen();
    } else if (document.body.mozRequestFullScreen) {
        return document.body.mozRequestFullScreen();
    } else {
        return document.body.msRequestFullscreen();
    }
}

function convertTimestamp (timestamp) {
    timestamp = new Date(timestamp * 1000);
    var date = timestamp.toLocaleDateString ();
    temp = date.split('\/');
    for (var i = 1; i < temp.length; i++) {
        if (temp[i].length != 2) {
        temp[i] = '0' + temp[i];
        }
    }
    date = temp.join('-');
    
    var time = timestamp.getHours() + ':' + timestamp.getMinutes() + ':' + timestamp.getSeconds();
    temp = time.split(':');
    for (var i = 0; i < temp.length; i++) {
        if (temp[i].length != 2) {
        temp[i] = '0' + temp[i];
        }
    }
    time = temp.join(':');
    
    return date + ' ' + time;
}
