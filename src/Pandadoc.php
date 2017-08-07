<?php namespace Bigandbrown\Pandadoc;

use GuzzleHttp\Client;

class Pandadoc
{
    private $config;
    private $client;
    private $baseUrl;
    private $oauthUrl;
    private $oauth_client;
    private $oauth_authorization_url;

    function __construct($config)
    {
        $this->config = $config;
        $this->baseUrl = $config['base_url'];
        $this->client = new Client(['base_uri' => $this->baseUrl, 'headers' => $this->getHeaders()]);

        $this->oauthUrl = 'https://api.pandadoc.com/oauth2/';
        $this->oauth_client = new Client(['base_uri' => $this->oauthUrl, 'headers' => $this->getHeaders()]);
        $this->oauth_authorization_url = 'https://app.pandadoc.com/oauth2/authorize?client_id='.$config['client_id'].'&redirect_uri='.$config['redirect_uri'].'&scope=read+write&response_type=code';
    }

    // Helper Functions
    public function rawJson($response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    public function createDocument($data){
        $request = $this->client->post('documents', ['json'=>$data]);
        $response = $this->rawJson($request);

        return $response;
    }

    public function createWebhook($data){
        $request = $this->client->post('https://api.pandadoc.com/=>https://demo.dev/webhook', ['json'=>$data]);
        return $this->rawJson($request);
    }

    public function getHeaders($accept = 'application/json', $contentType = 'application/json')
    {
        return array(
            /*'Accept' => $accept,*/
            'Content-Type' => $contentType,
            'Authorization'=>'Bearer '.session('access_token')
        );
    }

    public function getAuthorizationUrl(){
        return $this->oauth_authorization_url;
    }

    public function getDocuments(){
        $request = $this->client->get('documents', ['query'=>'']);
        return $documents = $this->rawJson($request);
    }

    public function getToken($data){
        $request = $this->oauth_client->post('access_token', ['form_params' => $data]);
        return $token = $this->rawJson($request);
    }

    public function sendDocument($id, $data){
        $request = $this->client->post('documents/'.$id.'/send', ['json'=>$data]);
        return $this->rawJson($request);
    }
}