<?php
function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LcwXvcUAAAAAPUVblQsMbGlSWU-2UjAV8SM4Yld',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Agregarmos una variable CaptCha
    $res = post_captcha($_POST['g-recaptcha-response']);
    // Fin Agregarmos una variable CaptCha

        if (!$res['success']) {
       
            echo "<script type=\"text/javascript\">alert('Su mensaje NO fue enviado, Por favor Complete el formulario y el Captcha'); window.location='http://bateriasparacarrobogota.com/';</script>"; 
        } else {
            
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$celular = $_POST['celular'];
$mensaje = $_POST['mensaje'];
$telefono = $_POST['telefono'];
$para  = 'bateriascar@gmail.com' . ', '; 
$titulo = 'EMAIL WEB';
$header = 'From: ' . $email;
$msjCorreo = "Nombre: $nombre\n Telefono: $telefono\n Celular: $celular\n E-Mail: $email\n Mensaje:\n $mensaje";

mail($para, $titulo, $msjCorreo, $header); 
echo "<script language='javascript'>
window.location.href = 'http://bateriasparacarrobogota.com/';
</script>";
}

        
?>
