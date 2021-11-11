<?php


get_header();

?>

<ul id="post-<?php the_ID(); ?>" class="subdomains-feed">

<?php

	function faster_screen($url, $id){

		$filename = 'wp-content/uploads/screenshots/'.$id.'.png';
		if (file_exists($filename)) {
			return;
		}
		
		$image = $id.'.png';

		$accountKey = 'f863cc';

		$ch = curl_init('http://api.screenshotmachine.com/?key='.$accountKey.'&dimension=320x240&format=png&url='.$url);

		$fp = fopen('wp-content/uploads/screenshots/'.$image, 'wb');

		curl_setopt($ch, CURLOPT_FILE, $fp);

		curl_setopt($ch, CURLOPT_HEADER, 0);

		curl_exec($ch);

		curl_close($ch);

		fclose($fp);
	}

?>

<?php
 function get_screenshot($url) 
 {
	$api ="AIzaSyC-Q5kaY97eZTYjFgPLLwGkzHHTvZ-WZn4";

	// $curl_init = curl_init("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&screenshot=true");
	$adress="https://pagespeedonline.googleapis.com/pagespeedonline/v5/runPagespeed?url=$url&category=CATEGORY_UNSPECIFIED&strategy=DESKTOP&key=$api";
 	
	$curl_init = curl_init($adress);
    curl_setopt($curl_init,CURLOPT_RETURNTRANSFER,true);
    
    $response = curl_exec($curl_init);
    curl_close($curl_init);

	// curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
 	// $response = curl_exec($curl_init);
 	// curl_close($curl_init);
 	//call Google PageSpeed Insights API
 	//decode json data
 	$googlepsdata = json_decode($response, true);
 	//screenshot data

 	// echo $googledata["lighthouseResult"]["audits"]["full-page-screenshot"]["details"]["screenshot"]['data'];
 
 	return $googlepsdata['lighthouseResult']['audits']['final-screenshot']['details']['data'];
 }

 
?>

		<?php
			$subsites = get_sites(array('offset' => '1',));
			foreach( $subsites as $subsite ) {
			  $subsite_id = get_object_vars($subsite)["blog_id"];
			  $subsite_name = get_blog_details($subsite_id)->blogname;
			  $subsite_url = get_site_url($subsite_id);
			//   $screen = get_screenshot("https://seznam.cz");
			  $b_screen = faster_screen("https://law.prf.cuni.cz/pravavpraze", $subsite_id);
			  echo '<li style="background-image: linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3)), url(wp-content/uploads/screenshots/' . $subsite_id . '.png);" class="card"><a class="title" href="' . $subsite_url . '">' . $subsite_name .'</a></li>';
			}

		?>
			
</ul>

<?php
get_footer();
