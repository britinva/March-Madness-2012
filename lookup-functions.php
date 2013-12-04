<?php

function convertToStateAbbv($state) {
	$state_list = array('AL'=>"Alabama",
					'AK'=>"Alaska", 
					'AZ'=>"Arizona", 
					'AR'=>"Arkansas", 
					'CA'=>"California", 
					'CO'=>"Colorado", 
					'CT'=>"Connecticut", 
					'DE'=>"Delaware", 
					'DC'=>"District Of Columbia", 
					'FL'=>"Florida", 
					'GA'=>"Georgia", 
					'HI'=>"Hawaii", 
					'ID'=>"Idaho", 
					'IL'=>"Illinois", 
					'IN'=>"Indiana", 
					'IA'=>"Iowa", 
					'KS'=>"Kansas", 
					'KY'=>"Kentucky", 
					'LA'=>"Louisiana", 
					'ME'=>"Maine", 
					'MD'=>"Maryland", 
					'MA'=>"Massachusetts", 
					'MI'=>"Michigan", 
					'MN'=>"Minnesota", 
					'MS'=>"Mississippi", 
					'MO'=>"Missouri", 
					'MT'=>"Montana",
					'NE'=>"Nebraska",
					'NV'=>"Nevada",
					'NH'=>"New Hampshire",
					'NJ'=>"New Jersey",
					'NM'=>"New Mexico",
					'NY'=>"New York",
					'NC'=>"North Carolina",
					'ND'=>"North Dakota",
					'OH'=>"Ohio", 
					'OK'=>"Oklahoma", 
					'OR'=>"Oregon", 
					'PA'=>"Pennsylvania", 
					'RI'=>"Rhode Island", 
					'SC'=>"South Carolina", 
					'SD'=>"South Dakota",
					'TN'=>"Tennessee", 
					'TX'=>"Texas", 
					'UT'=>"Utah", 
					'VT'=>"Vermont", 
					'VA'=>"Virginia", 
					'WA'=>"Washington", 
					'WV'=>"West Virginia", 
					'WI'=>"Wisconsin", 
					'WY'=>"Wyoming");		
	return array_search(trim($state), $state_list); 
}

function whichTeam($hashtag) {
	$hashtag_list = array('#grizzlies'=> '0',
						//"Montana Grizzlies",
						'#badgers'=> '1',
						//"Wisconsin Badgers",
						'#gobadgers'=> '1', 
						//"Wisconsin Badgers",
						'#cougars'=> '2',
						//"BYU Cougars",
						'#byu'=> '2',
						//"BYU Cougars",
						'#mubb'=> '3',
						//"Marquette Golden Eagles",
						'#marquette'=> '3',
						//"Marquette Golden Eagles",
						'#jackrabbits'=> '4',
						//"South Dakota St. Jackrabbits",
						'#baylor'=> '5', 
						//"Baylor Bears",
						'#cubuffs'=> '6',
						//"Colorado Buffaloes",
						'#gobuffs'=> '6',
						//"Colorado Buffaloes",
						'#unlv'=> '7',
						//"UNLV Rebels",
						'#davidson'=> '8',
						//"Davidson Wildcats",
						'#louisville'=> '9',
						//"Louisville Cardinals",
						'#longbeachstate'=> '10',
						//"Long Beach St. Dirtbags",
						'#dirtbags'=> '10',
						//"Long Beach St. Dirtbags",
						'#lobos'=> '11',
						//"New Mexico Lobos",
						'#aggies'=> '12', 
						//"New Mexico St. Aggies",
						'#nmsu'=> '12', 
						//"New Mexico St. Aggies",
						'#hoosiers'=> '13',
						//"Indiana Hoosiers",
						'#iu'=> '13',
						//"Indiana Hoosiers",
						'#rams'=> '14',
						//"VCU Rams",
						'#ramnation'=> '14',
						//"VCU Rams",
						'#vcu'=> '14',
						//"VCU Rams",
						'#shockers'=> '15',
						//"Wichita State Shockers",
						'#goshockers'=> '15',
						//"Wichita State Shockers",
						'#csu'=> '16',
						//"Colorado State Rams",
						'#murraystate'=> '17',
						//"Murray State Breds",
						'#racers'=> '17',
						//"Murray State Breds",
						'#uconn'=> '18',
						//"Connecticut Huskies / UConn",
						'#cyclones'=> '19',
						//"Iowa State Cyclones",
						'#isu'=> '19',
						//"Iowa State Cyclones",
						'#loyola'=> '20',
						//"Loyola Maryland Greyhounds",
						'#greyhounds'=> '20',
						//"Loyola Maryland Greyhounds",
						'#buckeyes'=> '21',
						//"Ohio State Buckeyes",
						'#osu'=> '21',
						//"Ohio State Buckeyes",
						'#mountaineers'=> '22',
						//"West Virginia Mountaineers",
						'#wvu'=> '22',
						//"West Virginia Mountaineers",
						'#gonzaga'=> '23',
						//"Gonzaga Bulldogs/Zags",
						'#zags'=> '23',
						//"Gonzaga Bulldogs/Zags",
						'#southernmiss'=> '24',
						//"Southern Miss Golden Eagles",
						'#ksu'=> '25',
						//"Kansas State Wilcats",
						'#kstate'=> '25',
						//"Kansas State Wilcats",
						'#bulldogs'=> '26',
						//"UNC-Asheville Bulldogs",
						'#cuse'=> '27',
						//"Syracuse Orange",
						'#syracuse'=> '27',
						//"Syracuse Orange",
						'#hilltoppers'=> '28',
						//"Western Kentucky Hilltoppers",
						'#wku'=> '28',
						//"Western Kentucky Hilltoppers",
						'#wildcats'=> '29',
						//"Kentucky Wildcats",
						'#uk'=> '29',
						//"Kentucky Wildcats",
						'#crimson'=> '30',
						//"Harvard Crimson",
						'#harvard'=> '30',
						//"Harvard Crimson",
						'#vandy'=> '31',
						//"Vanderbilt Commodores",
						'#commodores'=> '31');
						//"Vanderbilt Commodores");	return $hashtag_list[$hashtag]; 
	return $hashtag_list[$hashtag]; 
						
}

function matchHashtag($hashtags) {
	$keywordSearch = explode(",",WORDS_TO_TRACK);
	foreach ($hashtags as $hashtag) {
		if (in_array(strtolower($hashtag), $keywordSearch)) return whichTeam(strtolower($hashtag));
	}
}

function convertToCoordinates($strLocation, $arrZips) {
	preg_match("/([^,]+),\s*(\w{2})\s*/", $strLocation, $matches);
	list($arr['addr'], $arr['city'], $arr['state']) = $matches;
	if (strlen($arr['state']) > 2) {
		$arr['state'] = convertToStateAbbv($arr['state']); 
	}
	if ($arr['city']) {
		$coords = $arrZips[strtoupper(trim($arr['state']).", ".trim($arr['city']))];
		if ($coords != "") 
			return $coords;
			//return $strLocation . ": " . $coords[2] . ", " . $coords[3];
		else 
			return;
			// return $strLocation;
	}
	return NULL;
}
?>