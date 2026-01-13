<?php

namespace App\Affiliates\Normalizers;

use Carbon\Carbon;

class AdmitadMetricNormalizer
{
    public static function normalize(array $row): array
    {
        return [
            'date' => self::normalizeDate($row['date'] ?? null),
            'metrics' => self::extractMetrics($row),
            'raw_payload' => $row,
        ];
    }

    protected static function normalizeDate(?string $date): ?string
    {
        if (!$date) {
            return null;
        }

        try {
            // Admitad format: d.m.Y
            if (preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $date)) {
                return Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
            }

            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }

    protected static function extractMetrics(array $row): array
    {
        $currency = $row['currency'] ?? null;

        $map = [
            'views'                => ['views', null],
            'clicks'               => ['clicks', null],
            'sales_sum'            => ['orders', null],
            'leads_sum'            => ['leads', null],
            'payment_sum_approved' => ['revenue', $currency],
            'payment_sum_declined' => ['declined_revenue', $currency],
        ];

        $metrics = [];

        foreach ($map as $sourceKey => [$metricKey, $currency]) {
            if (!isset($row[$sourceKey])) {
                continue;
            }

            if (!is_numeric($row[$sourceKey])) {
                continue;
            }

            $metrics[] = [
                'key'      => $metricKey,
                'value'    => (float) $row[$sourceKey],
                'currency' => $currency,
            ];
        }

        return $metrics;
    }
}
