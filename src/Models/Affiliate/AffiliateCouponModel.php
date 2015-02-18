<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateCouponEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Coupons\CreateAffiliateCouponPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Coupons\UpdateAffiliateCouponPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Coupons\AffiliateCouponCodePayload;
use Fortifi\FortifiApi\Affiliate\Responses\Coupons\AffiliateCouponResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Coupons\AffiliateCouponsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateCouponModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateCouponsResponse|FortifiApiRequestInterface
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

    $ep = AffiliateCouponEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $couponCode
   *
   * @return AffiliateCouponResponse|FortifiApiRequestInterface
   */
  public function retrieve($couponCode)
  {
    $payload             = new AffiliateCouponCodePayload();
    $payload->couponCode = $couponCode;

    $ep = AffiliateCouponEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $couponCode
   * @param string $affiliateFid
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function create($couponCode, $affiliateFid,
    $campaignHash, $sid1, $sid2, $sid3
  )
  {
    $payload               = new CreateAffiliateCouponPayload();
    $payload->couponCode   = $couponCode;
    $payload->affiliateFid = $affiliateFid;
    $payload->campaignHash = $campaignHash;
    $payload->sid1         = $sid1;
    $payload->sid2         = $sid2;
    $payload->sid3         = $sid3;

    $ep = AffiliateCouponEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $couponCode
   * @param string $campaignHash
   * @param string $sid1
   * @param string $sid2
   * @param string $sid3
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($couponCode, $campaignHash,
    $sid1, $sid2, $sid3
  )
  {
    $payload               = new UpdateAffiliateCouponPayload();
    $payload->couponCode   = $couponCode;
    $payload->campaignHash = $campaignHash;
    $payload->sid1         = $sid1;
    $payload->sid2         = $sid2;
    $payload->sid3         = $sid3;

    $ep = AffiliateCouponEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $couponCode
   *
   * @return AffiliateCouponResponse|FortifiApiRequestInterface
   */
  public function delete($couponCode)
  {
    $payload             = new AffiliateCouponCodePayload();
    $payload->couponCode = $couponCode;

    $ep = AffiliateCouponEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }
}
