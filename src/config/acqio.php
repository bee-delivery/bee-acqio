<?php

return [

    /*
    |-------------------------------------------------------------
    | BASE URL
    |-------------------------------------------------------------
    | URL base, a partir da qual será montada a URL da requisição. 
    | Podendo ser os endpoints de homologação ou produção.
    */
    'base_url' => env('ACQIO_BASE_URL'),
    'base_url_auth' =>  env('ACQIO_BASE_URL_AUTH'),
    'base_url_tokenize' =>  env('ACQIO_BASE_URL_TOKENIZE'),

    /*
    |-------------------------------------------------------------
    | Authentication
    |-------------------------------------------------------------
    | Variáveis utilizadas para geração do token de acesso.
    */

    'client_id' => env('ACQIO_CLIENT_ID'),
    'client_secret' => env('ACQIO_CLIENT_SECRET'),
    'client_grant_type' => env('ACQIO_GRANT_TYPE'),
];
