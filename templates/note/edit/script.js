$(function () {
    var id = location.search;
    id = id.split('=');
    id = id[1];
    
    $.post('//home.itroy.cc/note/getContent', {id: id},
        function (data, status) {
            console.log(data);
            $('.note-content').html (data[0]['content'].replace(RegExp ('\n', 'g'), '<br>'));
        }
    );
    
    $('#save').click(function () {
        $.post('//home.itroy.cc/note/edit', {id: id, content: $('.note-content').val()},
            function (data, status) {
                if (status != 'success') {
                    console.log ('[Tencoe Error] System Error: ' + status);
                    return false;
                }
            }
        , 'json');
        
        location.href = '/note';
    });
});
