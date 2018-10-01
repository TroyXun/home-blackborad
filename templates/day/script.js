$(function () {
    getAllDay ();
});

function getAllDay () {
    $.get('//home.itroy.cc/day/getAllContent',
        function (data, status) {
            for (var i = 0; i < data.length; i++) {
                $('.day-list').append ('\
            <div class="day-item" day-id="' + data[i]['id'] + '">\
                <div class="day-item-content">\
                    <div class="day-item-content-text">' + data[i]['content'].replace(RegExp ('\n', 'g'), '<br>') + '</div>\
                    <div class="day-item-content-time">' + convertTimestamp (data[i]['timestamp']) + '</div>\
                </div>\
                <div class="day-item-action">\
                    <span class="day-item-time">修改于 ' + convertTimestamp (data[i]['edit_timestamp']) + '</span>\
                    <button class="edit">修改</button>\
                    <button class="delete">删除</button>\
                </div>\
            </div>');
            }
            
            bindInitialize ();
        }
    );
}

function bindInitialize () {
    $('.edit').click(function () {
        var id = $(this).parent().parent().attr('day-id');
        location.href = 'day/edit?id=' + id;
    });
    
    $('.delete').click(function () {
        var id = $(this).parent().parent().attr('day-id');
        $.post('//home.itroy.cc/day/delete', {id: id},
            function (data, status) {
                if (status != 'success') {
                    console.log ('[Tencoe Error] System Error: ' + status);
                    return false;
                }
            }
        , 'json');
        refreshDay ();
    });
    
    $('#new').click(function () {
        location.href = 'day/new';
    });
}

function refreshDay () {
    $('.day-list').html('');
    getAllDay ();
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
