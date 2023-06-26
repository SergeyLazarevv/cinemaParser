<?

namespace App\Servise\Kinopoisk;

use App\interfaces\ApiRequestInterface;

class KinopoiskRequest
{

    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function send(string $url): string
    {
        $ch = curl_init($url);
        $headers = [];
        $headers[] = "X-API-KEY: $this->apiKey";
        $headers[] = "Content-Type':'application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $jsonResp = curl_exec($ch);
        curl_close($ch);
        return $jsonResp;
    }
}