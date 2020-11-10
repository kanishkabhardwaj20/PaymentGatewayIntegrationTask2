<?php
$to = "kanishkabhardwaj20@gmail.com";
$subject = "Invoice Of Payment";

$type = $_GET['type'];
$amount = $_GET['amount'];
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}


$tran_id = random_str(8);

$message = "
<html>
<head>
<title> Congratulation! Payment Successfully Process</title>
</head>
<body>
<p> Hi,<br>Your Payment has been successfully recieved.Following are the details of your payment-</p>


<p>Best regards,</p>
<table>
<tr>
<th>Payment Type</th>  
<th>Amount Paid-</th>
<th>Amount status-</th>
<th>TransactionID- </th>
</tr>
<tr>
<td>$type</td>
<td>Rs. $amount</td>
<td>success</td>
<td>$tran_id</td>
</tr>
</table>


</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <thevasugoel@gmail.com>' . "\r\n";


//most important line  - the function used to send mail, we will pass all the data to this function; ie.
$sendmail = mail($to,$subject,$message,$headers); //this will process all the data and then send the mail but only if it is hosted on a live server not on a local server
if($sendmail){
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title> Payment Confirmation Screen</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,900'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>
<link rel="stylesheet" href="./style_success.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="bg">
  
  <div class="card">
    
    <span class="card__success"><i class="ion-checkmark"></i></span>
    
    <h1 class="card__msg">Payment Complete</h1>
    <h2 class="card__submsg">Thank you for your transfer</h2>
    
  <!-- <div class="card__body">
      
      <img src="http://nathgreen.co.uk/assets/img/nath.jpg" class="card__avatar">
      <div class="card__recipient-info">
        <p class="card__recipient">Nath Green</p>
        <p class="card__email">hello@nathgreen.co.uk</p>
      </div>
      -->
      <h1 class="card__price"><span>Rs </span><span id="rs"></span><span>.00</span></h1>
      
      <p class="card__method">Payment method</p>
      <div class="card__payment">
        <img src="" id="myImg" class="card__credit-card">
        <div class="card__card-details">
          <p class="card__card-type" id="type"></p>
         <!-- <p class="card__card-number">Visa ending in **89</p>   -->       
        </div>
      </div>
      
    </div>
    
    <!--<div class="card__tags">
        <span class="card__tag">completed</span>
        <span class="card__tag">#123456789</span>        
    </div>-->
    
  </div>
  
</div>
<!-- partial -->
  <script>
  function parseURLParams(url) {
  
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
	var s = document.getElementById("rs");
            s.innerHTML = parms['amount'];
	var asd = document.getElementById("type");
            asd.innerHTML = parms['type'];
	
	if(parms['type']=='PayPal'){
		var sd = document.getElementById("myImg").src = "images/pic4.png";
	}else{
		var sd = document.getElementById("myImg").src = "https://seeklogo.com/images/V/VISA-logo-F3440F512B-seeklogo.com.png";
	}
	return parms;
	
}
parseURLParams(location.search);
  </script>
</body>
</html>
<?php
}
else{
	echo "Mail Not Sending";
}?>