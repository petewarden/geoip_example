<?php

/*
 * A simple example showing how to use the GeoIP API in PHP with the free database
 * from http://maxmind.com
 *
 * Before you can run this you'll need to install the data files, either using the
 * one included in this package or downloading the latest from 
 * http://www.maxmind.com/app/geolitecity
 * Once you have the GeoLiteCity.dat file downloaded and unzipped, copy it to
 * /usr/local/share/GeoIP (or update the code below to reflect the location you've
 * actually installed it in).
 * 
 * Based on code from http://pear.php.net/package/Net_GeoIP/ with the PEAR
 * dependencies removed. Adapted by Pete Warden <pete@petewarden.com>
 * For more details see http://petewarden.typepad.com/
 * 
 * The classes are licensed under the LGPL, but this test script is freely reusable
 * with no restrictions.
 */

require ('./GeoIP.php');

if (isset($_REQUEST['ip_address'])) {
	$ip_address = urldecode($_REQUEST['ip_address']);
} else {
	$ip_address = $_SERVER['REMOTE_ADDR'];
}

$geoip = Net_GeoIP::getInstance('/usr/local/share/GeoIP/GeoLiteCity.dat');

$location = $geoip->lookupLocation($ip_address);

?>
<html>
<head>
<title>Test page for the GeoIP module</title>
<style>
div {
    padding:20px; 
    width:600px; 
    margin-left: auto; 
    margin-right: auto; 
    border: 1px solid #000; 
    margin-top: 5px; 
}</style>
</head>
<body>
<div>
<center>
A simple example showing how to use the GeoIP API in PHP with the free database from <a href="http://maxmind.com">http://maxmind.com</a>
<br/><br/>
In the box below you'll see the geographic information found for the current IP address. If you haven't entered one explicitly, the address of the machine loading this page will be used.
<br/><br/>
Based on code from <a href="http://pear.php.net/package/Net_GeoIP/">http://pear.php.net/package/Net_GeoIP/</a> with the PEAR dependencies removed. Adapted by Pete Warden &lt;<a href="mailto:pete@petewarden.com">pete@petewarden.com</a>&gt;, for more details see <a href="http://petewarden.typepad.com/">http://petewarden.typepad.com/</a>
<br/><br/>
<form method="GET" action="index.php">
IP address: <input type="text" size="40" name="ip_address" value="<?=$ip_address?>"/>
</form>
</center>
</div>
<div>
<center>
<?php

print "city: " . $location->city . ", " . $location->region;
print "<br/>\n";
print "lat: " . $location->latitude . ", lon: " . $location->longitude;

?>
</center>
</div>
</html>