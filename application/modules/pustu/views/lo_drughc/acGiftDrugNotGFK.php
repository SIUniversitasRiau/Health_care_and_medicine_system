<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <header class="panel-heading">
                    <h3 class="panel-title"><?= $jenisTransNama ?></h3>
                </header>
                <div class="panel-body">
                    <div class="col-sm-4">
                        <form class="form-inline">
                            <div class="input-group" style="margin-bottom:20px;">
                                <input id="oi1" type="text" class="form-control" placeholder="Kata Kunci Utama">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" onclick="renderTable()" type="button">Pencarian Obat</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <ul class="nav nav-pills">
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
                            </ul>
                            <hr/>
                            <h3 class="oxigenfontblue">Hasilnya</h3>
                            <span class="hide-on-print" id="pivot-detail"></span>
                            <hr/>
                            <div style="" id="results"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <header class="panel-heading">
                    <h3 class="panel-title">Obat yang dipilih</h3>
                </header>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Batch</th>
                            <th>Nama</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Expired</th>
                            <th>Sumber_Anggaran</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="list_obat">
                        </tbody>
                    </table>
                    <br/><br/>
                    <form class="form-horizontal bucket-form" method="post" action="<?= base_url().$this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/addRequest' ?>">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-sm-3">
                                <input type="text" name="transaksi" class="datepicker form-control default-date-picker"  size="16" value="<?= date('d-m-Y') ?>" />
                                <span class="help-block">Pilih Tanggal</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Dari</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" name="dari" value="" placeholder="Dari Selain GFK">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">ke</label>
                            <div class="col-sm-3">
                                <input type="hidden" name="ke" value="<?= $ke_id ?>">
                                <input class="form-control" type="text" value="<?= $ke_nama ?>" readonly="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-3">
                                <input type="hidden" name="jenis_transaksi" value="<?= $jenisTransId ?>">
                                <input type="hidden" name="flag_konfirmasi" value="1">
                                <input type="hidden" name="total_kodeObat" class="total_kodeObat" value="" /> <!-- total id obat -->
                                <input type="hidden" name="total_batch" class="total_batch" value="" /><!-- total_batch -->
                                <input type="hidden" name="total_jumlahObat" class="total_jumlahObat" value="" /> <!-- total jumlah obat -->
                                <input type="hidden" name="total_expired" class="total_expired" value="" /> <!-- total_expired -->
                                <input type="hidden" name="total_anggaran" class="total_anggaran" value="" /> <!-- total_anggaran -->
                                <input type="hidden" name="transaksi_now" class="" value="<?= date('d-m-Y') ?>" /> <!-- tanggal transaksi -->
                                <input class="btn btn-primary pull-right" type="submit" value="submit" name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Detail Obat</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nama Obat</label>
                            <input class="form-control nama_obat" type="text" name="nama_obat" value="" readonly="true">
                        </div>
                        <div class="form-group">
                            <label>No. BATCH</label>
                            <input class="form-control detil_id" type="hidden" name="detil_id" value="" readonly="true">
                            <input class="form-control id_obat" type="hidden" name="id_obat" value="" readonly="true">
                            <input class="form-control batch" type="text" name="batch" value="">
                        </div>
                        <div class="form-group">
                            <label>Expired Date</label>
                            <input type="text" name="expObat" class="form-control form-control-inline default-date-picker expObat datepicker" size="16" value="<?= date('d-m-Y') ?>">
                            <span class="help-block">Pilih Tanggal (bulan-tanggal-tahun)</span>
                        </div>
                        <div class="form-group">
                            <label>Sumber Anggaran</label>
                            <select name="anggaran" class="form-control anggaran">
                                <?php for($i=0; $i<sizeof($anggaran); $i++): ?>
                                <option value="<?= $anggaran[$i]['ID_SUMBER_ANGGARAN_OBAT'] ?>"><?= $anggaran[$i]['NAMA_SUMBER_ANGGARAN_OBAT'] ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Penerimaan</label>
                                    <input class="form-control pesan" type="text" name="pesan" value="" placeholder="Jumlah Permintaan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input class="form-control satObat" type="text" name="satObat" value="" readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" type="button">Keluar</button>
                <button data-dismiss="modal" class="btn btn-primary" type="button" onclick="cekBatchObat($('.detil_id').val(), $('.id_obat').val(), $('.batch').val(), $('.nama_obat').val(), $('.expObat').val(), $('.pesan').val(), $('.jmlObat').val(), $('.satObat').val(), $('.anggaran option:selected').val(), $('.anggaran option:selected').text())">Tambah</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

<style>
    .datepicker{z-index: 100000}
</style>
<script>
    $(function () {
        $( ".datepicker" ).datepicker({
                format: 'dd-mm-yyyy',
        });
    });
</script>

<script type="text/javascript" src="<?php echo base_url();?>assets/newui/js/pilihObatNotGfk.js"></script>

<script type="text/javascript">
    function setObat(id_obat,nama_obat,satObat)
    {
        $('.batch').val('');
        $('.id_obat').val(id_obat);
        $('.nama_obat').val(nama_obat);
        $('.pesan').val(0);
        $('.satObat').val(satObat);
    }
    
    function cekBatchObat(detil_id, id_obat, batch, nama_obat, expObat, pesan, jmlObat, satObat, anggaran, anggaranText){
        var result= false;
        var kapsul = {};
        kapsul.teksnya = {};
        kapsul.teksnya.tanda = batch;
//        alert(kapsul.teksnya.tanda);
        $.ajax({
            type : "POST",
            url : '<?php echo base_url().$this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/checkBatchObat'; ?>',
            data: kapsul,
            success : function(dataCheck) {
//                alert("Hasil: "+dataCheck["NOMOR_BATCH"]+"");
                if(dataCheck["NOMOR_BATCH"]=='false'){
                    choose(id_obat, id_obat, batch, nama_obat, Number(pesan), satObat, expObat, anggaran, anggaranText);
                }
                else {
                    alert("Nomor Batch: "+dataCheck["NOMOR_BATCH"]+" telah digunakan\nSilahkan gunakan Nomor Batch lain");
                    
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              alert(xhr.responseText);
            }
        });
    }
    
    var fields = [{
            name : 'NAMA OBAT',
            type : 'string',
            filterable : true
        },{
            name : 'SATUAN',
            type : 'string',
            filterable : true
        },{
            name : 'KELOLA',
            type : 'string',
            filterable : true
        }
    ]

    function renderTable(){
        var jso;
        var data_pos = $("#oi1").val();
        var kapsul = {};
        kapsul.teksnya = {};
        kapsul.teksnya.tanda = $("#oi1").val();
//        alert(kapsul.teksnya.tanda);
        $.ajax({
            type : "POST",
            url : '<?php echo base_url().$this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/searchObatMaster'; ?>',
            data: kapsul,
            success : function(dataCheck) {
//                alert(dataCheck);
                jso = dataCheck;
                setupPivot({
                    json : jso,
                    fields : fields,
                    rowLabels : ["NAMA OBAT","SATUAN","KELOLA"]
                })
                $('.stop-propagation').click(function(event) {
                    event.stopPropagation();
                });
            }
//            ,error: function (xhr, ajaxOptions, thrownError) {
//              alert(xhr.status);
//              alert(thrownError);
//              alert(xhr.responseText);
//            }
        });
    }
</script>