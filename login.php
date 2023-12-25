#!/usr/local/bin/php
<?php
 session_save_path(__DIR__ . '/sessions/');
 session_name('myWebpage');
 session_start();

 $incorr_submiss = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        if (!validate($username, $password, $incorr_submiss)) {
            $_SESSION['loggedin'] = false;
            
        } else {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        }
    }
}

function validate($username, $password, &$incorr_submiss) {
    $file = fopen('h_password.txt', 'r') or die('Unable to find the hashed password');

    $hashed_password = fgets($file);
    $hashed_password = trim($hashed_password);

    fclose($file);
    $hashed_submiss = hash('md2', $password);

    if (
        validate_username($username) &&
        $hashed_submiss === $hashed_password
    ) {
        
        return true;
    } 
    if(validate_username($username) && $hashed_submiss !== $hashed_password){ 
        
        $incorr_submiss = true;
        global $error_message;
        $error_message = 'Invalid password!';
        return false;
    }if(!validate_username($username) && $hashed_submiss !== $hashed_password) {
       
        $incorr_submiss = true;
        global $error_message;
        $error_message = 'Invalid password!';
        return false;
    }
    if(!validate_username($username) && $hashed_submiss === $hashed_password){ 
        
        $incorr_submiss = true;
        return false;
    }
}

function validate_username($username) {
    return preg_match('/^[a-zA-Z0-9!@#$%^*()\-_+\[\]{}:\'|\`~<.>\/?]+$/', $username)
        && !preg_match('/\s|,|;|=|&/', $username)
        && strlen($username) >= 5
        && strlen($username) <= 40;
}
?>
<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width" > 
    <title>Login</title>
    <script src="username.js" defer></script>
    <script src="login.js" defer></script>
    
</head>
<body>
    <h1>Welcome! Ready to check out my webpage?</h1>

    <section>
        <h2>Enter a username</h2>
        <p>So that you can make your own posts and purchases, select a username and password.</p>

        <form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" autocomplete="off"><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <input type="submit" id="submit-button" value="Login">
            </fieldset>
            <div ><?php echo $error_message; ?></div><br>
            </form>
            
        
    </section>

    <footer>
        &copy; 2023 Armine Meseldzhyan
    </footer>
</body>
</html>