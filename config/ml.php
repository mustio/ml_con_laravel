<?php
return [
    'api_key'       => '', // aca tiene que registrar el ID (APP_ID) que provee Mercado Libre.
    'secret_key'    => '', // aca tiene que registrar la secret key que provee el registro de Mercado Libre.
    /**
     * Acá es donde donde va a redireccionar una vez logueado el usuario con su cuenta de mercado libre:
     * Si es a nivel local puede poner cualquier ruta registrada en su sistema Laravel
     * Si es a nivel produccion es importante poner la ruta absoluta de donde va a redireccionar y (importantisimo!) tiene que ser HTTPS.
     */
    'redirect'      => '/home' 
];
