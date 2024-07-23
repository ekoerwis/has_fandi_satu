<hr>

<div class="table-responsive">
    <!-- table-striped table-bordered table-hover  -->
    <!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
    <table id="table1" class="table table-striped table-hover table-border" >
        <thead class="thead-light">
            <tr >
                <!-- <th>No</th> -->
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Jenis Pengalaman</th>
                <th style="text-align: center;">Nama Pengalaman</th>
                <th style="text-align: center;">Bulan Awal</th>
                <th style="text-align: center;">Tahun Awal</th>
                <th style="text-align: center;">Bulan Akhir</th>
                <th style="text-align: center;">Tahun Akhir</th>
                <th style="text-align: center;">Detail Pengalaman</th>
                <th style="text-align: center;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($data_pengalamanpraktis)){
                    $i=0;
                    foreach($data_pengalamanpraktis as $data){
                        $i++;
                        echo "<tr>";
                        echo "<td class='text-center'>".$i."</td>";
                        echo "<td>".$data['jenis_pengalaman_label']."</td>";
                        echo "<td>".$data['nama_pengalaman']."</td>";
                        echo "<td>".$data['bulan_awal_label']."</td>";
                        echo "<td>".$data['tahun_awal']."</td>";
                        echo "<td>".$data['bulan_akhir_label']."</td>";
                        echo "<td>".$data['tahun_akhir']."</td>";
                        echo "<td>".$data['detail_pengalaman']."</td>";
                        echo "<td>".$data['keterangan']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                        echo "<td colspan=9 class='text-center'>Tidak Ada Data</td>";
                        echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>