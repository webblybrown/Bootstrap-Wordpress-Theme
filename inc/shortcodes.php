<?php
/**
 * Shortcodes for orchard hill
 *
 * @package orchard_hill
 */


// Shortcode for audio blocks
function show_audio_clips_shortcode() {
    if( have_rows('audio_clips', 'option') ): ?>
		<div class="audio-clips">
		<?php while( have_rows('audio_clips', 'option') ): the_row(); 

			// Fields
			$audio_title = get_sub_field('audio_title');
			$image = get_sub_field('image');
			$audio_file_mp3 = get_sub_field('audio_file_mp3');
			$audio_file_wav = get_sub_field('audio_file_wav');

			// $image url
			$image_attributes = wp_get_attachment_image_src( $image, 'medium' );
			if ($audio_file_mp3 || $audio_file_wav) {
				echo '<div class="audio-block">';
				echo '	<audio controls class="audio-block-inside"';
				if ($image)
					echo ' style="background-image: url('.$image_attributes[0].');"';
				echo '>';
				if ($audio_file_mp3)
					echo '		<source src="'.$audio_file_mp3.'" type="audio/mpeg">';
				if ($audio_file_wav)
					echo '		<source src="'.$audio_file_wav.'" type="audio/wav">';
				echo '		Your browser does not support the audio element.';
				echo '	</audio>';
				if ($audio_title) 
					echo '	<h3 class="audio-title">'.$audio_title.'</h3>';
				echo '</div>';
			}
		endwhile; ?>
		</div>
	<?php endif;
}
add_shortcode('show_audio_clips', 'show_audio_clips_shortcode');