<?php
$host   = "riset.revolusi-it.com";
$port     = 1883;
$username = "";
$password = "";

require("phpMQTT.php");
$message = "D3=1";
$message = @$_GET["message"];
$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());

if ($mqtt->connect(true,NULL,$username,$password)) {
  $mqtt->publish("iot/kendali",$message, 0);
  $mqtt->close();
  //echo "Mesaage TErkirim";
}else{
  echo "Fail or time out
";
}
?>
<html>
  <head>
  <style>
  a{
    text-decoration: none;
    color : white;
  }
  .button_green {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 10px;
}
.button_red {
  background-color: red;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 10px;
}

</style>
  </head>
  <body>
    <!-- D1 -->
    <button class="button_red"><a href="http://localhost/iot/send.php?message=D1=0">D1 Mati</a></button>
    <button class="button_green"><a href="http://localhost/iot/send.php?message=D1=1">D1 Nyala</a></button>
</br>
    <!-- D3 -->
    <button class="button_red"><a href="http://localhost/iot/send.php?message=D2=0">D2 Mati</a></button>
    <button class="button_green"><a href="http://localhost/iot/send.php?message=D2=1">D2 Nyala</a></button>
    </br>
    <!-- D3 -->
    <button class="button_red"><a href="http://localhost/iot/send.php?message=D3=0">D3 Mati</a></button>
    <button class="button_green"><a href="http://localhost/iot/send.php?message=D3=1">D3 Nyala</a></button>
    </br>
    <!-- D3 -->
    <button class="button_red"><a href="http://localhost/iot/send.php?message=D4=0">D4 Mati</a></button>
    <button class="button_green"><a href="http://localhost/iot/send.php?message=D4=1">D4 Nyala</a></button>
    </br>
  </body>
</html>