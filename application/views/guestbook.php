<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buku Tamu Pernikahan Ides-Yusup</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css">
</head>
<body>

<div class="cn-navigation">
    <div class="cn-app-name">
        <h2>Bukutamu Pernikahan Ides&Yusup</h2>
    </div>
    <div class="cn-time">
        <p id="time">21:40 PM</p>
    </div>
</div>

<div class="modal form-editable animate scale" id="tambah">
    <div class="header">
        <h2 class="no-bold">Form Data Tamu</h2>
    </div>
    <form class="clearfix" method="POST" action="<?php echo site_url("Admin/tambahData");?>">
        <div class="input-control">
            <label>Nama :</label>
            <input type="text" name="nama" value="" required>
        </div>
        <div class="input-control">
            <label>Alamat :</label>
            <input type="text" name="subject" value="" required>
        </div>
        <div class="input-control">
            <label>Undangan Dari :</label>
            <select name="isi" class="undangan">
                <option>Mempelai</option>
                <option>Orang Tua</option>
            </select>
        </div>
        <button class="btn bg-blue place-right" type="submit">Tambahkan</button>
    </form>
</div>

<div class="cn-sidemenu">
    <div class="header" data-role="dialog" data-target="tambah">
        <span>Tambahkan Tamu</span>
        <span class="iconic">+</span>
    </div>
    <div class="header">
    <a href="<?php echo base_url('logout'); ?>">Logout</a>
    </div>

</div>

<div class="modal form-editable animate scale" id="edit">
    <div class="header">
        <h2 class="no-bold">Edit Data Tamu</h2>
    </div>
    <form class="clearfix" method="POST" action="<?php echo site_url("Admin/pembaruanData") ?>">
        <div class="input-control" hidden>
            <label>Id :</label>
            <input type="text" name="id" value="" required>
        </div>
        <div class="input-control">
            <label>Nama :</label>
            <input type="text" name="nama" value="" required>
        </div>
        <div class="input-control">
            <label>Alamat :</label>
            <input type="text" name="subject" value="" required>
        </div>
        <div class="input-control">
            <label>Undangan Dari :</label>
            <select name="isi" class="undangan">
                <option>Mempelai</option>
                <option>Orang Tua</option>
            </select>
        </div>
        <button class="btn bg-blue place-right" type="submit">Simpan</button>
    </form>
</div>

<div class="cn-main-content">
    <h1 class="no-bold">Daftar Tamu</h1>
    <hr class="ma-hr">
    <button class="btn bg-blue" data-role="dialog" data-target="edit" disabled>Edit Data</button>
    <a href="<?php echo site_url("Admin/hapusData") ?>" class="btn bg-red">Hapus Semua</a>
    <table class="cn-data-tables">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Undangan Dari</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                foreach($tamu as $guest) :
            ?>
            <tr>
                <td><?php echo $guest["id"];?></td>
                <td><?php echo $guest["nama"];?></td>
                <td><?php echo $guest["subject"];?></td>
                <td><?php echo $guest["isi"];?></td>
                <td><?php echo $guest["jam"];?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="cn-footer clearfix">
    <p class="place-right">Created by <span class="love">&hearts;</span> Pandu Wijaya</p>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>assets/js/dialog.js"></script>
<script>
(function($) {

    // Data Tables
    $(".cn-data-tables").dataTable();
    $('.dataTables_paginate > a').wrapInner('<span />');
	$('.dataTables_paginate > a span').addClass('btn-paginate');

    var cnTable = $(".cn-data-tables");

    cnTable.each(function() {
        var that = $(this);
        var isi = that.find("tbody tr");

        that.on("click", "tbody tr", function() {
            if($(this).siblings().removeClass("selected")) {
                $(this).addClass("selected");
            }
            check($(this));
            $('[data-target="edit"]').removeAttr("disabled");
        });
    });

    function check(param) {
        var target = param.children();
        var myJSON = { 
                        id: target.eq(0).text(),
                        nama: target.eq(1).text(),
                        subject: target.eq(2).text(),
                        isi: target.eq(5).text()
                    };
        edit(myJSON);
    }

    function edit(param) {
        var myObj = JSON.stringify(param);
        var osd = JSON.parse(myObj);
        var edit = $("#edit");
        edit.find("[name='id']").val(osd.id);
        edit.find("[name='nama']").val(osd.nama);
        edit.find("[name='subject']").val(osd.subject);
        edit.find("[name='isi']").val(osd.isi);

        return param;
    }

    // Time
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
        t = setTimeout(function () {
            startTime()
        }, 500);
    }
    startTime();

})(jQuery);
</script>
</body>
</html>