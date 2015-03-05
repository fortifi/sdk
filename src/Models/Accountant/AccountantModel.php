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
   *
   * @return AccountsResponse
   */
  public function all($objectFid)
  {
    $payload = new ListAccountsPayload();
    $payload->objectFid = $objectFid;
    $ep = AccountantEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
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
    $ep = AccountantEndpoint::bound($this->getApi());
    return $ep->transactions($payload)->get();
  }
}
