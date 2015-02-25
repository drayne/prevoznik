<?php 


include_once("include/check_login_status.php");
include_once("include/include_eos.php");
//moraju 2 upita jer se desio problem, ne prikaze dovoljno jedne vrste
$ruta_ponuda_id=$ruta_ponuda_od=$ruta_ponuda_do=$ruta_ponuda_kilometraza=$ruta_ponuda_trajanje=$ruta_ponuda_cijena=$ruta_ponuda_broj_mjesta=$ruta_ponuda_slobodna_mjesta=$ruta_ponuda_vrijeme=array();
$ime_prezime_ponuda=$slika_profila_ponuda=$korisnik_ponuda=$ruta_ponuda_tip=$ruta_ponuda_vrijeme_objave=array();
	$sql = "SELECT * FROM ruta WHERE tip='1' order by id desc";
	$user_query = mysqli_query($db_conx, $sql);
	while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) 
	{
		array_push($ruta_ponuda_id, $row['id']);
		
		
		array_push($ruta_ponuda_od, preg_replace_moj(prije_zareza($row['od'])	,	'slova_razmak'));
		array_push($ruta_ponuda_do, preg_replace_moj(prije_zareza($row['do'])	,	'slova_razmak'));
		
		
		$datum=date('d.m.Y H:i', strtotime($row['krece']));
		array_push($ruta_ponuda_vrijeme, $datum);
		array_push($ruta_ponuda_kilometraza, $row['kilometraza']);
		array_push($ruta_ponuda_trajanje, $row['trajanje']);
		array_push($ruta_ponuda_cijena, $row['cijena']);
		array_push($ruta_ponuda_broj_mjesta, $row['broj_mjesta']);
		array_push($ruta_ponuda_slobodna_mjesta, $row['slobodna_mjesta']);
		array_push($ruta_ponuda_tip, $row['tip']);
		
		
		
		$timeAgoObject = new convertToAgo;
		$convertedTime = ($timeAgoObject -> convert_datetime($row['vrijeme_objave'])); // Convert Date Time
		$profil_last_login = ($timeAgoObject -> makeAgo($convertedTime));
		array_push($ruta_ponuda_vrijeme_objave, $profil_last_login);
		
		$user=$row['kreirao'];
		array_push($korisnik_ponuda, $user);
		$i_p= vrati_naziv_profila($row['kreirao']);
		array_push($ime_prezime_ponuda, $i_p);
		$s=vrati_sliku_profila($user);
		array_push($slika_profila_ponuda, $s);
		
		if (count($ruta_ponuda_id) <10) { $broj_ponuda= count($ruta_ponuda_id); }
	}


//POTRAZNJA
$ruta_potraznja_id=$ruta_potraznja_od=$ruta_potraznja_do=$ruta_potraznja_kilometraza=$ruta_potraznja_trajanje=$ruta_potraznja_cijena=$ruta_potraznja_broj_mjesta=$ruta_potraznja_slobodna_mjesta=$ruta_potraznja_vrijeme=array();
$ime_prezime_potraznja=$slika_profila_potraznja=$korisnik_potraznja=$ruta_potraznja_tip=$ruta_potraznja_vrijeme_objave=array();
	$sql = "SELECT * FROM ruta WHERE tip='2' order by id desc";
	$user_query = mysqli_query($db_conx, $sql);
	while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) 
	{
		array_push($ruta_potraznja_id, $row['id']);
		array_push($ruta_potraznja_od, preg_replace_moj(prije_zareza($row['od'])	,	'slova_razmak'));
		array_push($ruta_potraznja_do, preg_replace_moj(prije_zareza($row['do'])	,	'slova_razmak'));
		$datum=date('d.m.Y H:i', strtotime($row['krece']));
		array_push($ruta_potraznja_vrijeme, $datum);
		array_push($ruta_potraznja_kilometraza, $row['kilometraza']);
		array_push($ruta_potraznja_trajanje, $row['trajanje']);
		array_push($ruta_potraznja_cijena, $row['cijena']);
		array_push($ruta_potraznja_broj_mjesta, $row['broj_mjesta']);
		array_push($ruta_potraznja_slobodna_mjesta, $row['slobodna_mjesta']);
		array_push($ruta_potraznja_tip, $row['tip']);
		
		
		
		$timeAgoObject = new convertToAgo;
		$convertedTime = ($timeAgoObject -> convert_datetime($row['vrijeme_objave'])); // Convert Date Time
		$profil_last_login = ($timeAgoObject -> makeAgo($convertedTime));
		array_push($ruta_potraznja_vrijeme_objave, $profil_last_login);
		
		$user=$row['kreirao'];
		array_push($korisnik_potraznja, $user);
		$i_p= vrati_naziv_profila($row['kreirao']);
		array_push($ime_prezime_potraznja, $i_p);
		$s=vrati_sliku_profila($user);
		array_push($slika_profila_potraznja, $s);
		
		$broj_potraznji=10;
		if (count($ruta_potraznja_id) <10) { $broj_potraznji= count($ruta_potraznja_id); }
	}



//TABELA OGLASA
$tabela_ruta_id=$tabela_ruta_tip=$tabela_ruta_od=$tabela_ruta_do=$tabela_ruta_krece=$tabela_ruta_broj_mjesta=$tabela_ruta_slobodna_mjesta=$tabela_ruta_cijena=$tabela_ruta_kreirao=$tabela_slika_profila=$tabela_ruta_vozilo_ikonica=array();
	$sql = "SELECT ruta.*, vozilo.vrsta FROM ruta LEFT JOIN vozilo ON vozilo.id=ruta.id_vozila WHERE ruta.krece>now() order by id desc LIMIT 8";
	$user_query = mysqli_query($db_conx, $sql);
	while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) 
	{
		
		array_push($tabela_ruta_kreirao, $row['kreirao']);
		array_push($tabela_ruta_id, $row['id']);
		array_push($tabela_ruta_tip, $row['tip']);
		array_push($tabela_ruta_od, preg_replace_moj(prije_zareza($row['od'])	,	'slova_razmak'));
		array_push($tabela_ruta_do, preg_replace_moj(prije_zareza($row['do'])	,	'slova_razmak'));		
		array_push($tabela_ruta_krece, $row['krece']);
		array_push($tabela_ruta_broj_mjesta, $row['broj_mjesta']);
		array_push($tabela_ruta_slobodna_mjesta, $row['slobodna_mjesta']);
		array_push($tabela_ruta_cijena, $row['cijena']);
		$s=vrati_sliku_profila($row['kreirao']);
		array_push($tabela_slika_profila, $s);
		
		if ($row['tip']=='2') { $vozilo_ikonica='img/trazi_t.png'; }
		else if ($row['vrsta'] == 'kamion') { $vozilo_ikonica='img/kamion_t.png'; }
		else if ($row['vrsta'] == 'kombi') { $vozilo_ikonica='img/kombi_t.png'; }
		else if ($row['vrsta'] == 'automobil') { $vozilo_ikonica='img/auto_t.png'; }
		else { $vozilo_ikonica='img/auto_t.png'; }
		array_push($tabela_ruta_vozilo_ikonica, $vozilo_ikonica);
		
	} 
$tabela_broj_ruta=count($tabela_ruta_id);




require_once("view/v_index.php"); 
?>
 

