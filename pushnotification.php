<?php

    function sendMessage($data, $target) {

        $url = 'https://fcm.googleapis.com/fcm/send';

        $server_key = 'AAAATlKjMhs:APA91bEQmryF8saxFzOkWqXid7BEMMg5Pk5Uu4mxPe4xsPxrfEa5PekyIL1iibU9fuqMYWs3wcA64dPS4mHr1sWhECcRQEIb36PgJhh0tUOktO39frg9X0FPkWWsfMrhGJQJFah1Ln1E';

        $fields = array();
        $fields['data'] = $data;

        if(is_array($target)) {
            
            $fields['registration_ids'] = $target;

        }
        else {

            $fields['to'] = $target;
        }

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        if($result == FALSE) {

            die('FCM Send Error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $result;
        
    }
?>