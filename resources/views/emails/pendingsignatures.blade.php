<!DOCTYPE html>
<html lang=&quot;en-US&quot;>
<head>
<meta charset=&quot;utf-8&quot;>
</head>
<body>
<h2>You have been asked to sign the below documents</h2>
<div> You have {{ count($unsigned_contracts) }} unsigned documents on <a href="http://www.bitsign.it/">BitSign.it</a>
<br>
Please <a href="http://bitsign.it/signup/{{$pending_user->token}}">Click here to complete your signature</a>
</div>
</body>
</html>