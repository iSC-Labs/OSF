<?php

define( 'IN_APPLICATION', 1);
session_start();


  include("config/config.php");
  require_once 'jsonrpcphp/includes/jsonRPCClient.php';
  include("includes/infomsg.php");


$khs =0;



print"<html>";
print"<head>";
print"<title>Test script</title>";
print"<meta http-equiv=\"refresh\" content=\"60\" />";
print"</head>";
print"</body>";
print"<center> <img src=\"logos/" . $symbol . ".png\"></center><br/>";
print"<center><font size=\"10\">" . $name . " Faucet.</font></center><br/>"; 
  $bitcoin = new jsonRPCClient('http://' . $user . ':' . $password .'@' . $host . ':' . $port. '/');
 
//  print_r($bitcoin->getmininginfo());

$array = $bitcoin->getmininginfo();
$array2 = $bitcoin->getinfo();

if (array_key_exists('networkhashps', $bitcoin->getmininginfo()))
{
$khs = $array['networkhashps'];
$kname = "KH's";
}

if (array_key_exists('netmhashps', $bitcoin->getmininginfo()))
{
$kname = "MH's";
$khs = $array['netmhashps'];
}

/*
#Needs finishing.
#if (array_key_exists('Proof-of-Stake', $bitcoin->getinfo()))
#{
#$PoS = $array[1]['Proof-of-Stake'];
#}

*/

$block = $array['blocks'];
$coins = $array2['moneysupply'];


print "<b>Some $name information</b><br/>";


print "Blocks - $block<br/>";
print "$kname - $khs<br/>";
print "Coins - $coins<br/>";

#Needs Finishing.

#If(is_null($PoS))
#{
# return;
#}
#else 
#print"Proof of Stake - $PoS";


?>

        <form id="submit" name="submit" method="post" action="includes/submit.php">
            <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
                     <tr>
                        <td><b><?php print"$symbol"; ?> Address</b></td>
                        <td><input name="address" type="address" class="textfield" id="address" /></td>

                    

                    <td colspan="3"><input type="submit" name="Submit" value="Submit" class="myButton"/></td>
                
            </table>
        </form>



<?php

include("includes/footer.php");
?>
