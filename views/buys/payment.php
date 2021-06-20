<h2>Verificá los datos</h2>

<?php var_dump($order_data) ?>


<?php

// SDK de Mercado Pago
require 'vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-2702444402666997-051715-ea23a29ddc752a0cffba000163c521cc-760795064');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

/* USUARIOS DE PRUEBA
curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token=TEST-6361856589301952-050316-6d42e27f6e4a28d152e1a7d52e5c3efa-171871686" -d "{'site_id':'MLA'}"

VENDEDOR
{"id":760795064,"nickname":"TETE629816","password":"qatest5660","site_status":"active","email":"test_user_4133713@testuser.com"}

COMPRADOR
{"id":760794447,"nickname":"TETE9021075","password":"qatest4519","site_status":"active","email":"test_user_33146707@testuser.com"}
*/

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = $order_data['product'];
$item->quantity = $order_data['amount'];
$item->unit_price = $order_data['price'];
$preference->items = array($item);
$preference->save();

$preference->back_urls = array(
    "success" => "http://tienda-musica/compras/gracias",
    "failure" => "http://tienda-musica/compras/payment",
    "pending" => "http://tienda-musica/compras/payment"
);

?>

<script
src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
data-preference-id="<?php echo $preference->id; ?>">
</script>
