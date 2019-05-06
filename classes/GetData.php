<?php

class GetData
{

    public function get($url)
    {
        $curl = new Curl();
        $response = $curl->getCurl($url);
        return json_decode($response, true);
    }
}
