<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
        #bigWrapper{
            width: 100%;
        }
        .foto{
            width: 700px !important;
            height: 1500px !important;
        }
        .foto img{
            width: 700px;
            height: 1500px;
        }
        .title{
            margin: 0 auto;
            margin-top: -80px;
            width: 600px;
            font-size: 18px;
        }
        table,th,td{
            border: 1px solid black;
        }
        table {
            border-collapse: collapse;
        	width: 100%; 
        	font-size: 140px !important;
        	font-family: serif;
        	color: red;
        }
        tr:nth-child(even) {
            background-color: #8D8B8B;
        }
        tr:first-child{
            width: 40px;
        }
        th{
            background-color: #8D8B8B;
            color: black;
        }
        td{
            padding: 100px;
            text-align: center;
            width: 200px;
        }
        .atur th{
        	height: 25px;
        }
        .nilai td, th{
        	width: 50px;
        }
	</style>
</head>
<body style="margin-top: 250px;">
	<div id="bigWrapper">
        <div class="content" style="margin: 0 auto; width:100%;">
            <p style="margin-top: 50px; width: 100%; font-weight: bold; font-size: 18px; text-align: center; margin-bottom: 30px;"><strong>Laporan Hasil Penilaian Pelamar</strong></p>
            <table>
				<tr class="atur">
                    <th rowspan="2" style="width: 40px;">No</th>
                    <th colspan="6">Data Pribadi Pelamar</th>
                    <th colspan="6">Data Hasil Penilaian Pelamar</th>
                </tr>
                
                <tr class="atur">
                	<th class="foto">Foto</th>
                	<th>Nama</th>
                	<th>TTL</th>
                	<th>No.HP</th>
                	<th>Email</th>
                	<th>Alamat</th>
                	<th class="nilai">Administrasi</th> 
                	<th class="nilai">Wawancara</th>
                	<th class="nilai">Psikotes</th>
                	<th class="nilai">MCU</th>
                	<th class="nilai">Hasil</th>
                	<th class="nilai">Keputusan</th>   
                </tr>

                <tr>
                	<td>1</td>
                	<td class="foto"><img src="<?= base_url('assets/foto/coba.jpg') ?>" width="700" height="1500"></td>
                	<td>Ayu Lestari</td>
                	<td>10-08-1998</td>
                	<td>082372348088</td>
                	<td>lestariayu669@gmail.com</td>
                	<td>Lrg balana mmahaa ha ahah </td>
                	<td>Tidak Ada Keahlian</td> 
                	<td>Tidak Ada Keahlian</td>
                	<td>Tidak Ada Keahlian</td>
                	<td>Tidak Ada Keahlian</td>
                	<td>Tak Karuan</td>
                	<td>Lulus</td>   
                </tr>
			</table>
		</div>
	</div>
</body>
</html>