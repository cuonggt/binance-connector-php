<?php

namespace Binance;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use WebSocket\Client as WebSocketClient;
use WebSocket\ConnectionException;

class Client
{
    /**
     * The base API endpoint.
     *
     * @var string
     */
    public $baseUrl;

    /**
     * The base websocket endpoint.
     *
     * @var string
     */
    public $baseWebsocketUrl;

    /**
     * The API key.
     *
     * @var string
     */
    public $key;

    /**
     * The Secret key.
     *
     * @var string
     */
    public $secret;

    /**
     * Create a new Binance Client instance.
     *
     * @param  array  $options
     * @return void
     */
    public function __construct($options = [])
    {
        $this->baseUrl = $options['base_url'] ?? 'https://api.binance.com';
        $this->baseWebsocketUrl = $options['base_websocket_url'] ?? 'wss://stream.binance.com:9443';
        $this->key = $options['key'] ?? null;
        $this->secret = $options['secret'] ?? null;
    }

    /**
     * Set the base URL.
     *
     * @param  string  $baseUrl
     * @return $this
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Set the API key.
     *
     * @param  string  $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Set the Secret key.
     *
     * @param  string  $secret
     * @return $this
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Call a public API endpoint.
     *
     * @param  string  $method
     * @param  string  $path
     * @param  array  $params
     * @return mixed
     *
     * @throws \Exception
     */
    public function publicRequest($method, $path, array $params = [])
    {
        return $this->request($method, $path, $params);
    }

    /**
     * Call a limit API endpoint.
     *
     * @param  string  $method
     * @param  string  $path
     * @param  array  $params
     * @return mixed
     *
     * @throws \Exception
     */
    public function limitRequest($method, $path, array $params = [])
    {
        return $this->request($method, $path, $params, [
            'X-MBX-APIKEY' => $this->key,
        ]);
    }

    /**
     * Call a sign API endpoint.
     *
     * @param  string  $method
     * @param  string  $path
     * @param  array  $params
     * @return mixed
     *
     * @throws \Exception
     */
    public function signRequest($method, $path, array $params = [])
    {
        $params = array_merge([
            'recvWindow' => 5000,
            'timestamp' => Date::now()->timestamp * 1000,
        ], $params);

        $params['signature'] = hash_hmac('sha256', http_build_query($params), $this->secret);

        return $this->request($method, $path, $params, [
            'X-MBX-APIKEY' => $this->key,
        ]);
    }

    /**
     * Send the request to the given URL.
     *
     * @param  string  $method
     * @param  string  $path
     * @param  array  $params
     * @param  array  $headers
     * @return mixed
     *
     * @throws \Exception
     */
    protected function request($method, $path, array $params = [], array $headers = [])
    {
        return Http::withHeaders($headers)
            ->asForm()
            ->{$method}($this->baseUrl.'/'.ltrim($path, '/'), $params)
            ->json();
    }

    /**
     * Subscribe to a stream.
     *
     * @param  string|array  $stream
     * @param  callable  $callback
     * @return void
     */
    public function subscribeStream($stream, $callback)
    {
        $path = is_array($stream) ?
            '/stream?streams='.implode('/', $stream) :
            '/ws/'.$stream;

        $client = new WebSocketClient($this->baseWebsocketUrl.$path);

        while (true) {
            try {
                $message = $client->receive();

                $data = json_decode($message, true);

                $callback($data);
            } catch (ConnectionException $e) {
                //
            }
        }
    }
}
