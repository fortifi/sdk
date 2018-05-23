<?php
namespace Fortifi\FortifiApi\Affiliate\Endpoints;

use Fortifi\FortifiApi\Affiliate\Payloads\Action\CreateAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\PostActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\ReversalPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\SetKeyAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\SetTypeAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Action\UpdateAffiliateActionPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\CreateAffiliateActionResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Action\PostActionResponse;
use Fortifi\FortifiApi\Foundation\Endpoints\AbstractFortifiEndpoint;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\GetByEnumPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\RawArrayResponse;
use Packaged\Api\HttpVerb;

class AffiliateActionEndpoint extends AbstractFortifiEndpoint
{
  protected $_path = '/affiliate/action/';

  /**
   * @param PaginatedDataNodePayload $payload
   *
   * @return FortifiApiRequestInterface|AffiliateActionsResponse
   */
  public function all(PaginatedDataNodePayload $payload)
  {
    return self::_createRequest($payload, 'list');
  }

  /**
   * @param string $type //AffiliateActionType
   *
   * @return FortifiApiRequestInterface|RawArrayResponse
   */
  public function unique($type = null)
  {
    if($type === null)
    {
      return self::_createRequest(null, 'unique', HttpVerb::GET);
    }
    else
    {
      $payload = new GetByEnumPayload();
      $payload->value = $type;
      return self::_createRequest($payload, 'unique', HttpVerb::POST);
    }
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|AffiliateActionResponse
   */
  public function retrieve(FidPayload $payload)
  {
    return self::_createRequest($payload, 'retrieve');
  }

  /**
   * @param CreateAffiliateActionPayload $payload
   *
   * @return FortifiApiRequestInterface|CreateAffiliateActionResponse
   */
  public function create(CreateAffiliateActionPayload $payload)
  {
    return self::_createRequest($payload, 'create');
  }

  /**
   * @param UpdateAffiliateActionPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update(UpdateAffiliateActionPayload $payload)
  {
    return self::_createRequest($payload, 'update');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete(FidPayload $payload)
  {
    return self::_createRequest($payload, 'delete');
  }

  /**
   * @param SetTypeAffiliateActionPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setType(SetTypeAffiliateActionPayload $payload)
  {
    return self::_createRequest($payload, 'set-type');
  }

  /**
   * @param SetKeyAffiliateActionPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setKey(SetKeyAffiliateActionPayload $payload)
  {
    return self::_createRequest($payload, 'set-key');
  }

  /**
   * @param PostActionPayload $payload
   *
   * @return FortifiApiRequestInterface|PostActionResponse
   */
  public function post(PostActionPayload $payload)
  {
    return self::_createRequest($payload, 'post');
  }

  /**
   * @param ReversalPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function reverse(ReversalPayload $payload)
  {
    return self::_createRequest($payload, 'reverse');
  }
}
