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
		function get_screenshot($url, $id){
			$filename = 'wp-content/uploads/screenshots/'.$id.'.png';
			if (file_exists($filename)) return;
			
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

		$subsites = get_sites(array('offset' => '1',));
		foreach( $subsites as $subsite ) {
			$subsite_id = get_object_vars($subsite)["blog_id"];
			$subsite_name = get_blog_details($subsite_id)->blogname;
			$subsite_url = get_site_url($subsite_id);
		
			get_screenshot($subsite_url, $subsite_id);
			echo '<li style="background-image: linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3)), url(wp-content/uploads/screenshots/' . $subsite_id . '.png);" class="card"><a class="title" href="' . $subsite_url . '">' . $subsite_name .'</a></li>';
		}
	?>
			
</ul>

<?php
get_footer();
