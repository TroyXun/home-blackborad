$(function () {
    $('#new').click(function () {
        var daytime = $('.day-time').val().split('T');
        var date = daytime[0];
        var time = daytime[1];
        var timestamp = Date.parse(date.replace(RegExp ('-', 'g'), '/') + " " + time);
        $.post('//home.itroy.cc/day/add', {timestamp: timestamp, content: $('.day-content').val()},
            function (data, status) {
                if (status != 'success') {
                    console.log ('[Tencoe Error] System Error: ' + status);
                    return false;
                }
            }
        , 'json');
        
        location.href = '/day';
    });
});
