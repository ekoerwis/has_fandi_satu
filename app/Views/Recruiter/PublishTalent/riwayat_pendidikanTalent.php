<hr>

<div class="table-responsive">
    <!-- table-striped table-bordered table-hover  -->
    <!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
    <table id="table1" class="table table-striped table-hover table-border" >
        <thead class="thead-light">
            <tr >
                <!-- <th>No</th> -->
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Jenjang</th>
                <th style="text-align: center;">Nama Instansi</th>
                <th style="text-align: center;">Jurusan</th>
                <th style="text-align: center;">Bulan Masuk</th>
                <th style="text-align: center;">Tahun Masuk</th>
                <th style="text-align: center;">Bulan Lulus</th>
                <th style="text-align: center;">Tahun Lulus</th>
                <!-- <th>Aksi</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($data_riwayatpendidikan)){
                    $i=0;
                    foreach($data_riwayatpendidikan as $data){
                        $i++;
                        echo "<tr>";
                        echo "<td class='text-center'>".$i."</td>";
                        echo "<td>".$data['jenjang']."</td>";
                        echo "<td>".$data['nama_instansi']."</td>";
                        echo "<td>".$data['jurusan']."</td>";
                        echo "<td>".$data['bulan_masuk_label']."</td>";
                        echo "<td>".$data['tahun_masuk']."</td>";
                        echo "<td>".$data['bulan_lulus_label']."</td>";
                        echo "<td>".$data['tahun_lulus']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                        echo "<td colspan=8 class='text-center'>Tidak Ada Data</td>";
                        echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>