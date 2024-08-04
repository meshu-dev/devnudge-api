<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Exceptions\NotionPageConverter\{
    ConversionException,
    UnauthorizedException
};

class NotionPageToHtmlService
{
    public function convert(string $pageId): string
    {
        $converterUrl   = config('services.notion.page_to_html.url');
        $converterToken = config('services.notion.page_to_html.token');

        $response = Http::withToken($converterToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post(
                $converterUrl,
                ['pageId' => $pageId]
            );

        throw_if(
            $response->status() === 401,
            UnauthorizedException::class,
            'Call to Notion page converter service was unauthorized'
        );

        throw_unless(
            $response->status() === 200,
            ConversionException::class,
            'Coverter failed to return HTML for requested Notion page'
        );

        return $response->body();
    }
}
