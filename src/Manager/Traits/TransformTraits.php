<?php


namespace NicAPI\Manager\Traits;


use Psr\Http\Message\ResponseInterface;

trait TransformTraits
{

    public function processResponse(ResponseInterface $response)
    {
        $response = $response->getBody()->__toString();
        $result = json_decode($response);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $result;
        } else {
            return $response;
        }
    }

}
