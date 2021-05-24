<?php

namespace Tobexkee\Reloadly\Http;

use Illuminate\Support\Collection;

/**
 * Class ResponseMediator.
 */
class ResponseMediator
{
    public static function getContent($response): string | array
    {
        $body = $response->getBody()->__toString();

        $content = json_decode($body, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return static::parseContent($content);
        }

        return $body;
    }

    protected static function parseContent($content): array
    {
        if (is_array($content) && isset($content['data'])) {
            $data = $content['data'];
            if (isset($data[0])) {
                return Collection::make($data)->toArray();
            }

            return $data;
        }

        return $content;
    }
}
