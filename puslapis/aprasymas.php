<?php
//skelbimas.php?id=2
$connect = new PDO("mysql:host=localhost;dbname=gyvuneliu_prieglauda;charset=utf8mb4", "prieglaudos_admin", "slaptazodis2022");$query = "SELECT * FROM gyvunai,kategorijos WHERE gyvunai.kategorijos_id = kategorijos.kategorijos_id AND gyvuno_id= " . $_GET['id'] ;
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach ($result as $row) {
$skelbimas[] = $row ;
$d1 = strtotime($skelbimas[0]["amzius"]); //gimimo data
$d2 = strtotime("now"); // šiandienos data
$totalSecondsDiff = abs($d1-$d2); //skirtumas sekundėmis
$amzius = round($totalSecondsDiff/60/60/24/365,1); //skirtumas metais suapvalintas iki 1 skaičiaus po kablelio
} ?>
<!DOCTYPE html>
<html>
<head>
	
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
html {
  overflow-y: scroll;
}
.row{ margin-left: 0; margin-right: 0;}

.container{
    .row{margin-left: -15px; margin-right: -15px;}
}

body {
    font-family: 'Balsamiq Sans';
}	
	
.nav-link {

color: black !important;
}

.navbar-brand, .active {

font-weight: 700 !important;
}

.navbar-brand img {
margin-top:-16px;
}
	
.prideti {
  border: 5px solid;
  padding: 0px;
  box-shadow: 3px 5px;
 margin-right: 20px;
}	

.telefonas {
  border: 5px solid;
  padding: 10px;
  box-shadow: 3px 5px;

 width: 250px;

}	

.fb{
 white-space: nowrap;
margin-left: 0
}

.navbar-expand-md{
top:20px ; /* meniu nuleidimas nuo viršaus */
}
.stiliusf {
	font-size: 17px;
}
	</style>

</head>

<body class="d-flex flex-column min-vh-100">
		
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
<a class="nav-link prideti " href="#">+ Pridėti</a>
</li>
<li class="nav-item">
<a class="nav-link " href="./">Pradžia</a>
</li>
<li class="nav-item">
<a class="nav-link" href="./apie_mus.html">Apie mus</a>
</li>

<li class="nav-item">
<a class="nav-link" href="./globotiniai.php">Globotiniai</a>
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
	  

 <main class="container py-5" >

<a class="nav-link " href="javascript:javascript:history.go(-1)">< Atgal</a>
	<div  style ="height:50px"> </div>

   <div class="row" data-masonry="{&quot;percentPosition&quot;: true } ">
    <div class="col-sm-6 col-lg-4">
      <div class="card">
	
        <img class="bd-placeholder-img card-img-top" src="./img/skelbimu_img/<?php echo $skelbimas[0]["foto_url"]; ?>" alt="..." width="100%" >

      
      </div>
    </div> 
 <div class="col-sm-6 col-lg-3" >
 
 <h4><b>Vardas:</b>&nbsp; <span class="stiliusf"><?php echo  $skelbimas[0]["vardas"]; ?></span></h4>
     <h4><b>Kategorija:</b>&nbsp;<span class="stiliusf"><?php echo  $skelbimas[0]["kategorija"]; ?></span></h4>
     <h4><b>Amžius:</b>&nbsp;<span class="stiliusf"><?php echo  $amzius  ." metai"; ?></h4>
     <h4><b>Dokumentai:</b>&nbsp;<span class="stiliusf"><?php echo  $skelbimas[0]["dokumentacija"]; ?></span></h4>
	


 
 </div>
  <div class="col-sm-6 col-lg-4" >
     
    <h4><b>Aprašymas:</b></h4>
   <span class="stiliusf"> <?php echo  $skelbimas[0]["aprasymas"]; ?></span>

 
 </div>
</div>


</main>


<div class=""> </div>

<div class="row mt-auto">
<div class="col my-auto col-6-offset">
<nav class="navbar navbar-expand-sm navbar-light ">
  <div class="container">
   
      <ul class="navbar-nav mx-auto ">

	        <li class="nav-item">
          <a class="nav-link " href="./apie_mus.html">Apie mus</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./globotiniai.php">Globotiniai</a>
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
