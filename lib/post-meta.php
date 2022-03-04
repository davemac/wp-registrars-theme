<?php

function dmc_display_post_tax_terms() {
	global $post;
	$taxonomy_name = get_object_taxonomies( $post );
	$post_terms    = wp_get_object_terms( $post->ID, $taxonomy_name[0] );
	$raw_termlist  = '';
	$termlist      = '';
	$separator     = ', ';
	$output        = '';

	if ( ! empty( $post_terms ) ) {
		if ( ! is_wp_error( $post_terms ) ) {
			ob_start();
			?>

			<div class="post-cats">
				<?php
				foreach ( $post_terms as $term ) {
					$raw_termlist .= '<a href="' . esc_url( get_term_link( $term->slug, $taxonomy_name[0] ) ) . '">' . esc_html( $term->name ) . '</a>' . $separator;
				}
				$termlist .= trim( $raw_termlist, $separator );
				echo $termlist;
				?>
			</div>

			<?php
			$output = ob_get_clean();
			echo $output;
		}
	}
}

// return entry meta information for posts, used by multiple loops
function dmcstarter_entry_meta() {
	?>
	<div class="entry-meta">
		<span class="byline author vcard">
			<?php
			// if Co-authors Plus plugin is active, get the co-author posts link
			if ( function_exists( 'coauthors_posts_links' ) ) {
				echo coauthors_posts_links( ', ', ' & ', 'by ', '', false );
			} else {
				// get WP author posts link
				echo 'by ' . get_the_author_posts_link();
			};
			?>
		</span>
		on
		<time class="updated" datetime="<?php echo get_the_time( 'c' ); ?>'" pubdate>
			<?php echo get_the_date(); ?>
		</time>

		<?php
		if ( is_single() || is_front_page() || is_post_type_archive( 'post' ) || is_search() ) :

			// dmc_display_post_tax_terms();

			$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
			if ( comments_open() ) :

				if ( '0' === $num_comments ) :
					$comments = __( '<span class="comment-result no-comments">Make a comment</span>' );
				elseif ( $num_comments > 1 ) :
					$comments = $num_comments . __( ' comments' );
				else :
					$comments = __( '<span class="comment-result">1 comment</span>' );
				endif;

				$write_comments = '<a href="' . get_comments_link() . '"><span class="icon small icon-forum"></span> ' . $comments . '</a>';
			else :
				$write_comments = __( '<span class="comment-result">Comments off</span>' );
			endif;
			?>
			<!-- <span class="comments comment-results">
				<?php // echo $write_comments; ?>
			</span> -->
			<?php
		endif;
		?>
	</div>
	<?php
}


//  Add author bio box to posts, accomodates guest authors
//  http://bekarice.com/adding-co-authors-plus-support-theme/
function dmc_user_profile() {

	if ( function_exists( 'coauthors_posts_links' ) ) {

		$output    = '';
		$coauthors = get_coauthors();

		foreach ( $coauthors as $coauthor ) {

			if ( isset( $coauthor->type ) && 'guest-author' === $coauthor->type ) {

				$author_id                 = $coauthor->ID;
				$author_name_first         = $coauthor->first_name;
				$author_name_last          = $coauthor->last_name;
				$author_url                = $coauthor->website;
				$author_email              = $coauthor->user_email;
				$author_bio                = $coauthor->description;
				$dmc_author_twitter_check  = get_field( 'dmc_twitter', $author_id );
				$dmc_author_linkedin_check = get_field( 'dmc_linkedin', $author_id );
				$dmc_author_position       = get_field( 'dmc_position', $author_id );
				$dmc_author_post_links     = coauthors_posts_links( ', ', ' & ', '', '', false );
				$archive_link              = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
				$link_title                = 'Articles by ' . $coauthor->first_name;
				$profile_image             = get_field( 'dmc_author_photo', $coauthor->ID );
				$display_profile_image     = wp_get_attachment_image( $profile_image, 'dmc-staff-profile' );

			} else {

				$author_id                 = $coauthor->ID;
				$author_name_first         = get_the_author_meta( 'first_name', $author_id );
				$author_name_last          = get_the_author_meta( 'last_name', $author_id );
				$author_url                = get_the_author_meta( 'user_url', $author_id );
				$author_email              = get_the_author_meta( 'user_email', $author_id );
				$author_bio                = get_the_author_meta( 'description', $author_id );
				$dmc_author_twitter_check  = get_the_author_meta( 'twitter_handle', $author_id );
				$dmc_author_linkedin_check = get_field( 'dmc_linkedin', 'user_' . $author_id );
				$dmc_author_position       = get_field( 'dmc_position', 'user_' . $author_id );
				$dmc_author_company        = get_the_author_meta( 'billing_company', $author_id );
				$archive_link              = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
				$link_title                = 'Articles by ' . get_the_author_meta( 'first_name', $author_id );
				$profile_image             = get_field( 'dmc_author_photo', 'user_' . $author_id );
				$display_profile_image     = wp_get_attachment_image( $profile_image, 'thumbnail' );
			}
			?>

				<div class="author-info">
					<div class="media">
						<div class="media-figure">

							<?php
							if ( $profile_image ) :
								echo $display_profile_image;

							elseif ( function_exists( 'coauthors_posts_links' ) ) :
								?>
								<a href="<?php echo esc_url( $archive_link ); ?>" class="author-link" title="<?php echo esc_attr( $link_title ); ?>">
									<?php echo esc_url( $display_profile_image ); ?>
								</a>
								<?php
							endif;
							?>
							<div class="social__wrap">
							<?php
							if ( $dmc_author_twitter_check ) :
								?>
								<div class="social__item">
									<a class="social__link--twitter" href="http://twitter.com/<?php echo esc_html( $dmc_author_twitter_check ); ?>"  target="_blank" rel="noopener" title="View <?php echo esc_html( $author_name_first ); ?>'s Twitter feed">
										<span class="social__link--text">twitter</span>
									</a>
								</div>
								<?php
							endif;

							if ( $dmc_author_linkedin_check ) :
								?>
								<div class="social__item">
									<a class="social__link--linkedin" href="<?php echo esc_url( $dmc_author_linkedin_check ); ?>"  target="_blank" rel="noopener" title="View <?php echo esc_html( $author_name_first ); ?>'s LinkedIn page">
										<span class="social__link--text">linkedin</span>
									</a>
								</div>
								<?php
							endif;
							?>
							</div>

						</div>

						<div class="media-body">
							<h5>
								<?php echo esc_html( $author_name_first ); ?> <?php echo esc_html( $author_name_last ); ?>
							</h5>

							<h6>
								<?php echo esc_html( $dmc_author_position ); ?> @
								<?php echo esc_html( $dmc_author_company ); ?>
							</h6>



							<div class="additional">
								<a href="<?php echo esc_url( $archive_link ); ?>" title="<?php esc_attr( $link_title ); ?>" class="author-articles">
									<?php echo esc_html( $link_title ); ?>
								</a>
								<?php
								if ( $author_email ) :
									?>
									<a href="mailto:<?php echo antispambot( $author_email ); ?>">
										<?php echo antispambot( $author_email ); ?>
									</a>
									<?php
								endif;

								if ( $author_url ) :
									?>
									<a href="mailto:<?php echo esc_url( $author_url ); ?>">
										<?php echo esc_html( $author_name_first ); ?>'s website
									</a>
									<?php
								endif;
								?>
							</div>

						</div>
					</div>
				</div>

			<?php

		}
	}

}


//  smaller user profile box
function dmc_user_profile_small() {

	$output = '';
	if ( function_exists( 'coauthors_posts_links' ) ) {

		$coauthors = get_coauthors();
		foreach ( $coauthors as $coauthor ) {

			if ( isset( $coauthor->type ) && 'guest-author' == $coauthor->type ) {
				$author_id             = $coauthor->ID;
				$author_name           = $coauthor->first_name;
				$author_url            = $coauthor->website;
				$author_email          = $coauthor->user_email;
				$author_bio            = $coauthor->description;
				$dmc_author_post_links = coauthors_posts_links( ', ', ' & ', '', '', false );
				$archive_link          = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
				$link_title            = 'Articles by ' . $coauthor->first_name;
				$profile_image         = get_field( 'dmc_profile_image', $coauthor->ID );
				$display_profile_image = wp_get_attachment_image( $profile_image, 'dmc-staff-profile' );
			} else {
				$author_id             = get_the_author_meta( 'ID' );
				$author_name           = get_the_author_meta( 'first_name' );
				$author_url            = get_the_author_meta( 'user_url' );
				$author_email          = get_the_author_meta( 'user_email' );
				$author_bio            = get_the_author_meta( 'description' );
				$dmc_author_post_links = get_the_author_posts_link();
				$archive_link          = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$link_title            = 'Articles by ' . get_the_author_meta( 'first_name' );
				$profile_image         = get_field( 'dmc_profile_image', 'user_' . $author_id );
				$display_profile_image = wp_get_attachment_image( $profile_image, 'dmc-staff-profile' );
			}

				$output  = '';
				$output .= '<div class="entry-meta">';
				$output .= '<div class="byline author vcard">';

			if ( $profile_image ) {
				$output .= wp_get_attachment_image( $profile_image, 'thumbnail' );
				// else check for guest-author image
			} elseif ( function_exists( 'coauthors_posts_links' ) ) {
				$output .= '<a href="' . esc_url( $archive_link ) . '" class="author-profile-image" title="' . esc_attr( $link_title ) . '">' . coauthors_get_avatar( $coauthor, 128 ) . '</a>';
			}

				$output .= '<div class="holder">';
				$output .= $dmc_author_post_links;

				$output .= '<time class="updated" datetime="' . get_the_time( 'c' ) . '" pubdate>' . sprintf( __( '%s', 'dmcstarter' ), get_the_date(), get_the_date() ) . '</time> ';

			if ( $dmc_author_linkedin_check ) {
				$output .= '<span class="social__item"><a class="social__link--linkedin" href="' . $dmc_author_linkedin_check . '" title="View ' . $author_name . 's LinkedIn profile"><span class="social__link--text">twitter</span></a></span>';
			}

				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';

		}// End foreach().
	}// End if().
	echo $output;
}


function dmc_display_image_with_caption() {
	?>
	<div class="wp-caption">
	<?php
		the_post_thumbnail(
			'large',
			array(
				'class' => 'img-featured',
			)
		);
		$get_description = get_post( get_post_thumbnail_id() )->post_excerpt;
	if ( ! empty( $get_description ) ) {
		echo '<p class="wp-caption-text">' . esc_attr( $get_description ) . '</p>';
	}
	?>
	</div>
	<?php
}
