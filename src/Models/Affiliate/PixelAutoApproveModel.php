<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliatePixelAutoApprovalEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Pixels\UpdatePixelAutoApprovalPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelAutoApprovalsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class PixelAutoApproveModel extends FortifiApiModel
{

  /**
   * @return PixelAutoApprovalsResponse
   */
  public function all()
  {
    $ep = AffiliatePixelAutoApprovalEndpoint::bound($this->getApi());
    return $ep->all()->get();
  }

  /**
   * @param string $type
   * @param bool $approve
   *
   * @return PixelAutoApprovalsResponse
   */
  public function approve($type, $approve)
  {
    $payload = new UpdatePixelAutoApprovalPayload();
    $payload->type = $type;
    $payload->approve = $approve;

    $ep = AffiliatePixelAutoApprovalEndpoint::bound($this->getApi());
    return $ep->approve($payload)->get();
  }
}
