<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Lukas Oppermann - veare.net" />
	<meta name="description" content="Lukas Oppermann is a freelance interface & interaction designer who enjoys creating fast, usable and gorgeous interfaces." />
	<meta name="robots" content="index,follow" />
	<meta name="language" content="en" />
	<link rel="favicon" type="image/x-icon" href="./media/favicon.ico" />
	<link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="./libs/css/screen.css" media="screen" />
	<title>Lukas Oppermann - interface & interaction designer | lukasoppermann.com</title>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-7074034-23']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>
<body>
	<div id="container">
		<div id="about" class="column-right column">
			<h1>Lukas<br /> Oppermann</h1>
			<p class="about-lukas-oppermann">
				My name is Lukas Oppermann and I have a passion for usable, fast and gorgeous interfaces. As an interface &amp; interaction designer I mainly focus on creating mobile applications and websites. I enjoy working on the visual design as well as programming the final app or website.<br /><br />
				What I do best is designing concepts with an intelligent workflow, focussing on the user experience. While caring most about the user I never forget about SEO, accessibility and brand experience.
				<br /><br />
				I love state of the art technologies, e.g. html 5 &amp; css 3, and I like getting things done.
			</p>
			<div id="portfolio">
				<a href="http://veare.net/portfolio.html">Portfolio</a>
			</div>
		</div>
		<div id="lukasoppermann_picture" class="column-left column">
			<script type="text/javascript">document.write(
"<n vq=\"rznvy\" uers=\"znvygb:yhxnf\100irner\056arg\">Qebc zr n yvar\056<\057n>".replace(/[a-zA-Z]/g, function(c){return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));
</script>
			<img src="media/lukasoppermann_profile.jpg" alt="Interface Designer - Lukas Oppermann">
		</div>
		
		<div id="social_media" class="column-left column">
			<a href="http://twitter.com/#!/lukasoppermann" id="twitter">Twitter</a>
			<a href="http://www.xing.com/profile/Lukas_Oppermann" id="xing">Xing</a>
			<a href="http://au.linkedin.com/in/lukasoppermann" id="linkedin">LinkedIn</a>
			<a href="http://dribbble.com/lukasoppermann" id="dribbble">Dribbble</a>
			<a href="https://plus.google.com/117502149578407470769/posts" id="googleplus">Google+</a>
			<a href="http://designmomentum.tumblr.com/" id="tumblr">Tumblr</a>			
			<a href="https://github.com/lukasoppermann" id="github">github</a>
		</div>
		<div id="tweet_container" class="column-right column">
			<ul id="tweets">
<?
	// twitter user name
	$twitterid = "lukasoppermann";
	// link fn
	function change_link($string, $urls)
	{
		foreach($urls as $url)
		{
			$string = str_replace($url['url'], "<a rel=\"nofollow\" target=\"_blank\" href='".$url['expanded_url']."'>".$url['expanded_url']."</a>", $string);
	  	}	
		return $string;
	}


	function tweet_time($t)
	{
		// clean
		$time_date = substr($t, 5, -6);
		// get tome
		$time = substr($time_date, -8);
		// get date
		$date = substr($time_date,0, 11);
		$date_arr = explode(' ',$date);
		// get month
		$m = array('jan' => '01', 'feb' => '02', 'mar' => '03', 'apr' => '04', 'may' => '05', 'jun' => '06', 'jul' => '07', 'aug' => '08', 'sep' => '09', 'oct' => '10', 'nov' => '11', 'dec' => '12');
		// build new date time string
		$time_date = $date_arr[2].'-'.$m[strtolower($date_arr[1])].'-'.$date_arr[0].' '.$time;
		//
		return $time_date;
	}
	
	function getLatestTweet($t_json, $twitterid)
	{
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL, $t_json );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		$result = curl_exec( $curl );
		curl_close( $curl );
		$tweets = json_decode($result, TRUE);
		$tweets = $tweets['results'];
		
		$c = 0;
		foreach($tweets as $tweettag)
		{
			$c++;
			$arrow = "";
			$time_date = tweet_time($tweettag['created_at']);
	   		$tweettime = (human_to_unix($time_date))+3600; // time difference - UK + 1 hours (3600s)
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
		// Tweet
		if($c == 1){
			$arrow = '<span class="arrow"></span>';
		}
		echo "<li class='tweet'>".$arrow.change_link($tweettag["text"], $tweettag['entities']['urls'])."<br />\n";
		// time
		echo "<span class='tweet-time'>".$timemessage."</span><a target='_blank' rel='nofollow' class='tweet-link' href='https://twitter.com/#!/".$twitterid.'/status/'.$tweettag['id_str']."'></a></li>\n";
		}
	}
	$tweets_json = "http://search.twitter.com/search.json?q=from:".$twitterid."&rpp=3&with_twitter_user_id=true&include_entities=true";
	getLatestTweet($tweets_json, $twitterid);
	
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
?>
			</ul>
		</div>
	</div>	
</body>
</html>