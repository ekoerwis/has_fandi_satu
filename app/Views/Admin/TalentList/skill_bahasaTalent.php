<hr>

<div class="table-responsive">
    <!-- table-striped table-bordered table-hover  -->
    <!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
    <table id="table1" class="table table-striped table-hover table-border" >
        <thead class="thead-light">
            <tr >
                <!-- <th>No</th> -->
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Bahasa</th>
                <th style="text-align: center;">Ket. Bahasa</th>
                <th style="text-align: center;">Sertifikat</th>
                <th style="text-align: center;">Level/Nilai/Predikat</th>
                <th style="text-align: center;">No. Sertifikat</th>
                <th style="text-align: center;">Bulan Terbit</th>
                <th style="text-align: center;">Tahun Terbit</th>
                <th style="text-align: center;">Keterangan Lainnya</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($data_skillbahasa)){
                    $i=0;
                    foreach($data_skillbahasa as $data){
                        $i++;
                        echo "<tr>";
                        echo "<td class='text-center'>".$i."</td>";
                        echo "<td>".$data['kode_bahasa_label']."</td>";
                        echo "<td>".$data['ket_bahasa']."</td>";
                        echo "<td>".$data['jenis_sertifikat_label']."</td>";
                        echo "<td>".$data['level']."</td>";
                        echo "<td>".$data['no_sertifikat']."</td>";
                        echo "<td>".$data['bulan_terbit_label']."</td>";
                        echo "<td>".$data['tahun_terbit']."</td>";
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