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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		

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

<?php
get_footer();
