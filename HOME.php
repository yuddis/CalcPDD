<?php
session_start();
include "library/connection.php";
include "library/userHandler.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kalkulator PDD - HOME</title>
<link href="cssheets/main.css" type="text/css" rel="stylesheet" />
<script type='Text/JavaScript' src='jscript/scw.js'></script>
<script type='Text/JavaScript' src='jscript/algoPDD.js'></script>
<script type="text/javascript">
	var error = [20];
	//main function
	function openResult(form)
	{
		checkForm(form);
		document.getElementById("errorContainer").innerHTML = "";
		var open = window.open("RESULT.php");
		open.form = form;
	}
	
	function strToDate(tempDate){
		
		var a = tempDate.split("/");
		var b = new Date(a[2],a[1]-1,a[0]);
		
		return b;
	}
	
	function checkForm(form)
	{
		//init var checking
		var errorCount = 0;
		var tempDateMDP = form.dateMDP.value;
		var tempDateRede = form.dateReady.value;
		var NoSPK = form.nomorSPK.value;
		var NamaPelanggan = form.namaPelanggan.value;
		var telpon = form.noTelepon.value;
		var hp = form.noHP.value;
		var NamaKendaraan = form.namaKendaraan.value;
		var WarnaKendaraan = form.warnaKendaraan.value;
		var PembayaranDll = form.PembayaranDLL.value;
		
		
		
		if(form.paramMDP[0].checked && tempDateMDP == form.dateMDP.defaultValue) {
			error[errorCount] = "Pilih Tanggal MDP";
			errorCount++;
		}
		if(!form.paramMDP[0].checked && !form.paramMDP[1].checked) {
			error[errorCount] = "Pilih MDP atau Ready";
			errorCount++;
		}
		if(NoSPK == form.nomorSPK.defaultValue || tempDateRede == form.dateReady.defaultValue ) {
			error[errorCount] = "Nomor SPK atau Tanggal Ready masih kosong";
			errorCount++;
		}
		if(NamaPelanggan == form.namaPelanggan.defaultValue) {
			error[errorCount] = "Nama Pelanggan masih kosong";
			errorCount++;
		}
		if(telpon == form.noTelepon.defaultValue && hp == form.noHP.defaultValue) {
			error[errorCount] = "Nomor Telepon atau HP masih kosong";
			errorCount++;
		}
		if(NamaKendaraan == form.namaKendaraan.defaultValue) {
			error[errorCount] = "Nama Kendaraan masih kosong";
			errorCount++;
		}
		if(!form.paramTipe[0].checked && !form.paramTipe[1].checked) {
			error[errorCount] = "Pilih CKD atau CBU";
			errorCount++;
		}
		if(WarnaKendaraan == form.warnaKendaraan.defaultValue) { 
			error[errorCount] = "Warna Kendaraan masih kosong";
			errorCount++;
		}
		if(!form.paramPembayaran[0].checked && !form.paramPembayaran[1].checked && !form.paramPembayaran[2].checked && !form.paramPembayaran[3].checked && !form.paramPembayaran[4].checked && PembayaranDll == form.PembayaranDLL.defaultValue) {
			error[errorCount] = "Tentukan Cara Pembayaran";
			errorCount++;
		}
		if(form.paramPembayaran[4].checked && PembayaranDll == form.PembayaranDLL.defaultValue){
			error[errorCount] = "Nama Asuransi Lain-lain masih kosong";
			errorCount++;
		}
		if(!form.paramSTNK[0].checked && !form.paramSTNK[1].checked) { 
			error[errorCount] = "Pilih STNK atau Tanpa STNK";
			errorCount++;
		}
		
		
		
		if(errorCount != 0) {
			var errorCode = "Error has been occured !<ul style='border:1px solid #F00;'>";
			for(i = 0; i < errorCount; i++) {
				errorCode += "<li>" + error[i] + "</li></br>";
			}
		   errorCode += "</ul>";
		   
		   document.getElementById("errorContainer").innerHTML = errorCode;
		   document.getElementById("errorContainer").scrollIntoView();
		   throw "err30";
		}
		else {
			return;
		}
	}
	
	function resetField()
	{
		//document.getElementById("namaPelanggan").innerHTML = "";
		//document.getElementById("paramPembayaran").innerHTML = document.getElementById("paramPembayaran").defaultValue;
	}

	function blank(a) { if(a.value == a.defaultValue) a.value = ""; }
	function unblank(a) { if(a.value == "") a.value = a.defaultValue; }
	function eTimeCKD(a){ 
							if(a.value == "ckd") {
													document.getElementById("timeCKD").disabled=false; 
												 	document.getElementById("timeCKD").selectedIndex = 1;
												 }
							else {
									document.getElementById("timeCKD").disabled=true;
									document.getElementById("timeCKD").selectedIndex = 0;
								 }
						}
	function eTglMDP(a) {
							if(a.value == "mdp") {
													document.getElementById("dateMDP").disabled=false;
												 }
							else {
									document.getElementById("dateMDP").disabled=true;
								 	document.getElementById("dateMDP").value = "Tanggal MDP";
								 }
							
						}
	function ePembayaranDll(a){
							if(a.value == "dll") {
													document.getElementById("PembayaranDLL").disabled=false;
													document.getElementById("paramBedaBank").disabled=true;
								 					document.getElementById("paramBedaBank").checked = false;
												 }
							else if(a.value == "cash"){
														document.getElementById("paramBedaBank").disabled=false;
														document.getElementById("PembayaranDLL").disabled=true;
								 						document.getElementById("PembayaranDLL").value = "Lain-lain";
											 		  }
							else { 
									document.getElementById("PembayaranDLL").disabled=true;
								 	document.getElementById("PembayaranDLL").value = "Lain-lain";
									document.getElementById("paramBedaBank").disabled=true;
								 	document.getElementById("paramBedaBank").checked = false;
								 }
							
						}
	function eSTNK(a) {
		if(a.value == "stnk") {
								document.getElementById("paramPilPol").disabled=false;
							 }
		else {
				document.getElementById("paramPilPol").disabled=true;
			 	document.getElementById("paramPilPol").checked = false;
			 }
		
	}
</script>
</head>

<body onload="loadData();">
	<div id="container">
        <div id="top"> 
            <div  align="center"><img src="images/logo plato.jpg" width="215" height="43"/></div>
            <div id="menubar">
               <ul >
               	<li><a href="HOME.php">HOME</a></li>
                <li><a href="HOLIDAYLIST.php">HOLIDAY</a></li>
                </ul>
            </div>
        </div>
     
        <div id="content-wrap">
        	<div id="input-nya">
        	<form name="formPDD" action="" method="post">
            	<table>
                	<tr>
                        <td colspan="3" align="center">
                        	<input type="radio" name="paramMDP" id="mdp" value="mdp" onclick="eTglMDP(this)" />MDP 
                            <input value="Tanggal MDP" name="dateMDP" id="dateMDP" type="text" disabled="disabled" onclick="scwShow(this,event);" onfocus="blank(this)" onblur="unblank(this)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="paramMDP" id="ready" value="ready" onclick="eTglMDP(this)" />READY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                	<tr>
                        <td>
                        	Nomor/Tanggal SPK
                        </td>
                        <td>
                        	:
                        </td>
                        <td>
                        	<input type="text" value="No SPK" name="nomorSPK" size="5" maxlength="5" onfocus="blank(this)" onblur="unblank(this)" />
                            <input value="Tanggal Ready (Klik Disini)" name="dateReady" size="25" type="text" onclick="scwShow(this,event);" onfocus="blank(this)" onblur="unblank(this)">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	Nama Pelanggan
                        </td>
                        <td>
                        	:
                        </td>
                        <td>
                        	<input value="Nama" type="text" id="namaPelanggan" name="namaPelanggan" size="37" onfocus="blank(this)" onblur="unblank(this)" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	Telepon/HP
                        </td>
                        <td>
                        	:
                        </td>
                        <td>
                        	<input value="Telepon" type="text" id="noTelepon" name="noTelepon" size="15" onfocus="blank(this)" onblur="unblank(this)" />
                            <input value="HP" type="text" name="noHP" size="15" onfocus="blank(this)" onblur="unblank(this)" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	Type Kendaraan
                        </td>
                        <td>
                        	:
                        </td>
                        <td>
                        	<input value="Nama Kendaraan" type="text" id="namaKendaraan" name="namaKendaraan" size="37" onfocus="blank(this)" onblur="unblank(this)" /><br />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;
                        	
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                        <td>
                        	<input type="radio" id="paramCKD" name="paramTipe" value="ckd" onclick="eTimeCKD(this)" /><span>CKD</span>
                            &nbsp;&nbsp;
                            <select id="timeCKD" disabled="disabled">
                                <option value="" style="display:none;" selected="selected">Pilih hari</option>
                                <option value="4">4 Hari</option>
                                <option value="6">6 Hari</option>
                            </select>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" id="paramCBU" name="paramTipe" value="cbu" onclick="eTimeCKD(this)" /><span>CBU</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	Warna Kendaraan
                        </td>
                        <td>
                        	:
                        </td>
                        <td>
                        	<input value="Warna Kendaraan" type="text" name="warnaKendaraan" size="37" onfocus="blank(this)" onblur="unblank(this)" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	Cara Pembayaran
                        </td>
                        <td>
                        	:
                        </td>
                        <td>
                        	<input type="radio" id="paramPembayaran" name="paramPembayaran" value="cash" onclick="ePembayaranDll(this)" /><span>CASH</span>
                            <input disabled="disabled" id="paramBedaBank" type="checkbox" name="paramBedaBank" value="bedaBank" /><span style="font-size:10px;">BEDA BANK</span>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;
                        	
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                        <td>
                            <input type="radio" name="paramPembayaran" value="tafs" onclick="ePembayaranDll(this)"/><span>TAFS</span>
                            <input type="radio" name="paramPembayaran" value="acc"  onclick="ePembayaranDll(this)"/><span>ACC</span>
                            <input type="radio" name="paramPembayaran" value="oto"  onclick="ePembayaranDll(this)"/><span>OTO</span>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;
                        	
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                        <td>
                            <input type="radio" name="paramPembayaran" value="dll" onclick="ePembayaranDll(this)" /><input disabled="disabled"  id="PembayaranDLL" value="Lain-lain" type="text" name="PembayaranDLL"  onfocus="blank(this)" onblur="unblank(this)" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        	<input type="radio" name="paramSTNK" value="nostnk" onclick="eSTNK(this)"/>TANPA STNK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="paramSTNK" value="stnk" onclick="eSTNK(this)" />DENGAN STNK
                            <input disabled="disabled" type="checkbox" id="paramPilPol" name="paramPilPol" value="PilPol" /><span style="font-size:10px;">PILIH NOMOR POLISI</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                        	<input type="button" size="30" value="Submit" style="width:180px; height:50px;" onClick="openResult(this.form);"  />
                            <button type="submit" onClick="resetField()" style="height:50px; width:100px;">Refesh</button>
                        </td>
                    </tr>
                </table>	 
            </form>
            </div>
            <div id="errorContainer">
            
        	</div>
        </div>
        
        <div id="bottom">
        	<div>
                <img src="images/footer.jpg" width="900" height="34" />
                Copyright 2012
            </div>
        </div>
    </div>
</body>
</html>
