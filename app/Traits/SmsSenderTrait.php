<?php

namespace App\Traits;

use App\Models\SmsTemplate;
use Twilio\Rest\Client;
use Vonage\SMS\Message\SMS;

trait SmsSenderTrait
{
    public function test($request): bool
    {
        $template_id  = arrayCheck('template_id', $request) ? $request['template_id'] : '';
        $phone_number = '+'.$request['code'].$request['test_number'];
        $provider     = setting('active_sms_provider');
        $sms_body     = 'This is a text message from '.$provider.' for checking configuration';
        if ($this->send($phone_number, $sms_body, $template_id, $provider, true)) {
            return true;
        } else {
            return false;
        }
    }

    public function send($phone_number, $sms_body, $template_id = '', $provider = '', $masking = false)
    {
        $provider = $provider != '' ? $provider : setting('active_sms_provider');

        if ($provider == 'twilio') {
            $sid    = setting('twilio_sms_sid');
            $token  = setting('twilio_sms_auth_token');
            $client = new Client($sid, $token);

            try {
                $client->messages->create(
                    $phone_number,
                    [
                        'from' => setting('valid_twilio_sms_number'),
                        'body' => $sms_body,
                    ]
                );

                return true;
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        } elseif ($provider == 'nexmo') {

            try {
                $basic    = new \Vonage\Client\Credentials\Basic(setting('nexmo_sms_key'), setting('nexmo_sms_secret_key'));
                $client   = new \Vonage\Client($basic);
                $response = $client->sms()->send(
                    new SMS($phone_number, BRAND_NAME, $sms_body)
                );
                $message  = $response->current();

                if ($message->getStatus() == 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } elseif ($provider == 'spagreen') {
            $phone_number = preg_replace('/^(\+88|88)/', '', $phone_number);
            $phone_number = preg_replace('/-/', '', $phone_number);
            $phone_number = preg_replace('/(\s)/', '', $phone_number);

            $url          = setting('spagreen_sms_url') ? setting('spagreen_sms_url') : 'https://smpp.ajuratech.com:7790/sendtext'; //http://apismpp.revesms.com
            $params       = [
                'apikey'         => setting('spagreen_sms_api_key'),
                'secretkey'      => setting('spagreen_secret_key'),
                'callerID'       => setting('spagreen_sender_id') ?: 'SENDER_ID',
                'toUser'         => is_array($phone_number) ? implode(',', $phone_number) : $phone_number,
                'messageContent' => $sms_body,
            ];

            $ch           = \curl_init();

            $data         = http_build_query($params);
            $getUrl       = $url.'?'.$data;
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $getUrl);
            curl_setopt($ch, CURLOPT_TIMEOUT, 80);

            $result       = \curl_exec($ch);

            \curl_close($ch);

            if ($success = str_contains($result, 'ACCEPTD')) {
                return true;
            } else {
                return false;
            }

        } elseif ($provider == 'mimo') {
            $token = $this->getToken();
            $this->sendMessage($phone_number, $sms_body, $token);
            $this->logout($token);

        } elseif ($provider == 'ssl' || $provider == 'ssl_wireless') {
            $token    = setting('ssl_sms_api_token');
            $sid      = setting('ssl_sms_sid');

            $data     = [
                'api_token' => $token,
                'sid'       => $sid,
                'msisdn'    => is_array($phone_number) ? implode(',', $phone_number) : $phone_number,
                'sms'       => $sms_body,
                'csms_id'   => date('dmYhhmi').rand(10000, 99999),
            ];

            $url      = setting('ssl_sms_url');
            $data     = json_encode($data);

            $ch       = \curl_init();
            \curl_setopt($ch, CURLOPT_URL, $url);
            \curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            \curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            \curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: '.strlen($data),
                'accept:application/json',
            ]);

            $response = \curl_exec($ch);

            \curl_close($ch);

            return true;

        } elseif ($provider == 'fast2') {
            if (strpos($phone_number, '+91') !== false) {
                $phone_number = substr($phone_number, 3);
            }

            if (setting('fast_2_route') == 'dlt_manual') {
                $fields = [
                    'sender_id'   => setting('fast_2_sender_id'),
                    'message'     => $sms_body,
                    'template_id' => $template_id,
                    'entity_id'   => setting('fast_2_entity_id'),
                    'language'    => setting('fast_2_language'),
                    'route'       => setting('fast_2_route'),
                    'numbers'     => is_array($phone_number) ? implode(',', $phone_number) : $phone_number,
                ];
            } else {
                $fields = [
                    'sender_id' => setting('fast_2_sender_id'),
                    'message'   => $sms_body,
                    'language'  => setting('fast_2_language'),
                    'route'     => setting('fast_2_route'),
                    'numbers'   => is_array($phone_number) ? implode(',', $phone_number) : $phone_number,
                ];
            }

            $auth_key = setting('fast_2_auth_key');

            $curl     = \curl_init();

            \curl_setopt_array($curl, [
                CURLOPT_URL            => 'https://www.fast2sms.com/dev/bulkV2',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'POST',
                CURLOPT_POSTFIELDS     => json_encode($fields),
                CURLOPT_HTTPHEADER     => [
                    "authorization: $auth_key",
                    'accept: */*',
                    'cache-control: no-cache',
                    'content-type: application/json',
                ],
            ]);

            $response = \curl_exec($curl);
            $err      = \curl_error($curl);

            \curl_close($curl);

            return true;
        }
    }

    public function getToken()
    {
        $curl     = \curl_init();

        \curl_setopt_array($curl, [
            CURLOPT_URL            => '52.30.114.86:8080/mimosms/v1/user/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => '{
                "username": "'.setting('mimo_username').'",
                "password": "'.setting('mimo_sms_password').'"
            }',
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
            ],
        ]);

        $response = \curl_exec($curl);

        \curl_close($curl);

        return json_decode($response)->token;

    }

    public function sendMessage($phone_number, $sms_body, $token): bool
    {
        $curl     = \curl_init();

        $fields   = [
            'sender'     => setting('mimo_sms_sender_id'),
            'text'       => $sms_body,
            'recipients' => $phone_number,
        ];
        // dd($to);
        \curl_setopt_array($curl, [
            CURLOPT_URL            => '52.30.114.86:8080/mimosms/v1/message/send?token='.$token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($fields),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
            ],
        ]);

        $response = \curl_exec($curl);

        \curl_close($curl);

        return true;
    }

    public function logout($token): bool
    {
        $curl     = \curl_init();

        \curl_setopt_array($curl, [
            CURLOPT_URL            => '52.30.114.86:8080/mimosms/v1/user/logout?token='.$token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
        ]);

        $response = \curl_exec($curl);

        \curl_close($curl);

        return true;
    }

    public function sendSMS($phone_number, $key, $otp): bool|string|null
    {
        $sms_template = SmsTemplate::where('key', $key)->first();
        $tags         = ['{otp}', '{site_name}', '{phone_no}'];
        $replace      = [$otp, setting('system_name'), $phone_number];
        $sms_body     = str_replace($tags, $replace, @$sms_template->body);

        return $this->send($phone_number, $sms_body, $sms_template->template_id);
    }
}
