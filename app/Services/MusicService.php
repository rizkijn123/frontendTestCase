<?php

namespace App\Services;

class MusicService
{
    public function showallmusic()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:3000/api/v1/music',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $response = json_decode($response);
        curl_close($curl);
        return $response ?: $err;
    }
    public function addMusic($datamusic)
    {

        $curl = curl_init();
        $data = [
            'artistname' => $datamusic['artistname'],
            'packagename' => $datamusic['packagename'],
            'imageurl' => $datamusic['imageurl'],
            'releasedate' => $datamusic['releasedate'],
            'sampleurl' => $datamusic['sampleurl'],
            'price' => $datamusic['price'],
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:3000/api/v1/music',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $response = json_decode($response);
        curl_close($curl);
        return $response ?: $err;
    }
    public function delete($id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:3000/api/v1/music/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',

        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $response = json_decode($response);
        curl_close($curl);
        return $response ?: $err;
    }
    public function edit($datamusic)
    {

        $curl = curl_init();
        $data = [
            'artistname' => $datamusic['artistname'],
            'packagename' => $datamusic['packagename'],
            'imageurl' => $datamusic['imageurl'],
            'releasedate' => $datamusic['releasedate'],
            'sampleurl' => $datamusic['sampleurl'],
            'price' => $datamusic['price'],
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:3000/api/v1/music/' . $datamusic['id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $response = json_decode($response);

        curl_close($curl);
        return $response ?: $err;
    }
}
