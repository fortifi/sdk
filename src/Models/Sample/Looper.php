<?php
namespace Fortifi\Sdk\Models\Sample;

use Fortifi\FortifiApi\Sample\Payloads\SampleLoopPayload;
use Fortifi\FortifiApi\Sample\Responses\SampleLoopResponse;
use Fortifi\FortifiApi\Sample\SampleEndpoint;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class Looper extends FortifiApiModel
{
  /**
   * @param string $id
   * @param string $name
   * @param string $email
   *
   * @return SampleLoopResponse
   */
  public function run($id, $name, $email)
  {
    $payload        = new SampleLoopPayload();
    $payload->id    = $id;
    $payload->name  = $name;
    $payload->email = $email;

    $ep = SampleEndpoint::bound($this->getApi());
    return $ep->runLoop($payload)->get();
  }
}
