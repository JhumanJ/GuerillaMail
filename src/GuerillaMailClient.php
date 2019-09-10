<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/09/2019
 * Time: 13:17
 */

namespace JhumanJ\GuerillaMail;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * A client to the Guerrillamail web service API
 * (https://www.guerrillamail.com/GuerrillaMailAPI.html).
 * @package JhumanJ\GuerillaMail
 */
class GuerillaMailClient
{
    const ENDPOINT = '/ajax.php';

    public $baseUrl, $clientIp, $client, $emailAddress, $emailTimestamp, $sessionId;

    public function __construct( $baseUrl = 'http://api.guerrillamail.com', $clientIp = '127.0.0.1' )
    {
        $this->baseUrl = $baseUrl;
        $this->clientIp = $clientIp;
        $this->client = new Client();
    }

    private function doRequest( $sessionId = null, Array $params = [] )
    {
        $url = $this->baseUrl . self::ENDPOINT;
        $params['ip'] = $this->clientIp;

        if ( $sessionId != null ) {
            $params['sid_token'] = $sessionId;
        }

        try {
            $response = $this->client->get( $url, [
                'query' => $params
            ] );
        } catch ( ClientException $e ) {
            throw new GuerillaMailException(
                'Request failed (' . $e->getCode() . '): ' . $e->getMessage(),
                0,
                $e
            );
        }

        return json_decode( $response->getBody(), true );
    }

    public function getEmailAddress( $sessionId = null )
    {
        $data = $this->doRequest( $sessionId, [ 'f' => 'get_email_address' ] );

        // Update details stored
        if (isset($data['email_addr'])) {
            $this->emailAddress = $data['email_addr'];
        }
        if (isset($data['email_timestamp'])) {
            $this->emailTimestamp = $data['email_timestamp'];
        }
        if (isset($data['sid_token'])) {
            $this->sessionId = $data['sid_token'];
        }

        return $data;
    }

    public function getEmailList( $sessionId = null, $offset = 0 )
    {
        if ( $sessionId == null ) {
            if ($this->sessionId == null) {
                throw new GuerillaMailException( 'Session ID can\'t be null.' );
            }
            $sessionId = $this->sessionId;
        }

        $data = $this->doRequest( $sessionId, [
            'f'      => 'get_email_list',
            'offset' => $offset
        ] );

        $emails = [];
        if (isset($data['list'])) {
            foreach ($data['list'] as $email) {
                $emails[] = Mail::fromResponse($email);
            }
        }

        return $emails;
    }

    public function getEmail( $emailId, $sessionId = null )
    {
        if ( $emailId == null ) {
            throw new GuerillaMailException( 'Email ID can\'t be null.' );
        }

        $data = $this->doRequest( $sessionId, [
            'f'        => 'fetch_email',
            'email_id' => $emailId
        ] );

        if ($data == null || $data == []) {
            throw new GuerillaMailException('Not found: '.$emailId);
        }

        return Mail::fromResponse( $data );
    }

    public function setEmailAddress( $email, $sessionId = null )
    {
        if ( $email == null ) {
            throw new GuerillaMailException( 'Email can\'t be null.' );
        }

        return $this->doRequest( $sessionId, [
            'f'        => 'set_email_user',
            'email_user' => $email
        ] );
    }
}