<?php

	function mo2f_frontend_get_forgotphone_form(){
		$random_mo_key = get_option('mo2f_new_customer');
		$message = $random_mo_key ? 'Please select the option and click on Continue button' :  'Please choose from below options:';
	?>
		<div class="mo2f_modal" tabindex="-1" role="dialog" id="mo2f_forgotphone_modal">
			<div class="mo2f-modal-backdrop"></div>
			<div class="mo2f_modal-dialog mo2f_modal-md">
				<div class="mo2f_modal-content">
					<div class="mo2f_modal-header">
						<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
						How would you like to authenticate yourself</h4>
					</div>
					<div class="mo2f_modal-body">
						<div id="kbaSection">
							<div style="padding-left:10px;padding-right:10px;fonnt-size:15px;"><?php echo isset($_SESSION['mo2f-login-message']) ? $_SESSION['mo2f-login-message'] : '';?></div>
							<p style="padding-left:10px;padding-right:10px;font-size: 15px;"><?php echo $message; ?></p>
							<div style="padding-left:40px;padding-right:40px;font-size: 15px;">
								<?php if(!$random_mo_key){ ?>
								<input type="radio"  name="mo2f_selected_forgotphone_option"  value="OTP OVER EMAIL"  checked="ckecked" />&nbsp;Send a one time passcode to my registered email<br /><br />
								<?php } ?>
								<input type="radio"  name="mo2f_selected_forgotphone_option"  value="KBA"  />&nbsp;Answer your Security Questions (KBA)
							
							<br /><br />
							<input type="button" name="miniorange_validtae_otp" value="Continue" class="button button-primary" onclick="mo2fselectforgotphoneoption();" />
						
							</div>
							<br>
							<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
								<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<style>
			.woocommerce .woocommerce-error {
				display: none !important;
			}
			.modal-backdrop{
				z-index: 0 !important;
			}
		</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#mo2f_forgotphone_modal').modal('show');
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			function mo2fselectforgotphoneoption(){
				var option = jQuery('input[name=mo2f_selected_forgotphone_option]:checked').val();
				document.getElementById("mo2f_challenge_forgotphone_form").elements[0].value = option;
				jQuery('#mo2f_challenge_forgotphone_form').submit();
			 }
		</script>
	<?php
	}

	function mo2f_frontend_get_kba_form(){
	?>
		<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal4">
			<div class="mo2f-modal-backdrop"></div>
			<div class="mo2f_modal-dialog mo2f_modal-md">
				<div class="mo2f_modal-content">
					<div class="mo2f_modal-header">
						<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
						Validate Security Questions</h4>
					</div>
					<div class="mo2f_modal-body center">
						<div id="kbaSection">
					
							<div id="mo_kba_title">
								<p class="mo2fa_display_message_frontend" ><?php echo isset($_SESSION['mo2f-login-message']) ? $_SESSION['mo2f-login-message'] : 'Please answer the following questions:'; ?></p><br />
							</div>
							<div id="mo2f_kba_content">
								<p style="text-align:center;font-size:15px;">
								<?php if(isset($_SESSION['mo_2_factor_kba_questions'])){
									echo $_SESSION['mo_2_factor_kba_questions'][0];
								?><br />
								<input class="mo2f-textbox" style="width:350px;" type="text" name="mo2f_answer_1" id="mo2f_answer_1" required="true" autofocus="true" pattern="(?=\S)[A-Za-z0-9_@.$#&amp;+-\s]{1,100}" title="Only alphanumeric letters with special characters(_@.$#&amp;+-) are allowed." autocomplete="off" ><br />
								<?php
									echo $_SESSION['mo_2_factor_kba_questions'][1];
								?><br />
								<input class="mo2f-textbox" style="width:350px;" type="text" name="mo2f_answer_2" id="mo2f_answer_2" required="true" pattern="(?=\S)[A-Za-z0-9_@.$#&amp;+-\s]{1,100}" title="Only alphanumeric letters with special characters(_@.$#&amp;+-) are allowed." autocomplete="off" >
								<?php 
									}
								?>
								</p>
							</div>
							
								<?php if(get_option('mo2f_login_policy')){
										if(get_option('mo2f_deviceid_enabled')){	
								?>
									<span class="mo2f_device" style="float:left; font-size:15px;"><input type="checkbox" name="miniorange_remember_device" id="miniorange_remember_device" />Remember this device.</span>
								<?php 
										}else{
								?>
									<input type="checkbox" name="miniorange_remember_device" id="miniorange_remember_device" style="display:none;" />
								<?php
										}
									}else{
								?>
									<input type="checkbox" name="miniorange_remember_device" id="miniorange_remember_device" style="display:none;" />
								<?php
									}
								?>
								<input type="button" name="miniorange_kba_validate" onclick="mo2f_validate_kba();" id="miniorange_kba_validate" class="button button-primary"  style="float:right;" value="Validate" />
								
						
						</div>
						<br /><br />
						<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
					</div>
				</div>
			</div>
		</div>
		<style>
			.woocommerce .woocommerce-error {
				display: none !important;
			}
			.modal-backdrop{
				z-index: 0 !important;
			}
		</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal4').modal('show');
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			function mo2f_validate_kba(){
				var ans1 = jQuery('#mo2f_answer_1').val();
				var ans2 = jQuery('#mo2f_answer_2').val();
				var check = jQuery('#miniorange_remember_device').prop('checked');
				document.getElementById("mo2f_submitkba_loginform").elements[0].value = ans1;
				document.getElementById("mo2f_submitkba_loginform").elements[1].value = ans2;
				document.getElementById("mo2f_submitkba_loginform").elements[2].value = check;
				jQuery('#mo2f_submitkba_loginform').submit();
			}
			jQuery('#mo2f_answer_2').keypress(function(e){
				  if(e.which == 13){//Enter key pressed
					e.preventDefault();
					mo2f_validate_kba();
				  } 
			});
		</script>
	<?php
	}

	function mo2f_frontend_get_trusted_device_form(){
	?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal">
		<div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
				Remember Device</h4>
			</div>
				<div class="mo2f_modal-body center">
				<div id="pushSection">
					
					<div id="mo_device_title" style="margin-bottom:10%;padding-top:6%;">
					
					<p style="text-align:center !important;">Do you want to remember this device?</p>
					
					</div>
				
					<div id="mo2f_device_content">
					<center>
						<input type="button" name="miniorange_trust_device_yes" onclick="mo_check_device_confirm();" id="miniorange_trust_device_yes" class="mo2f-button mo_green" style="margin-right:5%;" value="Yes" />
						
						<input type="button" name="miniorange_trust_device_no" onclick="mo_check_device_cancel();" id="miniorange_trust_device_no" class="mo2f-button mo_red" value="No" />
					</center>
					</div>
					<div id="showLoadingBar"  hidden>
						<center>
						<p style="text-align:center !important;">Please wait...We are taking you into your account.</p>
						 
							<img src="<?php echo plugins_url( 'includes/images/ajax-loader-login.gif' , __FILE__ );?>" />
						</center>
					</div>
					<br />
					<center>
						<span>
							<div style="font-size: 15px;">Click on <i><b>Yes</b></i> if its your personal device.<div/>
							<div style="font-size: 15px;">Click on <i><b>No</b></i> if its a public device.</div>
						</span>
					</center>
					
					<br />
					<br />
				</div>
				<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
			</div>
			
		</div>
		</div>
	</div>
	<style>

.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal').modal('show');
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			 }
			function mo_check_device_confirm(){
				jQuery('#mo2f_device_content').hide();
				jQuery('#mo_device_title').hide();
				jQuery('#showLoadingBar').show();
				jQuery('#mo2f_trust_device_confirm_form').submit();
			}
			function mo_check_device_cancel(){
				jQuery('#mo2f_device_content').hide();
				jQuery('#mo_device_title').hide();
				jQuery('#showLoadingBar').show();
				jQuery('#mo2f_trust_device_cancel_form').submit();
			}
		</script>
	<?php
	}
	
	function mo2f_frontend_getpush_oobemail_response($id){
	?>
		<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal1">
		<div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-md">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
				Accept Your Transaction</h4>
			</div>
		<div class="mo2f_modal-body center">
	
			<div id="otpMessage" > 
				<p class='mo2fa_display_message_frontend'><?php echo $_SESSION['mo2f-login-message']; ?></p>
			</div>
	
			
			<div id="mo_2_factor_push_page">
			<center>
				<div id="pushSection" >
					
					<a href="#showPushHelp" id="pushHelpLink" class="mo2f-link">See How It Works ?</a>
				
					<p style="font-size:20px;text-align:center;">Waiting for your approval...</p>
			
					<div id="showPushImage" style="margin-bottom:10px;" class="center">
			
						<img src="<?php echo plugins_url( 'includes/images/ajax-loader-login.gif' , __FILE__ );?>" style="display:inline!important;"/>
		
					</div>
					<span style="padding-right:2%;">
					<?php if(isset($_SESSION[ 'mo_2factor_login_status' ]) && $_SESSION[ 'mo_2factor_login_status' ] == 'MO_2_FACTOR_CHALLENGE_PUSH_NOTIFICATIONS'){ ?>
					<center>
						<?php if(get_option('mo2f_enable_forgotphone')){ ?>
						<a name="miniorange_login_forgotphone" onclick="mologinforgotphone();" id="miniorange_login_forgotphone" class="mo2f-link" >Forgot Phone?</a>
						<?php } ?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a name="miniorange_login_offline" onclick="mologinoffline();" id="miniorange_login_offline" class="mo2f-link" >Phone is Offline?</a>
					</center>
					
					<?php }else if(isset($_SESSION[ 'mo_2factor_login_status' ]) && $_SESSION[ 'mo_2factor_login_status' ] == 'MO_2_FACTOR_CHALLENGE_OOB_EMAIL' && get_user_meta($id,'mo2f_kba_registration_status',true)){ ?>
					<center><a href="#mo2f_alternate_login_kba" class="mo2f-link">Didn't receive mail?</a></center>
					<?php }
					?>
					</span>
						<br>
				
				</div>
				</center>
				<div id="showPushHelp" class="showPushHelp" hidden>
					<br>
					<center><a href="#showPushHelp" id="pushLink" class="mo2f-link">←Go Back.</a>
					<br>
						<div id="myCarousel" class="mo2f_carousel slide" data-ride="carousel">
						  <ol class="mo2f_carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
						</ol>
						<div class="mo2f_carousel-inner" role="listbox">
							<?php  if($_SESSION[ 'mo_2factor_login_status' ] == 'MO_2_FACTOR_CHALLENGE_OOB_EMAIL') { ?>
									<div class="item active">
								
							  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/email-with-link-login-flow-1.png" alt="First slide">
							</div>
						   <div class="item">
							<p>Click on Accept Transaction link to verify your email .</p><br>
							<img class="first-slide" src="https://login.xecurify.com/moas/images/help/email-with-link-login-flow-2.png" alt="First slide">
						 
						  </div>
						  <div class="item">
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/email-with-link-login-flow-3.png" alt="First slide">
						  </div>
							<?php } else {	?>
						  <!-- Indicators -->
						 
						
							<div class="item active">
								<p>You will receive a notification on your phone.</p><br>
							  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/push-login-flow.png" alt="First slide">
							</div>
						   <div class="item">
							<p>Open the notification and click on accept button.</p><br>
							<img class="first-slide" src="https://login.xecurify.com/moas/images/help/push-login-flow-1.png" alt="First slide">
						 
						  </div>
						  <div class="item">
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/push-login-flow-2.png" alt="First slide">
						  </div>
						 	<?php } ?>
						</div>
						</div>
					</center>
				</div>
				<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
			</div>
		
		 </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal1').modal('show');
			jQuery('body.woocommerce.login.form-row').hide();
			var timeout;
			pollPushValidation();
			function pollPushValidation()
			{	
				var transId = "<?php echo $_SESSION[ 'mo2f-login-transactionId' ];  ?>";
				var jsonString = "{\"txId\":\""+ transId + "\"}";
				var postUrl = "<?php echo get_option('mo2f_host_name');  ?>" + "/moas/api/auth/auth-status";
				
				jQuery.ajax({
					url: postUrl,
					type : "POST",
					dataType : "json",
					data : jsonString,
					contentType : "application/json; charset=utf-8",
					success : function(result) {
						var status = JSON.parse(JSON.stringify(result)).status;
						if (status == 'SUCCESS') {
							jQuery('#mo2f_mobile_validation_form').submit();
						} else if (status == 'ERROR' || status == 'FAILED' || status == 'DENIED') {
							jQuery('#mo2f_2fa_form_close').submit();
						} else {
							timeout = setTimeout(pollPushValidation, 3000);
						}
					}
				});
			}
			jQuery('#myCarousel').carousel('pause');
			jQuery('#pushHelpLink').click(function() {
				jQuery('#showPushHelp').show();
				jQuery('#pushSection').hide();
				jQuery('#otpMessage').hide();
				jQuery('#myCarousel').carousel(0); 
			});
			jQuery('#pushLink').click(function() {
				jQuery('#showPushHelp').hide();
				jQuery('#pushSection').show();
				jQuery('#otpMessage').show();
				jQuery('#myCarousel').carousel('pause');
			});
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			 }
			 function mologinoffline(){
				jQuery('#mo2f_show_softtoken_loginform').submit();
			 }
			 function mologinforgotphone(){
				jQuery('#mo2f_show_forgotphone_loginform').submit();
			 }
			  jQuery('a[href=\"#mo2f_alternate_login_kba\"]').click(function() {
				jQuery('#mo2f_alternate_login_kbaform').submit();
			 });
			 </script>
	<?php 
	}
	
	function mo2f_frontend_getqrcode(){	
			
	?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal2">
		<div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-md">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
				Scan QR Code</h4>
			</div>
				<div class="mo2f_modal-body center">
		
			<?php if(isset($_SESSION['mo2f-login-message']) && $_SESSION['mo2f-login-message'] == 'Error:OTP over Email'){ ?>
		
			<div  id="otpMessage"> 
				<p class='mo2fa_display_message_frontend'><?php echo 'Error occurred while sending OTP over email. Please try again.'; ?></p>
			</div>
			<?php } ?>
			
		
				<div id="scanQRSection">
					<p class='mo2fa_display_message_frontend'>Identify yourself by scanning the QR code with miniOrange Authenticator app.</p>
					<a href="#showQRHelp" id="helpLink" class="mo2f-link">See How It Works ?</a>
						<br><br>
					<div id="showQrCode" style="margin-bottom:10%;">
					<center><?php echo '<img src="data:image/jpg;base64,' . $_SESSION[ 'mo2f-login-qrCode' ] . '" />'; ?></center>
					</div>
							
				
				
						<?php if(get_option('mo2f_enable_forgotphone')){ ?>
						<a name="miniorange_login_forgotphone" onclick="mologinforgotphone();" id="miniorange_login_forgotphone" class="mo2f-link" >Forgot Phone?</a>
						<?php } ?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a name="miniorange_login_offline" onclick="mologinoffline();" id="miniorange_login_offline" class="mo2f-link" >Phone is Offline?</a>
				
					<br />
				
				</div>
				<div id="showQRHelp" class="showQRHelp" hidden>
					<br>
					<center><a href="#showQRHelp" id="qrLink" class="mo2f-link">←Back to Scan QR Code.</a>
					<br>
						<div id="myCarousel" class="mo2f_carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="mo2f_carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
							<li data-target="#myCarousel" data-slide-to="3"></li>
							<li data-target="#myCarousel" data-slide-to="4"></li>
						  </ol>
						<div class="mo2f_carousel-inner" role="listbox">
							<div class="item active">
							  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/qr-help-1.png" alt="First slide">
							</div>
						   <div class="item">
							<p>Open miniOrange Authenticator app and click on Authenticate.</p><br>
							<img class="first-slide" src="https://login.xecurify.com/moas/images/help/qr-help-2.png" alt="First slide">
						 
						  </div>
						  <div class="item">
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/qr-help-3.png" alt="First slide">
						  </div>
						  <div class="item">
						  <img class="first-slide" src="https://login.xecurify.com/moas//images/help/qr-help-4.png" alt="First slide">
						  </div>
						  <div class="item">
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/qr-help-5.png" alt="First slide">
						  </div>
						</div>
						</div>
					</center>
				</div>
				<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
		</div>
		 </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal2').modal('show');
			
			var timeout;
			pollMobileValidation();
			function pollMobileValidation()
			{
				var transId = "<?php echo $_SESSION[ 'mo2f-login-transactionId' ];  ?>";
				var jsonString = "{\"txId\":\""+ transId + "\"}";
				var postUrl = "<?php echo get_option('mo2f_host_name');  ?>" + "/moas/api/auth/auth-status";
				jQuery.ajax({
					url: postUrl,
					type : "POST",
					dataType : "json",
					data : jsonString,
					contentType : "application/json; charset=utf-8",
					success : function(result) {
						var status = JSON.parse(JSON.stringify(result)).status;
						if (status == 'SUCCESS') {
							var content = "<div id='success'><center><img src='" + "<?php echo plugins_url( 'includes/images/right.png' , __FILE__ );?>" + "' /></center></div>";
							jQuery("#showQrCode").empty();
							jQuery("#showQrCode").append(content);
							setTimeout(function(){jQuery("#mo2f_mobile_validation_form").submit();}, 100);
						} else if (status == 'ERROR' || status == 'FAILED') {
							var content = "<div id='error'><center><img src='" + "<?php echo plugins_url( 'includes/images/wrong.png' , __FILE__ );?>" + "' /></center></div>";
							jQuery("#showQrCode").empty();
							jQuery("#showQrCode").append(content);
							setTimeout(function(){jQuery('#mo2f_2fa_form_close').submit();}, 1000);
						} else {
							timeout = setTimeout(pollMobileValidation, 3000);
						}
					}
				});
			}
			jQuery('#myCarousel').carousel('pause');
			jQuery('#helpLink').click(function() {
				jQuery('#showQRHelp').show();
				jQuery('#scanQRSection').hide();
				
				jQuery('#myCarousel').carousel(0); 
			});
			jQuery('#qrLink').click(function() {
				jQuery('#showQRHelp').hide();
				jQuery('#scanQRSection').show();
				jQuery('#myCarousel').carousel('pause');
			});
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			 }
			 function mologinoffline(){
				jQuery('#mo2f_show_softtoken_loginform').submit();
			 }
			 function mologinforgotphone(){
				jQuery('#mo2f_show_forgotphone_loginform').submit();
			 }
			</script>
	<?php 
	}

	function mo2f_frontend_getotp_form(){
	?>	
	
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal3">
		<div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-md">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
				Validate OTP</h4>
			</div>
		<div class="mo2f_modal-body">
     

			<div  id="otpMessage">
				<p class="mo2fa_display_message_frontend" ><?php echo $_SESSION['mo2f-login-message']; ?></p>
			</div> 
			
				<div id="showOTP">
				<div class="mo2f-login-container">
					<?php if($_SESSION[ 'mo_2factor_login_status' ] != 'MO_2_FACTOR_CHALLENGE_GOOGLE_AUTHENTICATION'){	?>
					<a href="#showOTPHelp" id="otpHelpLink" class="mo2f-link">See How It Works ?</a>
					<?php } ?>
					<br />
					<input type="text" name="mo2fa_softtokenkey"  placeholder="Enter one time passcode" id="mo2fa_softtokenkey" required="true" class="mo2f-textbox" autofocus="true" pattern="[0-9]{4,8}" title="Only digits within range 4-8 are allowed."/>
					<br />
					<input type="button" name="miniorange_soft_token_submit" onclick="mootploginsubmit();" id="miniorange_soft_token_submit" class="button"  value="Validate" />
					<br><br>
					<?php if(get_option('mo2f_enable_forgotphone') && isset($_SESSION[ 'mo_2factor_login_status' ] ) && $_SESSION[ 'mo_2factor_login_status' ] != 'MO_2_FACTOR_CHALLENGE_OTP_OVER_EMAIL'){ ?>
					<a name="miniorange_login_forgotphone"  onclick="mologinforgotphone();" id="miniorange_login_forgotphone" class="mo2f-link"   >Forgot Phone ?</a>
					<?php } ?>
					<br><br>
				</div>
				</div>
			<div id="showOTPHelp" class="showOTPHelp" hidden>
				<br>
					<center><a href="#showOTP" id="otpLink" class="mo2f-link">←Go Back</a>
				<br>
				<div id="myCarousel" class="mo2f_carousel slide" data-ride="carousel">
					<!-- Indicators -->
     
					<?php if($_SESSION[ 'mo_2factor_login_status' ] == 'MO_2_FACTOR_CHALLENGE_SOFT_TOKEN'){ ?>
						<ol class="mo2f_carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
						<li data-target="#myCarousel" data-slide-to="3"></li>
						
						</ol>
						<div class="mo2f_carousel-inner" role="listbox">
      
						
						   <div class="item active">
						   <p>Open miniOrange Authenticator app and click on settings icon on top right corner.</p><br>
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/qr-help-2.png" alt="First slide">
						  </div>
						   <div class="item">
						   <p>Click on Sync button below to sync your time with miniOrange Servers. This is a one time sync to avoid otp validation failure.</p><br>
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/token-help-3.png" alt="First slide">
						  </div>
						  <div class="item">
						   <p>Go to Soft Token tab.</p><br>
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/token-help-2.png" alt="First slide">
						  </div>
						  <div class="item">
						   <p>Enter the one time passcode shown in miniOrange Authenticator app here.</p><br>
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/token-help-4.png" alt="First slide">
						  </div>
						</div>
					<?php } else  if($_SESSION[ 'mo_2factor_login_status' ] == 'MO_2_FACTOR_CHALLENGE_OTP_OVER_EMAIL') { ?>
						<ol class="mo2f_carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
						
						</ol>
						<div class="mo2f_carousel-inner" role="listbox">
							<div class="item active">
							  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/otp-help-1.png" alt="First slide">
							</div>
						   <div class="item">
						   <p>Check your email with which you registered and copy the one time passcode.</p><br>
							<img class="first-slide" src="https://login.xecurify.com/moas/images/help/otp-help-2.png" alt="First slide">
							</div>
						  <div class="item">
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/otp-help-3.png" alt="First slide">
						  </div>
						 </div>
					<?php } else if($_SESSION[ 'mo_2factor_login_status' ] == 'MO_2_FACTOR_CHALLENGE_OTP_OVER_SMS') { ?>
						<ol class="mo2f_carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
						
						</ol>
						<div class="mo2f_carousel-inner" role="listbox">
							<div class="item active">
							  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/otp-over-sms-login-flow-1.png" alt="First slide">
							</div>
						   <div class="item">
							<img class="first-slide" src="https://login.xecurify.com/moas/images/help/otp-over-sms-login-flow-2.png" alt="First slide">
							</div>
						  <div class="item">
						  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/otp-over-sms-login-flow-3.png" alt="First slide">
						  </div>
						 </div>
					<?php } else { ?> 
					<!-- phone call verification  -->
						<ol class="mo2f_carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						
						
						</ol>
						<div class="mo2f_carousel-inner" role="listbox">
							<div class="item active">
								<p>You will receive a phone call. Pick up the call and listen to the one time passcode carefully. </p>
							  <img class="first-slide" src="https://login.xecurify.com/moas/images/help/phone-call-login-flow-2.png" alt="First slide">
							</div>
						   <div class="item">
						   <p>Enter the one time passcode here and click on validate button to login.</p><br>
							<img class="first-slide" src="https://login.xecurify.com/moas/images/help/phone-call-login-flow.png" alt="First slide">
							</div>
						  
						 </div>
					<?php } ?>
					
				</div>
			</div>
			<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
			</div>
			</div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal3').modal('show');
		    jQuery('#otpHelpLink').click(function() {
				jQuery('#showOTPHelp').show();
				jQuery('#showOTP').hide();
				jQuery('#otpMessage').hide();
			});
			jQuery('#otpLink').click(function() {
				jQuery('#showOTPHelp').hide();
				jQuery('#showOTP').show();
				jQuery('#otpMessage').show();
			});
			
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			 }
			 function mologinforgotphone(){
				jQuery('#mo2f_show_forgotphone_loginform').submit();
			 }
			  function mootploginsubmit(){
				var otpkey = jQuery('#mo2fa_softtokenkey').val();
				document.getElementById("mo2f_submitotp_loginform").elements[0].value = otpkey;
				jQuery('#mo2f_submitotp_loginform').submit();
				
			 }
			 
			 jQuery('#mo2fa_softtokenkey').keypress(function(e){
				  if(e.which == 13){//Enter key pressed
					e.preventDefault();
					var otpkey = jQuery('#mo2fa_softtokenkey').val();
					document.getElementById("mo2f_submitotp_loginform").elements[0].value = otpkey;
					jQuery('#mo2f_submitotp_loginform').submit();
				  }
				 
			});
			
			

		</script>
	<?php
	}
	function prompt_user_to_register_frontend(){ ?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal5">
	 <div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-md">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
				Setup Two Factor</h4>
			</div>
	<div class="mo2f_modal-body center">
		<p class="mo2fa_display_message_frontend"><?php echo $_SESSION['mo2f-login-message']; ?></p>
			
			A new security system has been enabled to better protect your account. Please configure your Two-Factor Authentication method by setting up your account.
			<br><br>
			<div class="mo2f-login-container">
			<input type="email" autofocus="true" name="mo_useremail" id="mo_useremail" class="mo2f-textbox" style="width:305px !important;" required placeholder="person@example.com" />
			<br>
			<input type="button" name="miniorange_get_started" onclick="mouserregistersubmit();" class="button" value="Get Started" />
			<?php if( !get_option('mo2f_inline_registration')){ ?>
				<br><br>
				<input type="button" name="mo2f_skip_btn" onclick="moskipregistersubmit();" class="button " value="Skip" />
			<?php } ?>
			<br><br>
			</div>
			<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
		</div>
		
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal5').modal('show');
			
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			function mouserregistersubmit(){
				var userEmail = jQuery('#mo_useremail').val();
				document.getElementById("mo2f_inline_register_user_form").elements[0].value = userEmail;
				jQuery('#mo2f_inline_register_user_form').submit();
				
			 }
			 
			 jQuery('#mo_useremail').keypress(function(e){
				  if(e.which == 13){//Enter key pressed
					e.preventDefault();
					var userEmail = jQuery('#mo_useremail').val();
					document.getElementById("mo2f_inline_register_user_form").elements[0].value = userEmail;
					jQuery('#mo2f_inline_register_user_form').submit();
				  }
					
			});
			function moskipregistersubmit(){
				jQuery('#mo2f_inline_register_skip_form').submit();
			}
		</script>
	<?php }
	
	function prompt_user_for_validate_otp_frontend(){ ?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal6">
	 <div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-md">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
				Verify Your Email</h4>
			</div>
	<div class="mo2f_modal-body">
	<p class="mo2fa_display_message_frontend"><?php echo $_SESSION['mo2f-login-message']; ?></p>
	<center>
		<input  autofocus="true" type="text" name="otp_token" id="otp_token" required placeholder="Enter OTP" class="mo2f-textbox" style="width:305px !important;" />
			<br>
		<a href="#resendinlineotplink">Resend OTP ?</a>
		<input type="button" name="back" id="mo2f_inline_backto_regform" style="margin-left:20px;" class="button" value="Back" />
		<input name="submit" type="button" value="Validate OTP" class="button" onclick="movalidateotpsubmit();" />
		

	</center>		
		<br><br>
			<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
			</div>
	
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal6').modal('show');
			
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			function movalidateotpsubmit(){
				var otp = jQuery('#otp_token').val();
				document.getElementById("mo2f_inline_user_validate_otp_form").elements[0].value = otp;
				jQuery('#mo2f_inline_user_validate_otp_form').submit();
			 }
			 
			 jQuery('#otp_token').keypress(function(e){
				  if(e.which == 13){//Enter key pressed
					e.preventDefault();
					var otp = jQuery('#otp_token').val();
					document.getElementById("mo2f_inline_user_validate_otp_form").elements[0].value = otp;
					jQuery('#mo2f_inline_user_validate_otp_form').submit();
				  }
					
			});
			jQuery('a[href=\"#resendinlineotplink\"]').click(function(e) {
				jQuery('#mo2fa_inline_resend_otp_form').submit();
			});
			jQuery('#mo2f_inline_backto_regform').click(function() {	
					jQuery('#mo2f_goto_user_registration_form').submit();
			});
		</script>
	<?php }
	
	function prompt_user_to_select_2factor_method_frontend($current_user){
		$current_selected_method = get_user_meta($current_user,'mo2f_selected_2factor_method',true);
		if($current_selected_method == 'MOBILE AUTHENTICATION' 
		|| $current_selected_method == 'SOFT TOKEN' 
		|| $current_selected_method == 'PUSH NOTIFICATIONS'){
				
					prompt_user_for_miniorange_app_setup_frontend($current_user);
					
		}else if($current_selected_method == 'SMS' 
			|| $current_selected_method == 'PHONE VERIFICATION'){
					
					prompt_user_for_phone_setup_frontend($current_user);
					
		}else if($current_selected_method == 'GOOGLE AUTHENTICATOR' ){
			
					prompt_user_for_google_authenticator_setup_frontend($current_user);
					
		}else if($current_selected_method == 'AUTHY 2-FACTOR AUTHENTICATION'){
			prompt_user_for_authy_authenticator_setup_frontend($current_user);
		}else if($current_selected_method == 'KBA' ){
			
				prompt_user_for_kba_setup_frontend($current_user);
			
		}else if($current_selected_method == 'OUT OF BAND EMAIL' ){
			
				prompt_user_for_setup_success_frontend($current_user);
			
		}else{
			$opt = (array) get_option('mo2f_auth_methods_for_users'); ?>
<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal7">
	 <div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-lg">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
				Select Two Factor Method</h4>
			</div>
	<div class="mo2f_modal-body">
	
			<b>Select Any Two-Factor of your choice below and complete its setup.</b>
			<br>
				<input type="hidden" name="option" value="mo_2factor_validate_user_otp" />
				<br>
				<span class="<?php if( !(in_array("OUT OF BAND EMAIL", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; } ?>" >
					<label title="You will receive an email with link. You have to click the ACCEPT or DENY link to verify your email. Supported in Desktops, Laptops, Smartphones." class="mo2f_label">
								<input type="radio"  name="mo2f_selected_2factor_method" value="OUT OF BAND EMAIL"  />
								Email Verification
					</label>
					<br>
				</span>	
				
					<span class="<?php if( !(in_array("SMS", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; } ?>" >
						
							<label title="You will receive a one time passcode via SMS on your phone. You have to enter the otp on your screen to login. Supported in Smartphones, Feature Phones." class="mo2f_label">
								<input type="radio"  name="mo2f_selected_2factor_method" value="SMS" />
								OTP Over SMS
							</label>
					<br>	
				</span>
				
				<span class="<?php if(  !(in_array("PHONE VERIFICATION", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; } ?>">
					
							<label title="You will receive a phone call telling a one time passcode. You have to enter the one time passcode to login. Supported in Landlines, Smartphones, Feature phones." class="mo2f_label">
								<input type="radio"  name="mo2f_selected_2factor_method"  value="PHONE VERIFICATION"  />
								Phone Call Verification
							</label>
					<br>	
				</span>
				
				<span class="<?php if(  !(in_array("SOFT TOKEN", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; } ?>" >
							<label class="mo2f_label" title="You have to enter 6 digits code generated by miniOrange Authenticator App like Google Authenticator code to login. Supported in Smartphones only." >
								<input type="radio"  name="mo2f_selected_2factor_method" value="SOFT TOKEN"  />
								Soft Token
							</label>
							
					<br>	
				</span>
				
				<span class="<?php if(  !(in_array("MOBILE AUTHENTICATION", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; }?>">
					
							<label class="mo2f_label" title="You have to scan the QR Code from your phone using miniOrange Authenticator App to login. Supported in Smartphones only.">
								<input type="radio"  name="mo2f_selected_2factor_method"  value="MOBILE AUTHENTICATION"  />
								QR Code Authentication
							</label>
					<br>	
				</span>
				
				<span class="<?php if(  !(in_array("PUSH NOTIFICATIONS", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; } ?>" >
						
							<label class="mo2f_label" title="You will receive a push notification on your phone. You have to ACCEPT or DENY it to login. Supported in Smartphones only.">
								<input type="radio"  name="mo2f_selected_2factor_method"  value="PUSH NOTIFICATIONS"  />
								Push Notification
							</label>
					<br>		
						
				</span>
				
				
				<span class="<?php if( !(in_array("GOOGLE AUTHENTICATOR", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; }?>">
						
							<label title="You have to enter 6 digits code generated by Google Authenticaor App to login. Supported in Smartphones only." class="mo2f_label">
								<input type="radio"  name="mo2f_selected_2factor_method" value="GOOGLE AUTHENTICATOR"  />
								Google Authenticator
							</label>
				<br>
				</span>
				<span class="<?php if( !(in_array("AUTHY 2-FACTOR AUTHENTICATION", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; }?>">
						
							<label class="mo2f_label"  title="You have to enter 6 digits code generated by Authy 2-Factor Authentication App to login. Supported in Smartphones only.">
								<input type="radio"  name="mo2f_selected_2factor_method"  value="AUTHY 2-FACTOR AUTHENTICATION"  />
								Authy 2-Factor Authentication
							</label>
							<br>
				</span>
				
				<span class="<?php if( !(in_array("KBA", $opt))  ){ echo "mo2f_td_hide"; }else { echo "mo2f_td_show"; }?>">
				
					<label title="You have to answers some knowledge based security questions which are only known to you to authenticate yourself. Supported in Desktops,Laptops,Smartphones." class="mo2f_label">
					<input type="radio"  name="mo2f_selected_2factor_method"  value="KBA"  />
								Security Questions( KBA )
							</label>
				</span>
					
			<br><br>
			</div>
		<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
				</div>
			
		
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal7').modal('show');
			
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			jQuery('input:radio[name=mo2f_selected_2factor_method]').click(function() {
				var selectedMethod = jQuery(this).val();
				document.getElementById("mo2f_select_2fa_methods_form").elements[0].value = selectedMethod;
				jQuery('#mo2f_select_2fa_methods_form').submit();
			});
	
		</script>
		<?php } 
		} 
function prompt_user_for_authy_authenticator_setup_frontend($current_user){
	$mo2f_authy_auth = isset($_SESSION['mo2f_authy_keys']) ? $_SESSION['mo2f_authy_keys'] : null;
		$data = isset($_SESSION['mo2f_authy_keys']) ? $mo2f_authy_auth['authy_qrCode'] : null;
		$authy_secret = isset($_SESSION['mo2f_authy_keys']) ? $mo2f_authy_auth['authy_secret'] : null;
		$opt = (array) get_option('mo2f_auth_methods_for_users'); 
		?>
		<div class="mo2f_modal" tabindex="-1" role="dialog" id="mo2f_authy_modal">
			<div class="mo2f-modal-backdrop"></div>
				<div class="mo2f_modal-dialog mo2f_modal-lg" style="width:999px !important;margin:0px auto !important;">
					<div class="mo2f_modal-content">
						<div class="mo2f_modal-header">
							<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
					Setup Authy 2-Factor Authentication</h4>
						</div>
			
					<div class="mo2f_modal-body">
						<?php echo $_SESSION[ 'mo2f-login-message' ]; ?>
				<table style="border:hidden;">
				<tr>
				<td style="vertical-align:top;width:300px;padding-right:15px;border:none !important;">
					<div style="font-size: 18px !important;"><b>Step-1: Configure Authy App.</b></div><hr />
						<input type="button" name="mo2f_authy_configure" id="mo2f_authy_configure" class="button" value="Configure" /><br /><br />
						<?php if (sizeof($opt) > 1) { ?>
							<input type="button" name="back" id="mo2f_inline_back_btn" class="button" value="Back" />
						<?php } ?>
					
					
				</td>
				<td class="mo2f_separator mo2f_authy_table"></td>
				<td style="width:40%;padding-right:15px;vertical-align:top;border:none !important;">
					<div style="font-size: 18px !important;"><b>Step-2: Set up Authy App</b></div><hr>
					<div style="<?php echo isset($_SESSION['mo2f_authy_keys']) ? 'display:block' : 'display:none'; ?>">
					<ol class="mo2f_ordered_list">
					<li class="mo2f_list">Install the Authy 2-Factor Authentication App.</li>
					<li class="mo2f_list">Now open and configure Authy 2-Factor Authentication App.</li>
					<li class="mo2f_list"> Tap on Add Account and then tap on SCAN QR CODE in your App and scan the qr code.</li>
					</ol>
					<center><br><div id="displayQrCode" ><?php echo '<img src="data:image/jpg;base64,' . $data . '" />'; ?></div></center>
					<div><a  data-toggle="collapse" href="#mo2f_scanbarcode_a" aria-expanded="false" ><b>Can't scan the QR Code? </b></a></div>
					<div class="mo2f_collapse" id="mo2f_scanbarcode_a">
						<ol class="mo2f_ordered_list">
							<li class="mo2f_list">In Authy 2-Factor Authentication App, tap on ENTER KEY MANUALLY."</li>
							<li class="mo2f_list">In "Adding New Account" type your secret key:</li>
								<div style="padding: 10px; background-color: #f9edbe;width: 20em;text-align: center;" >
									<div style="font-size: 14px; font-weight: bold;line-height: 1.5;" >
									<?php echo $authy_secret; ?>
									</div>
									<div style="font-size: 80%;color: #666666;">
									Spaces don't matter.
									</div>
								</div>
							<li class="mo2f_list">Tap OK.</li>
						</ol>
					</div>
					</div>
				</td>
				<td class="mo2f_separator mo2f_authy_table"></td>
				<td style="vertical-align:top;width:25%;border:none !important;">
					<div style="font-size: 18px !important;"><b>Step-3: Verify and Save</b></div><hr>
					<div style="<?php echo isset($_SESSION['mo2f_authy_keys']) ? 'display:block' : 'display:none'; ?>">
					<li class="mo2f_list">Once you have scanned the qr code, enter the verification code generated by the Authenticator app</li>
					
						<span style="font-size:16px !important;"><b>Code: </b>
						<input class="mo2f_table_textbox" style="width:200px;" autofocus="true" required="true" type="text" id="authy_token" name="authy_token" placeholder="Enter OTP" style="width:95%;"/></span><br /><br/>
						<input type="button" name="validate" id="mo2f_authy_validate" class="button button-primary button-large" value="Verify and Save" />
					</div>
				</td>
			</tr><br>
		</table>
				<br><br>
			<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
			</div>
		 </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
.mo2f_authy_table{
	width: 1px !important;
	border-right: none !important;
	border-top: none !important;
	border-bottom: none !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#mo2f_authy_modal').modal('show');
			
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			jQuery('#mo2f_inline_back_btn').click(function() {	
					jQuery('#mo2f_goto_two_factor_form').submit();
			});
				jQuery('#mo2f_authy_configure').click(function() {
					jQuery('#mo2f_inline_authy_configure_form').submit();
				});
				jQuery('#mo2f_authy_validate').click(function() {
					var token = jQuery('#authy_token').val();
					document.getElementById("mo2f_inline_validate_authy_authentication_form").elements[0].value = token;
					jQuery('#mo2f_inline_validate_authy_authentication_form').submit();
				});
				
			 jQuery('#authy_token').keypress(function(e){
				  if(e.which == 13){//Enter key pressed
					e.preventDefault();
					var token = jQuery('#authy_token').val();
					document.getElementById("mo2f_inline_validate_authy_authentication_form").elements[0].value = token;
					jQuery('#mo2f_inline_validate_authy_authentication_form').submit();
				  }
					
			});
			</script>
	<?php
}
		
function prompt_user_for_google_authenticator_setup_frontend($current_user){ 
	$mo2f_google_auth = isset($_SESSION['mo2f_google_auth']) ? $_SESSION['mo2f_google_auth'] : null;
	$data = isset($_SESSION['mo2f_google_auth']) ? $mo2f_google_auth['ga_qrCode'] : null;
	$ga_secret = isset($_SESSION['mo2f_google_auth']) ? $mo2f_google_auth['ga_secret'] : null;
	$opt = (array) get_option('mo2f_auth_methods_for_users'); ?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal10">
	 <div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-lg" style="width:999px !important;margin:0px auto !important;">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
					Setup Google Authenticator</h4>
			</div>
			
	<div class="mo2f_modal-body">
	<?php echo $_SESSION['mo2f-login-message']; ?>
					<table style="border:hidden;" id="mo2f_ga_tab">
					<tr>
					<td style="vertical-align:top;width:200px !important;border: none !important;">
					<div style="font-size: 18px !important;"><b>Select Phone Type</b></div>
					<br>
						<p style="font-size: 15px !important;"><input type="radio" name="mo2f_inline_app_type_radio" value="android" <?php checked( $mo2f_google_auth['ga_phone'] == 'android' ); ?> /> <b>Android</b><br /><br />
							<input type="radio" name="mo2f_inline_app_type_radio" value="iphone" <?php checked( $mo2f_google_auth['ga_phone'] == 'iphone' ); ?> /> <b>iPhone</b><br /><br />
							<input type="radio" name="mo2f_inline_app_type_radio" value="blackberry" <?php checked( $mo2f_google_auth['ga_phone'] == 'blackberry' ); ?> /> <b>BlackBerry</b><br /><br /></p>
					<?php if (sizeof($opt) > 1) { ?>
					<input type="button" name="back" id="mo2f_inline_back_btn" class="button" value="Back" />
					<?php } ?>
					</td>
					<td class="mo2f_separator mo2f_ga_table"></td>
				<td style="width:400px;border: none !important;">
					
					
						<div id="mo2f_android_div" style="<?php echo $mo2f_google_auth['ga_phone'] == 'android' ? 'display:block' : 'display:none'; ?>">
							<div style="font-size: 18px !important;"><b>Install the Google Authenticator App for Android.</b></div>
							<ol class="mo2f_ordered_list">
								<li class="mo2f_list">On your phone,Go to Google Play Store.</li>
								<li class="mo2f_list">Search for <b>Google Authenticator.</b>
								<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">Download from the Google Play Store and install the application.</a>
								</li>
							
							</ol>
							<div style="font-size: 18px !important;">Now open and configure Google Authenticator.</div>
							<ol class="mo2f_ordered_list">
								<li class="mo2f_list">In Google Authenticator, touch Menu and select "Set up account."</li>
								<li class="mo2f_list">Select "Scan a barcode". Use your phone's camera to scan this barcode.</li>
							<center><br><div id="displayQrCode" ><?php echo '<img src="data:image/jpg;base64,' . $data . '" />'; ?></div></center>
								
							</ol>
							<br>
							<div><a  data-toggle="collapse" href="#mo2f_scanbarcode_a" aria-expanded="false" ><b>Can't scan the barcode? </b></a></div>
							<div class="mo2f_collapse" id="mo2f_scanbarcode_a">
								<ol class="mo2f_ordered_list">
									<li class="mo2f_list">In Google Authenticator, touch Menu and select "Set up account."</li>
									<li class="mo2f_list">Select "Enter provided key"</li>
									<li class="mo2f_list">In "Enter account name" type your full email address.</li>
									<li class="mo2f_list">In "Enter your key" type your secret key:</li>
										<div style="padding: 10px; background-color: #f9edbe;width: 20em;text-align: center;" >
											<div style="font-size: 14px; font-weight: bold;line-height: 1.5;" >
											<?php echo $ga_secret; ?>
											</div>
											<div style="font-size: 80%;color: #666666;">
											Spaces don't matter.
											</div>
										</div>
									<li class="mo2f_list">Key type: make sure "Time-based" is selected.</li>
									<li class="mo2f_list">Tap Add.</li>
								</ol>
							</div>
							
						</div>
					
						<div id="mo2f_iphone_div" style="<?php echo $mo2f_google_auth['ga_phone'] == 'iphone' ? 'display:block' : 'display:none'; ?>">
							<div style="font-size: 18px !important;"><b>Install the Google Authenticator app for iPhone.</b></div>
							<ol class="mo2f_ordered_list">
								<li class="mo2f_list">On your iPhone, tap the App Store icon.</li>
								<li class="mo2f_list">Search for <b>Google Authenticator.</b>
								<a href="http://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank">Download from the App Store and install it</a>
								</li>
							</ol>
							<div style="font-size: 18px !important;">Now open and configure Google Authenticator.</div>
							<ol class="mo2f_ordered_list">
								<li class="mo2f_list">In Google Authenticator, tap "+", and then "Scan Barcode."</li>
								<li class="mo2f_list">Use your phone's camera to scan this barcode.
									<br><div id="displayQrCode" >
									<center>
									<?php echo '<img src="data:image/jpg;base64,' . $data . '" />'; ?>
									</center>
									</div>
									<br>
									<a  data-toggle="collapse" href="#mo2f_scanbarcode_i" aria-expanded="false" ><b>Can't scan the barcode? </b></a>
							<div class="mo2f_collapse" id="mo2f_scanbarcode_i"  >
								<ol class="mo2f_ordered_list">
									<li class="mo2f_list">In Google Authenticator, tap +.</li>
									<li class="mo2f_list">Key type: make sure "Time-based" is selected.</li>
									<li class="mo2f_list">In "Account" type your full email address.</li>
									<li class="mo2f_list">In "Key" type your secret key:</li>
										<div style="padding: 10px; background-color: #f9edbe;width: 20em;text-align: center;" >
											<div style="font-size: 14px; font-weight: bold;line-height: 1.5;" >
											<?php echo $ga_secret; ?>
											</div>
											<div style="font-size: 80%;color: #666666;">
											Spaces don't matter.
											</div>
										</div>
									<li class="mo2f_list">Tap Add.</li>
								</ol>
							</div>
								</li>
							</ol>
							<br>
							
						</div>
						<div id="mo2f_blackberry_div" style="<?php echo $mo2f_google_auth['ga_phone'] == 'blackberry' ? 'display:block' : 'display:none'; ?>">
							<div style="font-size: 18px !important;"><b>Install the Google Authenticator app for BlackBerry</b></div>
							
							<ol class="mo2f_ordered_list">
								<li class="mo2f_list">On your phone, open a web browser.Go to <b>m.google.com/authenticator.</b></li>
								<li class="mo2f_list">Download and install the Google Authenticator application.</li>
							</ol>
							<div style="font-size: 18px !important;">Now open and configure Google Authenticator.</div>
							<ol class="mo2f_ordered_list">
								<li class="mo2f_list">In Google Authenticator, select Manual key entry.</li>
								<li class="mo2f_list">In "Enter account name" type your full email address.</li>
								<li class="mo2f_list">In "Enter key" type your secret key:</li>
									<div style="padding: 10px; background-color: #f9edbe;width: 20em;text-align: center;" >
										<div style="font-size: 14px; font-weight: bold;line-height: 1.5;" >
										<?php echo $ga_secret; ?>
										</div>
										<div style="font-size: 80%;color: #666666;">
										Spaces don't matter.
										</div>
									</div>
								<li class="mo2f_list">Choose Time-based type of key.</li>
								<li class="mo2f_list">Tap Save.</li>
							</ol>
						</div>
						<br>
					</td>
					<td class="mo2f_separator mo2f_ga_table"></td>
				<td style="vertical-align:top;border: none !important;">
						<div style="<?php echo isset($_SESSION['mo2f_google_auth']) ? 'display:block' : 'display:none'; ?>">
							<div style="font-size: 18px !important;"><b>Verify and Save</b></div><br/>
							<div style="font-size: 15px !important;">Once you have scanned the barcode, enter the 6-digit verification code generated by the Authenticator app</div>
							<span style="font-size:16px;"><b>Code: </b>
							<input class="mo2f_table_textbox_1"  autofocus="true" required="true" type="text" id="google_token" name="google_token" placeholder="Enter OTP" /></span><br /><br/>
					
							<input type="button" name="validate" id="validate" class="button" onclick="mo2f_inline_verify_ga_code();" value="Verify and Save" />
							
						</div>
						</td>
					<tr>
				</table>
	</div>
			<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
.mo2f_ga_table{
	width: 1px !important;
	border-right: none !important;
	border-top: none !important;
	border-bottom: none !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal10').modal('show');
			
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			jQuery('#mo2f_inline_back_btn').click(function() {	
					jQuery('#mo2f_goto_two_factor_form').submit();
			});
				jQuery('input:radio[name=mo2f_inline_app_type_radio]').click(function() {
					var selectedPhone = jQuery(this).val();
					document.getElementById("mo2f_inline_app_type_ga_form").elements[0].value = selectedPhone;
					jQuery('#mo2f_inline_app_type_ga_form').submit();
				});
				function mo2f_inline_verify_ga_code(){
					var token = jQuery('#google_token').val();
					document.getElementById("mo2f_inline_verify_ga_code_form").elements[0].value = token;
					jQuery('#mo2f_inline_verify_ga_code_form').submit();
				 }
			 
			 jQuery('#google_token').keypress(function(e){
				  if(e.which == 13){//Enter key pressed
					e.preventDefault();
					var token = jQuery('#google_token').val();
					document.getElementById("mo2f_inline_verify_ga_code_form").elements[0].value = token;
					jQuery('#mo2f_inline_verify_ga_code_form').submit();
				  }
					
			});
		</script>
	<?php }
	function prompt_user_for_phone_setup_frontend($current_user){ 
	$opt = (array) get_option('mo2f_auth_methods_for_users'); 
	?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal8">
	 <div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-md">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
					Verify Your Phone</h4>
			</div>
	<div class="mo2f_modal-body">
		<p style="font-size: 15px !important;"><?php echo $_SESSION['mo2f-login-message']; ?></p>

			<div class="mo_margin_left">	
				<div class="mo2f_row">
					<div style="font-size:20px">Enter your phone number</div>
						<input class="mo2f_textbox"  type="text" name="verify_phone" id="phone" style="padding-left:40px!important;height:30px !important;"
						    value="<?php if( isset($_SESSION['mo2f_phone'])){ echo $_SESSION['mo2f_phone'];} else echo get_user_meta($current_user,'mo2f_user_phone',true); ?>" pattern="[\+]?[0-9]{1,4}\s?[0-9]{7,12}" title="Enter phone number without any space or dashes" />
						<br />
						<input type="button" name="verify" onclick="moinlineverifyphone();" class="button" value="Verify" />
				</div>
<br />				
			<div class="mo2f_row">
						<div style="font-size:20px" >Enter One Time Passcode</div>
						
								<input class="mo2f_textbox"  style="width:170px !important;height:30px !important;border-radius: 4px !important;" autofocus="true" type="text" name="otp_token" placeholder="Enter OTP" id="otp_token"/>
								<?php if (get_user_meta($current_user, 'mo2f_selected_2factor_method',true) == 'SMS'){ ?>
									<a href="#resendsmslink">Resend OTP ?</a>
								<?php } else {?>
									<a href="#resendsmslink">Call Again ?</a>
								<?php } ?><br>
					
			</div><br />
					<?php if (sizeof($opt) > 1) { ?>
					<input type="button" name="back" id="mo2f_inline_back_btn" class="button" value="Back" />
					<?php } ?>
					<input type="button" name="validate" onclick="moverifyotp();" class="button" value="Validate OTP" />
			</div>
			<br><br>
			<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
	</div>
		
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal8').modal('show');
			jQuery("#phone").intlTelInput();
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			
			jQuery('#mo2f_inline_back_btn').click(function() {	
					jQuery('#mo2f_goto_two_factor_form').submit();
			});
			
			jQuery('a[href=\"#resendsmslink\"]').click(function(e) {
				jQuery('#mo2fa_inline_resend_otp_form').submit();
			});
			
			function moinlineverifyphone(){
				var phone = jQuery('#phone').val();
				document.getElementById("mo2f_inline_verifyphone_form").elements[0].value = phone;
				jQuery('#mo2f_inline_verifyphone_form').submit();
			 }
			 
			 jQuery('#phone').keypress(function(e){
				  if(e.which == 13){//Enter key pressed
					e.preventDefault();
					var phone = jQuery('#phone').val();
					document.getElementById("mo2f_inline_verifyphone_form").elements[0].value = phone;
					jQuery('#mo2f_inline_verifyphone_form').submit();
				  }
					
			});
			
			function moverifyotp(){
				var otp = jQuery('#otp_token').val();
				document.getElementById("mo2f_inline_validateotp_form").elements[0].value = otp;
				jQuery('#mo2f_inline_validateotp_form').submit();
			 }
			 
			 jQuery('#otp_token').keypress(function(e){
				  if(e.which == 13){//Enter key pressed
					e.preventDefault();
					var otp = jQuery('#otp_token').val();
					document.getElementById("mo2f_inline_validateotp_form").elements[0].value = otp;
					jQuery('#mo2f_inline_validateotp_form').submit();
				  }
					
			});
			
		</script>
	
	
	
	<?php }
	function prompt_user_for_miniorange_app_setup_frontend($current_user){ 
		$opt = (array) get_option('mo2f_auth_methods_for_users');
		$user = isset($_SESSION['mo2f_current_user']) ? unserialize($_SESSION['mo2f_current_user']) : null;
	?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal9">
	 <div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-lg" style="margin:0px auto !important;">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
						Setup miniOrange Authenticator App</h4>
			</div>
	<div class="mo2f_modal-body">
	<div style="font-size: 15px !important;"><?php echo $_SESSION['mo2f-login-message']; ?></div>
		
			<?php download_instruction_for_mobile_app($user); ?>
		<div class="mo_margin_left">
			<div style="font-size:15px !important;"><b>Step-2 : Scan QR code</b></div><hr class="mo_hr">
			<div id="mo2f_configurePhone" style="font-size: 15px !important;">Please click on 'Configure your phone' button below to scan QR Code.
			<br>
			<?php if (sizeof($opt) > 1) { ?>
					<input type="button" name="back" id="mo2f_inline_back_btn" class="button" value="Back" />
			<?php } ?>
					<input type="button" name="submit" onclick="moconfigureapp();" class="button" value="Configure your phone" />
			</div>
			
			<?php 
						if(isset($_SESSION[ 'mo2f_show_qr_code' ]) && $_SESSION[ 'mo2f_show_qr_code' ] == 'MO_2_FACTOR_SHOW_QR_CODE' && isset($_POST['miniorange_inline_show_qrcode_nonce']) && wp_verify_nonce( $_POST['miniorange_inline_show_qrcode_nonce'], 'miniorange-2-factor-inline-show-qrcode-nonce' )){
									initialize_inline_mobile_registration_frontend(); ?>
									<script>jQuery("#mo2f_app_div").hide();</script>
						<?php } ?>
			
		</div>
	
		<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
		</div>
		 </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
#mo2f_inline_table td{
	border: none !important;
}
#mo2f_phone_id{
	margin: 0px !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal9').modal('show');
			
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			
			function moconfigureapp(){
				jQuery('#mo2f_inline_configureapp_form').submit();
			 }
			 jQuery('#mo2f_inline_back_btn').click(function() {	
					jQuery('#mo2f_goto_two_factor_form').submit();
			});
		</script>
	
	
	<?php } 
	function initialize_inline_mobile_registration_frontend(){
		$data = $_SESSION[ 'mo2f-login-qrCode' ];
		$url = get_option('mo2f_host_name');
		$opt = (array) get_option('mo2f_auth_methods_for_users');
		?>
		
			<p style="font-size: 15px !important;">Open your <b>miniOrange Authenticator</b> app and click on <b>Configure button</b> to scan the QR Code. Your phone should have internet connectivity to scan QR code.</p>
			<div class="red">
			<p style="font-size: 15px !important;color: red;">I am not able to scan the QR code, <a  data-toggle="collapse" href="#mo2f_scanqrcode" aria-expanded="false" >click here </a></p></div>
			<div class="mo2f_collapse" id="mo2f_scanqrcode" style="padding-left:15px !important;">
				Follow these instructions below and try again.
				<ol>
					<li>Make sure your desktop screen has enough brightness.</li>
					<li>Open your app and click on Configure button to scan QR Code again.</li>
					<li>If you get cross mark on QR Code then click on 'Refresh QR Code' link.</li>
				</ol>
			</div>
			
			<a href="#mo2f_refreshQRCode" style="font-size: 15px !important;">Click here to Refresh QR Code.</a>
			<div id="displayInlineQrCode" style="margin-left:300px;"><?php echo '<img style="width:200px;" src="data:image/jpg;base64,' . $data . '" />'; ?>
			</div>
			<?php 
			if (sizeof($opt) > 1) { ?>
					<input type="button" name="back" id="mo2f_inline_back_to_btn" class="button" value="Back" />
			<?php } ?>
		
			
	
			<script>
			jQuery('#mo2f_inline_back_to_btn').click(function() {	
					jQuery('#mo2f_goto_two_factor_form').submit();
			});
			jQuery('a[href=\"#mo2f_refreshQRCode\"]').click(function(e) {	
					jQuery('#mo2f_inline_configureapp_form').submit();
			});
			jQuery("#mo2f_configurePhone").hide();
			var timeout;
			pollInlineMobileRegistration();
			function pollInlineMobileRegistration()
			{
				var transId = "<?php echo $_SESSION[ 'mo2f-login-transactionId' ];  ?>";
				var jsonString = "{\"txId\":\""+ transId + "\"}";
				var postUrl = "<?php echo $url;  ?>" + "/moas/api/auth/registration-status";
				jQuery.ajax({
					url: postUrl,
					type : "POST",
					dataType : "json",
					data : jsonString,
					contentType : "application/json; charset=utf-8",
					success : function(result) {
						var status = JSON.parse(JSON.stringify(result)).status;
						if (status == 'SUCCESS') {
							var content = "<br/><div id='success'><img style='width:165px;margin-top:-1%;margin-left:2%;' src='" + "<?php echo plugins_url( 'includes/images/right.png' , __FILE__ );?>" + "' /></div>";
							jQuery("#displayInlineQrCode").empty();
							jQuery("#displayInlineQrCode").append(content);
							setTimeout(function(){jQuery("#mo2f_inline_mobile_register_form").submit();}, 1000);
						} else if (status == 'ERROR' || status == 'FAILED') {
							var content = "<br/><div id='error'><img style='width:165px;margin-top:-1%;margin-left:2%;' src='" + "<?php echo plugins_url( 'includes/images/wrong.png' , __FILE__ );?>" + "' /></div>";
							jQuery("#displayInlineQrCode").empty();
							jQuery("#displayInlineQrCode").append(content);
							jQuery("#messages").empty();
							
							jQuery("#messages").append("<div class='error mo2f_error_container'> <p class='mo2f_msgs'>An Error occured processing your request. Please try again to configure your phone.</p></div>");
						} else {
							timeout = setTimeout(pollInlineMobileRegistration, 3000);
						}
					}
				});
			}
			</script>
	<?php }
	
	function prompt_user_for_kba_setup_frontend($current_user){ 
	$opt = (array) get_option('mo2f_auth_methods_for_users'); ?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="myModal11">
	 <div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-lg">
			<div class="mo2f_modal-content">
			<div class="mo2f_modal-header">
				<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
						Setup Security Questions (KBA)</h4>
			</div>
	<div class="mo2f_modal-body">
	<p id="validation_msg"><?php echo $_SESSION['mo2f-login-message']; ?></p>
		<div class="mo_margin_left">
		<?php mo2f_configure_kba_questions(); ?>
		<br />
		<?php if (sizeof($opt) > 1) { ?>
					<input type="button" name="back" id="mo2f_inline_back_btn" class="button" value="Back" />
		<?php } ?>
		<input type="button" name="validate" onclick="moinlinesavekba();" class="button" value="Save" />
		</div>
		
		<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
				<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
				<?php }?>
	</div>
		 </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
</style>
		<script>
			jQuery('.woocommerce-error').hide();
			jQuery('#myModal11').modal('show');
			
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
			
			function moinlinesavekba(){
				var kba_1 = jQuery('#mo2f_kbaquestion_1').val();
				var kba_2 = jQuery('#mo2f_kba_ans1').val();
				var kba_3 = jQuery('#mo2f_kbaquestion_2').val();
				var kba_4 = jQuery('#mo2f_kba_ans2').val();
				var kba_5 = jQuery('#mo2f_kbaquestion_3').val();
				var kba_6 = jQuery('#mo2f_kba_ans3').val();
				
				var regx = /^[a-zA-z0-9_@.$#&+-\s]*$/;
				
				if(!(kba_2.match(regx) && kba_4.match(regx) && kba_6.match(regx))){
					jQuery('#validation_msg').append("Only alphanumeric letters with special characters (_@.$#&amp;+-) are allowed.");
					return;
				}
				
				document.getElementById("mo2f_inline_save_kba_form").elements[0].value = kba_1;
				document.getElementById("mo2f_inline_save_kba_form").elements[1].value = kba_2;
				document.getElementById("mo2f_inline_save_kba_form").elements[2].value = kba_3;
				document.getElementById("mo2f_inline_save_kba_form").elements[3].value = kba_4;
				document.getElementById("mo2f_inline_save_kba_form").elements[4].value = kba_5;
				document.getElementById("mo2f_inline_save_kba_form").elements[5].value = kba_6;
				document.getElementById("mo2f_inline_save_kba_form").elements[6].value = '';
				jQuery('#mo2f_inline_save_kba_form').submit();
			 }
			 jQuery('#mo2f_inline_back_btn').click(function() {	
					jQuery('#mo2f_goto_two_factor_form').submit();
			});
		</script>
		
	<?php }
	
	function prompt_user_for_setup_success_frontend($id){
		$mo2f_second_factor = get_user_meta($id,'mo2f_selected_2factor_method',true);
		if($mo2f_second_factor == 'OUT OF BAND EMAIL'){
			$mo2f_second_factor = 'Email Verification';
		}else if($mo2f_second_factor == 'SMS'){
			$mo2f_second_factor = 'OTP over SMS';
		}else if($mo2f_second_factor == 'PHONE VERIFICATION'){
			$mo2f_second_factor = 'Phone Call Verification';
		}else if($mo2f_second_factor == 'SOFT TOKEN'){
			$mo2f_second_factor = 'Soft Token';
		}else if($mo2f_second_factor == 'MOBILE AUTHENTICATION'){
			$mo2f_second_factor = 'QR Code Authentication';
		}else if($mo2f_second_factor == 'PUSH NOTIFICATIONS'){
			$mo2f_second_factor = 'Push Notification';
		}else if($mo2f_second_factor == 'GOOGLE AUTHENTICATOR'){
			$mo2f_second_factor = 'Google Authenticator';
		}else if($mo2f_second_factor == 'AUTHY 2-FACTOR AUTHENTICATION'){
			$mo2f_second_factor = 'Authy 2-Factor Authentication';
		}else if($mo2f_second_factor == 'KBA'){
			$mo2f_second_factor = 'Security Questions (KBA)';
		}
		$status = get_user_meta($id,'mo_2factor_user_registration_status',true);
	?>
	<div class="mo2f_modal" tabindex="-1" role="dialog" id="mo2f_modal_inline_setup">
		<div class="mo2f-modal-backdrop"></div>
		<div class="mo2f_modal-dialog mo2f_modal-lg">
			<div class="mo2f_modal-content">
				<div class="mo2f_modal-header">
					<h4 class="mo2f_modal-title"><button type="button" class="mo2f_close" data-dismiss="modal" aria-label="Close" title="Back to login" onclick="mologinback();"><span aria-hidden="true">&times;</span></button>
						Two Factor Setup Complete</h4>
				</div>
				<div class="mo2f_modal-body">
					<?php if($status == 'MO_2_FACTOR_PLUGIN_SETTINGS'){
					?>
					<center>
					<h4 style="font-size: 20px !important;><b style="color:#7EAFB7;"><?php echo $mo2f_second_factor; ?> </b>has been set your Two Factor method for login.<br>
					Next time when you will login, you will be prompted <?php echo $mo2f_second_factor; ?> as your 2nd factor.
					</h4><br />
					</center>
					
					<?php } if($status != 'MO_2_FACTOR_PLUGIN_SETTINGS'){
					?><center><div id="validation_msg" style="color:red;"></div></center>
						<div id="mo2f_show_kba_reg" class="mo2f_inline_padding">
						<div id="mo2f_kba_browser">
							<div class="mo2fa_display_message_frontend"> Please set your security questions. It will be used as an alternate login or backup method for all authentication methods. It will also be used as 2nd factor when you will try to login from mobile browser.</div>
						</div>
						<?php echo isset($_SESSION[ 'mo2f-login-message' ]) ? '<p style="color:red;" >' . $_SESSION[ 'mo2f-login-message' ] . '</p>': '';?>
							<?php mo2f_configure_kba_questions(); ?>
							<input type="button" name="validate" onclick="moinlinesavekba();" class="button" value="Save" /> 
						</div>
					<?php }
						if($status == 'MO_2_FACTOR_PLUGIN_SETTINGS'){ ?>
					<center>
					<br /><br />
					<div style="font-size: 16px !important"><a href="#mo2f_login_account">Click Here</a></div><div style="font-size: 16px !important">to sign-in into your account.</div>
					<br>
					</center>
					<?php } ?>
					<?php if(get_option('mo2f_disable_poweredby') != 1 ){?>
					<div class="mo2f_powered_by_div"><a target="_blank" href="http://miniorange.com/2-factor-authentication"><div class="mo2f_powered_by_miniorange" style="background-image: url('<?php if(get_option('mo2f_enable_custom_poweredby')==1) echo site_url().'/wp-content/uploads/custom.png'; else echo plugins_url('/includes/images/miniOrange2.png',__FILE__); ?>');"></div></a></div>
					<?php }?>
					</div>
				
			</div>
		</div>
	</div>
<style>
.woocommerce .woocommerce-error {
  display: none !important;
}
.modal-backdrop{
	z-index: 0 !important;
}
.mo2f_kba_table{
	table-layout: auto !important;
}
.mo2f_kba_table td{
	border: none !important;
}
</style>
	<script>
		jQuery('.woocommerce-error').hide();
		jQuery('#mo2f_modal_inline_setup').modal('show');
			
			
			jQuery('a[href=\"#mo2f_login_account\"]').click(function(e) {
				jQuery('#mo2f_inline_register_skip_form').submit();
			});
			function moinlinesavekba(){
				var kba_1 = jQuery('#mo2f_kbaquestion_1').val();
				var kba_2 = jQuery('#mo2f_kba_ans1').val();
				var kba_3 = jQuery('#mo2f_kbaquestion_2').val();
				var kba_4 = jQuery('#mo2f_kba_ans2').val();
				var kba_5 = jQuery('#mo2f_kbaquestion_3').val();
				var kba_6 = jQuery('#mo2f_kba_ans3').val();
				
				var regx = /^[a-zA-z0-9_@.$#&+-\s]*$/;
				
				if(!(kba_2.match(regx) && kba_4.match(regx) && kba_6.match(regx))){
					jQuery('#validation_msg').empty().append("Only alphanumeric letters with special characters (_@.$#&amp;+-) are allowed.");
					return;
				}
				
				document.getElementById("mo2f_inline_save_kba_form").elements[0].value = kba_1;
				document.getElementById("mo2f_inline_save_kba_form").elements[1].value = kba_2;
				document.getElementById("mo2f_inline_save_kba_form").elements[2].value = kba_3;
				document.getElementById("mo2f_inline_save_kba_form").elements[3].value = kba_4;
				document.getElementById("mo2f_inline_save_kba_form").elements[4].value = kba_5;
				document.getElementById("mo2f_inline_save_kba_form").elements[5].value = kba_6;
				document.getElementById("mo2f_inline_save_kba_form").elements[6].value = 'mo2f_inline_kba_registration';
				jQuery('#mo2f_inline_save_kba_form').submit();
			 }
			function mologinback(){
				jQuery('#mo2f_2fa_form_close').submit();
			}
	</script>
	<?php
	}