<?php
require_once 'configDB.php';
echo '<xmp>'; print_r($_POST);
$sql = "INSERT INTO payment_laser (payment_id, order_id, signature_hash)
VALUES ('".$_POST['razorpay_payment_id']."', '".$_POST['razorpay_order_id']."', '".$_POST['razorpay_signature']."')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$razorpay_payment_id = $_POST['razorpay_payment_id'];
require_once 'razorpay-php/Razorpay.php';
use Razorpay\Api\Api;

$apiKey =" ";
$secretKey = " ";
$api = new Api($apiKey, $secretKey);
$payment = $api->payment->fetch($razorpay_payment_id);
$amount= $payment->amount;
$name= $payment->notes->name;
$email= $payment->notes->email;

$query="UPDATE donor SET payment_id = '".$_POST['razorpay_payment_id']."' WHERE(email = '$email')";
if ($conn->query($query) === TRUE) {
    echo "record updated";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
$conn->close();


$to_email = $email;
$subject = "Thanks For Your Support";
$body = "Dear '$name',\n
 On behalf of all of us at CollCom, thank you for your recent gift of ₹.'$amount'\n
 Your donation will be used in the enrichment and care to the needy.\n
 It is your generosity and support that makes our work possible.\n
 Thank you for your compassion and support.\n
 With gratitude,\n
 Dr Gaurav\n
 Director, CollCom";
$headers = "CollCom";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
?>
<!DOCTYPE html>
<html>
	<title>Donated Sucessfully</title>
	<body>
		<a href="  ">Go to homepage</a>
	</body>
</html>
