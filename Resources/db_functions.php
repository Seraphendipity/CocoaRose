<?php 
require_once 'exceptions.php';
function db_connect() {
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = 'cocoarose';
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
        throw new DatabaseConnectException($conn->error);
        //die("Connection failed: " . $conn->connect_error);
    }  return  $conn;
}

function db_createTable($table, $colNames) {
    $listSQL = ''; $i = 0;
    $dataType = ( (count($args = func_get_args()) == 3) && (gettype($args) == 'array') ) ?
        $args[2] :
        false;

    foreach($colNames as $col) {
        $listSQL .= ($dataType != false && $dataType[$i] != '') ?
                    "{$col} {$dataType[$i]}" :
                    "{$col} VARCHAR(128)";
        $listSQL .= ' DEFAULT NULL, ';
        $i++;
    }

    $conn = db_connect();
    $sql = "CREATE TABLE IF NOT EXISTS {$table} ( 
                id INT AUTO_INCREMENT, 
                {$listSQL}
                PRIMARY KEY (id) 
            ) 
            ENGINE = InnoDB;";
    if ( $conn->query($sql) === false ) {
        echo "HELLO";
        log::debugDump( $sql );
        log::debug( $conn->connect_error );
        db_disconnect($conn);
        return(false);
        // throw new DatabaseCreateException("
        //     Could not create table '{$table}' with columns {$colNames}".
        //     ($dataType != false ? ' and data types '.implode(' ,', $dataType) : '.'));
    } else {
        db_disconnect($conn);
        return(true);
    }
}

function db_clearTable($table) {
    $conn = db_connect();
    $sql = "DELETE FROM {$table}";
    $conn->query($sql);
    db_disconnect($conn);
}

function db_dropTable($database, $table) {
    $conn = db_connect($database);
    $sql = "DROP TABLE {$table}";
    $conn->query($sql);
    db_disconnect($conn);
}

function db_insertData($table, $namesArr, $arrVals) {
    $qmarks = ''; $types = ''; $values = []; $bFirst = true; $i = 0;
    $names = implode(',', $namesArr);
    foreach($arrVals as $j => $value) {
        if (!$bFirst) {
            $qmarks .= ', ';
        } else {$bFirst = false;}
        $qmarks .= '?';
        $types .= (gettype($value) == 'integer') ? 'i' : 's';
            //if( gettype($value[0]) == 'integer' ) {$types .= 'i';} else {}

        if ( gettype($value) == 'array' ) {
            $values[$i] = implode('', $value);
        } else { 
            $values[$i] = $value;
        } $i++;
    }
        
    log::debugDump( $names );
    log::debugDump( $arrVals );
    log::debugDump( $values );
    log::debugDump( $qmarks );
    log::debugDump( $types );
        $conn = db_connect();
        
        $sql = $conn->prepare("INSERT INTO {$table} ({$names}) VALUES ({$qmarks})");
    if($sql === false) {/*throw new DatabaseInsertException($conn->error);*/} else{
            $sql->bind_param("{$types}", ...$values); //Arguement Unpacking
        }
    try {
        if( $sql->execute() === false) {
            $results = false;
            // throw new DatabaseInsertException($conn->error);
        } else {
            $results = $conn->insert_id;

        }
    } finally {
        db_disconnect($conn);
    }
    // var_dump( $result );
    // echo $conn->error;
    return $results;
    // THE most convenient out of the blue function Ive found: https://www.php.net/manual/en/mysqli.insert-id.php

}

function db_selectData($table) {
    $conn = db_connect();
    $sql = "SELECT * FROM {$table};";
    $result = $conn->query($sql);
    while($row = $result->fetch_array()) {
        $data[] = $row;
    }
    db_disconnect($conn);
    return $data;
}

function db_selectDataById(string $table, int $ID) {
    $conn = db_connect(); $results;
    $sql = $conn->prepare("SELECT * FROM {$table} WHERE id = ?;");
    if($sql == false) {
       // throw new DatabaseSelectionException($conn->error);
       return false;
    } else {

        $sql->bind_param('i', $ID);
        $sql->execute();
        $result = $sql->get_result();
        // $sql->bind_result($results);
        // $sql->fetch();
        $sql->close();
        db_disconnect($conn);
        return $result->fetch_assoc();
    }
}

function db_updateDataById(string $table, $namesArr, $valsArr, int $ID) {
    $types = ''; $values = []; $bFirst = true; $i = 0;
    $results = false;
    foreach($valsArr as $value) {
        if (!$bFirst) {
            $equations .= ', ';
        } else {$bFirst = false;}
        $types .= (gettype($value) == 'integer') ? 'i' : 's';
        $equations .= $namesArr[$i].'=?';
        if ( gettype($value) == 'array' ) {
            $values[$i] = implode('', $value);
        } else { 
            $values[$i] = $value;
        } 

        $i++;
    }
        $conn = db_connect();
        $stmt = "UPDATE {$table} SET {$equations} WHERE id={$ID}";
        $sql = $conn->prepare($stmt);
        var_dump($sql);
    if($sql === false) {throw new DatabaseException($conn->error);} 
    else{
        $sql->bind_param("{$types}", ...$values); //Arguement Unpacking
        if( $sql->execute() === false) {
            $results = false;
            throw new Exception($conn->error);
        } else {
        }
    }
    db_disconnect($conn);
     var_dump( $result );
     echo $conn->error;
    return $results;
}

function db_disconnect($conn) {
    $conn->close();
}

// function db_getNextIdx($table) {
//     //https://www.bram.us/2008/07/30/mysql-get-next-auto_increment-value-fromfor-table/
//     $conn = db_connect(); 
//     $query = "\"
//     SELECT AUTO_INCREMENT
//     FROM information_schema.TABLES
//     WHERE TABLE_SCHEMA = \"cocoarose\"
//     AND TABLE_NAME = \"{$table}\"
//     ";
//     return ($conn->query($query));
// }

// function fileUploadToArray($name) {
//     // Takes the $_FILES super global and converts the given filename to an array.
//     // https://stackoverflow.com/questions/5593473/how-to-upload-and-parse-a-csv-file-in-php
//     // https://www.php.net/manual/en/function.fgetcsv.php
//     // https://www.php.net/manual/en/features.file-upload.php 
//     try {
//         if( (isset($_FILES[$name]['name'])) && ($_FILES[$name]['type'] == '.csv') ) {
//             //No Error, Proceed
//             if ( ($file = fopen($_FILES[$name]['name'], 'r')) !== false ) {
//                 return (fgetcsv($file));
//             } else {
//                 throw new FileOpenException($_FILES[$name]['name']);
//             }
//         } else {
//             throw new FileUploadException('.csv', $_FILES[$name]['type'], true, 'error');
//         }
//     }  catch (Exception $e) {
//         // Msg stated, back out.
//         return false;
//     }
// }


?>