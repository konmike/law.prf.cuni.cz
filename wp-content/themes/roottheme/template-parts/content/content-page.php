<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
			the_content();
		?>

		<?php
			$subsites = get_sites();
			foreach( $subsites as $subsite ) {
			  $subsite_id = get_object_vars($subsite)["blog_id"];
			  $subsite_name = get_blog_details($subsite_id)->blogname;
			  $url = get_site_url($subsite_id);
			  echo 'Site ID/Name: ' . $subsite_id . ' / ' . $subsite_name . ' / ' . $url . '<br>';
			}

		?>
		
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer default-max-width">
			
			<?php get_sidebar() ?>

		</footer><!-- .entry-footer -->
	<?php endif; ?>

	
</article><!-- #post-<?php the_ID(); ?> -->
