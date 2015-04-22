<?php
namespace Fortifi\Sdk;

use Fortifi\FortifiApi\FortifiApi;
use Fortifi\FortifiApi\Generic\CookieReference;
use Fortifi\Sdk\Models\Customer;
use Fortifi\Sdk\Models\Visitor;
use Fortifi\Sdk\OAuth\FortifiAccessToken;
use Fortifi\Sdk\OAuth\FortifiProvider;
use Fortifi\Sdk\OAuth\ServiceAccountGrant;
use Fortifi\Sdk\OAuth\TokenStorage\TmpFileTokenStorage;
use Fortifi\Sdk\OAuth\TokenStorage\TokenStorageInterface;

final class Fortifi
{
  public static $apiHost = 'api.fortifi.co';

  protected $_apiScheme = 'http';

  /**
   * @var FortifiApi
   */
  protected $_api;
  protected $_orgFid;
  protected $_apiUser;
  protected $_apiKey;
  protected $_userAgent;
  protected $_userLanguage;
  protected $_clientIp;
  /**
   * @var TokenStorageInterface
   */
  protected $_tokenStorage;
  protected $_tokenKey;
  protected $_token;
  /**
   * @var FortifiProvider
   */
  protected $_oAuthProvider;

  protected function __construct()
  {
    $this->_userAgent = idx($_SERVER, 'HTTP_USER_AGENT');
    $this->_userLanguage = idx($_SERVER, 'HTTP_ACCEPT_LANGUAGE');
    $this->_clientIp = $this->getRequestClientIp();
  }

  public static function getInstance(
    $orgFid, $apiUser, $apiKey, $tokenStorage = null, $scheme = 'http'
  )
  {
    $fortifi = new self();
    $fortifi->_apiScheme = $scheme;
    $fortifi->_orgFid = $orgFid;
    $fortifi->_apiUser = $apiUser;
    $fortifi->_apiKey = $apiKey;
    $fortifi->_tokenKey = substr(md5($apiKey), 0, 6);

    if($tokenStorage === null)
    {
      $tokenStorage = new TmpFileTokenStorage();
    }
    $fortifi->_tokenStorage = $tokenStorage;

    $url = $fortifi->_apiScheme . '://' . static::$apiHost;

    $fortifi->_api = new FortifiApi($url);
    $fortifi->_api->setOrgFid($orgFid);

    $fortifi->_oAuthProvider = new FortifiProvider();
    $fortifi->_oAuthProvider->setOrgFid($orgFid);
    $fortifi->_oAuthProvider->setFortifiUrl($url);

    return $fortifi;
  }

  public function getApi()
  {
    $this->_api->setAccessToken($this->getToken()->accessToken);
    return $this->_api;
  }

  public function getAuthProvider()
  {
    return $this->_oAuthProvider;
  }

  public function getToken($fresh = false)
  {
    if($fresh || $this->_token === null)
    {
      $token = $fresh ? null : $this->_tokenStorage->retrieveToken(
        $this->_tokenKey
      );
      if(empty($token))
      {
        $token = $this->_oAuthProvider->getAccessToken(
          new ServiceAccountGrant($this->_apiUser, $this->_apiKey),
          ['source' => 'fortifi.sdk.php']
        );
        $this->_tokenStorage->storeToken($this->_tokenKey, $token);
      }
      $this->_token = $token;
    }
    return new FortifiAccessToken(['access_token' => $this->_token]);
  }

  public function setUserAgent($userAgent)
  {
    $this->_userAgent = $userAgent;
    return $this;
  }

  public function getRequestClientIp()
  {
    static $ip;
    $ipKeys = [
      'HTTP_CLIENT_IP',
      'HTTP_X_FORWARDED_FOR',
      'HTTP_X_FORWARDED',
      'HTTP_X_CLUSTER_CLIENT_IP',
      'HTTP_FORWARDED_FOR',
      'HTTP_FORWARDED',
      'REMOTE_ADDR'
    ];
    if($ip === null)
    {
      foreach($ipKeys as $ipKey)
      {
        $ipString = idx($_SERVER, $ipKey);
        if($ipString !== null)
        {
          foreach(explode(",", $ipString) as $ip)
          {
            if(filter_var($ip, FILTER_VALIDATE_IP) !== false)
            {
              return $ip;
            }
          }
        }
      }
      $ip = "";
    }
    return $ip;
  }

  public function setClientIp($ip)
  {
    $this->_clientIp = $ip;
    return $this;
  }

  /**
   * @return null
   */
  public function getUserAgent()
  {
    return $this->_userAgent;
  }

  /**
   * @return string
   */
  public function getUserLanguage()
  {
    return $this->_userLanguage;
  }

  /**
   * @param $userLanguage
   *
   * @return $this
   */
  public function setUserLanguage($userLanguage)
  {
    $this->_userLanguage = $userLanguage;
    return $this;
  }

  /**
   * @return string
   */
  public function getClientIp()
  {
    return $this->_clientIp;
  }

  /**
   * Retrieve the current visitor ID from the $_COOKIE global
   *
   * @return string|null
   */
  public function getVisitorIdCookie()
  {
    return idx($_COOKIE, CookieReference::VISITOR_ID);
  }

  /**
   * @param string $visitorId
   *
   * @return Visitor
   */
  public function visitor($visitorId = null)
  {
    if($visitorId === null)
    {
      $visitorId = $this->getVisitorIdCookie();
    }
    return Visitor::newInstance($this)
      ->setVisitorId($visitorId);
  }

  /**
   * @param string $customerFid
   * @param string $visitorId
   *
   * @return Customer
   */
  public function customer($customerFid = null, $visitorId = null)
  {
    if($visitorId === null)
    {
      $visitorId = $this->getVisitorIdCookie();
    }

    return Customer::newInstance($this)
      ->setVisitorId($visitorId)
      ->setCustomerFid($customerFid);
  }
}
