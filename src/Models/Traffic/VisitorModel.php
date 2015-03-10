<?php
namespace Fortifi\Sdk\Models\Traffic;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Traffic\Endpoints\VisitorEndpoint;
use Fortifi\FortifiApi\Traffic\Responses\VisitorResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class VisitorModel extends FortifiApiModel
{
  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|VisitorResponse
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = VisitorEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }
}
