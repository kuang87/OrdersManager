<?php


namespace App;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\MessageBag;

class YandexWeather
{
    protected $token;
    protected $params = [];

    public function __construct($lat, $lon)
    {
        $this->token = env('YANDEX_WEATHER_KEY');
        $this->params['lat'] = $lat;
        $this->params['lon'] = $lon;
    }

    public function getWeather()
    {
        $errors = new MessageBag();

        $url = 'https://api.weather.yandex.ru/v1/informers?' . http_build_query($this->params);

        $client = new Client();
        try{
            $request = $client->request('GET', $url, [
                'headers' => [
                    'X-Yandex-API-Key' => $this->token,
                ],
            ]);
        }catch (BadResponseException $e){
            $errors->add('Yandex', 'Нет подключения к серверу');
            return false;
        }
        $response = json_decode($request->getBody()->getContents(), true);
        $weather ['temp'] = $response['fact']['temp'] ?? '';
        $weather ['feels_like'] = $response['fact']['feels_like'] ?? '';
        $weather ['wind_speed'] = $response['fact']['wind_speed'] ?? '';
        $weather ['humidity'] = $response['fact']['humidity'] ?? '';
        return $weather;
    }
}
