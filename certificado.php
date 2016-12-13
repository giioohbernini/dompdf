<?php

if ($_POST['emailcertificado']) {

	include("dompdf/dompdf_config.inc.php");

	$email = $_POST['emailcertificado'];
	$host = "";
	$user = ""; // Usuário do Servidor MySQL
	$senha = ""; // Senha do Usuário MySQL
	$dbase = "";

	$conecta = mysqli_connect($host, $user, $senha, $dbase) or print (mysql_error()); 
	mysqli_select_db($conecta, $dbase) or print(mysqli_error()); 

	$sql = "SELECT * FROM gee_participantes_2016 WHERE email = '".$email."'";
	$result = mysqli_query($conecta, $sql);

	// caso encontre um email ele pega o nome e gera o PDF
	if (mysqli_num_rows($result) == 1) {
		while($row = mysqli_fetch_assoc($result)) {
	        $nome = $row['nome'];
	    }
	    
		$html = "<html lang='pt_BR'><head><title>Certificado</title><link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'><style>*{padding:0;margin:0;border:0}.certificado{width:100%;margin:0 auto}.content-certificado{text-align:center;font-family:Lato;margin:0}.content-certificado>.titles{margin:0}.content-certificado>.titles h2{font-weight:lighter;font-size:20px}.content-certificado>.nome{position:absolute;top:448px;font-size:25px;font-family:arial;width:100%;}.content-certificado>.nome p{text-align:center}@media print{.content-certificado>.titles{display:none}body{margin:0 auto}.certificado{transform: rotate(90deg);display:block;width:100%;margin:0 auto}.content-certificado>.nome{}.content-certificado{margin:0}.content-certificado>.titles{margin:0}}</style></head><body><div class='content-certificado'><div class='nome'><p>".$nome."</p></div><div class='box'><img class='certificado' src='certificado.jpg'></div></div></body></html>";

		$dompdf = new DOMPDF();
		$dompdf->set_paper('A4', 'landscape');
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream("certificado.pdf");

	} elseif (mysqli_num_rows($result) > 1) {
		echo "Multiplos emails cadastrados";
	} else {
	    echo "Usuário não tem permissão para retirar certificado";
	}

	mysqli_close($conecta);

	} else {
		echo "sem email no post";
	}
?>


