<?php

namespace App\Services\Boostiny;

use Illuminate\Support\Facades\Http;

class BoostinyClient
{
    protected string $baseUrl = 'https://api.boostiny.com';
    protected string $token;

    public function __construct()
    {
        $this->token = config('services.boostiny.token');
    }

    public function fetchCouponPerformance(string $from, string $to): array
    {
        return $this->fetchPaginated('/publisher/performance', $from, $to);
    }

    public function fetchLinkPerformance(string $from, string $to): array
    {
        return $this->fetchPaginated('/publisher/link-performance', $from, $to);
    }

    protected function fetchPaginated(string $endpoint, string $from, string $to): array
    {
        $page = 1;
        $rows = [];

        do {
            $response = Http::withHeaders([
                'Accept'        => 'application/json',
                'Authorization' => $this->token,
            ])->get($this->baseUrl . $endpoint, [
                'from' => $from,
                'to'   => $to,
                'page' => $page,
            ]);

            if (! $response->successful()) {
                throw new \RuntimeException(
                    'Boostiny API error: ' . $response->body()
                );
            }

            $payload = $response->json('payload');
            $rows    = array_merge($rows, $payload['data'] ?? []);

            $pagination = $payload['pagination'] ?? null;

            $hasMore = $pagination
                && ($pagination['currentPage'] * $pagination['perPage'] < $pagination['total']);

            $page++;
        } while ($hasMore);

        return $rows;
    }
}
