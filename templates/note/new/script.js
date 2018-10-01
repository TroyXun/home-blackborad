$(function () {
    $('#new').click(function () {
        $.post('//home.itroy.cc/note/add', {content: $('.note-content').val()},
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
