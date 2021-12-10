<?php
class PushNotification{

    public function enviarNotificacion($token) {
       // var_dump( $token);
        $message=$_SESSION['message'];

        $instancia_controller= new AlertaController();
        $usToken=$instancia_controller->ObtenerUsuarioPush($token);
       foreach($usToken as $va){
        $tokens= $va->token;
        
        //echo $tokens;
        // Cargamos los datos de la notificacion en un Array
        $notification = array();
        $notification['title'] = 'Se ha detectado una incidencia';
        $notification['body'] = $message;
        
        $fields = array(
            'to' => $tokens,
            'notification' => $notification,
        );
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
                    'Authorization: key=AAAA5h5Rb58:APA91bHSAO5-I3Pxd-XdJ0pWrgJOAqO4kEZSlgrSRV9vTuWAQ4j6T-wpcUJGwNIPglTy7gt6rTP9UL_W7_S5FMC09Xf5YjNqtxwDAJgHIjzMqrBpP-k2HYxg9sq3D2sGaSTpyNCejD18',
                    'Content-Type: application/json'
                    );
                    
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));       
        
        $result = curl_exec($ch);
        if($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
    }
//
    }

}



?>