<?php
namespace Fortifi\Sdk\Models\Accountant;

use Fortifi\FortifiApi\Accountant\Endpoints\AccountantEndpoint;
use Fortifi\FortifiApi\Accountant\Payloads\ListAccountsPayload;
use Fortifi\FortifiApi\Accountant\Payloads\ListAccountTransactionsPayload;
use Fortifi\FortifiApi\Accountant\Responses\AccountsResponse;
use Fortifi\FortifiApi\Accountant\Responses\AccountTransactionsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AccountantModel extends FortifiApiModel
{
  /**
   * @param $objectFid
   * @param $accountType
   *
   * @return AccountsResponse
   */
  public function all($objectFid, $accountType = null)
  {
    $payload = new ListAccountsPayload();
    $payload->objectFid = $objectFid;
    $payload->accountType = $accountType;
    return AccountantEndpoint::bound($this->getApi())->all($payload);
  }

  /**
   * @param $accountFid
   * @param $startTime
   * @param $endTime
   *
   * @return AccountTransactionsResponse
   */
  public function transactions($accountFid, $startTime, $endTime)
  {
    $payload = new ListAccountTransactionsPayload();
    $payload->accountFid = $accountFid;
    $payload->startTime = $startTime;
    $payload->endTime = $endTime;
    return AccountantEndpoint::bound($this->getApi())->transactions($payload);
  }
}
