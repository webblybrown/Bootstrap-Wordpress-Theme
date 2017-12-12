<?php 

get_header(); ?>
<?php if( get_field('header_image') ): ?>
		<img src="<?php the_field('header_image'); ?>" style="width: 100%"/>
<?php endif; ?>
			<div class="container page">
							<ul class="breadcrumb">
								<i class='fa fa-home' aria-hidden='true'></i></a></li>
								<?php
									$ancestors_array = array_reverse(array_map('get_post', get_post_ancestors($post )));
									$ancestors_array[] = $post;
									$i = 1;
									$count = count($ancestors_array);
									foreach ($ancestors_array as $value) {
										if ($count == $i++) {
											echo '<li><span>' . get_the_title($post) . '</span></li>';
										} else {
											echo '<li><a href="' . get_permalink($value) . '">' . get_the_title($value) . '</a></li>';
										}
									}
								?> 
							</ul>
				<div class="col-md-3 no-pad-left">
						<div class="sidebar">
							<div class="sidebar-item">
								<div class="sub-nav">
									<?php
										if ($post->post_parent)	{
											$ancestors=get_post_ancestors($post->ID);
											$root=count($ancestors)-1;
											$parent = $ancestors[$root];
										} else {
											$parent = $post->ID;
										}

										$extra_pages = get_field('extra_sub_links', $parent);

										$args = array(
											'child_of'     => $parent,
											'echo'         => 0,
											'exclude'      => '',
											'include'      => '',
											'post_type'    => 'page',
											'post_status'  => 'publish',
											'sort_column'  => 'menu_order',
											'title_li'     => ''
										);

										$children = '								<h3 class="sub-nav-parent"><a href="'.get_permalink($parent).'">' . get_the_title($parent) . '</a></h3>';
										$children .= wp_list_pages($args);

										if ($children) { ?>

										<ul>
											<?php echo $children; ?>
											
											<?php if( $extra_pages ): ?>
										    <?php foreach( $extra_pages as $extra_page): ?>
										        <li>
										            <a href="<?php echo get_permalink($extra_page->ID); ?>"><?php echo get_the_title($extra_page->ID); ?></a>
										        </li>
										    <?php endforeach; ?>
											<?php endif; ?>
										</ul>
									<?php } ?>
								</div>
							</div>
							<div class="sidebar-item"> 
								<?php 

									$apply_pages = get_field('apply_now_button_pages', 'option');

									if( $apply_pages ):
										// Store the pages we've selected and push them into a new
										// array called $pages_array
										$pages_array = array();
										foreach( $apply_pages as $apply_page): 
											$pages_array[] = $apply_page->ID;
									    endforeach;
									    
									    $app_form_page = get_field('select_application_form_page', 'option');

									    if (is_page($pages_array)) : 
										    echo '<a href="';
											if ($app_form_page) {
												echo $app_form_page;
											} else {
												get_permalink(442);
											}
									    endif; 

									endif;

								?>
							</div>
                            

							
								<a href="<?php echo site_url(); ?>/vacancies/">
									<div class="apply-now-button">                  
										Available Jobs
							    	</div>
							    </a>	 
                                

	
						</div>

				</div>
                <div class="col-md-9 content-page">

                	<?php while ( have_posts() ) : the_post(); ?>


				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (!is_front_page()): ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
                	<?php 
                	$table = get_field( 'page_table' );

if ( $table ) {

    echo '<table border="0">';

        if ( $table['header'] ) {

            echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

            echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

                    foreach ( $tr as $td ) {

                        echo '<td>';
                            echo $td['c'];
                        echo '</td>';
                    }

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table>';
}
?>

                	<?php 
                	$table = get_field( 'page_table_2' );

if ( $table ) {

    echo '<table border="0">';

        if ( $table['header'] ) {

            echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

            echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

                    foreach ( $tr as $td ) {

                        echo '<td>';
                            echo $td['c'];
                        echo '</td>';
                    }

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table>';
}
?>
                	<?php 
                	$table = get_field( 'page_table_3' );

if ( $table ) {

    echo '<table border="0">';

        if ( $table['header'] ) {

            echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

            echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

                    foreach ( $tr as $td ) {

                        echo '<td>';
                            echo $td['c'];
                        echo '</td>';
                    }

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table>';
}
?>
                	<?php 
                	$table = get_field( 'page_table_4' );

if ( $table ) {

    echo '<table border="0">';

        if ( $table['header'] ) {

            echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

            echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

                    foreach ( $tr as $td ) {

                        echo '<td>';
                            echo $td['c'];
                        echo '</td>';
                    }

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table>';
}
?>
                	<?php 
                	$table = get_field( 'page_table_5' );

if ( $table ) {

    echo '<table border="0">';

        if ( $table['header'] ) {

            echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

            echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

                    foreach ( $tr as $td ) {

                        echo '<td>';
                            echo $td['c'];
                        echo '</td>';
                    }

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table>';
}
?>
	
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'orchard_hill' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

								<?php endwhile; // end of the loop. ?>
								<?php $id = get_queried_object_id(); ?>
                </div>

			</div>
	 
<?php get_footer(); ?>
