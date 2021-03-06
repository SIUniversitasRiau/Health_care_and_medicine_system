<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="slice bg-2 p-15">
                <h3>Kunjungan Pasien Poli KIA-KB </h3>
            </section> &nbsp;
            &nbsp;
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Antrian Pasien</h3>
                        </div>
                        <div class="panel-body">
                            <table style="width: 100%;" class="table table-striped table-responsive">
                                    <tr> 
                                    <td style="background-color: #C3FFB5">Hijau</td>
                                    <td colspan=2>Antrian dari Loket</td>
                                    </tr>

                                    <tr> 
                                    <td style="background-color: yellow">Kuning</td>
                                    <td colspan=2>Antrian dari Poli Lain</td>
                                    </tr>
                           </table>
                    <div style="height: 700px; overflow-y: scroll;">
                        <table id="tabelAntrian" style="width: 100%;" class="table table-responsive">
                                <!--<thead>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Pilih</th>
                                </thead> -->
                            <tbody>								 
								 
                                <?php if (isset($queues)) : ?>
                                    <?php $counter = 1; foreach ($queues as $row) : ?>
                                        <tr style="background-color: <?php if ($row['flag_intern'] == '0') echo '#C3FFB5'; else echo 'yellow'; ?>" id="row<?php echo $row['id_antrian_unit']; ?>">
                                            <td><?php echo $counter++; ?></td>					
                                            <td><?php echo $row['nama_pasien']; ?></td>
                                            <td><button type="button" class="btn btn-xs btn-success" onclick="getPatient(<?php echo $row['id_riwayat_rm']; ?>,<?php echo $row['id_antrian_unit']; ?>)"><i class="fa fa-check"></i></button></td>
											<td><button type="button" class="btn btn-xs btn-danger" onclick="removeAntrian(<?php echo $row['id_riwayat_rm']; ?>,<?php echo $row['id_antrian_unit']; ?>)"><i class="fa fa-cut"></i></button></td>
                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-body" >						
                                    <div class="alert alert-info" id="data_pas" hidden="hidden"> 
                                            <h4>PROFIL PASIEN</h4>
                                            <div class="row">
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                                    <label >No. Rekam Medik</label>
                                                                    <input class="form-control" type="text" id="norekammedik" name="norekammedik" readonly="true">
                                                            </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                                    <label >Nama Pasien</label>
                                                                    <input class="form-control" type="text" id="NAMA_PASIEN" name="NAMA_PASIEN" readonly="true">
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <label >Jenis Kelamin</label>
                                                                    <input class="form-control" type="text" id="GENDER_PASIEN" name="GENDER_PASIEN" readonly="true">
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <label >Umur Pasien</label>
                                                                    <input class="form-control" type="text" name="umurpasien" id="umurpasien" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                                    <label >Alamat Pasien</label>
                                                                    <input class="form-control" type="text" id="ALAMAT_PASIEN" name="ALAMAT_PASIEN" readonly="true">
                                                            </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                                    <label >Kunjungan Terakhir</label>
                                                                    <input class="form-control" id="kunjunganpasien" readonly>
                                                            </div>							
                                                    </div>                           
                                            </div>
                                    </div>
                            </div>
                    </div>

                    <div class="col-md-6">
                            <div class="form-body" >
                                    <div class="alert alert-info" id="tabelLab" hidden="hidden">         
                                            <h4>PEMERIKSAAN LAB</h4>
                                            <table class="table table-bordered table-striped table-comparison table-responsive">
                                                    <thead>
                                                            <tr>
                                                                    <th>NAMA PEMERIKSAAN LAB</th>
                                                                    <th>HASIL TES</th>
                                                                    <th>TANGGAL TES LAB</th>
                                                            </tr>
                                                    </thead>
                                                    <tbody id="bodyHasilLab">  
                                                            <tr><td colspan=3><center>Kosong<center></td></tr>
                                                    </tbody>
                                            </table>

                                    </div>
                            </div>
                    </div>
                    </div>
                    <div class="col-md-12 alert alert-info" id="detail_riwayat" hidden="hidden">
                        <form id="FormHomePoliumum" method="post" action="<?php echo base_url().$this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/updateDataKB'; ?>">
                            <input id="ID_SUMBER" name="ID_SUMBER" type="hidden" value="" />
                            <input id="id_rrm" name="id_rrm" type="hidden" value="">
                            <input id="ID_PASIEN" name="ID_PASIEN" type="hidden" value="">
                            <input id="hidden_noantrian" name="hidden_noantrian" type="hidden" value="">
                            <input id="UMUR_SAAT_INI" name="UMUR_SAAT_INI" type="hidden" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tinggi">Cuma Kontrol</label>
                                    <select class="form-control" id="CUMA_KONTROL" name="CUMA_KONTROL">
                                        <option value="0" checked="true">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tinggi">Tinggi Badan</label>
                                    <input required min="0" class="form-control" id="TINGGIBADAN_PASIEN" name="TINGGIBADAN_PASIEN" placeholder="dalam centimeter" type="number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="berat">Berat Badan</label>
                                    <input required min="0" class="form-control" id="BERATBADAN_PASIEN" name="BERATBADAN_PASIEN" placeholder="dalam kilogram" type="number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sistol">Tekanan Darah Atas</label>
                                    <input required min="0" class="form-control" id="SISTOL_PASIEN" name="SISTOL_PASIEN" placeholder="sistol" type="number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="diastol">Tekanan Darah Bawah</label>
                                    <input required min="0" class="form-control" id="DIASTOL_PASIEN" name="DIASTOL_PASIEN" placeholder="diastol" type="number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="suhu">Suhu Badan</label>
                                    <input required min="0" class="form-control" id="SUHU_BADAN" name="SUHU_BADAN" placeholder="dalam celcius" type="number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jantung">Detak Jantung</label>
                                    <input required min="0" class="form-control" id="DETAK_JANTUNG" name="DETAK_JANTUNG" placeholder="Detak Jantung" type="number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="napas">Napas Per Menit</label>
                                    <input required min="0" class="form-control" id="NAPAS_PER_MENIT" name="NAPAS_PER_MENIT" placeholder="Napas Per Menit" type="number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keluhan">Anamnesa/Keluhan</label><br>
                                    <textarea rows="1" style="height: 100px; resize: none" class="form-control" id="keluhan" name="keluhan" placeholder="Keluhan Pasien, pisahkan dengan koma. Contoh: mual, muntah"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Diagnosa Utama (ICD X)</label><br>
                                    <div class="input-group">
                                        <input required id="queryicd" name="queryicd" class="form-control" placeholder="Masukkan kata pencarian utama" type="text">
                                        <span class="input-group-btn">									
                                            <button style="" class="btn btn-primary" type="button" onclick="renderTable()">Cari Kode ICD X</button>
                                            <!-- <a class="btn btn-two" type="button" onclick="getICD()">Go!</a> -->
                                        </span>
                                    </div>
                                </div>			
                            </div>
                            <div class="col-md-12">
                                <!--<ul class="nav nav-pills">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Filter Fields <b class="caret"></b> </a>
                                        <ul class="dropdown-menu stop-propagation" style="overflow:auto;max-height:450px;padding:10px;">
                                            <div id="filter-list"></div>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Row Label Fields <b class="caret"></b> </a>
                                        <ul class="dropdown-menu stop-propagation" style="overflow:auto;max-height:450px;padding:10px;">
                                            <div id="row-label-fields"></div>
                                        </ul>
                                    </li>
                                </ul>-->
                                <span class="hide-on-print" id="pivot-detail"></span>
                                <div style="" id="results"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Daftar ICD X yang dipilih</label><br>
                                    <table style="width: 100%; " class="table-responsive">
                                        <tbody id="bodyChoosedICD">

                                        </tbody>
                                    </table>
                                </div>			
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="keluhan">Diagnosa Keterangan</label><br>
                                    <textarea rows="1" style="height: 100px; resize:none;" class="form-control" id="diagnosa" name="diagnosa" placeholder="Keterangan Diagnosa Pasien"></textarea>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="layananKesehatan">Layanan Kesehatan</label><br>
                                    <div class="input-group">
                                        <select id="layananKesehatan" class="form-control" name="layananKesehatan">
                                            <option value="">Pilih Layanan Kesehatan</option>
                                            <?php foreach ($layanan as $row) : ?>
                                                <option value="<?php echo $row['ID_LAYANAN_KES'] ?>"><?php echo $row['NAMA_LAYANAN_KES'] ?></option>
                                            <?php endforeach; ?>
                                        </select> 
                                        <span class="input-group-btn">									
                                            <button class="btn btn-primary" type="button" onclick="LayananChoosed()" id="buttonLayanan" ><i class="fa fa-check" ></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Daftar Layanan Kesehatan yang dipilih</label><br>
                                    <table style="width: 100%; " class="table-responsive">
                                        <tbody id="bodyChoosedLayanan">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kunjungan">Kunjungan Pasien</label><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="kunjungan" name="kunjungan" type="radio" value="BARU"> Baru
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="kunjungan" name="kunjungan" type="radio" value="LAMA"> Lama
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="kunjungan" name="kunjungan" type="radio" value="LAMA"> KKL
                                        </div>
                                    </div>
                                </div>
                            </div>	
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rawat">Status Perawatan</label><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input required id="rawat1" name="STAT_RAWAT_JALAN" type="radio" value="0"> Rawat Jalan
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input required id="rawat2" name="STAT_RAWAT_JALAN" type="radio" value="1"> Rawat Inap
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input required id="rawat3" name="STAT_RAWAT_JALAN" type="radio" value="2"> Dirujuk
                                            <input style="display: none" class="form-control" placeholder="Tempat Rujukan" id="TEMPAT_RUJUKAN" name="TEMPAT_RUJUKAN" type="text" value="">									
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kasus">Sumber Pembayaran : </label><label id="sumberbayar"></label>
                                </div>
                            </div>
                            <div class="col-md-12"><hr/></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah Anak Hidup</label>
                                    <input min="0" class="form-control" type="number" name="KB_JML_ANAK_HIDUP_L" value="" placeholder="Laki-laki">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> </label>
                                    <input min="0" class="form-control" type="number" name="JML_ANAK_HIDUP_P" value="" placeholder="Perempuan">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Umur Anak Terkecil</label>
                                    <input min="0" class="form-control" type="number" name="KB_UMUR_ANAK_TERKECIL_BULAN" value="" placeholder="Tahun">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> </label>
                                    <input min="0" class="form-control" type="number" name="KB_UMUR_ANAK_TERKECIL_TAHUN" value="" placeholder="Bulan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Status Peserta KB</label>
                                    <select name="KB_STAT_PESERTA_KB" class="form-control">
                                        <option value="1">Baru pertama kali</option>
                                        <option value="2">Pernah pakai alat KB berhenti sesudah bersalin/keguguran</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Cara KB Terakhir</label>
                                    <select name="KB_ID_ALAT_KONTRASEPSI_SEBELUMNYA" class="form-control">
                                        <?php for($i=0; $i<sizeof($alat_kb); $i++): ?>
                                        <option value="<?= $alat_kb[$i]['ID_ALAT_KB'] ?>"><?= $alat_kb[$i]['NAMA_ALAT_KB'] ?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <span >Sedang Menggunakan KB</span>
                                                <input class="pull-right" type="radio" name="KB_FLAG_SEDANG_KB" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_FLAG_SEDANG_KB" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr/>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 alert alert-warning">
                                    <label >Penapisan (Skrining) untuk menentukan alat kontrasepsi yang dapat digunakan calon peserta KB</label>
                                    <br/><label>Petunjuk: </label><br/>
                                    <span>- Periksalah keadaan berikut ini dan hasilnya ditulis dengan angka atau tanda centang (v) pada kotak yang tersedia.</span>
                                    <span><br/>- Penapisan (Skrinning) hanya boleh dilakukan oleh pelaksana yang telah dilatih dalam pelayanan kontrasepsi.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label ><br/><u>Anamnese</u></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Haid Terakhir (Bulan-Tanggal-Tahun)</label>
                                    <input class="datepicker form-control default-date-picker"  size="16" value="<?= date('d-m-Y') ?>" type="text" name="KB_HAID_TERAKHIR" placeholder="(Tanggal-Bulan-Tahun)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Hamil/Diduga Hamil</label>
                                    <select name="KB_DIDUGA_HAMIL" class="form-control">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Menyusui</label>
                                    <select name="KB_FLAG_MENYUSUI" class="form-control">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    <br/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-12">Jumlah GPA</label>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input class="form-control " type="text" name="KB_JML_GPA_GRAVIDA" value="" placeholder="GRAVIDA">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input class="form-control " type="text" name="KB_JML_GPA_PARTUS" value="" placeholder="PARTUS">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input class="form-control " type="text" name="KB_JML_GPA_ABORTUS" value="" placeholder="ABORTUS">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label >Riwayat Penyakit Sebelumnya</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span class="">Sakit Kuning</span>
                                                <input class="pull-right" type="radio" name="KB_PENYAKIT_SEBELUMNYA_SKUNING" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_PENYAKIT_SEBELUMNYA_SKUNING" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span >Pendarahan pervaginam yang<br/>tidak diketahui sebabnya</span>
                                                <input class="pull-right" type="radio" name="KB_PENYAKIT_SEBELUMNYA_PERVAGINAM" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <br/><input class="" type="radio" name="KB_PENYAKIT_SEBELUMNYA_PERVAGINAM" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span >Keputihan yang lama</span>
                                                <input class="pull-right" type="radio" name="KB_PENYAKIT_SEBELUMNYA_KEPUTIHAN" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_PENYAKIT_SEBELUMNYA_KEPUTIHAN" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span >Tumor (Payudara/Rahin/Indung Telur)</span>
                                                <input class="pull-right" type="radio" name="KB_PENYAKIT_SEBELUMNYA_TUMOR" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_PENYAKIT_SEBELUMNYA_TUMOR" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">Bila semua jawaban <b>TIDAK</b>, dapat diberikan salah satu dari cara KB (kecuali IUD, MOW). Pertanyaan harus dilanjutkan ke pertanyaan XIII. 9. Bila salah satu jawaban YA, rujuk ke dokter</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label ><u/>Pemeriksaan</u></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Keadaan Umum</label>
                                    <select name="KB_KEADAAN_UMUM" class="form-control">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label >Sebelum dilakukan pemasangan IUD atau MOW dilakukan pemeriksaan dalam:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span class="">Tanda-tanda radang</span>
                                                <input class="pull-right" type="radio" name="KB_TANDA2_RADANG" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_TANDA2_RADANG" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span >Tumor/keganasan ginekologi</span>
                                                <input class="pull-right" type="radio" name="KB_TUMOR_GINEKOLOGI" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_TUMOR_GINEKOLOGI" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-danger">Bila semua jawaban <b>TIDAK</b>, pemasangan IUD atau tindakan MOW dapat dilakukan. Bila salah satu jawaban YA, rujuk ke dokter</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <br/><label >Pemeriksaan tambahan khusus untuk calon MOP dan MOW)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span class="">Tanda-tanda diabetes</span>
                                                <input class="pull-right" type="radio" name="KB_TANDA_DIABET" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_TANDA_DIABET" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span >Kelainan pembekuan darah</span>
                                                <input class="pull-right" type="radio" name="KB_KELAINAN_PEMBEKUAN_DARAH" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_KELAINAN_PEMBEKUAN_DARAH" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span >Radang orchitis/epididymitis</span>
                                                <input class="pull-right" type="radio" name="KB_RADANG_ORCHITIS_EPIDIDYMITIS" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_RADANG_ORCHITIS_EPIDIDYMITIS" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <span >Tumor/keganasan ginekologi</span>
                                                <input class="pull-right" type="radio" name="KB_TUMOR_GINEKOLOGI_TAMBAHAN" value="1"><span class="pull-right">Ya</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="" type="radio" name="KB_TUMOR_GINEKOLOGI_TAMBAHAN" value="0">Tidak
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Posisi Rahim</label>
                                        <select name="KB_POSISI_RAHIM" class="form-control">
                                            <option value="1">Retrofleksi</option>
                                            <option value="2">Anterfleksi</option>
                                        </select>
                                    </div>
                                    <div class="alert alert-danger">Bila semua jawaban <b>TIDAK</b>, pemasangan IUD atau tindakan MOW dapat dilakukan. Bila salah satu jawaban YA, rujuk ke dokter</div>
                                </div>
                            </div>
                            <div class="col-md-12"><hr/></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Alat kontrasepsi yang boleh dipergunakan</label>
                                    <select name="KB_ID_ALAT_KONTRASEPSI_YG_BOLEH" class="form-control">
                                        <?php for($i=0; $i<sizeof($alat_kb); $i++): ?>
                                        <option value="<?= $alat_kb[$i]['ID_ALAT_KB'] ?>"><?= $alat_kb[$i]['NAMA_ALAT_KB'] ?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Metode dan Jenis Alat Kontraseksi yang dipilih:</label>
                                    <select name="ID_ALAT_KB" class="form-control">
                                        <?php for($i=0; $i<sizeof($alat_kb); $i++): ?>
                                        <option value="<?= $alat_kb[$i]['ID_ALAT_KB'] ?>"><?= $alat_kb[$i]['NAMA_ALAT_KB'] ?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Tanggal dilayani</label>
                                    <input class="datepicker form-control default-date-picker"  size="16" value="<?= date('d-m-Y') ?>" type="text" name="TANGGAL_DILAYANI" placeholder="TANGGAL_DILAYANI">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Tanggal di kembali</label>
                                    <input class="datepicker form-control default-date-picker"  size="16" value="<?= date('d-m-Y') ?>" type="text" name="KB_TANGGAL_DIPESAN_KEMBALI" placeholder="KB_TANGGAL_DIPESAN_KEMBALI">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Tanggal dicabut</label>
                                    <input class="datepicker form-control default-date-picker"  size="16" value="<?= date('d-m-Y') ?>" type="text" name="KB_TANGGAL_DICABUT" placeholder="KB_TANGGAL_DICABUT">
                                </div>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Komplikasi Berat</label>
                                    <input class="form-control" type="text" name="KB_AKIBAT_KOMPLIKASI_BERAT" placeholder="KB_AKIBAT_KOMPLIKASI_BERAT">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Kegagalan</label>
                                    <input class="form-control" type="text" name="KB_AKIBAT_KEGAGALAN" placeholder="KB_AKIBAT_KEGAGALAN">
                                </div>
                            </div>
                            <div class="col-md-12"><hr/></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input name="flagbutton" id="flagbutton" value="" type="hidden">
                                    <button onclick="CheckLaborat(1)" type="button" class="btn btn-primary">Simpan & Kembali ke Antrian Pasien</button>
                                    <button onclick="CheckLaborat(2)" type="button" class="btn btn-primary">Simpan & Buat Resep</button> <br><br>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal2" type="button">Simpan & Arahkan ke Poli Lain</button>
                                    <button class="btn btn-primary " data-toggle="modal" data-target="#myModal" type="button">Arahkan ke Poli Lain</button>
                                </div>
                            </div>
                            <input type="hidden" name="id_unit_tujuan" id="id_unit_tujuan"/>
                            <input type="text" name="tanggalAntrian" id="tanggalAntrian"/>
                            <input type="text" name="waktuAntrian" id="waktuAntrian"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal save riwayat and change unit -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Simpan & Arahkan Pasien ke Poli Lain</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <select name="save_unit" id="save_unit" class="form-control">
                            <?php foreach ($unit as $r) { 
                                $pos = strpos($r['NAMA_UNIT'], 'KIA');
                                if($pos !== false){ ?>
                                    <option value="<?= $r['ID_UNIT'] . '_balita' ?>">Poli KIA-Anak Balita</option>
                                    <option value="<?= $r['ID_UNIT'] . '_kia' ?>">Poli KIA-Ibu Hamil</option>
                                    <option value="<?= $r['ID_UNIT'] . '_vkkia' ?>">Poli KIA-VK KIA</option>
                                    <option value="<?= $r['ID_UNIT'] . '_kb' ?>">Poli KIA-KB</option>
                                <?php } else { ?>
                                    <option value="<?php echo $r['ID_UNIT'] ?>"><?php echo $r['NAMA_UNIT'] ?></option>
                                <?php }
                                } ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6">
                        <label>Tanggal Kunjungan</label>
                        <input class="form-control datepicker" id="tanggalAntrianTemp" name="tanggalAntrianTemp" value="<?= date('d:m:Y') ?>" placeholder="Masukkan Tanggal Antrian">
                    </div>
                    <div class="col-lg-6">
                        <label>Waktu Antrian</label>
                        <input required class="form-control" id="waktuAntrianTemp" name="waktuAntrianTemp" type="text" value="<?php
                        $time = date('H:i:s');
                        echo $time
                        ?>" placeholder="Format 24 Jam: Jam:Menit:detik , contoh: 21:15:55">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button onclick="CheckLaborat2(3)" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- modal change unit -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Arahkan Pasien ke Poli Lain</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <input type="hidden" name="pembayaranPasien" id="pembayaranPasien" value="" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <select name="unit" id="unit" class="form-control">													
                            <?php foreach ($unit as $r) { 
                                $pos = strpos($r['NAMA_UNIT'], 'KIA');
                                if($pos !== false){ ?>
                                    <option value="<?= $r['ID_UNIT'] . '_balita' ?>">Poli KIA-Anak Balita</option>
                                    <option value="<?= $r['ID_UNIT'] . '_kia' ?>">Poli KIA-Ibu Hamil</option>
                                    <option value="<?= $r['ID_UNIT'] . '_vkkia' ?>">Poli KIA-VK KIA</option>
                                    <option value="<?= $r['ID_UNIT'] . '_kb' ?>">Poli KIA-KB</option>
                                <?php } else { ?>
                                    <option value="<?php echo $r['ID_UNIT'] ?>"><?php echo $r['NAMA_UNIT'] ?></option>
                                <?php }
                                } ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6">
                        <label>Tanggal Kunjungan</label>
                        <input class="form-control datepicker" id="tanggalAntrianTemp2" name="tanggalAntrianTemp2" value="<?= date('d:m:Y') ?>" placeholder="Masukkan Tanggal Antrian">
                    </div>
                    <div class="col-lg-6">
                        <label>Waktu Antrian</label>
                        <input required class="form-control" id="waktuAntrianTemp2" name="waktuAntrianTemp2" type="text" value="<?php
                        $time = date('H:i:s');
                        echo $time
                        ?>" placeholder="Format 24 Jam: Jam:Menit:detik , contoh: 21:15:55">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button onclick="CheckLaborat(4)" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<style>
    .datepicker {
        z-index: 100000;
    }
</style>
<script>
    $(function () {
        $( ".datepicker" ).datepicker({
                format: 'dd-mm-yyyy',
        });
    });
    
    $('input:radio[name=NAMA_STATUS_KASUS]:nth(1)').attr('checked',true);
    $('input:radio[name=STAT_RAWAT_JALAN]:nth(0)').attr('checked',true);
    
    $('#rawat1').click(function() {
        $('#TEMPAT_RUJUKAN').attr("style",'display:none');
    });
    $('#rawat2').click(function() {
        $('#TEMPAT_RUJUKAN').attr("style",'display:none');
    });
    $('#rawat3').click(function() {
        $('#TEMPAT_RUJUKAN').attr("style",'display:block');
    });
    
    function CheckLaborat (value) {
	$('#flagbutton').val(value);
	var str = $('#unit :selected').text();
        $('#id_unit_tujuan').val($('#unit :selected').val());
        $('#tanggalAntrian').val($('#tanggalAntrianTemp2 :selected').val());
        $('#waktuAntrian').val($('#waktuAntrianTemp2 :selected').val());
	if (str.toLowerCase().indexOf("laborat") >= 0 ) {
		id_rrm = $('#id_rrm').val();
		id_antrian = $('#hidden_noantrian').val();
		id_unit_tujuan = $('#id_unit_tujuan').val();
		window.location = "<?php echo base_url() .$this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/toLaborat/' ?>" + id_rrm+"/"+id_antrian+"/"+id_unit_tujuan;
	}
	else {
		$('#FormHomePoliumum').submit();
	}
    }
    
    function CheckLaborat2 (value) {
	$('#flagbutton').val(value);
	var str = $('#save_unit :selected').text();
        $('#id_unit_tujuan').val($('#save_unit :selected').val());
        $('#tanggalAntrian').val($('#tanggalAntrianTemp :selected').val());
        $('#waktuAntrian').val($('#waktuAntrianTemp :selected').val());
	if (str.toLowerCase().indexOf("laborat") >= 0 ) {
		id_rrm = $('#id_rrm').val();
		id_antrian = $('#hidden_noantrian').val();
		id_unit_tujuan = $('#id_unit_tujuan').val();
		window.location = "<?php echo base_url() .$this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/toLaborat/' ?>" + id_rrm+"/"+id_antrian+"/"+id_unit_tujuan;
	}
	else {
		$('#FormHomePoliumum').submit();
	}
    }
</script>

<script>
    var fields = [
        {
            name: 'KODE ICD X',
            type: 'string',
            filterable: true
        }, {
            name: 'ENGLISH NAME',
            type: 'string',
            filterable: true
        }, {
            name: 'INDONESIAN NAME',
            type: 'string',
            filterable: true
        }, {
            name: 'KELOLA',
            type: 'string',
            filterable: true
        }
    ]

    function renderTable()
    {
        if ($("#queryicd").val() == "")
            return;

        var data_pos = $("#queryicd").val()
        var jso;
        var data_pos = $("#queryicd").val();
        var kapsul = {};
        kapsul.teksnya = {};
        kapsul.teksnya.tanda = $("#queryicd").val();

        // alert(kapsul.teksnya.tanda);
        // alert(kapsul.teksnya);
        // alert(kapsul);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/getSearch'; ?>',
            data: kapsul,
            success: function(dataCheck) {
                jso = dataCheck;
                setupPivot({
                    json: jso,
                    fields: fields,
                    rowLabels: ["KODE ICD X", "ENGLISH NAME", "INDONESIAN NAME", "KELOLA"]
                            //rowLabels : ["ID OBAT","KODE OBAT","NAMA OBAT","SATUAN"]
                })
                $('.stop-propagation').click(function(event) {
                    event.stopPropagation();
                });
            },
            error: function(xhr, status, error) {
                alert('error');
            }
        });
    }
    
    function getICD() {
        var value = $('#queryicd').val();

        $("#bodyICD").html('');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/showICD'; ?>",
            data: {query: value},
            success: function(data) {
                if (data) {
                    var dataObj = eval(data);
                    var content;
                    $.each(dataObj, function(index, value) {
                        content += '<tr><td>' + value.ID_ICD + '</td>';
                        content += '<td>' + value.INDONESIAN_NAME + '</td>';
                        var name = value.INDONESIAN_NAME.split(' ').join('+');
                        content += '<td><button type="button" class="btn btn-xs btn-success" name="' + name + '" id="' + value.ID_ICD + '" onclick="chooseICD(this.id, this.name)"><i class="fa fa-check"></i></button></td></tr>"';
                    });
                    $("#bodyICD").append(content);
                }
            },
            error: function(e) {
                alert(e.message);
            }
        });
    }

    function chooseICD(value, name) {
        var penyakit = name.split('+').join(' ');
        $('#bodyChoosedICD').append('<tr><td><input id="' + value + '" name="' + value + '" readonly class="form-control" type="text" value="' + penyakit + '"></td>&nbsp<td><button class="btn btn-warning" type="button">Hapus</button></td></tr>');
    }

    function ICDChoosed (value) {
	$.ajax({
            type: "POST",
            url: "<?php echo base_url() .$this->uri->segment(1).'/'.$this->uri->segment(2).'/showICDById'; ?>",
            data: {id : value},
            success: function(data){   	
                    var parsedData = JSON.parse(data);

                    $('#bodyChoosedICD').append('<tr id="'+value+'"><td><input id="icd-'+value+'" name="icd-'+value+'" readonly class="form-control" type="text" value="'+parsedData.INDONESIAN_NAME+'"></td><td><button onclick="removeSelectedICD('+value+')" class="btn btn-warning" type="button">Hapus</button></td><td><strong>Status Kasus :</strong></td><td><input id="kasus-'+value+'" name="kasus-'+value+'" type="radio" value="BARU">Baru</td><td><input id="kasus-'+value+'" name="kasus-'+value+'" type="radio" value="LAMA">Lama</td></tr>');
            },
            error: function(e){
			alert(e.message);
            }
	});
    }

    function removeSelectedICD(value) {

        $('#bodyChoosedICD').find('#' + value + '').remove();
    }


</script>

<script>
    function LayananChoosed() {
        value = $('#layananKesehatan').val();
        if (value != "") {
            name = $('#layananKesehatan :selected').text();

            $('#bodyChoosedLayanan').append('<tr id="layanan-' + value + '"><td><input id="layanan-' + value + '" name="layanan-' + value + '" readonly class="form-control" type="text" value="' + name + '"></td><td><button onclick="removeSelectedLayanan(\'layanan-' + value + '\')" class="btn btn-warning" type="button">Hapus</button></td></tr>');
        }
    }

    function removeSelectedLayanan(value) {
        $('#bodyChoosedLayanan').find('#' + value + '').remove();
    }
    
    var fields_layanan = [
        {
            name: 'ID LAYANAN KES',
            type: 'string',
            filterable: true
        }, {
            name: 'NAMA LAYANAN KES',
            type: 'string',
            filterable: true
        }, {
            name: 'JASA SARANA KES',
            type: 'string',
            filterable: true
        }, {
            name: 'JASA LAYANAN KES',
            type: 'string',
            filterable: true
        }, {
            name: 'KETERANGAN LAYANAN KES',
            type: 'string',
            filterable: true
        },
    ]

    function renderTableLayanan()
    {
        var jso;

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0); ?>/showHealthServices',
            success: function(dataCheck) {
                // alert(dataCheck);

                jso = dataCheck;
                setupPivotLayanan({
                    json: jso,
                    fields: fields_layanan,
                    rowLabels: ["ID LAYANAN KES", "NAMA LAYANAN KES", "JASA SARANA KES", "JASA LAYANAN KES"]
                })
                $('.stop-propagation').click(function(event) {
                    event.stopPropagation();
                });
            }
//            ,error: function(xhr, status, error) {
//                var err = eval("(" + xhr.responseText + ")");
//                alert(err.Message);
//            }
        });
    }
</script>

<script>
    function getPatient(rrm, id_antrian) {
        $("#data_pas").hide();
        $("#detail_riwayat").hide();

//        $('#tabelAntrian tbody tr').css("background-color", "transparent");
//        $('#row' + id_antrian).css("background-color", "#e1f8ff");

        $("#id_rrm").val(rrm);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/getPatientData'; ?>",
            data: {id: rrm},
            success: function(data) {
                if (data) {
//                     alert (data);
                    dataObj = jQuery.parseJSON(data);
                    $("#detail_riwayat").show();
                    $("#norekammedik").val(dataObj.noid_pasien);
                    $("#ID_PASIEN").val(dataObj.id_pasien);
                    $("#NAMA_PASIEN").val(dataObj.nama_pasien);
                    $("#umurpasien").val(Math.floor(dataObj.umur / 12) + " Th");
                    $("#UMUR_SAAT_INI").val(dataObj.umur);
                    $("#GENDER_PASIEN").val(dataObj.gender_pasien);
                    $("#ALAMAT_PASIEN").val(dataObj.alamat_pasien);
                    $("#kunjunganpasien").val(dataObj.WAKTU_ANTRIAN_UNIT);
                    $('#linknya').attr("href", "<?php echo base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/patientMRH/'; ?>" + dataObj.id_rekammedik);
                    $("#hidden_noantrian").val(id_antrian);
                    $("#data_pas").show();
                    $("#ID_SUMBER").val(dataObj.ID_SUMBER);
                    $("#sumberbayar").text(dataObj.NAMA_SUMBER_PEMBAYARAN);
                    getLabResult(rrm);
                }
            }
//            ,error: function(e) {
//                alert(e.message);
//            }
        });
    }
    
    function getLabResult(rrm) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/getLabResult'; ?>",
            data: {id: rrm},
            success: function(data) {
//                alert(data);
                if (data) {
                    var dataObj = eval(data);
                    $('#bodyHasilLab').html('');
                    var content = '';
                    $.each(dataObj, function(index, value) {
                        hasiltest = ifNull(value.HASIL_TES_LAB);
                        tanggaltest = ifNull(value.TANGGAL_TES_LAB);
                        content += '<tr><td>' + value.NAMA_PEM_LABORAT + '</td><td>' + hasiltest + '</td><td>' + tanggaltest + '</td></tr>';
                    });
                    $('#bodyHasilLab').append(content);
                }
                else {
                    $('#bodyHasilLab').html('');
                    var content = '<tr><td colspan=3><center>Kosong<center></td></tr>';
                    $('#bodyHasilLab').append(content);
                }
                $('#tabelLab').show();
            }
//            ,error: function(e) {
//                alert('Error!');
//            }
        });
    }
    
    function ifNull(value) {
        if (!value) {
            return '-';
        }
        else
            return value;
    }
	
	function removeAntrian (rrm, id_antrian) {
		if (confirm("Apakah Anda yakin menghapus antrian ini?") == true ){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() .$this->uri->segment(1).'/'.$this->uri->segment(2).'/removeDataAntrian'; ?>",
				data: {id_rrm : rrm, id_antrian : id_antrian},
				success: function(data){
					if (data.length > 0) {
						window.location = "<?php echo base_url() .$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);?>";
					}
				},
				error: function(e){
				}
			});
		}
	}	
</script>