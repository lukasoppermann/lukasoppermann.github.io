<?php
require_once("twitteroauth/twitteroauth/twitteroauth.php"); //Path to twitteroauth library
 
$twitteruser = "lukasoppermann";
$notweets = 10;
$consumerkey = "HnXVMoHDXpF0jGZSegZgCw";
$consumersecret = "y6RDanJT5ouZS6H4tsEdt08xrYY7qi5a06lauuwhwA";
$accesstoken = "42909902-r9gF5CI0hS6fKHyiyaGgnwkYN1VgpsHdk3Yx0v8ZR";
$accesstokensecret = "6xdNLvAYwejC7ewJtMAxQkTrGKCZf8nTRKmp2RAnHic";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

$tweets = json_decode(json_encode($tweets), TRUE);

	// link fn
	function change_link($string, $urls)
	{
		if( isset($urls) && is_array($urls) )
		{
			foreach($urls as $url)
			{
				$string = str_replace($url['url'], "<a rel=\"nofollow\" target=\"_blank\" href='".$url['expanded_url']."'>".$url['expanded_url']."</a>", $string);
		  	}
		}
		$string = preg_replace('!http://([a-zA-Z0-9./-]+[a-zA-Z0-9/-])!i', '<a href="\\0" target="_blank">\\0</a>', $string);
		return $string;
	}
	
	function getLatestTweet($tweets)
	{
		//
		foreach($tweets as $tweettag)
		{
			$tweettime = strtotime($tweettag['created_at'])+3600; // time difference - UK + 1 hours (3600s)
			$timeago = (time()-$tweettime);
			$thehours = floor($timeago/3600);
			$theminutes = floor($timeago/60);
			$thedays = floor($timeago/86400);
			if($theminutes < 60)
			{
				if($theminutes < 1)
				{
		 			$timemessage =  "Less than 1 minute ago";
				}
				elseif($theminutes == 1) 
				{
		 			$timemessage = $theminutes." minute ago.";
		 		}
				else
				{
		 			$timemessage = $theminutes." minutes ago.";
		 		}

			} 
			elseif($theminutes > 60 && $thedays < 1)
			{
		 		if($thehours == 1)
				{
		 			$timemessage = $thehours." hour ago.";
		 		} 
				else 
				{
		 			$timemessage = $thehours." hours ago.";
		 		}
			} 
			else
			{
		 		if($thedays == 1)
				{
		 			$timemessage = $thedays." day ago.";
		 		}
				else
				{
					$timemessage = $thedays." days ago.";
			}
		}
        $tweettag["text"] = str_replace('"',"'",$tweettag["text"]);
		echo "<li class='tweet'>".
		// time
        "<span class='tweet-time'>".$timemessage."</span>".
		// tweets
		change_link($tweettag["text"], $tweettag['entities']['urls'])."<br />\n"
		."</li>\n";
		}
	}
	
	function human_to_unix($datestr = '')
	{
		if ($datestr == '')
		{
			return FALSE;
		}

		$datestr = trim($datestr);
		$datestr = preg_replace("/\040+/", ' ', $datestr);

		if ( ! preg_match('/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}(?::[0-9]{1,2})?(?:\s[AP]M)?$/i', $datestr))
		{
			return FALSE;
		}

		$split = explode(' ', $datestr);

		$ex = explode("-", $split['0']);

		$year  = (strlen($ex['0']) == 2) ? '20'.$ex['0'] : $ex['0'];
		$month = (strlen($ex['1']) == 1) ? '0'.$ex['1']  : $ex['1'];
		$day   = (strlen($ex['2']) == 1) ? '0'.$ex['2']  : $ex['2'];
        echo "::".$year."__";

		$ex = explode(":", $split['1']);

		$hour = (strlen($ex['0']) == 1) ? '0'.$ex['0'] : $ex['0'];
		$min  = (strlen($ex['1']) == 1) ? '0'.$ex['1'] : $ex['1'];

		if (isset($ex['2']) && preg_match('/[0-9]{1,2}/', $ex['2']))
		{
			$sec  = (strlen($ex['2']) == 1) ? '0'.$ex['2'] : $ex['2'];
		}
		else
		{
			// Unless specified, seconds get set to zero.
			$sec = '00';
		}

		if (isset($split['2']))
		{
			$ampm = strtolower($split['2']);

			if (substr($ampm, 0, 1) == 'p' AND $hour < 12)
				$hour = $hour + 12;

			if (substr($ampm, 0, 1) == 'a' AND $hour == 12)
				$hour =  '00';

			if (strlen($hour) == 1)
				$hour = '0'.$hour;
		}

		return mktime($hour, $min, $sec, $month, $day, $year);
	}

    getLatestTweet($tweets);
?>