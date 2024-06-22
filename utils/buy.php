<?php
require_once '../conn.php';
$conn = createConn();
$conn->query("DELETE FROM cart");
include "../header.php";
?>
<div>Purchase success</div>
<?php include 'footer.php' ?>