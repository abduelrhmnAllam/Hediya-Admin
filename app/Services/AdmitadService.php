<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AdmitadService
{
    protected function token(): string
    {
        return Cache::remember('admitad_token_v3', 604000, function () {

            $response = Http::asForm()
                ->withHeaders([
                    'Authorization' => 'Basic ' . config('services.admitad.base64'),
                ])
                ->post('https://api.admitad.com/token/', [
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
            ->get('https://api.admitad.com' . $endpoint, $params)
            ->json();
    }

    // 📊 Daily report
    public function daily(array $params)
    {
        return $this->get('/statistics/dates/', $params);
    }

    // 🏷 Campaigns
    public function campaigns(array $params)
    {
        return $this->get('/statistics/campaigns/', $params);
    }

    // 🌐 Websites
    public function websites(array $params)
    {
        return $this->get('/statistics/websites/', $params);
    }

    // 🧾 Actions
    public function actions(array $params)
    {
        return $this->get('/statistics/actions/', $params);
    }
}
