<?php /* Template Name: Silippinas Map */ ?>

<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>
<style>
    body {background-color: #000; height: auto; width: auto;}
    path {cursor: pointer;}

    * {font-family: Arial, Helvetica, sans-serif; box-sizing: border-box;}

	#snapper {height: 1800px; width: 1200px; transform-origin: 0 0;}
	
    .layover {max-width: 100%; width: 350px; padding: 20px; background-color: #FFF; border-radius: 5px; display: none; position: absolute; z-index: 999; opacity: 0;  -webkit-box-shadow: 0px 0px 15px 5px rgba(0,0,0,0.25); -moz-box-shadow: 0px 0px 15px 5px rgba(0,0,0,0.25); box-shadow: 0px 0px 15px 5px rgba(0,0,0,0.25);}
    .layover .thumb, .layover .content {display: inline-block; vertical-align: top;}
    .layover .thumb {width: 120px; padding: 10px;}
    .layover .content {width: calc(100% - 125px); width: 100%; color: #333; font-size: 10px;}
    .layover .content p {font-size: inherit; color: inherit; display: inline; float: none;}
    .layover .content img {display: inline-block; vertical-align: top; float: left; margin: 0 15px 0 0;}

    .layover.active {display: block;}
</style>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<!-- <h1 class="entry-title main_title"><?php the_title(); ?></h1> -->
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

				<div class="snapper-wrapper">
					<svg id="snapper"></svg>
					<div class="layover">
						<div class="wrapper">
							<!-- <div class="thumb">
								<img src="https://via.placeholder.com/100x100" alt="placeholder-thumb" />
							</div> -->
							<div class="content">
								<img src="https://via.placeholder.com/100x100" alt="placeholder-thumb" />
								<p>
									<strong>Lorem ipsum dolor</strong>
									<span>
										<br/><br/>
										Lorem ipsum dolor sit amet, ne mei cibo vocent regione. No quidam timeam nostrum cum, erat posse delenit in ius. Pri an rebum ubique oporteat. Esse iusto in vix, delenit adolescens accommodare no cum. Agam vidisse sit cu.
										<br/><br/>
										Vix ornatus incorrupte cu, in illud tibique vix. Nibh clita partem mei ne, ne per malis dicam propriae. Qui tempor bonorum pericula et, alia tincidunt eum ad, id esse consetetur neglegentur pro. His no facete phaedrum. Sea tation dolores principes ea.
									</span>
								</p>
							</div>
						</div>
					</div>
				</div>

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

	<!-- <script src="../wp-content/uploads/assets/vendor/jquery/3.3.1.min.js"></script> -->
	<script src="../wp-content/uploads/assets/vendor/snap.svg/0.5.1.js"></script>
	<script src="../wp-content/uploads/assets/vendor/snap.svg/src/paper.js"></script>
	<script src="../wp-content/uploads/assets/vendor/snap.svg/src/matrix.js"></script>
	<script src="../wp-content/uploads/assets/js/settings.js"></script>
	<script src="../wp-content/uploads/assets/js/theme.js"></script>

<?php

get_footer();
