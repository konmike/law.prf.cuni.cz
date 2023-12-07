<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

?>

<ul id="post-<?php the_ID(); ?>" class="subdomains-feed">

	<?php
	function get_screenshot($url, $id)
	{
		$now = time();
		// number of days, how old is the file
		$days = 7;
		$filename = 'wp-content/uploads/screenshots/' . $id . '.png';
		if (file_exists($filename)) {
			if ($now - filemtime($filename) >= 60 * 60 * 24 * $days && ($id != "8"))
				unlink($filename);
			else {
				return;
			}
		}
		;

		$image = $id . '.png';
		$accountKey = 'f863cc';
		$ch = curl_init('http://api.screenshotmachine.com/?key=' . $accountKey . '&dimension=320x240&format=png&url=' . $url);
		$fp = fopen('wp-content/uploads/screenshots/' . $image, 'wb');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
	}

	$subsites = get_sites(array('offset' => '1', ));
	foreach ($subsites as $subsite) {
		$subsite_id = get_object_vars($subsite)["blog_id"];

		if (get_blog_details($subsite_id)->deleted) {
			continue;
		}

		$subsite_name = get_blog_details($subsite_id)->blogname;
		$subsite_url = get_site_url($subsite_id);

		get_screenshot($subsite_url, $subsite_id);
		echo '<li class="card ' . $is_public . '">
						<div class="card__thumbnail" style="background-image: url(wp-content/uploads/screenshots/' . $subsite_id . '.png);"></div>
						<span class="card__title">' . $subsite_name . '</span>
						<a href="' . $subsite_url . '" title="Přejít na stránku ' . $subsite_name . '" class="card__more"></a>
					 </li>';
	}
	?>

</ul>

<?php
get_footer();
