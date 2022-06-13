<?php
namespace App\service;

use DateTimeImmutable;

class JWTService {

    public function generate($header, $payload, $secret, $validity = 10800): string{

        if($validity > 0){
            $now = new DateTimeImmutable();
            $expire = $now->getTimestamp() + $validity;

            $payload["iat"] = $now->getTimestamp();
            $payload["exp"] = $expire;
        }


        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));

        // del +, /, =
        $base64Header = str_replace(["+", "/", "="], ["-", "_", ""], $base64Header);
        $base64Payload = str_replace(["+", "/", "="], ["-", "_", ""], $base64Payload);

        $secret = base64_encode($secret);

        $signature = hash_hmac('sha256', $base64Header.".".$base64Payload, $secret, true);
        $base64Signature = base64_encode($signature);
        $base64Signature = str_replace(["+", "/", "="], ["-", "_", ""], $base64Header);

        $jwt = $base64Header .".". $base64Payload .".". $base64Signature;


        return $jwt;
    }

    public function isValid(string $token):bool {
        return preg_match(
            '/^[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+$/', $token
        ) === 1;
    }

    public function getHeader(string $token) {
        $array= explode('.', $token);
        $header = json_decode(base64_decode($array[0], true));
        return $header;
    }

    public function getPayload(string $token) {
        $array= explode('.', $token);
        $payload = json_decode(base64_decode($array[1], true));
        return $payload;
    }

    public function check(string $token, string $secret) {
        $header =  $this->getHeader($token);
        $payload = $this->getPayload($token) ;

        $verifToken = $this->generate($header, $payload, $secret, 0);

        return $token === $verifToken;
    }
}