$(function () {
    var id = location.search;
    id = id.split('=');
    id = id[1];
    
    $.post('//home.itroy.cc/day/getContent', {id: id},
        function (data, status) {
            $('.day-content').html (data[0]['content'].replace(RegExp ('\n', 'g'), '<br>'));
            $('.day-time').val (convertTimestamp (data[0]['timestamp']));
        }
    );
    
    $('#save').click(function () {
        var daytime = $('.day-time').val().split('T');
        var date = daytime[0];
        var time = daytime[1];
        var timestamp = Date.parse(date.replace(RegExp ('-', 'g'), '/') + " " + time);
        $.post('//home.itroy.cc/day/edit', {id: id, timestamp: timestamp, content: $('.day-content').val()},
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
    
    return date + 'T' + time;
}
