<style>
        .nav-tabs .nav-link.active {
            background-color: #17a2b8; /* bg-info */
            color: #fff; /* text-light */
            border-color: #17a2b8;
        }
        .nav-tabs .nav-link {
            background-color: #f8f9fa; /* bg-light */
            color: #17a2b8; /* text-info */
            border-color: #17a2b8;
        }
        .nav-tabs .nav-link:hover {
            background-color: #e2e6ea; /* lighter bg-light on hover */
            color: #17a2b8; /* text-info */
            border-color: #17a2b8;
        }
    </style>

<div class="card">
	<div class="card-header bg-info text-light rounded">
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
            <ul class="nav nav-tabs border-bottom  border-info " id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="datadiri-tab" data-toggle="tab" href="#datadiri" role="tab" aria-controls="datadiri" aria-selected="false">Data Diri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="databaju_tambahan-tab" data-toggle="tab" href="#databaju_tambahan" role="tab" aria-controls="databaju_tambahan" aria-selected="false">Data Baju & Tambahan</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <div class="tab-pane fade" id="datadiri" role="tabpanel" aria-labelledby="datadiri-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
                <div class="tab-pane fade" id="databaju_tambahan" role="tabpanel" aria-labelledby="databaju_tambahan-tab">
                     <!-- Konten akan dimuat di sini -->
                </div>
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
    loadTabContent('#profile', 'getTab?page=profileTalent&id=<?php echo @$dataUser['id_user']; ?>');

    // Tambahkan event listener untuk setiap tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // Mendapatkan target tab
        var url = ''; // URL file yang akan dimuat

        // Tentukan URL file berdasarkan target tab
        if (target == '#profile') {
            url = 'getTab?page=profileTalent&id=<?php echo @$dataUser['id_user']; ?>';
        } else if (target == '#datadiri') {
            url = 'getTab?page=datadiriTalent&id=<?php echo @$dataUser['id_user']; ?>';
        } else if (target == '#databaju_tambahan') {
            url = 'getTab?page=databaju_tambahanTalent&id=<?php echo @$dataUser['id_user']; ?>';
        }

        // Muat konten dari file eksternal
        loadTabContent(target, url);
    });


	});


</script>