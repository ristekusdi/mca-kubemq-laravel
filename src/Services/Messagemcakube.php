<?php

namespace Ristekusdi\McaKubemqLaravel\Services;

class Messagemcakube
{

    /**
     * @var Address
     * alamat ip kubemq
     */
    protected $address;
    /**
     * @var port
     * alamat ip kubemq
     */
    protected $port;
    /**
     * @var clientid
     * alamat ip kubemq
     */
    protected $clientid;
    /**
     * @var channel
     * alamat ip kubemq
     */
    protected $channel;


    /**
     * Session constructor.
     * $address, $port, $channel, $clientid
     *
     * @param Address $address
     */
    public function __construct()
    {
        $this->address = config('mcakubemqphp.address', '');
        $this->port = config('mcakubemqphp.port', '');
        $this->clientid = config('mcakubemqphp.clientid', '');
        $this->channel = config('mcakubemqphp.channel', '');
    }

    /**
     * Sending Message.
     *
     * @param idsso $idsso
     * @param message $message
     */
    public function sendMessage($id_sso, $message_text, $debug = false)
    {
        $curl = curl_init();

        $post_fields = json_encode(array(
            "EventID" => "1234-5678-90",
            "ClientID" => $this->clientid,
            "Channel" => $this->channel,
            "Metadata" => "some-metadata",
            "Body" => base64_encode(json_encode(array(
                "id_sso" => $id_sso,
                "message_text" => $message_text
            ))),
            "Store" => false
        ));
        // echo $post_fields;
        // exit;
        curl_setopt_array($curl, array(
            CURLOPT_URL => "{$this->address}:{$this->port}/send/event",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Accept: application/json",
                "Content-Type: text/plain"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($debug == true) {
            if ($err ) {
                // echo "cURL Error #:" . $err;
                return $err;
            } else {
                return $response;
            }
        } else {
            # code...
        }
    }

    public function display()
    {
        // return 'tampilan menggunakan facades';
        dd('display message');
        // dd(config('mcakubemqphp.address', 'test'));
    }
}
