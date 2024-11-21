<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once($ROOT . "util/fpdf/fpdf.php");
include_once($ROOT . 'util/vendor/autoload.php');

// Función para generar el PDF
function generarPDFCompra($idCompra, $compraEstadoTipo, $objCompraItem) {
    global $URLIMAGEN; 

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Detalles de la Compra', 0, 1, 'C');
    $pdf->Ln(10);

    // Detalles de la compra
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'ID Compra: ' . $idCompra);
    $pdf->Ln(10);
    $pdf->Cell(40, 10, 'Estado de Compra: ' . $compraEstadoTipo->getCetDescripcion());
    $pdf->Ln(10);

    $arrayCompraItem = $objCompraItem->buscar(["idcompra" => $idCompra]);
    $totalCompra = 0;

    foreach ($arrayCompraItem as $compraItem) {
        $producto = $compraItem->getObjProducto();
        $nombreImagen = $producto->getUrlImagen();
        $rutaCompleta = $URLIMAGEN . $nombreImagen;

        if (@getimagesize($rutaCompleta)) {
            $pdf->Image($rutaCompleta, $pdf->GetX(), $pdf->GetY(), 30, 30);
            $pdf->Ln(35);
        } else {
            $pdf->Cell(60, 10, 'Sin Imagen', 1);
            $pdf->Ln(10);
        }

        $pdf->Cell(40, 10, 'Producto: ' . $producto->getProNombre());
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Cantidad: ' . $compraItem->getCiCantidad());
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Precio Unitario: $' . $producto->getProPrecio());
        $pdf->Ln(10);

        $subtotal = $compraItem->getCiCantidad() * $producto->getProPrecio();
        $totalCompra += $subtotal;

        $pdf->Cell(40, 10, 'Subtotal: $' . number_format($subtotal, 2));
        $pdf->Ln(10);
    }

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Ln(10);
    $pdf->Cell(40, 10, 'Total de la Compra: $' . number_format($totalCompra, 2));

    return $pdf->Output('S');
}


// Función para enviar el correo con el PDF adjunto
function enviarCorreoConPDF($emailDestinatario, $idCompra, $compraEstadoTipo, $objCompraItem) {
    $exito = false;
    try {
        // Generar el PDF
        $pdfContent = generarPDFCompra($idCompra, $compraEstadoTipo, $objCompraItem);

        // Configurar PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nicoantinao1998@gmail.com';  
        $mail->Password = 'myca nkfc mgnm fcka';        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Configurar destinatarios
        $mail->setFrom('nicoantinao1998@gmail.com', 'Deposito');
        $mail->addAddress($emailDestinatario);

        // Configurar contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Detalles de la Compra';
        $mail->Body    = 'Adjuntamos el PDF con los detalles de tu compra.';
        $mail->AltBody = 'Adjuntamos los detalles de tu compra en formato PDF.';

        // Adjuntar el PDF generado
        $mail->addStringAttachment($pdfContent, 'detalles_compra.pdf');

        // Enviar el correo
        $mail->send();
        $exito = true; // Éxito
    } catch (Exception $e) {
        $exito = false; // Falla
    }
    return $exito;
}
?>
