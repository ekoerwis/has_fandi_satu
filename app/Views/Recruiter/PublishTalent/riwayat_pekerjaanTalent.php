<hr>

<div class="table-responsive">
    <!-- table-striped table-bordered table-hover  -->
    <!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
    <table id="table1" class="table table-striped table-hover table-border" >
        <thead class="thead-light">
            <tr >
                <!-- <th>No</th> -->
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Tipe Pekerjaan</th>
                <th style="text-align: center;">Lokasi</th>
                <th style="text-align: center;">Kota</th>
                <th style="text-align: center;">Nama Perusahaan</th>
                <th style="text-align: center;">Bidang Pekerjaan</th>
                <th style="text-align: center;">Bulan Masuk</th>
                <th style="text-align: center;">Tahun Masuk</th>
                <th style="text-align: center;">Bulan Keluar</th>
                <th style="text-align: center;">Tahun Keluar</th>
                <!-- <th>Aksi</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($data_riwayatpekerjaan)){
                    $i=0;
                    foreach($data_riwayatpekerjaan as $data){
                        $i++;
                        echo "<tr>";
                        echo "<td class='text-center'>".$i."</td>";
                        echo "<td>".$data['tipe_pekerjaan_label']."</td>";
                        echo "<td>".$data['lokasi_pekerjaan_label']."</td>";
                        echo "<td>".$data['nama_kota']."</td>";
                        echo "<td>".$data['nama_perusahaan']."</td>";
                        echo "<td>".$data['bidang_pekerjaan']."</td>";
                        echo "<td>".$data['bulan_masuk_label']."</td>";
                        echo "<td>".$data['tahun_masuk']."</td>";
                        echo "<td>".$data['bulan_keluar_label']."</td>";
                        echo "<td>".$data['tahun_keluar']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                        echo "<td colspan=10 class='text-center'>Tidak Ada Data</td>";
                        echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>