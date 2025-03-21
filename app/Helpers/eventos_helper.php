<?php
    $token = null;
    $ambiente = null;
    use App\Models\EventosModel;

    function fetch_fn($url, $postData, $bearerToken = null) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
    
        $headers = [
            'Accept: */*',
            'Content-Type: application/json',
        ];
    
        if ($bearerToken) {
            $headers[] = "Authorization: Bearer $bearerToken";
        }
    
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            throw new Exception("Error en cURL: $error_msg");
        }
    
        curl_close($ch);
    
        return json_decode($response, true);
    }

    function obtener_token() {
        global $token; // Para almacenar el token en la variable global

        $dataPost = [
            "userName" => "userApiNetCore",
            "password" => "#Th3F@llen9o0"
        ];

        try {
            $response = fetch_fn(
                "https://app-standex.com:8443/api/auth",
                $dataPost
            );

            if (isset($response['accessToken'])) {
                $token = $response['accessToken'];
                return $token;
            } else {
                throw new Exception("Token no encontrado en la respuesta.");
            }
        } catch (Exception $e) {
            echo "Error al obtener el token: " . $e->getMessage();
            return null;
        }
    }

    function eventos($descripcion = '', $fecha_inicio = '', $fecha_fin = '') {
        global $token, $ambiente;

        if (!$token) {
            $token = obtener_token();
        }

        if (!$token) {
            return ['error' => 'No se pudo obtener el token.'];
        }
    
        $postData = [
            "descripcion" => $descripcion,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "conexion" => 1
        ];

        try {
            return fetch_fn(
                'https://app-standex.com:8443/COSTOS/Evento/Eventos',
                $postData,
                $token
            );
        } catch (Exception $e) {
            return ['error' => 'Error en la solicitud: ' . $e->getMessage()];
        }
    }

    function generarClave(){
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
    }

    if (!function_exists('obtener_info_evento')) {
        function obtener_info_evento($id){
            $db = \Config\Database::connect();
            $query = $db->table('vista_eventos_registros')->where('id_evento', $id)->get()->getRow();  // Retorna la fila como objeto
            return $query;
        }
    }

    if (!function_exists('obtener_registros')) {
        function obtener_registros($id){
            $db = \Config\Database::connect();
            $query = $db->table('inputs_outputs')->where('id_evento', $id)->get()->getResult();
            return $query;
        }
    }

?>
