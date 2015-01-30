<?php
namespace Fortifi\Sdk\Models\Meta;

use Fortifi\FortifiApi\Meta\Payloads\GetMetaDataPayload;
use Fortifi\FortifiApi\Meta\Payloads\MetaDataPayload;
use Fortifi\FortifiApi\Meta\Endpoints\MetaDataEndpoint;
use Fortifi\FortifiApi\Meta\Responses\MetaDataResponse;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class MetaModel extends FortifiApiModel
{
  /**
   * @param string       $objectFid
   * @param array|string $filter
   *
   * @return MetaDataResponse|FortifiApiRequestInterface
   */
  public function getMetaData($objectFid, $filter = null)
  {
    $payload            = new GetMetaDataPayload();
    $payload->objectFid = $objectFid;
    $payload->filter    = $filter;

    $ep = MetaDataEndpoint::bound($this->getApi());
    return $ep->getMetaData($payload)->get();
  }

  /**
   * @param $objectFid
   * @param $key
   * @param $value
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setMetaDatum($objectFid, $key, $value)
  {
    $payload            = new MetaDataPayload();
    $payload->objectFid = $objectFid;
    $payload->key       = $key;
    $payload->value     = $value;

    $ep = MetaDataEndpoint::bound($this->getApi());
    return $ep->setMetaData($payload)->get();
  }
}
