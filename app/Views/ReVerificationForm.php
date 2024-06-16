<!DOCTYPE HTML>
<html lang="en">
<title><?=$site_title?></title>
<meta name="descrition" content="<?=$site_title?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?=$config->baseURL . 'public/images/favicon.png?r='.time()?>" />
<link rel="stylesheet" type="text/css" href="<?=$config->baseURL . 'public/vendors/bootstrap/css/bootstrap.min.css?r='.time()?>"/>
<link rel="stylesheet" type="text/css" href="<?=$config->baseURL . 'public/vendors/font-awesome/css/all.css?r='.time()?>"/>
<link rel="stylesheet" type="text/css" href="<?=$config->baseURL . 'public/themes/modern/builtin/css/login.css?r='.time()?>"/>
<link rel="stylesheet" type="text/css" href="<?=$config->baseURL . 'public/themes/modern/builtin/css/login-header.css?r='.time()?>"/>

<link rel="stylesheet" type="text/css" href="<?=$config->baseURL . 'public/vendors/jquery.select25/css/select2.min.css?r='.time()?>"/>
<!-- $this->addStyle ( $this->config->baseURL . 'public/vendors/jquery.select2/css/select2.min.css' ); -->

<script type="text/javascript" src="<?=$config->baseURL . 'public/vendors/jquery/jquery-3.4.1.js?r='.time()?>"></script>
<script type="text/javascript" src="<?=$config->baseURL . 'public/vendors/bootstrap/js/bootstrap.min.js?r='.time()?>"></script>

<script type="text/javascript" src="<?=$config->baseURL . 'public/vendors/jquery.pwstrength.bootstrap/pwstrength-bootstrap.min.js?r='.time()?>"></script>
<script type="text/javascript" src="<?=$config->baseURL . 'public/themes/modern/js/password-meter.js?r='.time()?>"></script>

<script type="text/javascript" src="<?=$config->baseURL . 'public/vendors/jquery.select25/js/select2.full.min.js?r='.time()?>"></script>
<!-- $this->addJs ( $this->config->baseURL . 'public/vendors/jquery.select2/js/select2.full.min.js' ); -->

		
<?php
if (!empty($js)) {
	foreach($js as $file) {
		echo '<script type="text/javascript" src="'.$file.'?r='.time().'"></script>';
	}
}


?>
<body>
	<div class="background"></div>
	<div class="backdrop"></div>
	<div class="register-container">
		<div class="login-header">
			<div class="logo">
				<img src="<?php echo $config->baseURL . '/public/images/' . $settingWeb->logo_login?>">
			</div>
			
			<?php 
            
            helper ('html');
            if (!empty($desc)) {
				echo '<p>' . $desc . '</p>';
			}?>
		</div>

		<div class="login-body">
            <!-- isi reg -->

            <div class="card-body" >
                <?php
                // if (!empty($message)) {
                //     show_message($message);
                // }

                if (!empty($message)) {
                    show_message($message['message'], $message['status'], $message['dismiss']);
                }

                helper('form');
                
                if (@$register_status != 'register_sukses') {
                    ?>
                    <form id="frm" action="<?=current_url()?>" method="post" accept-charset="utf-8">
                    
                    <div class="mb-1">
                        <label class="mb-1">Email</label>
                        <input type="email"  name="email" value="<?=set_value('email', '')?>" class="form-control register-input" placeholder="Email" aria-label="Email" required>
                        <p class="small">Alamat email untuk permintaan verifikasi</p>
                    </div>
                    <div class="mb-1" style="margin-bottom:0">
                        <button type="submit" name="submit" value="submit" class="btn btn-success" style="display:block;width:100%">Verifikasi Ulang</button>
                    </div>
                </form>

                    <div class="form-group" style="">
                            <p>Sudah Verifikasi? <a href="<?=$config->baseURL?>">LOGIN</a></p>				
                        </div>
                    <?php
                }
                ?>
                    
            </div>

            <!-- batas isi reg  -->
		</div>

	</div><!-- register container -->

<script>
   
jQuery(document).ready(function () {
	
	$('.select2').select2({
		// 'theme' : 'bootstrap-5'
	})
});
</script>

<script type="text/javascript">
 

</script>



</body>
</html>