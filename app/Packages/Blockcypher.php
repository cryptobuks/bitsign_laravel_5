<?php

namespace App\Packages;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

class Blockcypher {

	/**
	 * Guzzle Http Client
	 */
	protected $client;

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->client = new Client([
	    // Base URI is used with relative requests
	    'base_uri' => 'https://api.blockcypher.com/v1/bcy/test/'
		]);
    }

    /**
     * Create a new controller instance.
     *
     * @param $data
     * @return $tx_hash
     */
    public function putData($data){
    	$uri = 'txs/data';
		$query = ['token'=> config('services.blockcypher.token')];
		$data = [
			//the signature hash record
			'data' => $data, 
			'encoding' => 'hex'
			];
		$response = $this->client->post($uri,
			['json' => $data, 'query'=>$query]);

		return json_decode($response->getBody(), true)['hash'];
    }
	/**
     * Store signature record data on the blockchain.
     *
     * @param  int  $contract_id
     * @return null
     */
	public function putMeta($signature_id, $signature_hash, $address){
		$uri = 'addrs/'.$address.'/meta';
		$query = ['token'=> config('services.blockcypher.token')];
		$data = [
			//the signature hash record
			$signature_id => $signature_hash
			];
		$response = $this->client->put($uri,
			['json' => $data, 'query'=>$query]);

		return json_decode($response->getBody(), true);
	}

	public function getMeta($address){
		$uri = 'addrs/'.$address.'/meta';
		$response = $this->client->get($uri);

		return json_decode($response->getBody(), true);
	}

	public function getAddress(){
		$uri = 'addrs';
		$data = ['token' => config('services.blockcypher.token')];
		$response = $this->client->post($uri,
			['json' => $data]);

		return json_decode($response->getBody(), true)['address'];
	}
}