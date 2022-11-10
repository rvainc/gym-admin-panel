<?php

namespace App\Support;

use Illuminate\Support\Arr;

class Helper
{
    /**
     * @param string $url
     * @param array $new
     * @return string
     */
    static function addQueryParams($url, array $new = [])
    {
        $urlParts = parse_url($url);
        parse_str($urlParts['query'] ?? '', $params);
        $urlParts['query'] = http_build_query(
            array_merge($params, $new),
            null,
            '&',
            PHP_QUERY_RFC3986
        );

        $queryPart = blank($urlParts['query']) ? '' : sprintf('?%s', $urlParts['query']);

        return $urlParts['scheme'] . '://'
            . data_get($urlParts, 'host')
            . data_get($urlParts, 'path')
            . $queryPart;
    }

    /**
     * @param string $url
     * @param string $key
     * @return string
     */
    static function removeQueryParams($url, $key)
    {
        $urlParts = parse_url($url);
        parse_str($urlParts['query'] ?? '', $params);
        $urlParts['query'] = Arr::query(Arr::except($params, $key));

        return data_get($urlParts, 'scheme')
            . '://'
            . data_get($urlParts, 'host')
            . data_get($urlParts, 'path')
            . (filled($urlParts['query']) ? '?' . data_get($urlParts, 'query') : '');
    }
}
