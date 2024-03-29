<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        ob_start();
        require_once '../Resources/db_functions.php';
        $table = 'images';
        $time = date('Y-m-d');
        $imagesDir = '../Images/';
        $ogName = (explode('.', $_FILES['src']['name']));
        $fileExt = end($ogName);
        $filename = 'tmp.'.$fileExt;
        $id = $_POST['id'];
        $dataArr = [
            ['filename', $fileExt],
            //['width', $_POST['width']],
            //['height', $_POST['height']],
            ['alt', $_POST['alt']],
            ['title', $_POST['title']],
            ['cite', $_POST['cite']],
            ['author', $_POST['author']],
            ['dateTaken', $_POST['date']],
            ['datePosted', $time]
        ];
        $namesArr = array_column($dataArr, 0);
        $valsArr = array_column($dataArr, 1);

        $postType = $_POST['submit'];
        if ( $postType == 'Add Image' ) {
            if (move_uploaded_file($_FILES['src']['tmp_name'], $imagesDir.$filename)) {
                
                //Success
            } else {
                //Failure
                log::debug("Could not upload file; {$_FILES['src']['error']}.");
            }
            
            $idx = db_insertData($table, $namesArr, $valsArr);
            if ($idx === false) {
                //echo 'Data could not be uploaded.';
            } else {
                rename($imagesDir.'tmp.'.$fileExt, $imagesDir.strval($idx).'.'.$fileExt );
            }
        } else if ( $postType == 'Edit Image' ) {
            // log::debugDump($namesArr);
            db_updateDataById($table, array_slice($namesArr, 1), array_slice($valsArr, 1), $id);
        } else if ( $postType == 'Delete Image') {
            db_updateDataById($table, ['bActive'], ['false'], $id);
        } else {
            log::debug("Unknown submit type, check image-form-handler conditionals.");
        }
        header("Location: ".'../Main/images');//$_SERVER['REQUEST_URI']);
        exit();
    }
    ?>