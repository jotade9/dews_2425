<?php
$forma_pago = 2;
switch ($forma_pago) {
    case 0:
        $pago = 'Contado';
        
    case 1:
        $pago = 'Transferencia bancaria';
        
    case 2:
        $pago = 'Contra reembolso';
        
    default:
        $pago = 'No definida';
}
echo $pago;
?>

