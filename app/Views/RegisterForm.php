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
                    
                    <p style="text-align:center">Komitmen kami: kami akan menyimpan data Anda dengan aman dan <strong>tidak akan membagi data Anda</strong> ke siapapun</p>
                    <div class="mb-1">
                        <label class="mb-1">Bagaimana kami memanggil Anda?</label>
                        <div class="row">
                            <div class="col-auto">
                                <select id="SEX" name="SEX" class="form-control login-input">
                                    <option value="L" <?=set_select('gender', '1')?>>Bapak/Mas</option>
                                    <option value="P" <?=set_select('gender', '0')?>>Ibu/Mbak</option>
                                </select>
                            </div>
                            <div class="col ps-0">
                                <input type="text" name="nama" value="<?=set_value('nama')?>" class="form-control register-input" placeholder="Nama" aria-label="Nama" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">Email</label>
                        <input type="email"  name="email" value="<?=set_value('email', '')?>" class="form-control register-input" placeholder="Email" aria-label="Email" required>
                        <p class="small">Alamat email dimana kami dapat berkomunikasi dengan Anda seperti menginformasikan update terbaru, dll ?</p>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">Daftar Sebagai</label>
                        <select class=" form-control select2"  name="id_role"  required>
                            <?php
                                foreach($role_register as $role){
                                    echo "<option value='".$role['id_role']."'>".$role['judul_role']."</option>";
                                }
                            ?>
                        </select>
						<p class="small">Mempengaruhi Fitur Dalam Aplikasi</p>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">Username</label>
                        <input type="text"  name="username" value="<?=set_value('username', '')?>" class="form-control register-input" placeholder="Username" aria-label="Username" required>
                        <p class="small">Username untuk login</p>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">Password</label>
                        <input type="password"  name="password" class="form-control register-input" placeholder="Password" aria-label="Password" required>
                        <div class="pwstrength_viewport_progress"></div>
                        <p class="small">Indikator: medium-strong, min 8 karakter, paling sedikit mengandung huruf kecil, huruf besar, dan angka.</p>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">Confirm Password</label>
                        <input type="password"  name="password_confirm" class="form-control register-input" placeholder="Confirm Password" aria-label="Confirm Password" required>
                    </div>
                    <div class="mb-1" style="margin-bottom:0">
                        <button type="submit" name="submit" value="submit" class="btn btn-success" style="display:block;width:100%">Register</button>
                    </div>
                </form>

                <!-- <button id="btn-add" class="btn btn-warning btnSearch" onclick="sendEmail()" style="display:block;width:100%"><i class="fas fa-plus"></i> Email</button> -->

                    <?php
                } else {
                    ?>
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