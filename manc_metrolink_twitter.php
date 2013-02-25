<?php
require_once 'twitteroauth.php';
include('simple_html_dom.php');
define("CONSUMER_KEY", "");
define("CONSUMER_SECRET", "");
define("OAUTH_TOKEN", "");
define("OAUTH_SECRET", "");


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_SECRET);
$content = $connection->get('account/verify_credentials');

$uname = 'manc_metrolink';
$pwd = '';
$twitter_url = 'http://twitter.com/statuses/update.xml';
//$feed = "http://open.dapper.net/transform.php?dappName=metrolinkfeedV2&transformer=RSS&extraArg_title=service_update&extraArg_description[]=service_text&applyToUrl=http%3A%2F%2Fwww.metrolink.co.uk%2Ftodaysdisruptions%2Findex.asp%3Fid%3D25";
//$feed = "http://www.dapper.net/services/metrorss";

//$feed = "http://www.metrolink.co.uk/todaysdisruptions/index.asp?id=33";
$feed = "http://www.metrolink.co.uk/pages/news.aspx?serviceID=55";

$html = file_get_html($feed);

$heading = $html->find('h2[class=pageHeading]');
$status = $heading[0]->plaintext." #metrolink http://bit.ly/RIjI2C";

$message = $html->find('table p');
$text = substr($message[1]->plaintext,0,135);
//$status = $xml->channel->item[0]->title." #metrolink http://bit.ly/qJlTjJ";
//$status2 = substr($xml->channel->item[0]->description,0,135)."...";

$status2 = $text."...";


//if (strlen($xml->channel->item[0]->title)==0)
//{
//$title = $xml->channel->item[0]->title;
//}
//else if (strcmp($xml->channel->item[0]->title,"(!) Can't read content")==0)
//{
//$title = $xml->channel->item[0]->title;
//}
//else
//{
shell_exec("curl --basic --user $uname:$pwd --data status=\"$status\" $twitter_url");
$connection->post('statuses/update', array('status' => $status));
shell_exec("curl --basic --user $uname:$pwd --data status=\"$status2\" $twitter_url");
$connection->post('statuses/update', array('status' => $status2));
//}
?>
