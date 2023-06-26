<?

namespace App\interfaces;

interface ApiRequestInterface {

    public function send(string $url): string;
}