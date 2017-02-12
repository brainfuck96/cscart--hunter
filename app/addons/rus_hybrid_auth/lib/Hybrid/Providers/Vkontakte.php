<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
*  (c) 2009-2015 HybridAuth authors | hybridauth.sourceforge.net/licenses.html
*/

/**
 * Hybrid_Providers_Vkontakte provider adapter based on OAuth2 protocol
 *
 * added by guiltar | https://github.com/guiltar
 *
 * @property OAuth2Client $api
 */

class Hybrid_Providers_Vkontakte extends Hybrid_Provider_Model_OAuth2
{
    // default permissions
    public $scope = "email";

    // default user fields map
    public $fields = array(
        // Old that saved for backward-compability
        'identifier'  => 'uid',
        'firstName'   => 'first_name',
        'lastName'    => 'last_name',
        'displayName' => 'screen_name',
        'gender'      => 'sex',
        'photoURL'    => 'photo_big',
        'home_town'   => 'home_town',
        'profileURL'  => 'domain',      // Will be converted in getUserByResponse()
        // New
        'nickname'    => 'nickname',
        'bdate'       => 'bdate',
        'timezone'    => 'timezone',
        'photo_rec'   => 'photo_rec',
        'domain'      => 'domain',
        'photo_max'   => 'photo_max',
        'home_phone'  => 'home_phone',
        'city'        => 'city',        // Will be converted in getUserByResponse()
        'country'     => 'country',     // Will be converted in getUserByResponse()
    );

    /**
     * IDp wrappers initialize
     */
    function initialize()
    {
        parent::initialize();

        // Provider api end-points
        $this->api->api_base_url   = 'https://api.vk.com/method/';
        $this->api->authorize_url  = "https://api.vk.com/oauth/authorize";
        $this->api->token_url      = "https://api.vk.com/oauth/token";
        if (!empty($this->config['fields']))
            $this->fields = $this->config['fields'];
    }

    function loginFinish()
    {
        $error = (array_key_exists('error',$_REQUEST))?$_REQUEST['error']:"";

        // check for errors
        if ( $error ){
            throw new Exception( "Authentication failed! {$this->providerId} returned an error: $error", 5 );
        }

        // try to authenticate user
        $code = (array_key_exists('code',$_REQUEST))?$_REQUEST['code']:"";

        try{
            $response = $this->api->authenticate( $code );
        }
        catch( Exception $e ){
            throw new Exception( "User profile request failed! {$this->providerId} returned an error: $e", 6 );
        }

        // check if authenticated
        if ( !property_exists($response,'user_id') || ! $this->api->access_token ){
            throw new Exception( "Authentication failed! {$this->providerId} returned an invalid access token.", 5 );
        }

        // store tokens
        $this->token( "access_token" , $this->api->access_token  );
        $this->token( "refresh_token", $this->api->refresh_token );
        $this->token( "expires_in"   , $this->api->access_token_expires_in );
        $this->token( "expires_at"   , $this->api->access_token_expires_at );

        // store user id. it is required for api access to Vkontakte
        Hybrid_Auth::storage()->set( "hauth_session.{$this->providerId}.user_id", $response->user_id );
        Hybrid_Auth::storage()->set(
            "hauth_session.{$this->providerId}.user_email",
            property_exists($response, 'email')
                ? $response->email
                : null
        );

        // set user connected locally
        $this->setUserConnected();
    }

    /**
     * load the user profile from the IDp api client
     */
    function getUserProfile()
    {
        // refresh tokens if needed
        $this->refreshToken();

        // Vkontakte requires user id, not just token for api access
        $params['uid'] = Hybrid_Auth::storage()->get( "hauth_session.{$this->providerId}.user_id" );
        $params['fields'] = implode(',', $this->fields);
        // ask vkontakte api for user infos

        $response = $this->api->api( 'getProfiles' , 'GET', $params);

        if (!isset( $response->response[0] ) || !isset( $response->response[0]->uid ) || isset( $response->error ) ){
            throw new Exception( "User profile request failed! {$this->providerId} returned an invalid response.", 6 );
        }

        // Fill datas
        $response = reset($response->response);
        foreach ($this->getUserByResponse($response, true) as $k => $v)
            $this->user->profile->$k = $v;

        // Additional data
        $this->user->profile->email = Hybrid_Auth::storage()->get( "hauth_session.{$this->providerId}.user_email" );

        return $this->user->profile;
    }

    /**
     * load the user contacts
     */
    function getUserContacts()
    {
        $params=array(
            'fields' => implode(',', $this->fields),
        );

        $response = $this->api->api('friends.get','GET',$params);

        if(empty($response) || empty($response->response)){
            return array();
        }

        $contacts = array();
        foreach( $response->response as $item ) {
            $contacts[] = $this->getUserByResponse($item);
        }

        return $contacts;
    }

    /**
     * @param object $response
     * @param bool   $withAdditionalRequests True to get some full fields like 'city' or 'country'
     *                                       (requires additional responses to vk api!)
     *
     * @return \Hybrid_User_Contact
     */
    function getUserByResponse($response, $withAdditionalRequests = false)
    {
        $user = new Hybrid_User_Contact();

        foreach ($this->fields as $field => $map)
            $user->$field = (property_exists($response,$map)) ? $response->$map : null;

        if (property_exists($user, 'profileURL') && !empty($user->profileURL)) {
            $user->profileURL = 'http://vk.com/' . $user->profileURL;
        }

        if (property_exists($user, 'gender')) {
            switch ($user->gender) {
                case 1: $user->gender = 'female'; break;
                case 2: $user->gender = 'male'; break;
                default: $user->gender = null; break;
            }
        }

        if (property_exists($user, 'bdate')) {
            $birthday = explode('.', $user->bdate);
            switch (count($birthday)) {
                case 3:
                    $user->birthDay   = (int) $birthday[0];
                    $user->birthMonth = (int) $birthday[1];
                    $user->birthYear  = (int) $birthday[2];
                    break;

                case 2:
                    $user->birthDay   = (int) $birthday[0];
                    $user->birthMonth = (int) $birthday[1];
                    break;
            }
        }

        if (property_exists($user, 'city') && $withAdditionalRequests) {
            $params     = array(
                'city_ids' => $user->city,
            );
            $cities     = $this->api->api( 'database.getCitiesById' , 'GET', $params);
            $city       = reset($cities);
            if (is_array($city)) $city = reset($city);
            if (is_object($city) || is_string($city)) {
                $user->city = property_exists($city, 'name') ? $city->name : null;
            }
        }

        if (property_exists($user, 'country') && $withAdditionalRequests) {
            $params        = array(
                'country_ids' => $user->country,
            );
            $countries     = $this->api->api( 'database.getCountriesById' , 'GET', $params);
            $country       = reset($countries);
            if (is_array($country)) $country = reset($country);
            if (is_object($country) || is_string($country)) {
                $user->country = property_exists($country, 'name') ? $country->name : null;
            }
        }

        return $user;
    }
}
