<?php 

namespace App\Http\Helpers;

use Exception;
use GuzzleHttp\Client;

class DogsApi 
{
    private string $api_uri;
    private string $api_key;
    private Client $connection;

    public function __construct(string $api_key) 
    {
        $this->api_uri = 'https://petstore.swagger.io/v2/';
        $this->api_key = $api_key;
        $this->connection = new Client();
    }

    public function getDogs(string $status) : array | string
    {
        try {
            $endpoint = "pet/findByStatus?status={$status}&api_key=".$this->api_key;
            $response = $this->connection->get($this->api_uri.$endpoint);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function getDog(string $id) : array | string
    {
        try {
            $endpoint = "pet/{$id}";
            $response = $this->connection->get($this->api_uri.$endpoint);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function addDog(array $data) : int | string
    {
        $endpoint = "pet";
        $form_params = [
            'category' => [
                'id' => 0,
                'name' => 'string'
            ],
            'name' => $data['name'],
            'photoUrls' => ['string'],
            'tags' => [
                [
                    'id' => 0,
                    'name' => 'string'
                ]
            ],
            'status' => $data['status']
        ];
        try {
            $response = $this->connection->request('POST', $this->api_uri.$endpoint, [
                'json' => $form_params,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ]
            ]);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateDog(array $data) : int | string
    {
        $endpoint = "pet";
        $form_params = [
            'id' => $data['id'],
            'category' => [
                'id' => 0,
                'name' => 'string'
            ],
            'name' => $data['name'],
            'photoUrls' => ['string'],
            'tags' => [
                [
                    'id' => 0,
                    'name' => 'string'
                ]
            ],
            'status' => $data['status']
        ];
        try {
            $response = $this->connection->request('PUT', $this->api_uri.$endpoint, [
                'json' => $form_params,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ]
            ]);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteDog(string $id) : int | string
    {
        $endpoint = "pet/{$id}";
        try {
            $response = $this->connection->request('DELETE', $this->api_uri.$endpoint, [
                'headers' => [
                    'Accept' => 'application/json',
                    'api_key' => $this->api_key, 
                ]
            ]);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}