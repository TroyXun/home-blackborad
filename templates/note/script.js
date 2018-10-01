$(function () {
    getAllNote ();
});

function getAllNote () {
    $.get('//home.itroy.cc/note/getAllContent',
        function (data, status) {
            for (var i = 0; i < data.length; i++) {
                $('.note-list').append ('\
            <div class="note-item" note-id="' + data[i]['id'] + '">\
                <div class="note-item-content">' + data[i]['content'].replace(RegExp ('\n', 'g'), '<br>') + '</div>\
                <div class="note-item-action">\
                    <span class="note-item-time">修改于 ' + convertTimestamp (data[i]['timestamp']) + '</span>\
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
        var id = $(this).parent().parent().attr('note-id');
        location.href = 'note/edit?id=' + id;
    });
    
    $('.delete').click(function () {
        var id = $(this).parent().parent().attr('note-id');
        $.post('//home.itroy.cc/note/delete', {id: id},
            function (data, status) {
                if (status != 'success') {
                    console.log ('[Tencoe Error] System Error: ' + status);
                    return false;
                }
            }
        , 'json');
        refreshNote ();
    });
    
    $('#new').click(function () {
        location.href = 'note/new';
    });
}

function refreshNote () {
    $('.note-list').html('');
    getAllNote ();
}

function convertTimestamp (timestamp) {
    var date = new Date((timestamp * 1000)).toLocaleDateString ();
    tmp = date.split('\/');
    if (tmp.length === 1) {
        return date;
    }
    if (tmp[1].length !== 2) {
        tmp[1] = '0' + tmp[1];
    }
    if (tmp[2].length !== 2) {
        tmp[2] = '0' + tmp[2];
    }
    return tmp.join('-');
}
