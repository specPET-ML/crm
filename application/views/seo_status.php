<?php
	$this -> load -> view('header', array('uzytkownik' => $uzytkownik, 'klient' => isset($klient) ? $klient : false));
			
	forms::title(array('title' => 'Dane klienta'));
	$key = "bWaIvexnHHMj9J1E62Kd";
    $method = "cast5-cfb";
    $cms_login = $klient['cms_login'];
    $decrypted_cms_login = openssl_decrypt($cms_login, $method, $key);
    $cms_haslo = $klient['cms_haslo'];
    $decrypted_cms_haslo = openssl_decrypt($cms_haslo, $method, $key);
    $ftp_login = $klient['ftp_login'];
    $decrypted_ftp_login = openssl_decrypt($ftp_login, $method, $key);
    $ftp_haslo = $klient['ftp_haslo'];
    $decrypted_ftp_haslo = openssl_decrypt($ftp_haslo, $method, $key); 
    $pozycjonerzy = $this -> load -> model('pozycjonerzy');
	$pozycjoner = $pozycjonerzy -> jeden($klient['id_pozycjonera']);
	$partnerzy = $this -> load -> model('partnerzy');
	$partner = $partnerzy -> jeden($klient['id_partnera']);
	
	$my_file = '/CrustyCrock753159/x'.$klient['hash'].'yz.ftp';
	unlink($my_file);
	
if ($klient['ftp_haslo'] != ''){
	$my_file = '/CrustyCrock753159/x'.$klient['hash'].'yz.ftp';
	$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
	$data = '<?xml version="1.0" encoding="windows-1252"?>
	<SITES VERSION="1.2">
	<SITE NAME="'.$klient['adres_strony'].'">
	<PROTOCOL>FTP</PROTOCOL>
    <ADDRESS>'.$klient['ftp_server'].'</ADDRESS>
    <PORT>21</PORT>
    <USERNAME>'.$decrypted_ftp_login.'</USERNAME>
    <PASSWORD>'.$decrypted_ftp_haslo.'</PASSWORD>
    <PASSIVE>DEFAULT</PASSIVE>
    <SSL>NONE</SSL>
	</SITE>
	</SITES>';
	fwrite($handle, $data);
	fclose($handle);
}	  
	  
	  
	  
	  ?>
		
		<table border="0" cellpadding="50px" cellspacing="1ox" id="dane_klienta" style="width: 100%;">
			<tr>
				<td width="25%">Nazwa klienta:<br /><b><?php echo $klient['nazwa'];?></b></td>
				<td width="25%">Nazwa strony:<br /><b><a href="http://<?php echo $klient['adres_strony'];?>" rel="external"><?php echo $klient['adres_strony'];?></a></b></td>
				<td width="25%">Prowadzący "informatyk":<br /><b><a href="mailto:<?php echo $pozycjoner['mail'];?>?subject=W sprawie Klienta: <?php echo $klient['adres_strony']?>"><?php echo $pozycjoner['nazwa'];?></a></b></td>
				<td width="25%">Handlowiec prowadzący:<br /><b><a href="mailto:<?php echo $partner['mail'];?>?subject=W sprawie Klienta: <?php echo $klient['adres_strony']?>"><?php echo $partner['nazwa'];?></a></b></td>
		<?php	if($uzytkownik['typ'] == 'admin' && ($uzytkownik['id'] == '1' || $uzytkownik['id'] == '4' || $uzytkownik['id'] == '5' || $uzytkownik['id'] == '6'  || $uzytkownik['id'] == '10' || $uzytkownik['id'] == '126' || $uzytkownik['id'] == '129')){ ?>	
				<td width="25%"><?php forms::button(array('value' => 'Edytuj', 'link' => url::page(CONTROLLER.'/form/'.$klient['id_klienta'])));?></td>
		<?php } ?>
			</tr>
		</table>
		<?php forms::line(0);
		if ($klient['reczna_filtr'] == true) { ?>
		
		<table border="0" cellpadding="10px" cellspacing="10px" style="width: 100%;background-color: red;">
			<tr>
			<td style="text-align: center;font-size: large;"><b>!! Ręczna Interwencja lub Filtr Algorytmiczny !!</b></td>
			</tr>
		</table>
		<?php forms::line(0); }?>
		<table border="0" cellpadding="10px" cellspacing="10px" style="width: 100%;">
			<tr>
				<td>
				<a href="https://ahrefs.com/site-explorer/overview/subdomains/?target=<?php echo $klient['adres_strony']; ?>">A HREFS</a>
				<a href="http://www.majesticseo.com/reports/site-explorer?q=<?php echo $klient['adres_strony']; ?>">Majestic SEO</a>
				<a href="http://suite.searchmetrics.com/en/research?acc=0&amp;url=<?php echo $klient['adres_strony']; ?>">Searchmetrics</a>
				<a href="https://www.google.pl/search?q=site%3A<?php echo $klient['adres_strony']; ?>">Google Site</a>
				<a href="http://www.opensiteexplorer.org/links?site=<?php echo $klient['adres_strony']; ?>">MOZ</a>
				<a href="http://explorer.cognitiveseo.com/?u=<?php echo $klient['adres_strony']; ?>">COGNITIVE</a>
				<a href="http://www.semrush.com/pl/info/<?php echo $klient['adres_strony']; ?>?db=pl">SEMRush</a>
				<a href="http://www.bing.com/search?q=<?php echo $klient['adres_strony']; ?>">Bing</a>
				</td>
			</tr>
		</table>
		<?php forms::line(0);?>
		<table border="0" cellpadding="10px" cellspacing="10px" style="width: 100%;">
			<tr>
			<?php if($klient['niebonie'] == false) {?>
				<td>
				<?php if($klient['dostepy'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['dostepy'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				Dostęp FTP?: <b><?php if($klient['dostepy'] == true){ echo "TAK";}
				if($klient['dostepy'] == false){ echo "NIE";}?></b></td>
				<td>
				<?php if($klient['dostepy_cms'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['dostepy_cms'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				Dostęp CMS?: <b><?php if($klient['dostepy_cms'] == true){ echo "TAK";}
				if($klient['dostepy_cms'] == false){ echo "NIE";}?></b></td> 
				<td style="width:65%;"></td>
			<?php } else { ?>
				<td>
				<?php echo "<img src=\"/../../inc/cms/img/Gay-icon.png\" alt=\"He is gay\">"; ?>
				Nie, bo nie?: <b>Niestety TAK !!</b></td>
			<?php } ?>
			</tr>
		</table>
		<?php forms::line(0);?>
		<table border="0" cellpadding="10px" cellspacing="10px" style="width: 100%;">
			<tr>				
				<td>
				<?php if($klient['optymalizacja'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['optymalizacja'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				Optymalizacja techniczna: <b><?php if($klient['optymalizacja'] == true){ echo "TAK";}
				if($klient['optymalizacja'] == false){ echo "NIE";}?></b></td>
				<td><?php echo "<img src=\"/../../inc/cms/img/Cal-icon.png\" alt=\"Copyscape\">";?> Data OPT TECH: <b><?php if($klient['opt_data'] > 0000-00-00) echo texts::nice_date($klient['opt_data']);
				if($klient['opt_data'] == false){ echo "Nie wpisano";}?></b></td>
				<td style="width:50%;"></td>
			</tr>
			<tr>				
				<td>
				<?php if($klient['opt_meta'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['opt_meta'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				Optymalizacja META: <b><?php if($klient['opt_meta'] == true){ echo "TAK";}
				if($klient['opt_meta'] == false){ echo "NIE";}?></b></td>
				<td><?php echo "<img src=\"/../../inc/cms/img/Cal-icon.png\" alt=\"Copyscape\">";?> Data OPT META: <b><?php if($klient['opt_meta_data'] > 0000-00-00) echo texts::nice_date($klient['opt_meta_data']); ?></b></td>
			</tr>
			<tr>
			<td>
				<?php if($klient['poprawa'] == false){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['poprawa'] == true){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				Nieznany PROBLEM ?: <b><?php if($klient['poprawa'] == true){ echo "tak";}
				if($klient['poprawa'] == false){ echo "nie";}?></b></td>
			</tr>
		</table>
		<?php forms::line(0);?>
		<table border="0" cellpadding="10px" cellspacing="10px" style="width: 100%;">
			<tr>
				<td>
				<?php if($klient['teksty'] == false){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['teksty'] == true){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				Teksty do wymiany lub ich brak?: <b><?php if($klient['teksty'] == true){ echo "TAK";}
				if($klient['teksty'] == false){ echo "NIE";}?></b></td>
				<td><?php echo "<img src=\"/../../inc/cms/img/Cal-icon.png\" alt=\"Copyscape\">";?> Data CS: <b><?php if($klient['cs_data'] > 0000-00-00) echo texts::nice_date($klient['cs_data']);
				if($klient['cs_data'] == false){ echo "Nie wpisano";}?></b></td>
				<td><?php echo "<img src=\"/../../inc/cms/img/Cs-icon.png\" alt=\"Copyscape\">";?> Link CS: <b><?php if($klient['cs_link'] == true){ echo "<a href=\"".$klient['cs_link']."\">KLIK</a>";}
				if($klient['cs_link'] == false){ echo "Nie jest zapisany";}?></b></td>
				<td style="width:30%;"></td>
			</tr>
			<tr>
				<td>
				<?php if($klient['host_zly'] == false){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['host_zly'] == true){ echo "<img src=\"/../../inc/cms/img/cat-icon.png\" alt=\"STOP\">";} ?>
				Hosting do dupy?: <b><?php if($klient['host_zly'] == true){ echo "TAK";}
				if($klient['host_zly'] == false){ echo "NIE";}?></b></td>
				<td>
				<?php if($klient['strona_zla'] == false){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['strona_zla'] == true){ echo "<img src=\"/../../inc/cms/img/cat-icon.png\" alt=\"STOP\">";} ?>
				Strona do zmiany całkiem?: <b><?php if($klient['strona_zla'] == true){ echo "TAK";}
				if($klient['strona_zla'] == false){ echo "NIE";}?></b></td>
				<td>
				<?php if($klient['strona_popr'] == false){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['strona_popr'] == true){ echo "<img src=\"/../../inc/cms/img/cat-icon.png\" alt=\"STOP\">";} ?>
				Strona do dużej poprawy?: <b><?php if($klient['strona_popr'] == true){ echo "TAK";}
				if($klient['strona_popr'] == false){ echo "NIE";}?></b></td>
			</tr>
			<tr>
				<td>
				<?php if($klient['google_ana'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['google_ana'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				<a href="https://www.google.com/analytics/web/" targe="_blank">Google Analytics:</a> <b><?php if($klient['google_ana'] == true){ echo "tak";}
				if($klient['google_ana'] == false){ echo "nie";}?></b></td>	
				<td>
				<?php if($klient['web_tool'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['web_tool'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				<a href="https://www.google.com/webmasters/tools/dashboard?hl=pl&siteUrl=http://<?php echo $klient['adres_strony']; ?>" target="_blank">Google Webmaster Tools:</a> <b><?php if($klient['web_tool'] == true){ echo "tak";}
				if($klient['web_tool'] == false){ echo "nie";}?></b></td>
				<td>
				<?php if($klient['google_mapa'] == true){ echo "<a href=\"".$klient['google_mapa']."\" rel=\"external\"><img src=\"/../../inc/cms/img/google_maps_logo.jpg\" alt=\"Google Maps\"></a>";}?>
				<?php if($klient['google_mapa'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";}
				if($klient['google_mapa'] == false){ echo " Google Maps?: <b>nie</b>";}?></td>
				
			</tr>
		</table>
		<?php 
		if($uzytkownik['typ'] == 'admin' && ($uzytkownik['id'] == '1' || $uzytkownik['id'] == '7' || $uzytkownik['id'] == '4' || $uzytkownik['id'] == '6' || $uzytkownik['id'] == '10' || $uzytkownik['id'] == '126' || $uzytkownik['id'] == '2') || $uzytkownik['typ'] == 'pozycjoner'){ forms::line(0);?>	
		<table border="0" cellpadding="10px" cellspacing="10px" style="width: 100%;">
			<tr>
				<td>
				<?php if($klient['katalogi'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['katalogi'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				Katalogi?: <b><?php if($klient['katalogi'] == true){ echo "tak";} if($klient['katalogi'] == false){ echo "nie";}?></b></td>
				<td>
				<?php if($klient['SWL'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['SWL'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				SWL?: <b><?php if($klient['SWL'] == true){ echo "tak";} if($klient['SWL'] == false){ echo "nie";}?></b></td>
				<td>
				<?php if($klient['zaplecza'] == true){ echo "<img src=\"/../../inc/cms/img/Ok-icon.png\" alt=\"OK\">";} ?>
				<?php if($klient['zaplecza'] == false){ echo "<img src=\"/../../inc/cms/img/No-icon.png\" alt=\"STOP\">";} ?>
				Zaplecza?: <b><?php if($klient['zaplecza'] == true){ echo "tak";} if($klient['zaplecza'] == false){ echo "nie";}?></b></td>
			</tr>
			<tr>
				<td><?php echo "<img src=\"/../../inc/cms/img/Cal-icon.png\" alt=\"Copyscape\">";?> Od kiedy?: <b><?php if($klient['data_katalogi_start'] > 0000-00-00) echo texts::nice_date($klient['data_katalogi_start']);?></b></td>
				<td><?php echo "<img src=\"/../../inc/cms/img/Cal-icon.png\" alt=\"Copyscape\">";?> Od kiedy?: <b><?php if($klient['data_SWL_start'] > 0000-00-00) echo texts::nice_date($klient['data_SWL_start']);?></b></td>
				<td><?php echo "<img src=\"/../../inc/cms/img/Cal-icon.png\" alt=\"Copyscape\">";?> Od kiedy?: <b><?php if($klient['data_zaplecza'] > 0000-00-00) echo texts::nice_date($klient['data_zaplecza']);?></b></td>
			</tr>
			<tr>	
				<td><?php echo "<img src=\"/../../inc/cms/img/Cal-icon.png\" alt=\"Copyscape\">";?> Do kiedy?: <b><?php if($klient['data_katalogi_end'] > 0000-00-00) echo texts::nice_date($klient['data_katalogi_end']);?></b></td>
				<td><?php echo "<img src=\"/../../inc/cms/img/Cal-icon.png\" alt=\"Copyscape\">";?> Do kiedy?: <b><?php if($klient['data_SWL_end'] > 0000-00-00) echo texts::nice_date($klient['data_SWL_end']);?></b></td>
				<td><?php echo "<img src=\"/../../inc/cms/img/Wave-icon.png\" alt=\"Copyscape\">";?> Która fala?: <b><?php if($klient['zaplecza_fala'] > 0) echo $klient['zaplecza_fala'];?></b></td>
			</tr>
	</table>
   <?php forms::line(0);
                          
   forms::title(array('title' => 'Dane strony klienta'));
    ?>
    <table border="0" cellpadding="10px" cellspacing="10px" style="width: 100%;">
    <tr>
    <td width="50%"><h3 style="margin: 0 0 0 5px;">CMS</h3></td>
    <td width="50%"><h3 style="margin: 0 0 0 5px;"><?php if ($klient['ftp_haslo'] != ''){ ?><a href="/CrustyCrock753159/x<?php echo $klient['hash']; ?>yz.ftp">FTP</a><?php } else {?>FTP<?php } ?></h3></td>
    </tr>
    <tr>
    <td width="50%">Adres CMS:<br /><b><?php if ($klient['cms_adres'] != ''){ ?><a href="<?php echo $klient['cms_adres']; ?>" target="_blank"><?php echo $klient['cms_adres']; ?></a><?php } else { echo $klient['cms_adres']; } ?></b></td>
    <td width="50%">Serwer FTP:<br /><b><?php echo $klient['ftp_server'];?></b></td>
    </tr>
    <tr>
    <td width="50%">Login do cmsa:<br /><b><?php echo $decrypted_cms_login;?></b></td>
    <td width="50%">Login do FTP:<br /><b><?php echo $decrypted_ftp_login;?></b></td>
    </tr>
    <tr>
    <td width="50%">Hasło do cmsa:<br /><b><?php echo $decrypted_cms_haslo;?></b></td>
    <td width="50%">Hasło do FTP:<br /><b><?php echo $decrypted_ftp_haslo;?></b></td>
    </tr>
    <tr>
    <td width="50%">Inne informacje:<br /><b><?php echo $klient['seo_inne'];?></b></td>
    </tr>
    </table><?php }
                          
    forms::close(0);

    $this -> load -> view('footer');
?>