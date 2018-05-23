<?php
namespace Fortifi\FortifiApi;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;
use GuzzleHttp\Exception\ConnectException;
use Packaged\Api\Abstracts\AbstractApi;
use Packaged\Api\HttpVerb;
use Packaged\Api\Interfaces\ApiRequestInterface;
use Psr\Http\Message\ResponseInterface;

class FortifiApi extends AbstractApi
{
  /**
   * @var string
   */
  protected $_url;
  /**
   * @var string
   */
  protected $_accessToken;

  /**
   * @var string
   */
  protected $_lastRequestId;
  protected $_orgFid;
  protected $_disableNesting = false;
  protected $_shortNesting = false;
  protected $_disableLogging = false;

  /**
   * @param string $apiUrl e.g. https://org-comp-1234-abcde.fortifi.co/
   */
  public function __construct($apiUrl)
  {
    $this->_url = $apiUrl;
  }

  /**
   * Retrieve the url for the API
   *
   * @return string
   */
  public function getUrl()
  {
    return $this->_url;
  }

  /**
   * Set the current organisation FID
   *
   * @param $fid
   *
   * @return $this
   */
  public function setOrgFid($fid)
  {
    $this->_orgFid = $fid;
    return $this;
  }

  /**
   * Retrieve the current organisation ID
   *
   * @return string|null
   */
  public function getOrgFid()
  {
    return $this->_orgFid;
  }

  /**
   * Set the access token to use for this request
   *
   * @param $token
   *
   * @return $this
   */
  public function setAccessToken($token)
  {
    $this->_accessToken = $token;
    return $this;
  }

  /**
   * Process the raw response from api calls
   *
   * @param $response
   *
   * @return mixed
   */
  protected function _processResponse($response)
  {
    if($response instanceof ResponseInterface)
    {
      $this->_lastRequestId = $response->getHeader('X-Fort-Request-Id');
    }
    return $response;
  }

  /**
   * @param \Packaged\Api\Interfaces\ApiRequestInterface $request
   *
   * @return \Packaged\Api\Interfaces\ApiResponseInterface
   */
  public function processRequest(ApiRequestInterface $request)
  {
    $maxAttempts = 2;
    $ex = null;
    $startTime = time();
    for($i = 0; $i < $maxAttempts; $i++)
    {
      try
      {
        $ex = null;
        $response = parent::processRequest($request);
        break;
      }
      catch(ConnectException $e)
      {
        usleep(10000); // 10ms sleep on failures
        $ex = $e;
        if((time() - $startTime) > 10) // wait no more than 10 seconds to get a connection
        {
          break;
        }
      }
    }
    if($ex)
    {
      throw $ex;
    }

    if($response instanceof FortifiApiResponse)
    {
      $response->setRequestId($this->_lastRequestId);
    }
    return $response;
  }

  /**
   * @param ApiRequestInterface $request
   *
   * @return array
   */
  protected function _makeOptions(ApiRequestInterface $request)
  {
    $headers = $options = [];

    if($request->getVerb() == HttpVerb::POST)
    {
      $options['json'] = $request->getPostData();
    }

    if($this->_accessToken !== null)
    {
      $headers['Authorization'] = 'Bearer ' . $this->_accessToken;
    }

    if($this->_orgFid !== null)
    {
      $headers['X-Fortifi-Org'] = $this->_orgFid;
    }

    if($this->_disableNesting)
    {
      $headers['Disable-Nesting'] = "true";
    }

    if($this->_disableLogging)
    {
      $headers['Disable-Logging'] = "true";
    }

    if($this->_shortNesting)
    {
      $headers['Short-Nesting'] = "true";
    }

    if(!empty($headers))
    {
      $options['headers'] = $headers;
    }

    return $options;
  }

  /**
   * DO NOT Automatically load relationships
   *
   * @return $this
   */
  public function disableNesting()
  {
    $this->_disableNesting = true;
    return $this;
  }

  /**
   * Automatically load relationships
   *
   * @param bool $shortNesting - Return Limited DataNodes (id,fid,displayName)
   *
   * @return $this
   */
  public function enableNesting($shortNesting = false)
  {
    $this->_disableNesting = false;
    $this->_shortNesting = $shortNesting;
    return $this;
  }

  /**
   * Check auto load relationship status
   *
   * @return bool
   */
  public function isNestingEnabled()
  {
    return $this->_disableNesting !== false;
  }

  /**
   * DO NOT Log API Call (Fortifi Side)
   *
   * @return $this
   */
  public function disableLogging()
  {
    $this->_disableLogging = true;
    return $this;
  }

  /**
   * Log API Call
   *
   * @return $this
   */
  public function enableLogging()
  {
    $this->_disableLogging = false;
    return $this;
  }

  /**
   * Is Fortifi Logging Enabled
   *
   * @return bool
   */
  public function isLoggingEnabled()
  {
    return $this->_disableLogging !== false;
  }
}
