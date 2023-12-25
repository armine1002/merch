#!/usr/local/bin/php
<?php
session_save_path(__DIR__ . '/sessions/');
session_name('myWebpage');
session_start();


if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit();
}


$db = new SQLite3('credit.db');


$db->exec('CREATE TABLE IF NOT EXISTS users (username TEXT PRIMARY KEY, credit REAL)');


$username = $_SESSION['username'];

//echo "Before: Username: $username, Credit: {$_SESSION['credit']}";
//if (!isset($_SESSION['credit'])) {
  
$result = $db->query("SELECT * FROM users WHERE username = '$username'");
$row = $result->fetchArray() ;

$credit = 20;

if ( $row ) {
        //echo 'aaaa';
        //$_SESSION['credit'] = $row['credit'];
        //echo "Username: $username, Credit: {$row['credit']}";
$credit = $row['credit'];
} else {
        //echo 'bbbbb';
        //$_SESSION['credit'] = 20;
        /*$ok =*/ 
$db->exec("INSERT INTO users (username, credit) VALUES ('$username', $credit)");
        //var_dump($ok);
        
}
//}

//$credit = $_SESSION['credit'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
       let username = '<?php echo $_SESSION['username']; ?>';
       let credit = <?php echo $credit; ?>;
    console.log(username);
    console.log(credit);
</script>




    <script src="merch.js?v181" defer></script>
    <title>Our Merchandise</title>
</head>
<body>
    <header>
        <h1>Our Merchandise</h1>
    </header>
    <section>
        <h2>Basic Clothing Items</h2>
        <p>Please have a look around. Our new members are awarded with $20.00 in credit. You can add credit at any time with a coupon code. When you want to make a purchase, please select the checkboxes of the items you wish to purchase and click the "Checkout" button below.</p>
       
        <p id="credit-value">Credit: $<?php echo number_format($credit, 2) ?> </p>
        <table>
            <tbody>
                 <tr>
                    <td>

                        <img src="https://www.travelandleisure.com/thmb/8pZhhNuFgiYSfM0U1f3uVOi3K4w=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/artfish-womens-sleeveless-tank-top-6a6624fce8b345ba8991a68a0301d534.jpg" width="200" alt="White basic top" >
                        <h3>White Basic Top</h3>
                        <input type="checkbox" id="checkbox1">
                        <span id="prices1"></span> 
                        <p>White slim-fitting tank</p>
                  
                    </td>
                    <td>
                        <img src="https://us.princesspolly.com/cdn/shop/products/1-model-info-Josephine-us2_839205fa-0220-446a-9d37-7ee1bbff1f58_450x610.jpg?v=1698357241" width="100" alt="Black basic top" >
                        <h3>Black Basic Top</h3>
                        <input type="checkbox" id="checkbox2">
                        <span id="prices2"></span>
                        <p>Black slim-fitting tank</p>
                  
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <img src="https://m.media-amazon.com/images/I/51HdR6bwOyL._AC_UY1000_.jpg" width="100" alt="Grey basic top" >
                        <h3>Grey Basic Topic</h3>
                        <input type="checkbox" id="checkbox3">
                        <span id="prices3"></span>
                        <p>Grey loose-fitting t-shirt</p>
                  
                    </td>
                    <td>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6ptdcwDs4gWH8JqmvXd61SeiM5LK8mcY6uw&usqp=CAU" width="100" alt="navy basic top" >
                        <h3>Navy Basic Top</h3>
                        <input type="checkbox" id="checkbox4">
                        <span id="prices4"></span>
                        <p>Navy slim-fitting t-shirt</p>
                  
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    <fieldset>
        <label for="coupon">Coupon code:</label>
        <input type="text" id="coupon">
        <button id="checkout">Checkout</button>
        <p id="message"></p>
    </fieldset>
    <footer>
        <p>&copy; 2023 Armine Meseldzhyan</p>
    </footer>
   
    </body>
</html>