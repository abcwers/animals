<?php

include 'db.php';

$connect = getDBConnection();

$query = "
	SELECT vardas, amzius, dokumentacija, aprasymas, foto_url 
	FROM gyvunai 
	ORDER BY gyvuno_id asc
";

$statement = $connect->prepare($query);
$statement->execute();


$result = $statement->fetchAll(PDO::FETCH_ASSOC);


// These headers will force download on browser,
// and set the custom file name for the download, respectively.
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="animals-list.csv"');

$fh = @fopen('php://output', 'w' );

fputs($fh, "\xEF\xBB\xBF"); // UTF-8 BOM
fputcsv($fh, array("Vardas", "Gimimo data", "Turi dokumentus", "Aprašymas", "Foto"));

// visas is DB istrauktas eilutes siuncima i narsykle kaip failo turini 

foreach ($result as $row) {
	//echo $row['vardas'] . "\n";
	
	fputcsv($fh, $row);
}

ob_flush();

?>