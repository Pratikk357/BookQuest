<?php include 'header.php'; ?>

<?php
function createDB($servername, $username, $password)
{
    $conn = mysqli_connect($servername, $username, $password);
    $sql = "CREATE DATABASE IF NOT EXISTS `bookDB`";
    if ($conn->query($sql) !== TRUE) {
        echo "Creation Failed.";
    }
    $conn->close();
}

function createTable($servername, $username, $password, $db)
{
    $conn = mysqli_connect($servername, $username, $password, $db);
    $sql = "CREATE TABLE if not exists books(
        id  INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(50),
        author VARCHAR(40),
        price INT
        );";
    if ($conn->query($sql) !== TRUE) {
        echo "Creation Failed.";
    };
    $conn->close();
}

function displayBooks($servername, $username, $password, $db){
    $conn = mysqli_connect($servername, $username, $password, $db);
    if (!$conn) {
        die("Connection Failed");
    }
    
    $result = mysqli_query($conn,"SELECT * FROM books");
    echo '<div class="max-w-md mx-auto my-8 bg-white p-8 border rounded shadow-md">';
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo '<p class="text-lg font-semibold mb-2">Title: ' . $row["title"] . '</p>';
            echo '<p class="text-gray-700">Author: ' . $row["author"] . '</p>';
            echo '<hr class="my-4">';
        }
        $result->free();
    } else {
        echo '<p class="text-red-500">Error Duh</p>';
    }
    echo '</div>';
    
    $conn->close();
}
function main()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "bookDB";
    
    createDB($servername, $username, $password);
    createTable($servername, $username, $password, $db);
    displayBooks($servername, $username, $password, $db);
    
}

echo main();
?>



<?php include 'footer.php'; ?>