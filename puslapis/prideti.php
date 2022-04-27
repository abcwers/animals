<?php
//prideti.php
include 'db.php';
//require 'db.php';

$connect = getDBConnection();
$query = "SELECT * FROM kategorijos";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	  ?>

<?php

// ---------------------------------------------------------------------------------
// define variables and set to empty values
$KlaidosPranesimas = "";
$dokumentaiErrArrow = $kategorijaErrArrow = "";
$vardasErrBorder = $kategorijaErrBorder = $amziusErrBorder = $dokumentaiErrBorder = $fileToUploadErrBorder = "";

$vardas = $kategorija = $amzius = $dokumentai = $fileToUpload= $aprasymas = "";
$patikrinimas = 0;




if ($_SERVER["REQUEST_METHOD"] == "POST") {

$aprasymas = test_input($_POST["aprasymas"]);

  if (empty($_POST["vardas"])) {
    $KlaidosPranesimas = "Neteisingai suvesti duomenys. Prašome įvesti visus * pažymėtus laukelius.";
	$vardasErrBorder = 'class="errorBorder"';
	$patikrinimas = 1;
  } else {
    $vardas = test_input($_POST["vardas"]);
  }
  
  if (empty($_POST["kategorija"])) {
    $KlaidosPranesimas = "Neteisingai suvesti duomenys. Prašome įvesti visus * pažymėtus laukelius.";
	$kategorijaErrBorder  = 'class="errorBorder"';
	$kategorijaErrArrow = 'ErrDropList';
	$patikrinimas = 1;
  } else {
    $kategorija = test_input($_POST["kategorija"]);
  }
    
  if (empty($_POST["amzius"])) {
    $KlaidosPranesimas = "Neteisingai suvesti duomenys. Prašome įvesti visus * pažymėtus laukelius.";
	$amziusErrBorder  = 'class="errorBorder"';
	$patikrinimas = 1;
  } else {
    $amzius = test_input($_POST["amzius"]);
  }

  if (empty($_POST["dokumentai"])) {
    $KlaidosPranesimas = "Neteisingai suvesti duomenys. Prašome įvesti visus * pažymėtus laukelius.";
	$dokumentaiErrBorder  = 'class="errorBorder"';
	$dokumentaiErrArrow = 'ErrDropList';
	$patikrinimas = 1;
  } else {
    $dokumentai = test_input($_POST["dokumentai"]);
  }

  if (empty($_FILES["fileToUpload"]["name"])) {
    $KlaidosPranesimas = "Neteisingai suvesti duomenys. Prašome įvesti visus * pažymėtus laukelius.";
	$fileToUploadErrBorder  = 'class="errorBorder"';
	$patikrinimas = 1;
  } else {
    $fileToUpload = test_input(basename($_FILES["fileToUpload"]["name"]));
  }
  
    if ($patikrinimas == 0) {
    $KlaidosPranesimas = "klaidos nėra , pasiruošęs įrašo sukūrimui į DB ir failo įkėlimui";

$query2 = "SELECT * FROM gyvunai ORDER BY gyvuno_id DESC";
	
	
$connect = getDBConnection();
$statement = $connect->prepare($query2);
$statement->execute();
$result2 = $statement->fetchAll();
foreach ($result2 as $row) {
	$skelbimas[] = $row ;
	 }

//būsimas ID naujam įrašui SQL, ir dalis būsimo failo vardo
$ID = $skelbimas[0][0]+1;
	
$target_dir = "./img/skelbimu_img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$NaujasVardas = $target_dir ."ID-". $ID .".". $imageFileType;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $KlaidosPranesimas =  "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $KlaidosPranesimas =  "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
//if (file_exists($NaujasVardas)) {
//  echo "Sorry, file already exists.";
//  $uploadOk = 0;
//}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 10485760) {
  $KlaidosPranesimas =  "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "webp") {
  $KlaidosPranesimas =  "Sorry, only JPG, JPEG, PNG, WEBP & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $KlaidosPranesimas =  "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $NaujasVardas)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
  $KlaidosPranesimas =  "Sorry, there was an error uploading your file.";
  }
}
// duomenų bazės įrašas su nauju failo pavadinimu
$query3 = sprintf("INSERT INTO `gyvunai` (`gyvuno_id`, `vartotojo_id`, `kategorijos_id`, `vardas`, `amzius`, `dokumentacija`, `aprasymas`, `foto_url`) VALUES (%s,13, %s, '%s', date '%s', '%s', '%s', '%s')",
	($ID),
	($_POST["kategorija"]),
	($_POST["vardas"]),
	($_POST["amzius"]),
	($_POST["dokumentai"]),
	($_POST["aprasymas"]),
	("ID-". $ID .".". $imageFileType)
	);	
	
$connect = getDBConnection();
$statement = $connect->prepare($query3);
$statement->execute();
$result3 = $statement->fetchAll();

header("Location: ./prideti_pavyko.php?id=". $ID);
exit();
	
  } else {
 //  $KlaidosPranesimas = $patikrinimas;
  
   
   
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// ---------------------------------------------------------------------------------
?>



<!DOCTYPE html>
<html lang="lt">
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

html {
  overflow-y: scroll;
}

.row{ margin-left: 0; margin-right: 0;}

.row-fix{   display: -webkit-box;
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;}


body {
    font-family: 'Balsamiq Sans';
	min-height:100vh;
	

}

.nav-link {

color: black !important;
}

.nav-link:hover {

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
 /* box-shadow: 3px 5px; */
 margin-right: 20px;
 background: #2b78e4;
 /* background:#4275b9 ; */
 color: white !important;
}



.fb{
 white-space: nowrap;
margin-left: 0
}

.navbar-expand-md{
margin-top:20px ; /* meniu nuleidimas nuo viršaus */
}

	</style>
	
	<style>

.error {color: #cf292a;}
.errorBorder {border: 4px solid #cf292a !important;}


.btn_issaugoti {
  border: 5px solid black;
  padding: 10px;
 /* box-shadow: 3px 5px; */
 background: #2b78e4;
 /* background:#4275b9 ; */
 color: white !important;
 width: 250px;

}

.btn_issaugoti:hover {
opacity:0.8;
}


input,select{
	  border: 4px solid;
	background: white;
	text-color:black;
	width: 150px;
}


::-webkit-input-placeholder {
       color: orange;
    }
    :-moz-placeholder { /* Upto Firefox 18, Deprecated in Firefox 19  */
       color: orange;  
    }
    ::-moz-placeholder {  /* Firefox 19+ */
       color: orange;  
    }
    :-ms-input-placeholder {  
       color: orange;  
    }


select {
	//-webkit-appearance: none;
  //-moz-appearance: none;
  background: transparent;
  width: 150px;

  border: 0px solid #CCC;
  height: 34px;
  border: 4px solid;
  opacity: 1;
}


option{background: white;
border: 4px solid;
}


textarea::-webkit-input-placeholder {
  color: black;
}

textarea:-moz-placeholder { /* Firefox 18- */
  color: black;  
}

textarea::-moz-placeholder {  /* Firefox 19+ */
  color: black;  
}

textarea:-ms-input-placeholder {
  color: black;  
}

::placeholder {
  color: #000000;  
  opacity: 1;
}

textarea{
border: 4px solid black;
box-sizing: border-box;
padding: 5px 10px;
max-width: 100%;
}

input:focus { 
        outline: none !important;
        border-color: #black;
      /*  box-shadow: 0 0 10px #719ECE; */
    }
	
textarea:focus { 
        outline: none !important;
        border-color: #black;
    /*    box-shadow: 0 0 10px #719ECE; */
    }


.select_box{
  width: 150px;
  overflow: hidden;
  border: 0px solid #000;
  position: relative;
 
}
 
 .select_box:after{
  width: 0; 
  height: 0; 
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-top: 6px solid black ;
  position: absolute;
  top: 43%;
  right: 7px;
  content: "";
  z-index: 98;
 }

.ErrDropList{
  width: 150px;
  overflow: hidden;
  border: 0px solid #000;
  position: relative; 
 }

.ErrDropList:after{
  width: 0; 
  height: 0; 
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-top: 6px solid #cf292a ;
  position: absolute;
  top: 43%;
  right: 7px;
  content: "";
  z-index: 98;
 }

}

</style>

<script>
    function fileValidation() {
        var fileInput = 
            document.getElementById('fileToUpload');
          
        var filePath = fileInput.value;
      
        // Allowing file type
        var allowedExtensions = 
                /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
          
        if (!allowedExtensions.exec(filePath)) {
            alert('Netinkamas failo formatas! Pasirinkite jpg, jpeg, webp, gif ar png tipo failą.');
            fileInput.value = '';
            return false;
        } 
        else 
        {
          
            // Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(
                        'imagePreview').innerHTML = 
                        '<img  class="col-6" src="' + e.target.result
                        + '"/>';
                };
                  
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
</script>

<script>
  function validateDate() {
      var userdate = new Date(document.getElementById("mydate").value).toJSON().slice(0,10);
      var today = new Date().toJSON().slice(0,10);
      if(userdate > today){
        alert('Gimimo diena negali būti vėlesnė nei šiandiena!');
      }
  }
  </script>

</head>
<body class="d-flex flex-column min-vh-100 overflow-auto">

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

		<div  style ="height:50px">
	</div>

<header class="container">
   <div class="row row-fix">
		<div class="col-7 float-right">

<H1>Pridėti globotinį</H1>

		<div>
		</div>
  </div>
</header>


    <p>

	
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"> 
  <main class="container py-2">
  
    <p class="my-2">
  
    <div class="row row-fix" data-masonry="{&quot;percentPosition&quot;: true }" style="position: relative; height: 690px;">
      <div class="col-sm-6 col-lg-4 mb-4" style="position: absolute; left: 0%; top: 0px;">
        
          
            <div><input type="text" name="vardas" placeholder="Vardas*" value="<?php echo $vardas;?>" <?php echo $vardasErrBorder;?>></div>
            <br>
            <div class="<?php echo $kategorijaErrArrow;?> select_box "><select name="kategorija" oninvalid="this.setCustomValidity('Pamiršote pasirinkti kategoriją!')" <?php echo $kategorijaErrBorder;?>>
			
			<option value="">Kategorija*</option>
			
            <?php foreach($result as $id => $option) { ?>
                        <option  value="<?php echo $option["kategorijos_id"] ?>"><?php echo $option["kategorija"] ?></option>
          <?php } ?>
              </select><span class="error"> </div>
              <br>
                  <label for="amzius">Gyvūno amžius *:</label>
              <br>
                  <input <?php echo $amziusErrBorder;?> id="mydate" type="date" name="amzius" value="<?php echo $amzius;?>" min="2000-01-01" max="<?= date('Y-m-d'); ?>" >
				  </br>
              <br><div class="<?php echo $dokumentaiErrArrow;?> select_box "> <select name="dokumentai" <?php echo $dokumentaiErrBorder;?> >
                  <option value="">Dokumentai*</option>
                      <option value="yra">yra</option>
              <option value="nėra">nėra</option></select></div></br>
			  
              <label for="fileToUpload">Pasirinkite foto *:</label>
              <br>
                  <input id="fileToUpload" <?php echo $fileToUploadErrBorder;?> type="file" name="fileToUpload" accept="image/jpg,image/jpeg,image/png,image/webp,image/gif" onchange="return fileValidation()">
								  
                  <br>
				  <p>
           <div  id="imagePreview"></div>
          
       
      </div>
      <div class="col-auto col-lg-8 mb-4" style="position: absolute; right: 33.3333%; top: 0px;">
        
  
  
         
            <div><textarea name="aprasymas" rows="14" cols="70" placeholder="Aprašymas" value=""><?php echo $aprasymas; ?></textarea></div></body>
            <h5 class="card-title text-center"></h5>
          
        </div>
      </div>

  </div>
  </main> 
            <div style="text-align:center"><input class="btn_issaugoti" type="submit" name="submit" value="Išsaugoti">
			<br>
			<br>
			<span class="error"> <?php echo $KlaidosPranesimas;?></span>	
			</div><br> 

  </form>   
        


<div class="row mt-auto">
<div class="col my-auto col-6-offset">
<nav class="navbar navbar-expand-sm navbar-light ">
  <div class="container">
   
      <ul class="navbar-nav mx-auto ">

	        <li class="nav-item">
          <a class="nav-link" href="./apie_mus.html">Apie mus</a>
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