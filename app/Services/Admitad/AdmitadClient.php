<?php

namespace App\Services\Admitad;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AdmitadClient
{
    protected string $baseUrl = 'https://api.admitad.com';

    protected function token(): string
    {
        return Cache::remember('admitad_token_v3', 604000, function () {

            $response = Http::asForm()
                ->withHeaders([
                    'Authorization' => 'Basic ' . config('services.admitad.base64'),
                ])
                ->post($this->baseUrl . '/token/', [
                    'grant_type' => 'client_credentials',
                    'client_id'  => config('services.admitad.client_id'),
                    'scope'      => 'statistics private_data private_data_balance',
                ]);

            if (! $response->successful()) {
                throw new \RuntimeException(
                    'Admitad token error: ' . $response->body()
                );
            }

            return $response->json('access_token');
        });
    }

    protected function get(string $endpoint, array $params = [])
    {
        return Http::withToken($this->token())
            ->get($this->baseUrl . $endpoint, $params);
    }

    /**
     * Fetch statistics actions
     */
    public function fetchActions(array $params): array
    {
        $response = $this->get('/statistics/actions/', $params);

        if (!$response->successful()) {
             throw new \RuntimeException(
                'Admitad API error: ' . $response->body()
            );
        }

        return $response->json();
    }
}
