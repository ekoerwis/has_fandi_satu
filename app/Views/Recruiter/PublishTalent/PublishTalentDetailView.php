<style>
        .nav-tabs .nav-link.active {
            background-color: #FFA500; /* bg-warning */
            color: #fff; /* text-light */
            border-color: #FFA500;
        }
        .nav-tabs .nav-link {
            background-color: #f8f9fa; /* bg-light */
            color: black; /* text-warning */
            border-color: #FFA500;
        }
        .nav-tabs .nav-link:hover {
            background-color: #e2e6ea; /* lighter bg-light on hover */
            color: black; /* text-warning */
            border-color: #FFA500;
        }
    </style>

<div class="card">
	<div class="card-header bg-warning text-light rounded">
		<h5 class="card-title rounded">Detail Talent <?php echo @$dataUser['username']; ?></h5>
	</div>

	<?php
			if (!empty($message)) {
				show_message($message['message'], $message['status'], $message['dismiss']);
			}

            if(@$message['status'] != 'error'){
		?>
	
	<div class="card-body">
    
            <!-- Nav tabs -->
            <ul class="nav nav-tabs border-bottom  border-warning " id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="datadiri-tab" data-toggle="tab" href="#datadiri" role="tab" aria-controls="datadiri" aria-selected="true">Data Diri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="databaju_tambahan-tab" data-toggle="tab" href="#databaju_tambahan" role="tab" aria-controls="databaju_tambahan" aria-selected="false">Data Baju & Tambahan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="riwayat_pendidikan-tab" data-toggle="tab" href="#riwayat_pendidikan" role="tab" aria-controls="riwayat_pendidikan" aria-selected="false">Riwayat Pendidikan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="riwayat_pekerjaan-tab" data-toggle="tab" href="#riwayat_pekerjaan" role="tab" aria-controls="riwayat_pekerjaan" aria-selected="false">Riwayat Pekerjaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="skill_bahasa-tab" data-toggle="tab" href="#skill_bahasa" role="tab" aria-controls="skill_bahasa" aria-selected="false">Skill Bahasa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="skill_sertifikat-tab" data-toggle="tab" href="#skill_sertifikat" role="tab" aria-controls="skill_sertifikat" aria-selected="false">Sertifikat Skill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pengalaman_praktis-tab" data-toggle="tab" href="#pengalaman_praktis" role="tab" aria-controls="pengalaman_praktis" aria-selected="false">Pengalaman Praktis</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="file_upload-tab" data-toggle="tab" href="#file_upload" role="tab" aria-controls="file_upload" aria-selected="false">File Upload</a>
                </li> -->
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active" id="datadiri" role="tabpanel" aria-labelledby="datadiri-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <div class="tab-pane fade" id="databaju_tambahan" role="tabpanel" aria-labelledby="databaju_tambahan-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <div class="tab-pane fade" id="riwayat_pendidikan" role="tabpanel" aria-labelledby="riwayat_pendidikan-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <div class="tab-pane fade" id="riwayat_pekerjaan" role="tabpanel" aria-labelledby="riwayat_pekerjaan-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <div class="tab-pane fade" id="skill_bahasa" role="tabpanel" aria-labelledby="skill_bahasa-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <div class="tab-pane fade" id="skill_sertifikat" role="tabpanel" aria-labelledby="skill_sertifikat-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <div class="tab-pane fade" id="pengalaman_praktis" role="tabpanel" aria-labelledby="pengalaman_praktis-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <!-- <div class="tab-pane fade" id="file_upload" role="tabpanel" aria-labelledby="file_upload-tab"> -->
                     <!-- Konten akan dimuat di sini -->
                <!-- </div> -->
            </div>


	</div>

    <?php
    }
    ?>
</div>

	<?php
	// helper('deleteModal');
	// echo deleteModal();
	?>

<script type="text/javascript">

	$(document).ready( function(){

       // Fungsi untuk memuat konten dari file eksternal
    function loadTabContent(tabId, url) {
        $(tabId).load(url);
    }

    // Muat konten untuk tab aktif pertama kali
    
    loadTabContent('#datadiri', 'getTab?page=datadiriTalent&id=<?php echo @$dataUser['id_user']; ?>');

    // Tambahkan event listener untuk setiap tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // Mendapatkan target tab
        var url = ''; // URL file yang akan dimuat

        // Tentukan URL file berdasarkan target tab
        if (target == '#datadiri') {
            url = 'getTab?page=datadiriTalent&id=<?php echo @$dataUser['id_user']; ?>';
        } else if (target == '#databaju_tambahan') {
            url = 'getTab?page=databaju_tambahanTalent&id=<?php echo @$dataUser['id_user']; ?>';
        }else if (target == '#riwayat_pendidikan') {
            url = 'getTab?page=riwayat_pendidikanTalent&id=<?php echo @$dataUser['id_user']; ?>';
        }else if (target == '#riwayat_pekerjaan') {
            url = 'getTab?page=riwayat_pekerjaanTalent&id=<?php echo @$dataUser['id_user']; ?>';
        }else if (target == '#skill_bahasa') {
            url = 'getTab?page=skill_bahasaTalent&id=<?php echo @$dataUser['id_user']; ?>';
        }else if (target == '#skill_sertifikat') {
            url = 'getTab?page=skill_sertifikatTalent&id=<?php echo @$dataUser['id_user']; ?>';
        }else if (target == '#pengalaman_praktis') {
            url = 'getTab?page=pengalaman_praktisTalent&id=<?php echo @$dataUser['id_user']; ?>';
        }
        // else if (target == '#file_upload') {
        //     url = 'getTab?page=file_uploadTalent&id=<?php echo @$dataUser['id_user']; ?>';
        // }

        // Muat konten dari file eksternal
        loadTabContent(target, url);
    });


	});


</script>