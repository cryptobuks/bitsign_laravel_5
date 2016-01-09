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

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use XmlDigitalSignature;

/**
 * This is the home controller class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class SignatureController extends Controller
{
    /***Initializes the class***/

    function __construct()
    {
        XmlDigitalSignature::setCryptoAlgorithm(1);
        XmlDigitalSignature::setDigestMethod('sha512');
        XmlDigitalSignature::forceStandalone();

        try
        {
            XmlDigitalSignature::loadPrivateKey(storage_path('keys/private.pem'), 'MrMarchello');
            XmlDigitalSignature::loadPublicKey(storage_path('keys/public.pem'));
            XmlDigitalSignature::loadPublicXmlKey(storage_path('keys/public.xml'));
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
        try
        {
            XmlDigitalSignature::addObject('Lorem ipsum dolor sit amet');
            XmlDigitalSignature::sign();
            XmlDigitalSignature::verify();
        }
        catch (\UnexpectedValueException $e)
        {
            print_r($e);
            exit(1);
        }

        dd(XmlDigitalSignature::getSignedDocument());
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
                XmlDigitalSignature::addObject($node, 'object'.$countr);
            }
            catch (\UnexpectedValueException $e){
                print_r($e);
                exit(1);
            }
            $countr++;
        }

        try
        {
            XmlDigitalSignature::sign();
            XmlDigitalSignature::verify();
        }
        catch (\UnexpectedValueException $e)
        {
            print_r($e);
            exit(1);
        }

        dd(XmlDigitalSignature::getSignedDocument());
    }
}
