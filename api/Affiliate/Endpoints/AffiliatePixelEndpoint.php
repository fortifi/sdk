<?php
namespace Fortifi\FortifiApi\Affiliate\Endpoints;

use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\CreatePixelPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\ListPixelPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\PixelApprovalPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\RetrievePendingPixelsPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\UpdatePixelPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelHistoriesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelPoliciesResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelPolicyResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelsResponse;
use Fortifi\FortifiApi\Foundation\Endpoints\AbstractFortifiEndpoint;
use Fortifi\FortifiApi\Foundation\Exceptions\NotFoundException;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\ToggleFidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;

class AffiliatePixelEndpoint extends AbstractFortifiEndpoint
{
  protected $_path = '/affiliate/pixels/';

  /**
   * @param ListPixelPayload $payload
   *
   * @return FortifiApiRequestInterface|PixelPoliciesResponse
   */
  public function all(ListPixelPayload $payload)
  {
    return self::_createRequest($payload, 'list');
  }

  /**
   * @param CreatePixelPayload $payload
   *
   * @return FortifiApiRequestInterface|PixelPolicyResponse
   */
  public function create(CreatePixelPayload $payload)
  {
    return self::_createRequest($payload, 'create');
  }

  /**
   * @param UpdatePixelPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   * @throws NotFoundException
   */
  public function update(UpdatePixelPayload $payload)
  {
    return self::_createRequest($payload, 'update');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|PixelPolicyResponse
   * @throws NotFoundException
   */
  public function retrieve(FidPayload $payload)
  {
    return self::_createRequest($payload, 'retrieve');
  }

  /**
   * @param PixelApprovalPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   * @throws NotFoundException
   */
  public function approve(PixelApprovalPayload $payload)
  {
    return self::_createRequest($payload, 'approve');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   * @throws NotFoundException
   */
  public function delete(FidPayload $payload)
  {
    return self::_createRequest($payload, 'delete');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   * @throws NotFoundException
   */
  public function restore(FidPayload $payload)
  {
    return self::_createRequest($payload, 'restore');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|PixelHistoriesResponse
   * @throws NotFoundException
   */
  public function history(FidPayload $payload)
  {
    return self::_createRequest($payload, 'history');
  }

  /**
   * @param ToggleFidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   * @throws NotFoundException
   */
  public function setState(ToggleFidPayload $payload)
  {
    return self::_createRequest($payload, 'set-state');
  }

  /**
   * @param RetrievePendingPixelsPayload $payload
   *
   * @return FortifiApiRequestInterface|PixelsResponse
   */
  public function getPending(RetrievePendingPixelsPayload $payload)
  {
    return self::_createRequest($payload, 'get-pending');
  }
}
