<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 04.03.18
 * Time: 20:17
 */
namespace App\Services;

use GuzzleHttp\Client;

class ProductService
{
    const END_POINT = 'end_point';
    const DATE_START = 'start_date';
    const DATE_END = 'end_date';
    const TRAVELERS = 'travelers';

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public function search($args)
    {
        $response = $this->client->request('GET', $args[self::END_POINT]);
        $products = json_decode($response->getBody()->getContents(), true);
        $this->validateResponse($products);

        $items = [];
        foreach ($products['product_availabilities'] as $product) {
            if ($this->isAvailable($product, $args)) {

                if (!empty($items[$product['product_id']])) {
                    $items[$product['product_id']]['available_starttimes'][] = $product['activity_start_datetime'];
                    continue;
                }

                $item = [
                    'product_id' => $product['product_id'],
                    'available_starttimes' => [
                        $product['activity_start_datetime']
                    ]
                ];

                $items[$product['product_id']] = $item;
            }

        }

        return array_values($items);
    }

    /**
     * @param array $data
     * @param array $args
     * @return bool
     * @throws \Exception
     */
    private function isAvailable($data, $args)
    {
        $activityStart = new \DateTimeImmutable($data['activity_start_datetime']);
        $duration = $data['activity_duration_in_minutes'];
        $durationInterval = new \DateInterval("PT{$duration}M");
        $activityEnd = (new \DateTimeImmutable($args[self::DATE_START]))->add($durationInterval);

        $requestStart = new \DateTimeImmutable($args[self::DATE_START]);
        $requestEnd = new \DateTimeImmutable($args[self::DATE_END]);

        if ($data['places_available'] < $args[self::TRAVELERS]) {
            return false;
        }

        if ($activityStart < $requestStart) {
            return false;
        }

        if ($activityStart > $requestEnd) {
            return false;
        }

        if ($activityEnd > $requestEnd) {
            return false;
        }

        return true;
    }

    /**
     * @param $response
     * @throws \Exception
     */
    private function validateResponse($response)
    {
        if (!is_array($response)) {
            throw new \Exception('invalid response type');
        }

        if (!array_diff_key(array_flip([
            'product_id',
            'activity_duration_in_minutes',
            'activity_start_datetime',
            'places_available'
        ]), $response)) {
            throw new \Exception('response missing data');
        }
    }
}