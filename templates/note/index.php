<!DOCTYPE html>
<html lang="zh-cmn-Hans-CN">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title><?php echo NOTE_NAME, ' - ', TITLE; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="shortcut icon" href="favicon.ico">
        <meta name="theme-color" content="#000">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="Troy">
        <link href="note/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <center><h1><?php echo NOTE_NAME, ' - ', TITLE; ?></h1></center>
        <div class="note-list"></div>
        <div class="note-action">
            <button id="new">新建</button>
        </div>
        
        <script src="https://static.itroy.cc/jquery/jquery-3.1.1.min.js"></script>
        <script src="note/script.js"></script>
    </body>
</html>
