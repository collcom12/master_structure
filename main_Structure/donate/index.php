<html><body>
<?php
$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
$unique =$today.$rand;

require_once 'configDB.php';
$sql = "INSERT INTO donor (name, email, mobile,amount,payment_id)
VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['mobile']."','".$_POST['amount']."','$unique')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

require_once 'razorpay-php/Razorpay.php';
use Razorpay\Api\Api;

$apiKey =" ";
$secretKey = "  ";
$api = new Api($apiKey, $secretKey);

$CUSTOMER_NAME = $_POST['name'];
$CUSTOMER_EMAIL = $_POST['email'];
$CUSTOMER_MOBILE = $_POST['mobile'];
$PAY_AMT = $_POST['amount']*100;

/*
 * To create order to RazorPay
 */
$order = $api->order->create(array(
    'receipt' => rand(1000, 9999) . 'ORD',
    'amount' => $PAY_AMT,
    'payment_capture' => 1,
    'currency' => 'INR',
        )
);
?>

<meta name="viewport" content="width=device-width">
<form action="sucess.php" method="POST">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script>
    $(window).on('load', function() {
     jQuery('.razorpay-payment-button').click();
     jQuery('.razorpay-payment-button').hide();
    });
  </script>
<script

    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $apiKey; ?>" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
    data-amount="<?php echo $order->amount ?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
    data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
    data-order_id="<?php echo $order->id ?>"//Replace with the order_id generated by you in the backend.
    data-buttontext="Pay with Razorpay"
    data-name="Jerald Lawrence"
    data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
    data-image="https://example.com/your_logo.jpg"
    data-prefill.name="<?php echo $CUSTOMER_NAME; ?>"
    data-prefill.email="<?php echo $CUSTOMER_EMAIL; ?>"
    data-prefill.contact="<?php echo $CUSTOMER_MOBILE; ?>"
    data-theme.color="#364f6b"
    data-notes.Name="<?php echo $_POST['name'];?>"
    data-notes.Mobile="<?php echo $_POST['mobile'];?>"
    data-notes.Email="<?php echo $_POST['email'];?>"
    data-notes.City="<?php echo $_POST ['address'];?>"

></script>
<script>
jQuery(function(){
   jQuery('data-buttontext').click();
});
</script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form></body>
</html>
