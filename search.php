<?php
//Check if search data was submitted

include('database.php');
if(isset($_POST['search_keyword'])) {

    $search_keyword = $dbconfig->real_escape_string($_POST['search_keyword']);
    $query = "SELECT symbol, name FROM ftse100 WHERE symbol LIKE '%$search_keyword%' or name like '%$search_keyword%'
 union SELECT symbol, name FROM ftse250 WHERE symbol LIKE '%$search_keyword%' or name like '%$search_keyword%' limit 10";
    $result = $dbconfig->query($query);


    if ($result === false) {
        trigger_error('Error: ' . $dbconfig->error, E_USER_ERROR);
    } else {
        $rows_returned = $result->num_rows;
    }

    $bold_search_keyword = '<strong>' . $search_keyword . '</strong>';
    if ($rows_returned > 0) {
        while ($rows = $result->fetch_assoc()) {
            echo '<div class="show" align="left"><span class="name">' . str_ireplace
                ($search_keyword, $bold_search_keyword, $rows['name']) . '</span></div>';
        }
    } else {
        echo '<div class="show" align="left">No matching records.</div>';
    }
}
?>
