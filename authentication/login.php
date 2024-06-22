<?php
// Start session
session_start();
require_once '../conn.php';
$conn = createConn();
// Database connection

// Function to sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to validate username
function validate_username($username)
{
    // Username should be alphanumeric and between 3 to 20 characters
    return preg_match('/^[a-zA-Z0-9]{3,20}$/', $username);
}

// Function to validate password
function validate_password($password)
{
    // Password should be at least 8 characters and include at least one letter and one number
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password);
}

// Handle user login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $username = sanitize_input($_POST["username"]);
    $password = sanitize_input($_POST["password"]);

    // Validate user input
    if (validate_username($username) && validate_password($password)) {
        // Retrieve user from database
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Set session variables
                $_SESSION["username"] = $username;
                $_SESSION["full_name"] = $row["full_name"];
                $_SESSION["logged_in"] = true;
                // Redirect to dashboard or other page
                if ($row["is_admin"] === 1) {
                    header('Location: ../admin_panel/dashboard-.php');
                    exit; // Ensure script stops execution after redirect
                } else {
                    header('Location: ../index.php');
                    exit; // Ensure script stops execution after redirect
                }
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Invalid username or password.";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Invalid username or password format.";
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Login</title>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-xs">
        <h2 class="text-2xl font-bold mb-4 text-center">User Login Form</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label for="login_username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                <input type="text" id="login_username" name="username" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label for="login_password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="login_password" name="password" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <input type="submit" value="Login"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </div>

            <p class="mt-4 text-center text-gray-600">Don't have an account? <a href="register.php"
                    class="text-blue-500 hover:text-blue-800">Register Now</a></p>
        </form>
    </div>
</body>


</html>