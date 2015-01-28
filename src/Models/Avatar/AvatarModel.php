<?php
namespace Fortifi\Sdk\Models\Avatar;

use Fortifi\FortifiApi\Avatar\Endpoints\AvatarEndpoint;
use Fortifi\FortifiApi\Avatar\Payloads\CreateAvatarPayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AvatarModel extends FortifiApiModel
{
  /**
   * @param $fid
   * @param $sourceType
   * @param $source
   *
   * @return BoolResponse
   */
  public function create($fid, $sourceType, $source)
  {
    $payload = new CreateAvatarPayload();
    $payload->fid = $fid;
    $payload->sourceType = $sourceType;
    $payload->source = $source;

    $ep = AvatarEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }
}
