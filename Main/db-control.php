<?php require_once '../Resources/head-js.php'; ?>
<?php require_once '../Resources/body-common.php'; ?>
<div class="centeredBox">
        <h1>Database Management Form</h1>
        <p>FOR ADMIN USE ONLY.</p>
        <p>This database management form assumes you have a database named 'CocoaRose' with a user 'localhost'
            with no password. This tool is unpolished, and the only people who are to have access to this are site
            developers and administrators (re: myself); as such, you can likely find ways to break it or the 
            database. It is here for debugging purposes until a proper username/password system can be put in place.</p>
        <!-- <p> As of now, the only data type is varchar(100). Primary key is already added, and all
            columns are part of a unique ID -- there cannot be an exact duplicate row. No data
            can be NULL. A better web app could work around this better, but I'm not coding
            PHPMyAdmin here.</p> -->
        <ul>
            <li>STANDARD - RESETS with standard CocoaRose names list, as used by this web app.</li>
            <li>CREATE - if table does not exist, create it with the specified columns.</li>
            <li>DROP - drops the table completly, erasing all data and columns.</li>
            <li>CLEAR - deletes the data from the table, leaving columns/structure/ID.</li>
            <li>RESET - DROP then CREATE.</li>
        </ul>
    <form action="" method="POST" class="searchBar">
        <fieldset> 
            <legend>Table Name</legend>
            <!-- <input type="text"   name="database" value="test" placeholder="test" required> -->
            <input type="text"   name="table"    value="cocoaroseData" placeholder="" required>
        </fieldset> 

        <fieldset class="colHeaders"> 
            <legend>Column Names</legend>

            <button type="button" name="addColBtn" class="addColBtn">+</button>
        </fieldset> 

        <fieldset> 
            <legend>Submit SQL Request</legend>
        
            <select name="action" required>
                <option value="create">Create</option>
                <option value="drop">Drop</option>
                <option value="clear">Clear Data</option>
                <option value="reset">Reset</option>
                <option value="standard">Standard</option>
            </select>
            <input type="submit" value="Process SQL Request">
        </fieldset> 
        
    </form>
</div> <div class="breakClear"></div>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once '../Resources/db_functions.php';
        $tableName = $_POST['table'];
        $colNames = isset($_POST['colNames']) ? $_POST['colNames'] : [];
        $action = $_POST['action'];

        switch($action) {
            case 'create':
                if (db_createTable($tableName, $colNames)) {
                    $success = "Database created successfully.";
                } else {
                    $fail = "Database not created.";
                }
                break;
            case 'drop':
                db_dropTable($tableName);
                break;
            case 'clear':
                db_clearTable($tableName);
                break;
            case 'reset':
                db_dropTable($tableName);
                db_createTable($tableName, $colNames);
                break;
            case 'standard':
                db_createCocoaRoseTables();
                break;
            default: 
                echo "ERROR - Sorting: Unknown parameter to sort by.";
        }
        
    }

    function db_createCocoaRoseTables() {
        $imgArr = [
            ['filename', 'VARCHAR(128)'],
            ['filenameOpt', 'VARCHAR(128)'],
            ['filenameHd', 'VARCHAR(128)'],
            ['width', 'INT'],
            ['height', 'INT'],
            ['alt', 'VARCHAR(128)'],
            ['title', 'VARCHAR(128)'],
            ['cite', 'VARCHAR(2048)'],
            ['author', 'VARCHAR(128)'],
            ['dateTaken', 'DATETIME'],
            ['datePosted', 'DATETIME']
        ];

        $archiveArr = [
            ['title', 'VARCHAR(128)'],
            ['subtitle', 'VARCHAR(128)'],
            ['author', 'VARCHAR(128)'],
            ['mainImgId', 'INT'],
            ['scheme', 'VARCHAR(128)'],
            ['colors', 'VARCHAR(128)'],
            ['content', 'VARCHAR(20000)'],
            ['dateTaken', 'DATETIME'],
            ['datePosted', 'DATETIME']
        ];

        $usersArr = [
            ['username', 'VARCHAR(128)'],
            ['password', 'VARCHAR(256)'],
            ['token', 'VARCHAR(1024)'],
            ['userImgId', 'INT'],
            ['email', 'INT'],
            ['phone', 'VARCHAR(128)'],
            ['messageIds', 'VARCHAR(128)']
        ];

        db_createTable('images', array_column($imgArr,0), array_column($imgArr, 1) );
        db_createTable('content', array_column($archiveArr,0), array_column($archiveArr, 1) );
        db_createTable('users', array_column($usersArr,0), array_column($usersArr, 1) );
    }
    ?>

    <script>
        $('.addColBtn').on('click', function() {
            colInput = `
            <label class="colNames">
                <input type="text"   name="colNames[]">
                <button type="button" name="remColBtn" class="remColBtn">-</button> 
            </label> 
            `;
            //$('.colHeaders').append(colInput);
            $(this).before(colInput);
        });

        $('.colHeaders').on('click', '.remColBtn', function() {
            $(this).parent().remove();
        }); //NOTE: In this context, `this` refers to the btn that was clicked
        //        This is called event delegation, useful here due to dynamic gen
    </script>
    <?php require_once '../Resources/foot-common.php';?>