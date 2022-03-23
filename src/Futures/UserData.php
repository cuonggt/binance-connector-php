<?php

namespace Binance\Futures;

trait UserData
{
    /**
     * Start a new user data stream. The stream will close after 60 minutes unless a keepalive is sent.
     * If the account has an active listenKey, that listenKey will be returned and its validity will
     * be extended for 60 minutes.
     *
     * @return mixed
     */
    public function createListenKey()
    {
        return $this->client->limitRequest('POST', '/fapi/v1/userDataStream');
    }

    /**
     * Keepalive a user data stream to prevent a time out. User data streams will close after 60 minutes.
     * It's recommended to send a ping about every 30 minutes.
     *
     * @return mixed
     */
    public function keepAliveListenKey($listenKey)
    {
        return $this->client->limitRequest('PUT', '/fapi/v1/userDataStream', [
            'listenKey' => $listenKey,
        ]);
    }

    /**
     * Close out a user data stream.
     *
     * @return mixed
     */
    public function closeListenKey($listenKey)
    {
        return $this->client->limitRequest('DELETE', '/fapi/v1/userDataStream', [
            'listenKey' => $listenKey,
        ]);
    }

    /**
     * Listen user data stream.
     *
     * @param  string  $listenKey
     * @param  callable  $callback
     * @return void
     */
    public function listenUserDataStream($listenKey, $callback)
    {
        $this->client->subscribeStream($listenKey, $callback);
    }
}
