<?php
namespace Fortifi\FortifiApi\Foundation\Endpoints;

use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Packaged\Api\Abstracts\AbstractEndpoint;
use Packaged\Api\ApiRequest;
use Packaged\Api\HttpVerb;
use Packaged\Api\Interfaces\ApiPayloadInterface;

abstract class AbstractFortifiEndpoint extends AbstractEndpoint
{
  /**
   * @param ApiPayloadInterface $payload
   * @param string              $path
   * @param string              $verb
   *
   * @return ApiRequest|FortifiApiRequestInterface
   */
  protected function _createRequest(
    ApiPayloadInterface $payload = null, $path = null, $verb = HttpVerb::POST
  )
  {
    return parent::_createRequest($payload, $path, $verb);
  }

  /**
   * Retrieve the path for the endpoint
   *
   * @return string
   */
  public function getPath()
  {
    return '';
  }
}
