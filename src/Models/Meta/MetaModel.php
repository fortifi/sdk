<?php
namespace Fortifi\Sdk\Models\Meta;

use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Meta\Endpoints\MetaDataEndpoint;
use Fortifi\FortifiApi\Meta\Payloads\GetMetaDataPayload;
use Fortifi\FortifiApi\Meta\Payloads\MetaDataPayload;
use Fortifi\FortifiApi\Meta\Responses\MetaDataResponse;
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
    $payload = new GetMetaDataPayload();
    $payload->objectFid = $objectFid;
    $payload->filter = $filter;

    $ep = MetaDataEndpoint::bound($this->getApi());
    return $ep->getMetaData($payload)->get();
  }

  /**
   * @param string $objectFid
   * @param string $key
   * @param string $value
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setMetaData($objectFid, $key, $value)
  {
    $payload = new MetaDataPayload();
    $payload->objectFid = $objectFid;
    $payload->key = $key;
    $payload->value = $value;

    $ep = MetaDataEndpoint::bound($this->getApi());
    return $ep->setMetaData($payload)->get();
  }
}
