<?php

namespace Binance\Futures;

trait WebsocketMarket
{
    /**
     * The Aggregate Trade Streams push market trade information that is aggregated for fills with same price and taking side every 100 milliseconds.
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
     * Mark price and funding rate for a single symbol pushed every 3 seconds or every second.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @param  string|null  $updateSpeed
     * @return void
     */
    public function listenMarkPriceStream($symbol, $callback, $updateSpeed = null)
    {
        $this->client->subscribeStream(strtolower($symbol).'@markPrice'.($updateSpeed ? '@'.$updateSpeed : ''), $callback);
    }

    /**
     * Mark price and funding rate for all symbols pushed every 3 seconds or every second.
     *
     * @param  callable  $callback
     * @param  string|null  $updateSpeed
     * @return void
     */
    public function listenMarkPriceStreamForAllMarket($callback, $updateSpeed = null)
    {
        $this->client->subscribeStream('!markPrice@arr'.($updateSpeed ? '@'.$updateSpeed : ''), $callback);
    }

    /**
     * The Kline/Candlestick Stream push updates to the current klines/candlestick every 250 milliseconds (if existing).
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
     * Continuous Contract Kline/Candlestick Streams.
     * @param  string  $pair
     * @param  string  $contractType
     * @param  string  $interval
     * @param  callable  $callback
     * @return void
     */
    public function listenContinuousContractKlineStream($pair, $contractType, $interval, $callback)
    {
        $this->client->subscribeStream(strtolower($pair).'_'.$contractType.'@continuousKline_'.$interval, $callback);
    }

    /**
     * 24hr rolling window mini-ticker statistics. These are NOT the statistics of the UTC day,
     * but a 24hr rolling window for the previous 24hrs.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenMiniTickerStream($symbol, $callback)
    {
        $this->client->subscribeStream(strtolower($symbol).'@miniTicker', $callback);
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
        $this->client->subscribeStream('!miniTicker@arr', $callback);
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
        $this->client->subscribeStream(strtolower($symbol).'@ticker', $callback);
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
        $this->client->subscribeStream('!ticker@arr', $callback);
    }

    /**
     * Pushes any update to the best bid or ask's price or quantity in real-time for a specified symbol.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenBookTickerStream($symbol, $callback)
    {
        $this->client->subscribeStream(strtolower($symbol).'@bookTicker', $callback);
    }

    /**
     * Pushes any update to the best bid or ask's price or quantity in real-time for all symbols.
     *
     * @param  callable  $callback
     * @return void
     */
    public function listenAllMarketBookTickersStream($callback)
    {
        $this->client->subscribeStream('!bookTicker', $callback);
    }

    /**
     * The Liquidation Order Snapshot Streams push force liquidation order information for specific symbol.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenLiquidationOrderStream($symbol, $callback)
    {
        $this->client->subscribeStream(strtolower($symbol).'@forceOrder', $callback);
    }

    /**
     * The All Liquidation Order Snapshot Streams push force liquidation order information for all symbols in the market.
     *
     * @param  callable  $callback
     * @return void
     */
    public function listenAllMarketLiquidationOrdersStream($callback)
    {
        $this->client->subscribeStream('!forceOrder@arr', $callback);
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
     * @param  string|null  $updateSpeed
     * @return void
     */
    public function listenDiffDepthStream($symbol, $callback, $updateSpeed = null)
    {
        $this->client->subscribeStream(strtolower($symbol).'@depth'.($updateSpeed ? '@'.$updateSpeed : ''), $callback);
    }

    /**
     * BLVT Info Streams.
     *
     * @param  string  $tokenName
     * @param  callable  $callback
     * @return void
     */
    public function listenBLVTInfoStream($tokenName, $callback)
    {
        $this->client->subscribeStream(strtoupper($tokenName).'@tokenNav', $callback);
    }

    /**
     * BLVT NAV Kline/Candlestick Streams.
     *
     * @param  string  $tokenName
     * @param  string  $interval
     * @param  callable  $callback
     * @return void
     */
    public function listenBLVTNavNAVStream($tokenName, $interval, $callback)
    {
        $this->client->subscribeStream(strtoupper($tokenName).'@nav_Kline_'.$interval, $callback);
    }

    /**
     * Composite index information for index symbols pushed every second.
     *
     * @param  string  $symbol
     * @param  callable  $callback
     * @return void
     */
    public function listenCompositeIndexSymbolInformationStream($symbol, $callback)
    {
        $this->client->subscribeStream(strtolower($symbol).'@compositeIndex', $callback);
    }
}
