<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateActionOptionEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\CreateAffiliateActionOptionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\UpdateAffiliateActionOptionPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionOptionResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionOptionsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\CreateAffiliateActionOptionResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateActionOptionModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateActionOptionsResponse|FortifiApiRequestInterface
   */
  public function all($limit = 10, $page = 1, $sortField = null,
    $sortDirection = null, $showDeleted = false, $filter = null
  )
  {
    $payload                = new PaginatedDataNodePayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->filter        = $filter;

    $ep = AffiliateActionOptionEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliateActionOptionResponse|FortifiApiRequestInterface
   */
  public function retrieve($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliateActionOptionEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $actionFid
   * @param string $key
   * @param string $name
   * @param string $visibility
   * @param string $valueType
   * @param string $values
   * @param string $defaultValue
   * @param string $urlType
   *
   * @return FortifiApiRequestInterface|CreateAffiliateActionOptionResponse
   */
  public function create($actionFid, $key, $name, $visibility, $valueType,
    $values, $defaultValue, $urlType
  )
  {
    $payload               = new CreateAffiliateActionOptionPayload();
    $payload->actionFid    = $actionFid;
    $payload->key          = $key;
    $payload->name         = $name;
    $payload->visibility   = $visibility;
    $payload->valueType    = $valueType;
    $payload->values       = $values;
    $payload->defaultValue = $defaultValue;
    $payload->urlType      = $urlType;

    $ep = AffiliateActionOptionEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $actionFid
   * @param string $key
   * @param string $name
   * @param string $visibility
   * @param string $valueType
   * @param string $values
   * @param string $defaultValue
   * @param string $urlType
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($actionFid, $fid, $key, $name, $visibility,
    $valueType, $values, $defaultValue, $urlType
  )
  {
    $payload               = new UpdateAffiliateActionOptionPayload();
    $payload->fid          = $fid;
    $payload->actionFid    = $actionFid;
    $payload->key          = $key;
    $payload->name         = $name;
    $payload->visibility   = $visibility;
    $payload->valueType    = $valueType;
    $payload->values       = $values;
    $payload->defaultValue = $defaultValue;
    $payload->urlType      = $urlType;

    $ep = AffiliateActionOptionEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }
}
