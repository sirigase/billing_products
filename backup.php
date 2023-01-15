<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
<?php
    
     $connection = mysqli_connect($servername, $username, $password, $dbname);
   
    $backupAlert = '';
    $tables = array();
    $result = mysqli_query($connection, "SHOW TABLES");
    if (!$result) {
        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
    } else {
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        mysqli_free_result($result);

        $return = '';
        foreach ($tables as $table) {

            $result = mysqli_query($connection, "SELECT * FROM " . $table);
            if (!$result) {
                $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
            } else {
                $num_fields = mysqli_num_fields($result);
                if (!$num_fields) {
                    $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
                } else {
                    $return .= 'DROP TABLE ' . $table . ';';
                    $row2 = mysqli_fetch_row(mysqli_query($connection, 'SHOW CREATE TABLE ' . $table));
                    if (!$row2) {
                        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
                    } else {
                        $return .= "\n\n" . $row2[1] . ";\n\n";
                        for ($i = 0; $i < $num_fields; $i++) {
                            while ($row = mysqli_fetch_row($result)) {
                                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                                for ($j = 0; $j < $num_fields; $j++) {
                                    $row[$j] = addslashes($row[$j]);
                                    if (isset($row[$j])) {
                                        $return .= '"' . $row[$j] . '"';
                                    } else {
                                        $return .= '""';
                                    }
                                    if ($j < $num_fields - 1) {
                                        $return .= ',';
                                    }
                                }
                                $return .= ");\n";
                            }
                        }
                        $return .= "\n\n\n";
                    }
                    date_default_timezone_set('Asia/Kolkata');
                    $backup_file = $dbname . date("Y-m-d-H-i-s") . '.sql';
                    $handle = fopen("dbbackup/{$backup_file}", 'w+');
                    fwrite($handle, $return);
                    fclose($handle);
                    $backupAlert = 'Succesfully got the backup!';
                }
            }
        }
    }
    echo $backupAlert;
    header('Location:Settings.php?s=4');
?>