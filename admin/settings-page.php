<?php // bulksmsplugin - Settings Page



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// display the plugin settings page
function bulksmsplugin_display_settings_page() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'bulksmsplugin_options' );
			
			// output setting sections
			do_settings_sections( 'bulksmsplugin' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php
	
}


function bulk_sms_custom_form_call_back(){
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<?php if($_POST['submit']){
			  $fileName = $_FILES["fileToUpload"]["tmp_name"];
			  $get_setting_option = get_option( 'bulksmsplugin_options' );
				$row = 1;
				if (($handle = fopen( $fileName, "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						if($row > 1){        
							$num = count($data);

							$student_key = array(
								"name",
								"father_name",
								"mobile_number",
								"math",
								"hindi",
								"english",
								"social_science"

							);
							$student_records = array_combine($student_key,$data);
							//$new_array = array();
							$sender= 'TESTID';
							$message = "";
							$total_marks = $student_records['math']+$student_records['hindi']+$student_records['english']+$student_records['social_science'];
							$percentage = ($total_marks*100)/400;
							$message .= nl2br(" Student Name {$student_records['name']}");
							$message .= nl2br(" Math {$student_records['math']}");
							$message .= nl2br(" Hindi {$student_records['hindi']}");
							$message .= nl2br(" English {$student_records['english']}");
							$message .= nl2br(" Social Science {$student_records['social_science']}");
							$message .= nl2br(" Total Marks {$total_marks}");
							$message .= nl2br(" Total Percentage {$percentage}");
							
							$url="https://www.sms4india.com/api/v1/sendCampaign";
							
							$curl = curl_init();
							curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
							curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=".$get_setting_option['api_key']."&secret=".$get_setting_option['secret_key']."&usetype=stage&phone=".urlencode($student_records['mobile_number'])."&senderid=".$sender."&message=".$message);
							curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
							curl_setopt($curl, CURLOPT_URL, $url);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
							$result = curl_exec($curl);
							curl_close($curl);
							
						}
						$row++;
					}
					fclose($handle);


				}
    

			  
		}
		?>

		<form method="post" enctype="multipart/form-data">
			<?php 
			$response =  json_decode($result);
			if($response->status == 'success'){
			?>
			<div class="notice notice-success is-dismissible">
				<p><strong><?php _e( 'Congratulations, Sms has been sent you will receive  within 10 min!', 'bulksmsplugin' ); ?></strong></p>
			</div>
			<?php } ?>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<?php
			// submit button
			submit_button();

			?>
		</form>
	</div>
	<?php
}


// display admin notices
function bulksmsplugin_admin_notices() {
	
	// get the current screen
	$screen = get_current_screen();
	$response =  json_decode($result);

	// return if not bulksmsplugin settings page
	if ( $screen->id !== 'toplevel_page_bulksmsplugin' ) return;
	
	
	// check if settings updated
	if ( isset( $_GET[ 'settings-updated' ] ) ) {
		
		// if settings updated successfully
		if ( 'true' === $_GET[ 'settings-updated' ] ) : 
		
		?>
			
			<div class="notice notice-success is-dismissible">
				<p><strong><?php _e( 'Congratulations, you are awesome!', 'bulksmsplugin' ); ?></strong></p>
			</div>
			
		<?php 
		
		// if there is an error
		else : 
		
		?>
			
			<div class="notice notice-error is-dismissible">
				<p><strong><?php _e( 'Some thing went wrong', 'bulksmsplugin' ); ?></strong></p>
			</div>
			
		<?php 
		
		endif;
		
	}
	
}
add_action( 'admin_notices', 'bulksmsplugin_admin_notices' );


