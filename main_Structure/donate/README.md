# donate-razorpay
Web Integration Of Razorpay Using PHP

# Prerequisites
1.PHP Installed
2.Razorpay account
3.MYSQL database

# STEPS TO PROCEED

1.Create a account in Razorpay and generate API KEY.
2.Copy the API KEY ID & SECRET KEY and paste it in the index.php & send.php file.
3.Create a database named "razorpay" & create 2 tables named 
"PAYMENT_LASER" With fields ( pay_id | int |PRI , payment_id | varchar(255) , order_id | varchar(255), signature_hash | varchar(255), created_at | timestamp|DEFAULT-CURRENT_TIMESTAMP)
"donor " with fields ( donor_id   | int, name | varchar(255), email | varchar(255), mobile| varchar(20), payment_id | varchar(255) |PRI,amount | int)
4.Edit the config.php file with values as follows
  hostname : "localhost"
  username : "YourMySQL_ User Name" .eg- root
  password: "Your Passowrd"
  database name: "raazorpay"
 NOTE: Follow the syntax as per config.php
 5. Start the php server by
 Going through your project root folder and execute "php -S localhost:8000"  in command line.
 6.After sucessfull completion of onlne payment, the person who payed will recieve an automated mail, & the details will be updated in MYSQL databse & in razorpay dashboard.
 
