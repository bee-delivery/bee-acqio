<?php

namespace BeeDelivery\Acqio\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Connection
{
    protected $accessToken;
    protected $baseUrl;
    protected $baseUrlAuth;
    protected $baseUrlTokenize;
    protected $client_id;
    protected $client_secret;

    /*
     * Pega valores no arquivo de configuração do pacote e atribui às variáveis
     * para utilização na classe.
     *
     * @return void
     */
  
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        
        $this->baseUrl = config('acqio.base_url');
        $this->baseUrlAuth =config('acqio.base_url_auth');
        $this->baseUrlTokenize = config('acqio.base_url_tokenize');
        $this->client_id = config('acqio.client_id');
        $this->client_secret = config('acqio.client_secret');        

        $this->getAccessToken();
    }

    /*
     * Realiza uma solicitação get padrão utilizando
     * Bearer Authentication.
     *
     * @param string $url
     * @param array|null $params
     * @return array
     */
    public function get($url, $params = null)
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])
                ->withToken($this->accessToken)
                ->get($this->baseUrl . $url, $params);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody(), true)
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }
    }

    /*
     * Realiza uma solicitação post padrão utilizando
     * Bearer Authentication.
     *
     * @param string $url
     * @param array|null $params
     * @return array
     */
    public function post($url, $params = array())
    {
        try {           
            
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])
                ->withToken($this->accessToken)
                ->post($this->baseUrl . $url, $params);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody(), true)
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }
    }

        /*
     * Realiza uma solicitação post para tokenizar o cartão utilizando
     * Bearer Authentication.
     *
     * @param string $url
     * @param array|null $params
     * @return array
     */
    public function postTokenize($url, $params = array())
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])
                ->withToken($this->accessToken)
                ->post($this->baseUrlTokenize . $url, $params);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody(), true)
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }
    }

    /*
     * Realiza uma solicitação put padrão utilizando
     * Bearer Authentication.
     *
     * @param string $url
     * @param array|null $params
     * @return array
     */
    public function put($url, $params = null)
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])
                ->withToken($this->accessToken)
                ->put($this->baseUrl . $url, $params);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody(), true)
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }
    }

    /*
     * Realiza uma solicitação post utilizando Basic Authentication
     * para gerar um token de acesso.
     *
     * @param array $params
     * @return array
     */
    public function auth($params)
    {
        try {
            $response = Http::asForm()->post($this->baseUrlAuth . '/oauth2/token', $params);            
            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody(), true)
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }
    }

    /*
     * Pega o token de acesso da sessão ou gera um novo para
     * utilização na próxima requisição.
     *
     * @return array|void
     */
    public function getAccessToken()
    {
        if (isset($_SESSION["acqioToken"])) {
            $token = $_SESSION["acqioToken"];
            $diffInSeconds = Carbon::parse($token['updated_at'])->diffInSeconds(now());

            if ($diffInSeconds <= 3400) {
                $this->accessToken = $token['access_token'];

                return;
            }
        }

        $params = [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials',
        ];
        $response = $this->auth($params);
        
        if ($response['code'] == 200) {
            $token['access_token'] = $response['response']['access_token'];
            $token['token_type'] = $response['response']['token_type'];
            $token['expires_in'] = $response['response']['expires_in'];
            $token['scope'] = $response['response']['scope'];
            $token['created_at'] = now();
            $token['updated_at'] = now();

            $_SESSION["acqioToken"] = $token;

            $this->accessToken = $token['access_token'];

            return;
        }

        return $response;
    }
}
