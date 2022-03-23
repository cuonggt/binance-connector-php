<?php

namespace Binance\Spot;

trait WebsocketMarket
{
    /**
     * The Aggregate Trade Streams push trade information that is aggregated for a single taker order.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenAggregateTradeStream($symbol, $callback)
    {
        $this->client->subscribeStream(strtolower($symbol).'@aggTrade', $callback);
    }

    /**
     * The Trade Streams push raw trade information; each trade has a unique buyer and seller.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenTradeStream($symbol, $callback)
    {
        $this->client->subscribeStream(strtolower($symbol).'@trade', $callback);
    }

    /**
     * The Kline/Candlestick Stream push updates to the current klines/candlestick every second.
     * @param  string  $symbol
     * @param  string  $interval
     * @param  callable  $callback
     * @return void
     */
    public function listenKlineStream($symbol, $interval, $callback)
    {
        $this->client->subscribeStream(strtolower($symbol).'@kline_'.$interval, $callback);
    }

    /**
     * 24hr rolling window mini-ticker statistics. These are NOT the statistics of the UTC day,
     * but a 24hr rolling window for the previous 24hrs.
     *
     * @param  string|null  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenMiniTickerStream($symbol = null, $callback)
    {
        $stream = $symbol ? strtolower($symbol).'@miniTicker' : '!miniTicker@arr';

        $this->client->subscribeStream($stream, $callback);
    }

    /**
     * 24hr rolling window mini-ticker statistics for all symbols that changed in an array. These are NOT the statistics of the UTC day,
     * but a 24hr rolling window for the previous 24hrs. Note that only tickers that have changed will be present in the array.
     *
     * @param  callable  $callback
     * @return void
     */
    public function listenAllMarketMiniTickersStream($callback)
    {
        return $this->listenMiniTickerStream(null, $callback);
    }

    /**
     * 24hr rolling window ticker statistics for a single symbol. These are NOT the statistics of the UTC day,
     * but a 24hr rolling window for the previous 24hrs.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenTickerStream($symbol, $callback)
    {
        $stream = $symbol ? strtolower($symbol).'@ticker' : '!ticker@arr';

        $this->client->subscribeStream($stream, $callback);
    }

    /**
     * 24hr rolling window ticker statistics for all symbols that changed in an array. These are NOT the statistics of the UTC day,
     * but a 24hr rolling window for the previous 24hrs. Note that only tickers that have changed will be present in the array.
     *
     * @param  callable  $callback
     * @return void
     */
    public function listenAllMarketTickersStream($callback)
    {
        $this->listenTickerStream(null, $callback);
    }

    /**
     * Pushes any update to the best bid or ask's price or quantity in real-time for a specified symbol.
     *
     * @param  string|null  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenBookTickerStream($symbol = null, $callback)
    {
        $stream = $symbol ? strtolower($symbol).'@bookTicker' : '!bookTicker';

        $this->client->subscribeStream($stream, $callback);
    }

    /**
     * Pushes any update to the best bid or ask's price or quantity in real-time for all symbols.
     *
     * @param  callable  $callback
     * @return void
     */
    public function listenAllMarketBookTickersStream($callback)
    {
        return $this->listenBookTickerStream(null, $callback);
    }

    /**
     * Top bids and asks, Valid are 5, 10, or 20.
     *
     * @param  string  $symbol
     * @param  int  $levels
     * @param  callable  $callback
     * @param  string|null  $updateSpeed
     * @return void
     */
    public function listenDepthStream($symbol, $levels, $callback, $updateSpeed = null)
    {
        $this->client->subscribeStream(strtolower($symbol).'@depth'.$levels.($updateSpeed ? '@'.$updateSpeed : ''), $callback);
    }

    /**
     * Order book price and quantity depth updates used to locally manage an order book.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @param  array  $options
     * @param  string|null  $updateSpeed
     * @return void
     */
    public function listenDiffDepthStream($symbol, $callback, $updateSpeed = null)
    {
        $this->client->subscribeStream(strtolower($symbol).'@depth'.($updateSpeed ? '@'.$updateSpeed : ''), $callback);
    }
}
