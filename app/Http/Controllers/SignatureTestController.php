<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;
use XmlDSig;
use App\Http\Controllers\Controller;
use UCrypt;
use Cache;
use Auth;
use App\Crypted;

/**
 * This is the home controller class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class SignatureTestController extends Controller
{
    /***Initializes the class***/

    function __construct()
    {
        XmlDSig::setCryptoAlgorithm(1);
        XmlDSig::setDigestMethod('sha512');
        XmlDSig::forceStandalone();

        try
        {
            XmlDSig::loadPrivateKey(storage_path('keys/private.pem'), 'MrMarchello');
            XmlDSig::loadPublicKey(storage_path('keys/public.pem'));
            XmlDSig::loadPublicXmlKey(storage_path('keys/public.xml'));
        }
        catch (\UnexpectedValueException $e)
        {
            print_r($e);
            exit(1);
        }
    }

    /**
     * Handles the request sign a blob
     *
     * @return Idontknowyer
     */
    public function blobSign()
    {
        dd(Cache::get(Auth::user()->id, 'no value bitch'));
        // $data = 'startedfromthebottomnowwerehere';
        // $key = openssl_pkey_get_public(file_get_contents(storage_path('keys').'\serverpublic.pem'));
        // openssl_public_encrypt($data, $encrypted, $key);
        // $privkey = openssl_pkey_get_private(file_get_contents(storage_path('keys').'\serverprivate.pem'));
        // openssl_private_decrypt($encrypted, $decrypted, $privkey);
        // $resultss = [
        // 'testval'=> $data,
        // 'encryptedval'=> base64_encode($encrypted),
        // 'decryptedval'=> $decrypted
        // ];
        
        // var_dump($resultss);

        // $config = array(
        // "private_key_bits" => 4096,
        // "private_key_type" => OPENSSL_KEYTYPE_RSA,
        // );
        // $private1 = openssl_pkey_new($config);

        // // openssl_pkey_export($private2, $readableprivate);
        // // var_dump($readableprivate);
        // $details = openssl_pkey_get_details($private1);
        // $public1 = $details['key'];
        // openssl_pkey_export_to_file($private1, storage_path('keys').'\serv1erprivate.pem');
        // file_put_contents(storage_path('keys').'\serv1erpublic.pem', $public1);
        // $myfile = fopen(storage_path('keys').'\tstkeys.txt', 'w');
        // fwrite($myfile, "id:,rsaenckey:sometext,\n");
        // fwrite($myfile, "id:,rsaenckey:sometext2,\n");
        // fclose($myfile);
        // die('I die with success')
        // var_dump($private1);
        // var_dump($public1);
        // $secretkey = openssl_dh_compute_key($public2, $private1);
        // var_dump($secretkey);
        // die();
        //var_dump(Auth::user());
        // $request = ['password'=>'uhfnkjsnf'];
        // dd($request->only('password')['email'] = Auth::user()->email);
        // test encryption
        // $crypted = new Crypted;
        // $crypted->setSecret('oQdZj2fbSZKbk4ggMLLwP0BmG86wHgCy');
        // $crypted->testval = "sixjuf8idaracter";
        // $crypted->testcryptval = $crypted->testval;
        // $crypted->save();
        // $crypt_id = $crypted->getKey();
        // //test decryption
        // $cryptrecord = Crypted::find($crypt_id)->setSecret();
        // $resultss = [
        // 'testval'=> $cryptrecord->testval,
        // 'encryptedval'=> $cryptrecord->testcryptval,
        // ];
        // var_dump($resultss);
        // die();

        // Ucrypt::setKey(hash('sha256','anything',true));
        // $plaintextval = 'encryptmebitch';
        // $encryptedval = UCrypt::encrypt($plaintextval);
        // try {
        //     Ucrypt::setKey(hash('sha256','anything',true));
        //     $decryptedval = UCrypt::decrypt($encryptedval);
        // } catch (Exception $e) {
        //     $decryptedval = 'faill';
        // }
        // $resultss = [
        // 'plaintextval'=> $plaintextval,
        // 'encryptedval'=> $encryptedval,
        // 'decryptedval'=> $decryptedval,
        // 'hash' => hash('sha256', $decryptedval.config('app.secret'))
        // ];
        // var_dump($resultss);

    //     $client = new Client();
    //  $response = $client->post('https://api.blockcypher.com/v1/bcy/test/addrs', [
    //         'token' => '0ca04b9e7819100572b03eb19ed5fd0c',
    //     ]);
    // var_dump(json_decode($response->getBody()));
        // dd(hash_algos());
        // try
        // {
        //     XmlDSig::addObject('Lorem ipsum dolor sit amet');
        //     XmlDSig::sign();
        //     XmlDSig::verify();
        // }
        // catch (\UnexpectedValueException $e)
        // {
        //     print_r($e);
        //     exit(1);
        // }

        // dd(XmlDSig::getSignedDocument());
    }

    /**
     * Handles the request to view the privacy policy.
     *
     * @return \Illuminate\View\View
     */
    public function domSign()
    {
        $fakeXml = new \DOMDocument();
        $fakeXml->loadXML('<?xml version="1.0" encoding="UTF-8"?><foo><bar><baz>I am a happy camper</baz><baz>So am I</baz><baz>A third one bitch</baz></bar></foo>');
        //dd($fakeXml->saveXML());
        $nodes = $fakeXml->getElementsByTagName('baz');
        $countr=1;
        foreach ($nodes as $node) {
            try{
                XmlDSig::addObject($node, 'object'.$countr);
            }
            catch (\UnexpectedValueException $e){
                print_r($e);
                exit(1);
            }
            $countr++;
        }

        try
        {
            XmlDSig::sign();
            XmlDSig::verify();
        }
        catch (\UnexpectedValueException $e)
        {
            print_r($e);
            exit(1);
        }

        dd(XmlDSig::getSignedDocument());
    }
}
