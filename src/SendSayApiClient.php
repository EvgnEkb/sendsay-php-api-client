<?php

namespace Evgeny\SendsayPhpApiClient;

use Exception;

class SendSayApiClient
{
    private String $url;
    private String $login;
    private String $password;
    private String $groupId;
    private String $session;


    public function __construct(String $url, String $login, String $password, String $groupId)
    {
        $this->url = $url;
        $this->login = $login;
        $this->password = $password;
        $this->groupId = $groupId;

        $this->auth();
    }

    /**
     * Отправка запроса
     * @param array $data
     * @return mixed
     */
    public function sendRequest(Array $data)
    {
        $ch = curl_init($this->url);
        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }

    /**
     * Авторизация
     *
     * @return void
     */
    public function auth() : void
    {
        $data = array(
            "action" => "login",
            "login" => $this->login,
            "passwd" => $this->password
        );

        $result = $this->sendRequest($data);

        if(!$result->session){
            throw new Exception('[SendSay] что то пошло не так на этапе авторизации');
        }else{
            $this->session = $result->session;
        }
    }

    /**
     * Добавляем подписчика
     * @param $email
     * @return mixed
     */
    public function addSubscriber(String $email)
    {
        $data = [
            'action' => 'member.set',
            'email' => $email,
            'addr_type' => 'email',
            'if_exists' => 'error',
            'session' => $this->session,
            'datakey' => [
                [
                    "-group.{$this->groupId}",
                    'set',
                    1
                ]
            ]
        ];

        $result = $this->sendRequest($data);

        return $result;
    }

}