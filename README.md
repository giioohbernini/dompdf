# Transforming HTML to PDF with PHP using [DOMPDF](https://github.com/dompdf/dompdf).


> Basic Exmple

```php
include("dompdf/dompdf_config.inc.php");

$html = "<h1>Hello World</h1>";
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'landscape');
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("name.pdf");

```

