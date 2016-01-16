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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use XmlDSig;
use App\Http\Controllers\Controller;
use UCrypt;

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
        Ucrypt::setKey('0tu4c0vaJ1cvSNtu7SLr3eIfmVfOfBuB');
        $plaintextval = 'encryptmebitch';
        $encryptedval = UCrypt::encrypt($plaintextval);
        try {
            $decryptedval = UCrypt::decrypt($encryptedval);
        } catch (Exception $e) {
            $decryptedval = 'fail';
        }
        $resultss = [
        'plaintextval'=> $plaintextval,
        'encryptedval'=> $encryptedval,
        'decryptedval'=> $decryptedval
        ];
        var_dump($resultss);
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
