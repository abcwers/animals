<?php
//globotiniai.php
include 'db.php';

$connect = getDBConnection();

//if (!empty($_GET)) {echo $_GET['vardas'];}

$vardas = $kategorija = $amzius = "";


//jei $_GET['amzius'] daugiau už 0 ir nėra tuščias
if (!empty($_GET["amzius"])) {
$time = strtotime("-" . $_GET['amzius'] . " year", time()); //
$date = date("Y-m-d", $time);
$amzius = " AND  amzius BETWEEN DATE_SUB(date '" . $date . "', INTERVAL 1 YEAR) AND date '" . $date ."'";
;} 
//jei $_GET['amzius'] == 0
 if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 0) {
 
$amzius = " AND  amzius BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE()";
	 
 }

if (!empty($_GET["vardas"])) {$vardas = "AND vardas LIKE '%" . $_GET['vardas']."%'";}
if (!empty($_GET["kategorija"])) {$kategorija = "AND kategorijos_id = " . $_GET['kategorija'];}


//paieškos SQL užklausa
$query = "SELECT * FROM gyvunai  WHERE 1 " . $vardas ." ". $kategorija ." ".  $amzius . " ORDER BY gyvuno_id DESC" ; 
//echo "<br>";
//echo $query;

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach ($result as $row) {
	$skelbimas[] = $row ;
	 }
    ?>
	
	<?php

$query2 = "SELECT * FROM kategorijos";
$statement = $connect->prepare($query2);
$statement->execute();
$kategorijosList = $statement->fetchAll(PDO::FETCH_ASSOC);
	  ?>

	

	

	<?php
//SELECT amzius FROM gyvunai WHERE DATE_SUB(CURDATE(),INTERVAL 1 YEAR) <= amzius; 
//SELECT amzius(DATEDIFF(DAY, amzius, @TargetDate) / 365.25) FROM gyvunai ORDER BY `gyvunai`.`amzius` DESC

$query3 = "SELECT DISTINCT amzius FROM gyvunai ORDER BY `gyvunai`.`amzius` DESC";
$statement = $connect->prepare($query3);
$statement->execute();
$result3 = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 0;
foreach ($result3 as $row) {
$skelbimas1[] = $row ;
$d1 = strtotime($skelbimas1[$i]["amzius"]); //gimimo data
$d2 = strtotime("now"); // šiandienos data
$totalSecondsDiff = abs($d1-$d2); //skirtumas sekundėmis
$amzius = round($totalSecondsDiff/60/60/24/365,1); //skirtumas metais suapvalintas iki 1 skaičiaus po kablelio
//echo  $amzius  ." metai"; 
$i++;
} ?>  



<!DOCTYPE html>
<html>
<head>
<!-- skirtuko pavadinimas -->
<title>BestAnimals.lt</title>

<!-- skirtuko ikona SVG koduotas kodas-->

<link rel="icon" href="data:image/svg+xml,
%3Csvg version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 48.839 48.839' style='enable-background:new 0 0 48.839 48.839;' xml:space='preserve'%3E%3Cg%3E%3Cpath style='fill:%23030104;' d='M39.041,36.843c2.054,3.234,3.022,4.951,3.022,6.742c0,3.537-2.627,5.252-6.166,5.252 c-1.56,0-2.567-0.002-5.112-1.326c0,0-1.649-1.509-5.508-1.354c-3.895-0.154-5.545,1.373-5.545,1.373 c-2.545,1.323-3.516,1.309-5.074,1.309c-3.539,0-6.168-1.713-6.168-5.252c0-1.791,0.971-3.506,3.024-6.742 c0,0,3.881-6.445,7.244-9.477c2.43-2.188,5.973-2.18,5.973-2.18h1.093v-0.001c0,0,3.698-0.009,5.976,2.181 C35.059,30.51,39.041,36.844,39.041,36.843z M16.631,20.878c3.7,0,6.699-4.674,6.699-10.439S20.331,0,16.631,0 S9.932,4.674,9.932,10.439S12.931,20.878,16.631,20.878z M10.211,30.988c2.727-1.259,3.349-5.723,1.388-9.971 s-5.761-6.672-8.488-5.414s-3.348,5.723-1.388,9.971C3.684,29.822,7.484,32.245,10.211,30.988z M32.206,20.878 c3.7,0,6.7-4.674,6.7-10.439S35.906,0,32.206,0s-6.699,4.674-6.699,10.439C25.507,16.204,28.506,20.878,32.206,20.878z M45.727,15.602c-2.728-1.259-6.527,1.165-8.488,5.414s-1.339,8.713,1.389,9.972c2.728,1.258,6.527-1.166,8.488-5.414 S48.455,16.861,45.727,15.602z'/%3E%3C/g%3E%3C/svg%3E
">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

<link href='https://fonts.googleapis.com/css?family=Balsamiq Sans' rel='stylesheet'>

	
<style>

.CSV_mygtukas {
  border: 4px solid black !important;
  padding: 6px;
 color:black;
font-size: 19px;
 min-width: 250px;
  background: #cccccc;
  
}

select {

  background: transparent;
  width: min-200px;


color: #bbb;
  border: 4px black solid;
  opacity: 1;
  
    
  display: flex;

 padding: 7px 8px;
  
}

input::placeholder {
  color: #bbb;
}

option{background: white;
border: 4px solid;

}

html {
  overflow-y: scroll;
}

.search-bar {
  color: #555;
  display: flex;
  padding: 2px;
  border: 4px solid black;
 /* border-radius: 5px; */

  min-width: 257px;
}

input[type=search] {
  border: none;
  background: transparent;
  


  color: inherit;
  border: 1px solid transparent;
  border-radius: inherit;
}

input[type=search]::placeholder {
  
}

button[type=submit] {
  text-indent: -999px;
  overflow: hidden;
  width: 40px;
  padding: 0;
  
  border: 1px solid transparent;
  border-radius: inherit;
  background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat center;
  cursor: pointer;
  opacity: 0.7;
}

button[type=submit]:hover {
  opacity: 1;
}

button[type=submit]:focus,
input[type=search]:focus {
  box-shadow: 0 0 3px 0 #1183d6;
  border-color: #1183d6;
  outline: none;
}





.row{ margin-left: 0; margin-right: 0;}

.row-fix{   display: -webkit-box;
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;}

body {
    font-family: 'Balsamiq Sans';
}	
	
.nav-link {

color: black !important;
}

.nav-link:hover {

opacity:0.8;
}

.galerija-link {

color: black !important;
}

.galerija-link:hover {

opacity:0.8;
}

.navbar-brand, .active {

font-weight: 700 !important;
}

.navbar-brand img {
margin-top:-16px;
}
	
.prideti {
  border: 5px solid black;
  padding: 0px;
 margin-right: 20px;
 background: #2b78e4;
 color: white !important;
}

.telefonas {
  border: 5px solid;
  padding: 10px;
  
 background: #cccccc;
 width: 260px;

}	

.fb{
 white-space: nowrap;
margin-left: 0
}

.navbar-expand-md{
top:20px ; /* meniu nuleidimas nuo viršaus */
}

	</style>

</head>

<body class="d-flex flex-column min-vh-100 overflow-auto"  >
		
<nav class="navbar navbar-expand-md navbar-light">
<div class="container position-static">
<a class="navbar-brand " href="./">
<img src="./img/peda.svg" alt="..." height="30"> Best Animals
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav ms-auto ">
<li class="nav-item">
<a class="nav-link prideti " href="./prideti.php">+ Pridėti</a>
</li>
<li class="nav-item">
<a class="nav-link " href="./">Pradžia</a>
</li>
<li class="nav-item">
<a class="nav-link" href="./apie_mus.html">Apie mus</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="./globotiniai.php">Globotiniai</a>
</li>

<li class="nav-item">
<a class="nav-link" href="./kontaktai.html">Kontaktai</a>
</li>

<!-- gali prireikti, jei kursime su vartotojais
<li class="nav-item">
<a class="nav-link" href="#">Prisijungti</a>
</li>
-->
</ul>
</div>
</div>
</nav>
	  
	  
		<div  style ="height:50px"> </div>

      

	
 <main class="container py-5">
 
 <div class="container">
  <form  >
  <div class="container">
  <div class="row-fix row d-flex justify-content-start ">
  <div class="search-bar col-auto">
  <input name="vardas" type="search" placeholder="Paieška pagal vardą" value="<?php if (!empty($_GET)) {echo $_GET['vardas'];}?>">
  <button type="submit" >Ieškoti</button>
  </div>
              <div class=" col-auto row-fix"><select name="kategorija" onchange="this.form.submit()" >
		
			<option value="">Kategorija</option>
			
            <?php foreach($kategorijosList as $id => $option) { ?>
                        <option  value="<?php echo $option["kategorijos_id"] ?>" <?php if (!empty($_GET) && $_GET['kategorija'] == $option["kategorijos_id"]) {echo " selected";} ?>><?php echo $option["kategorija"] ?></option>
          <?php } ?>
              </select> </div>
			  
			                <div class=" col-auto row-fix"><select name="amzius" onchange="this.form.submit()">
		
			<option value="">Amžius</option>
			
            
<option  value="0" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 0) {echo "selected";}?>>nuo 0 iki 1 metų</option>
<option  value="1" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 1) {echo "selected";}?>>nuo 1 iki 2 metų</option>
<option  value="2" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 2) {echo "selected";}?>>nuo 2 iki 3 metų</option>
<option  value="3" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 3) {echo "selected";}?>>nuo 3 iki 4 metų</option>
<option  value="4" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 4) {echo "selected";}?>>nuo 4 iki 5 metų</option>
<option  value="5" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 5) {echo "selected";}?>>nuo 5 iki 6 metų</option>
<option  value="6" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 6) {echo "selected";}?>>nuo 6 iki 7 metų</option>
<option  value="7" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 7) {echo "selected";}?>>nuo 7 iki 8 metų</option>
<option  value="8" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 8) {echo "selected";}?>>nuo 8 iki 9 metų</option>
<option  value="9" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 9) {echo "selected";}?>>nuo 9 iki 10 metų</option>
<option  value="10" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 10) {echo "selected";}?>>nuo 10 iki 11 metų</option>
<option  value="11" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 11) {echo "selected";}?>>nuo 11 iki 12 metų</option>
<option  value="12" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 12) {echo "selected";}?>>nuo 12 iki 13 metų</option>
<option  value="13" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 13) {echo "selected";}?>>nuo 13 iki 14 metų</option>
<option  value="14" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 14) {echo "selected";}?>>nuo 14 iki 15 metų</option>
<option  value="15" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 15) {echo "selected";}?>>nuo 15 iki 16 metų</option>
<option  value="16" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 16) {echo "selected";}?>>nuo 16 iki 17 metų</option>
<option  value="17" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 17) {echo "selected";}?>>nuo 17 iki 18 metų</option>
<option  value="18" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 18) {echo "selected";}?>>nuo 18 iki 19 metų</option>
<option  value="19" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 19) {echo "selected";}?>>nuo 19 iki 20 metų</option>
<option  value="20" <?php if (!empty($_GET) && is_numeric($_GET['amzius']) && $_GET['amzius'] == 20) {echo "selected";}?>>nuo 20 iki 21 metų</option>
						
						
         
              </select> </div>  <a class="CSV_mygtukas text-center col-auto nav-link"  href="./download-animals-csv.php">Atsiųsti gyvūnėlių duomenis (CSV)</a> 
</div></div></form>



 

  <p class="my-5">

  <div class="row row-fix" data-masonry="{&quot;percentPosition&quot;: true }">
  
  
   <?php foreach($result as $row => $option) { ?>
      <div class="col-sm-6 col-lg-4 mb-4" >
	<a class="galerija-link"  href="./aprasymas.php?id=<?php echo $option["gyvuno_id"]; ?>">
      <div class="card">
	
	<img class="bd-placeholder-img card-img-top" src="./img/skelbimu_img/<?php echo $option["foto_url"]; ?>" alt="..." width="100%" >

        <div class="card-body">
          <h5 class="card-title text-center"><?php echo $option["vardas"]; ?></h5>
        </div>
      </div></a>
    </div>
  <?php } ?>
  
  
  




  </div>
 </div>
</main>


 
<div class="row mt-auto">
<div class="col my-auto col-6-offset">
<nav class="navbar navbar-expand-sm navbar-light ">
  <div class="container">

      <ul class="navbar-nav mx-auto ">

	        <li class="nav-item">
          <a class="nav-link " href="./apie_mus.html">Apie mus</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="./globotiniai.php">Globotiniai</a>
        </li>

		<li class="nav-item">
          <a class="nav-link" href="./kontaktai.html">Kontaktai</a>
        </li>

      </ul>
   </div>
 </nav>
  </div>
  <div class="col-4 col-sm-2 my-auto col-12-offset">
<img src="./img/facebook.svg" alt="..." height="25"> &nbsp;<img src="./img/instagram.svg" alt="..." height="25">
  </div>

   </div>

   

	
           
    </body>
</html>

