<?php
/**
 * @copyright	Copyright (c) 2013 GDAT. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
 /*
stdClass Object ( [query] => stdClass Object ( [count] => 1 [created] => 2013-10-22T19:44:10Z [lang] => en-US [results] => stdClass Object ( [quote] => stdClass Object ( [ChangeRealtime] => +5.43 [LastTradeDate] => 10/22/2013 [LastTradePriceOnly] => 1202.27 [ChangeinPercent] => +0.45% [LastTradeTime] => 10:19am ) ) ) ) */
// no direct access
defined('_JEXEC') or die;
//add stylesheet
$documentgdat = JFactory::getDocument();
$documentgdat->addStyleSheet(JURI::base() . 'modules/mod_gdat/tmpl/style.css');

// Xrimatistirio
$json_xa = file_get_contents('http://query.yahooapis.com/v1/public/yql?q=select%20LastTradeDate%2CLastTradeTime%2CChangeRealtime%2CChangeinPercent%2C%20LastTradePriceOnly%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22GD.AT%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
if (!$json_xa) {
	$data = '';
} else {
	$data = json_decode($json_xa);
	$time = $data->query->results->quote->LastTradeTime;
	$change = $data->query->results->quote->ChangeRealtime;
	$changeper = $data->query->results->quote->ChangeinPercent;
	$day = $data->query->results->quote->LastTradeDate;
	$Price = $data->query->results->quote->LastTradePriceOnly;
	if ($change[0] =='+') {
		$color = 'color:green';
		$img = 'up.png';
	} elseif ($change[0] =='-') {
		$color = 'color:red';
		$img = 'down.png';
	} else {
		$img = 'even.png';
		$color = '';
	}
	$data = '<span style="font-style:italic;font-weight:bold;font-size:1.4em;">'.$Price.'</span> (<span style="'.$color.'">'.$changeper.'</span>)';
}

//eur-usd
$json_eurusd = file_get_contents('http://query.yahooapis.com/v1/public/yql?q=select%20ChangeRealtime%2CLastTradePriceOnly%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22EURUSD%3DX%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
if ($json_eurusd == false) {
	$data_eurusd = '';
} else {
	$data_eurusd = json_decode($json_eurusd);
	$eu_lastprice = $data_eurusd->query->results->quote->LastTradePriceOnly;
	$eu_ChangeRT = $data_eurusd->query->results->quote->ChangeRealtime;
	if ($eu_ChangeRT[0] == '+') {
		$eu_color = 'green';
	} elseif ($eu_ChangeRT[0] == '-') {
		$eu_color = 'red';
	} else {
        $eu_ChangeRT = "&nbsp;".$eu_ChangeRT;
		$eu_color = 'inherit';
	}
}
//gold
$json_gold = file_get_contents('http://query.yahooapis.com/v1/public/yql?q=select%20ChangeRealtime%2CLastTradePriceOnly%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22gold%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
if ($json_gold == false) {
	$data_gold = '';
} else {
	$data_gold = json_decode($json_gold);
	$gold_lastprice = $data_gold->query->results->quote->LastTradePriceOnly;
	$gold_ChangeRT = $data_gold->query->results->quote->ChangeRealtime;
	if ($gold_ChangeRT[0] == '+') {
		$gold_color = 'green';
	} elseif ($gold_ChangeRT[0] == '-') {
		$gold_color = 'red';
	} else {
        $gold_ChangeRT = "&nbsp;".$gold_ChangeRT;
		$gold_color = 'inherit';
	}
}
//brent
$json_brent = file_get_contents('http://query.yahooapis.com/v1/public/yql?q=select%20ChangeRealtime%2CLastTradePriceOnly%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22BZZ13.NYM%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
if ($json_brent == false) {
	$data_brent = '';
} else {
	$data_brent = json_decode($json_brent);
	$brent_lastprice = $data_brent->query->results->quote->LastTradePriceOnly;
	$brent_ChangeRT = $data_brent->query->results->quote->ChangeRealtime;
	if ($brent_ChangeRT[0] == '+') {
		$brent_color = 'green';
	} elseif ($brent_ChangeRT[0] == '-') {
		$brent_color = 'red';
	} else {
        $brent_ChangeRT = "&nbsp;".$brent_ChangeRT;
		$brent_color = 'inherit';
	}
}


//$dji = file_get_contents('http://finance.yahoo.com/d/quotes.csv?s=DJIA&f=snl1d1t1p2c1v&e=.csv');
//var_dump($dji)
?>

<p style="text-align:center;font-weight:bold;">
Γενικός Δείκτης:<br />
<?php echo $data; ?>
</p>
<p style="text-align:center;"><img style="border: 0;" src="http://ichart.finance.yahoo.com/t?s=GD.AT&w=280&q=100&a=cc&zc=1&s=1" alt="" width="190" height="auto" border="0" />
</p>
<p></p>
<div class="rates">
	<div class="rates-1">
		<span>Χρυσός</span><span><?php echo $gold_lastprice; ?></span><span style="color:<?php echo $gold_color; ?>"><?php echo $gold_ChangeRT; ?></span>
	</div>
	<div class="rates-1">
		<span>Μπρέντ</span><span><?php echo $brent_lastprice; ?></span><span style="color:<?php echo $brent_color; ?>"><?php echo $brent_ChangeRT; ?></span>
	</div>
	<div class="rates-1">
		<span>EUR/USD</span><span><?php echo $eu_lastprice; ?></span><span style="color:<?php echo $eu_color; ?>"><?php echo $eu_ChangeRT; ?></span>
	</div>
</div>


