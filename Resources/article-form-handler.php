<?php

    function getContentHtml($contentMd) {
        $tmpDir = 'Tmp\\'; //may change to ../Resources/
        $tmpFileMd = 'tmp-article.md';
        $tmpFileHtml = 'tmp-article.html';
        $currDir = getcwd();
        //Converts Markdown to Html
        file_put_contents($tmpDir.$tmpFileMd, $contentMd);
        $contentHtml = file_get_contents($tmpDir.$tmpFileHtml);
        exec('../Resources/Tmp/convertToHtml.cmd'); //"cmd /C {$currDir}\\{$tmpDir}convertToHtml.cmd";
        return $contentHtml;

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //ob_start(); //prevents any output of data, which would disrupt header()
        require_once '../Resources/db_functions.php';
        $table = 'articles';
        $time = date('Y-m-d');

        $id = $_POST['id'];
        $dataArr = [
            ['title', $_POST['title']],
            ['subtitle', $_POST['subtitle']],
            ['author', $_POST['author']],
            ['mainImgId', $_POST['mainImgId']],
            ['scheme', $_POST['scheme']],
            ['colors', $_POST['colors']],
            ['contentMd', $_POST['contentMd']],
            ['contentHtml', getContentHtml($_POST['contentMd'])],
            ['datePosted', $time]
        ];
        $namesArr = array_column($dataArr, 0);
        $valsArr = array_column($dataArr, 1);

        $postType = $_POST['submit'];
        if ( $postType == 'Add Article' ) {
           
            $idx = db_insertData($table, $namesArr, $valsArr);
            if ($idx === false) {
                //echo 'Data could not be uploaded.';
            } else {}
        } else if ( $postType == 'Edit Article' ) {
            // log::debugDump($namesArr);
            db_updateDataById($table, array_slice($namesArr, 0), array_slice($valsArr, 0), $id);
        } else if ( $postType == 'Delete Image') {
            db_updateDataById($table, ['bActive'], ['false'], $id);
        } else {
            log::debug("Unknown submit type, check image-form-handler conditionals.");
        }
        header("Location: ".'../Main/archive');//$_SERVER['REQUEST_URI']);
        exit();
    }
    ?>