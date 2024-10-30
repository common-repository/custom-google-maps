<?php

/*Register option settings*/
function cgm_register_settings() {
	/*Options Group, options (array), sanitize function*/
	register_setting( 'cgm-settings-group', 'cgm_options', 'cgm_sanitize_options');
}
add_action( 'admin_init', 'cgm_register_settings' );


/*IMPORTANT  FOR SECURITY*/
function cgm_sanitize_options( $input ) {
	if ($input['google_map_api'] == "" ) {
		add_settings_error(
            'hasNumberError',
            'validationError',
            'This field may not empty',
            'error');
	} else {

	$input['google_map_api'] = sanitize_text_field( $input['google_map_api']);

	return $input;
	}
}

/*The options page*/
function cgm_style_settings() {
?>

	<div class="wrap">
		<h2>Custom Google Maps <?php _e('Settings', 'custom-google-maps'); ?></h2>

		<div class="updated notice is-dismissible">
			<p>
				<?php _e('Do you like this plugin, buy me a coffee!', 'custom-google-maps'); ?>
			</p>
			<!--PAYPAL-->
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHRwYJKoZIhvcNAQcEoIIHODCCBzQCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYC1ODUZ9saCfzm2+wwFohk6HjqmDFcGbCjonpVrodBROUqQg0WSK0qWmiPfiCAQn2D8FFp1DchZKYoMamhSVc1Cnpa+0rKb1BpPrFIxfYlhL/gXlb+jpyRTuS3hg16zrx/PGGTNJzo0RL7S0vWCwHu8EJLhuEshB7rjdQqvTFK3NTELMAkGBSsOAwIaBQAwgcQGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIrmLFaKOa+k2AgaD2vYHplvgOTDiTRUg3QfPF/sqZyGdZE6LtPoTLrNnLBCbLoMXM8PmTpzaetCa0sy/6slQnGt8pNByTaUcrkbrpg59g6j37oNZMdTfMW0e/zhNmrUna6NmTYbr7uw000XMPWobx2ZqKJusI3XyA66zmRUM4muIGpn0z+DmlzqSVtLyNO//TX+IucSLQTgKlVHKUDbsrLyo9NbqP1savuoVmoIIDhzCCA4MwggLsoAMCAQICAQAwDQYJKoZIhvcNAQEFBQAwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDIxMzEwMTMxNVoXDTM1MDIxMzEwMTMxNVowgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBR07d/ETMS1ycjtkpkvjXZe9k+6CieLuLsPumsJ7QC1odNz3sJiCbs2wC0nLE0uLGaEtXynIgRqIddYCHx88pb5HTXv4SZeuv0Rqq4+axW9PLAAATU8w04qqjaSXgbGLP3NmohqM6bV9kZZwZLR/klDaQGo1u9uDb9lr4Yn+rBQIDAQABo4HuMIHrMB0GA1UdDgQWBBSWn3y7xm8XvVk/UtcKG+wQ1mSUazCBuwYDVR0jBIGzMIGwgBSWn3y7xm8XvVk/UtcKG+wQ1mSUa6GBlKSBkTCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQCBXzpWmoBa5e9fo6ujionW1hUhPkOBakTr3YCDjbYfvJEiv/2P+IobhOGJr85+XHhN0v4gUkEDI8r2/rNk1m0GA8HKddvTjyGw/XqXa+LSTlDYkqI8OwR8GEYj4efEtcRpRYBxV8KxAW93YDWzFGvruKnnLbDAF6VR5w/cCMn5hzGCAZowggGWAgEBMIGUMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMTYxMDIzMjAwNDU3WjAjBgkqhkiG9w0BCQQxFgQUIiXyzWgJE43G6cYIpoF2iDbRtjEwDQYJKoZIhvcNAQEBBQAEgYAMGhXsZCZpNs+d5VIqpPxELLALHAD6vWk7Yc7aU8WavJB727w4I6D8HJptMh7GtOkcu3rur9b/GjxAkE8wJpCafKu/QtayZM4+RXPOtMz0wgxxHnvLWJaFLSK+6fYA01fslR1mVKpLsVewzDDdW5MIlzqS9aV0I87qCsBlEs5UMA==-----END PKCS7-----
">
				<input type="image" src="https://www.paypalobjects.com/nl_NL/BE/i/btn/btn_donateCC_LG.gif"
				border="0" name="submit" alt="PayPal, de veilige en complete manier van online betalen.">
				<img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif"
				width="1" height="1">
			</form>
			<!--.PAYPAL-->
		</div>

		<?php
			/*Admin notices*/
			settings_errors();
		?>

			<p>
				<?php _e('Add a shortcode with the minimum requirements: Latitude and Longtitude!', 'custom-google-maps'); ?><br><span style="background-color: #ddd;">[cgm lat="" lng=""]</span></p>
				<p>There are several options for extend the shortcode:<br><span style="background-color: #ddd;">[cgm lat="" lng="" width="100%" height="300px" zoom="true/false" scrollwheel="true/false" controls="true/false"]</span></p>

			<form method="post" action="options.php">

				<?php
			/*Init settings options group*/
			settings_fields( 'cgm-settings-group' );

			/*Load options array*/
			$cgm_options = get_option( 'cgm_options' );
			?>

					<table class="form-table">
						<tr valign="top">
							<th scope="row">Google Maps API</th>
							<td>
								<input type="text" name="cgm_options[google_map_api]" value="<?php echo esc_attr( $cgm_options['google_map_api']); ?>"
								/>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Media</th>
							<td>
								<input id="image_attachment_url" type="text" name="cgm_options[media_url]" value="<?php echo esc_attr($cgm_options['media_url']); ?>"
								/>
								<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image', 'custom-google-maps' ); ?>"
								/>
								<span class="description"><?php _e('Upload an image.', 'custom-google-maps' ); ?></span>

								<?php wp_enqueue_media(); ?>

								<div class='image-preview-wrapper'>
									<img id='image-preview' src='<?php echo esc_attr($cgm_options[' media_url
									']); ?>' width='100' height='100' style='max-height: 100px; width: 100px;'>
								</div>
								<input type="hidden" name="cgm_options[media_id]" id="image_attachment_id" value="<?php echo esc_attr( $cgm_options['media_id']); ?>"
								/>
							</td>
						</tr>
					</table>

					<p class="submit">
						<input type="submit" class="button-primary" value="Opslaan">
					</p>
			</form>
			<?php print_r($cgm_options); ?>
	</div>

	<?php

}

add_action( 'admin_footer', 'media_selector_print_scripts' );

function media_selector_print_scripts() {

	// $my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
	$cgm_options 	= get_option( 'cgm_options' );

	$media_id 		= $cgm_options[ 'media_id' ];

	$media_url 		= $cgm_options[ 'media_url' ];

	?>
		<script type='text/javascript'>
		jQuery(document).ready(function($) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $media_id; ?>; // Set this
			var set_to_post_url = '<?php echo $media_url; ?>'; // Set this

			$('#image-preview').attr('src', set_to_post_url).css('width', 'auto');


			jQuery('#upload_image_button').on('click', function(event) {

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if (file_frame) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param('post_id', set_to_post_id);
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false // Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on('select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$('#image-preview').attr('src', attachment.url).css('width',
						'auto');
					$('#image_attachment_id').val(attachment.id);
					$('#image_attachment_url').val(attachment.url);

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

				// Finally, open the modal
				file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery('a.add_media').on('click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});

		});
		</script>
		<?php

}

?>