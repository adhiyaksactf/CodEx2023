<?php
error_reporting(0);

if (isset($_GET['source'])) {
  highlight_file(__FILE__);
  die();
}

define('APP_RAN', true);
require('flag.php');

class myshop
{
  public $cookie_type = 'porosxbcc';
  public $user_type = 'Common_User'; // Set the user_type to 'Common_User' for non-VIP users
  public $wallet = 10; // Initial wallet balance
  public $purchasedFlag = false; // Flag to track if the user has purchased a flag

  public function is_vip()
  {
    return $this->user_type === 'VIP_User';
  }

  public function purchaseFlagProduct($productPrice)
  {
    if ($this->wallet >= $productPrice) {
      $this->wallet -= $productPrice;
      $this->purchasedFlag = true;
      return true;
    } else {
      return false;
    }
  }

  public function hasPurchasedFlag()
  {
    return $this->purchasedFlag;
  }

  public function getWalletBalance()
  {
    return $this->wallet;
  }

  public function __sleep()
  {
    return ['cookie_type', 'user_type', 'wallet', 'purchasedFlag'];
  }
}

if (!isset($_COOKIE['user'])) {
  $common_user = new myshop;
  $_COOKIE['user'] = base64_encode(serialize($common_user));
  setcookie('user', $_COOKIE['user'], time() + 1 * 30 * 24 * 3600, "/");
}

if (isset($_POST['user'])) {
  setcookie('user', $_POST['user'], time() + 1 * 30 * 24 * 3600, "/");
}

if (isset($_POST['purchase'])) {
  try {
    $user_data = base64_decode($_COOKIE['user']);
    if ($user_data === false) {
      throw new Exception('Invalid user data in the cookie');
    }
    $user = unserialize($user_data);
    
    if (!$user || !($user instanceof myshop)) {
      throw new Exception('Invalid user object');
    }

    $productPrice = (int)$_POST['purchase'];
    if ($user->is_vip()) {
      if ($user->purchaseFlagProduct($productPrice)) {
        // Purchase successful
        setcookie('user', base64_encode(serialize($user)), time() + 1 * 30 * 24 * 3600, "/");
        // Check and display the flag immediately
        if ($user->hasPurchasedFlag()) {
          echo '<h3 class="success">This Piece Of Flag For You,</h3>';
          // Display the purchased flag content based on the productPrice
          switch ($productPrice) {
            case 10:
              your_flag();
              break;
            case 100:
              your_flag2();
              break;
            case 9999:
              your_flag3();
              break;
            default:
              echo '<p>Invalid flag product price.</p>';
          }
        } else {
          echo '<p>Flag purchase successful, but you have not received the flag.</p>';
        }
      } else {
        // Insufficient balance
        echo '<p>Insufficient balance. Purchase failed.</p>';
      }
    } else {
      // Not a VIP user
      echo '<p>You Are Not VIP user</p>';
    }
  } catch (Exception $e) {
    echo '<p>Error: ' . $e->getMessage() . '</p>';
  }
}
?>

<!DOCTYPE html>
<head>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 10 15 10 15;
    }

    #title {
      text-align: center;
      background-color: #35424a;
      color: #ffffff;
      padding: 20px;
      margin-bottom: 20px;
    }

    #content {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    h1 {
      color: #35424a;
      font-size: 24px;
    }

    p {
      font-size: 16px;
      line-height: 1.5;
      color: #333333;
      margin-right: 20px;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-right: 90px;
      margin-bottom: 20px;
    }

    input[type="radio"] {
      margin-right: 20px;
      margin-bottom: 20px;
    }

    input[type="submit"] {
      background-color: #35424a;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 20px;
    }

    input[type="submit"]:hover {
      background-color: #232f33;
    }

    .success {
      color: #009900;
    }
  </style>
  <title>Jual Bendera</title>
</head>
<body>
  <!--?source-->
  <h1 id="title">Jual Bendera</h1>
  <br>

  <?php
  if (isset($_COOKIE['user']) || isset($_POST['user'])) {
    $user = unserialize(base64_decode($_COOKIE['user']));
    echo "<p>Wallet Balance: $" . $user->getWalletBalance() . "</p>";

    // Add flag products with their prices here
    $flagProducts = [
      'Flag1' => 10,
      'Flag2' => 100,
      'Flag3' => 9999,
    ];

    echo "<form action='./index.php' method='post'>";
    foreach ($flagProducts as $productName => $productPrice) {
      echo "<label>$productName ($$productPrice)</label> <input type='radio' name='purchase' value='$productPrice'><br>";
    }
    echo "<input type='submit' value='Purchase'>";
    echo "</form>";
  }
  ?>
</body>
</html>
