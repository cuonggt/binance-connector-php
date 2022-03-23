<?php

namespace Binance\Futures;

trait MarketData
{
    /**
     * Test connectivity to the Rest API.
     *
     * @return mixed
     */
    public function ping()
    {
        return $this->client->publicRequest('GET', '/fapi/v1/ping');
    }

    /**
     * Test connectivity to the Rest API and get the current server time.
     *
     * @return mixed
     */
    public function time()
    {
        return $this->client->publicRequest('GET', '/fapi/v1/time');
    }

    /**
     * Current exchange trading rules and symbol information.
     *
     * @return mixed
     */
    public function exchangeInfo()
    {
        return $this->client->publicRequest('GET', '/fapi/v1/exchangeInfo');
    }

    /**
     * Order Book.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function depth($symbol, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/depth', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get recent market trades.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function trades($symbol, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/trades', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get older market historical trades.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function historicalTrades($symbol, array $options = [])
    {
        return $this->client->limitRequest('GET', '/fapi/v1/historicalTrades', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get compressed, aggregate market trades. Market trades that fill in 100ms with the same
     * price and the same taking side will have the quantity aggregated.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function aggTrades($symbol, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/aggTrades', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Kline/candlestick bars for a symbol.
     *
     * @param  string  $symbol
     * @param  string  $interval
     * @param  array  $options
     * @return mixed
     */
    public function klines($symbol, $interval, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/klines', array_merge([
            'symbol' => $symbol,
            'interval' => $interval,
        ], $options));
    }

    /**
     * Kline/candlestick bars for a specific contract type.
     *
     * @param  string  $pair
     * @param  string  $contractType
     * @param  string  $interval
     * @param  array  $options
     * @return mixed
     */
    public function continuousKlines($pair, $contractType, $interval, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/continuousKlines', array_merge([
            'pair' => $pair,
            'contractType' => $contractType,
            'interval' => $interval,
        ], $options));
    }

    /**
     * Kline/candlestick bars for the index price of a pair.
     *
     * @param  string  $pair
     * @param  string  $interval
     * @param  array  $options
     * @return mixed
     */
    public function indexPriceKlines($pair, $interval, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/indexPriceKlines', array_merge([
            'pair' => $pair,
            'interval' => $interval,
        ], $options));
    }

    /**
     * Kline/candlestick bars for the mark price of a symbol.
     *
     * @param  string  $symbol
     * @param  string  $interval
     * @param  array  $options
     * @return mixed
     */
    public function markPriceKlines($symbol, $interval, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/markPriceKlines', array_merge([
            'symbol' => $symbol,
            'interval' => $interval,
        ], $options));
    }

    /**
     * Mark Price and Funding Rate.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function premiumIndex($symbol = null)
    {
        return $this->client->publicRequest('GET', '/fapi/v1/premiumIndex', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Get Funding Rate History.
     *
     * @param  string|null  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function fundingRate($symbol = null, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/fundingRate', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * 24 hour rolling window price change statistics.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function ticker24hr($symbol = null)
    {
        return $this->client->publicRequest('GET', '/fapi/v1/ticker/24hr', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Latest price for a symbol or symbols.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function tickerPrice($symbol = null)
    {
        return $this->client->publicRequest('GET', '/fapi/v1/ticker/price', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Best price/qty on the order book for a symbol or symbols.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function bookTicker($symbol = null)
    {
        return $this->client->publicRequest('GET', '/fapi/v1/ticker/bookTicker', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Get present open interest of a specific symbol.
     *
     * @param  string  $symbol
     * @return mixed
     */
    public function openInterest($symbol)
    {
        return $this->client->publicRequest('GET', '/fapi/v1/openInterest', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Open Interest Statistics.
     *
     * @param  string  $symbol
     * @param  string  $period
     * @param  array  $options
     * @return mixed
     */
    public function openInterestStatistics($symbol, $period, array $options = [])
    {
        return $this->client->publicRequest('GET', '/futures/data/openInterestHist', array_merge([
            'symbol' => $symbol,
            'period' => $period,
        ], $options));
    }

    /**
     * Top Trader Long/Short Ratio (Accounts).
     *
     * @param  string  $symbol
     * @param  string  $period
     * @param  array  $options
     * @return mixed
     */
    public function topLongShortAccountRatio($symbol, $period, array $options = [])
    {
        return $this->client->publicRequest('GET', '/futures/data/topLongShortAccountRatio', array_merge([
            'symbol' => $symbol,
            'period' => $period,
        ], $options));
    }

    /**
     * Long/Short Ratio.
     *
     * @param  string  $symbol
     * @param  string  $period
     * @param  array  $options
     * @return mixed
     */
    public function globalLongShortAccountRatio($symbol, $period, array $options = [])
    {
        return $this->client->publicRequest('GET', '/futures/data/globalLongShortAccountRatio', array_merge([
            'symbol' => $symbol,
            'period' => $period,
        ], $options));
    }

    /**
     * Taker Buy/Sell Volume.
     *
     * @param  string  $symbol
     * @param  string  $period
     * @param  array  $options
     * @return mixed
     */
    public function takerlongshortRatio($symbol, $period, array $options = [])
    {
        return $this->client->publicRequest('GET', '/futures/data/takerlongshortRatio', array_merge([
            'symbol' => $symbol,
            'period' => $period,
        ], $options));
    }

    /**
     * Historical BLVT NAV Kline/Candlestick.
     *
     * @param  string  $symbol
     * @param  string  $interval
     * @param  array  $options
     * @return mixed
     */
    public function lvtKlines($symbol, $interval, array $options = [])
    {
        return $this->client->publicRequest('GET', '/fapi/v1/lvtKlines', array_merge([
            'symbol' => $symbol,
            'interval' => $interval,
        ], $options));
    }

    /**
     * Composite Index Symbol Information.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function indexInfo($symbol = null)
    {
        return $this->client->publicRequest('GET', '/fapi/v1/indexInfo', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Asset index for Multi-Assets mode.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function assetIndex($symbol = null)
    {
        return $this->client->publicRequest('GET', '/fapi/v1/assetIndex', [
            'symbol' => $symbol,
        ]);
    }
}
