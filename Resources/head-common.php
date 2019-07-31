<!DOCTYPE html> <html>
<head>
    <title><?php echo ucwords(basename($_SERVER['PHP_SELF'], '.php')); ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../style/common.css">
    <?php require_once "../Resources/image-loader.php";?>
    <?php require_once "../Resources/exceptions.php";?>
    <?php require_once '../Resources/db_functions.php';?>
