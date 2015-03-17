<?php
namespace Fortifi\Sdk\Models\Payment;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Payment\Endpoints\PaymentAccountEndpoint;
use Fortifi\FortifiApi\Payment\Payloads\Account\CreatePaymentAccountPayload;
use Fortifi\FortifiApi\Payment\Payloads\Account\GetPaymentAccountPayload;
use Fortifi\FortifiApi\Payment\Payloads\SetConfigurationPayload;
use Fortifi\FortifiApi\Payment\Responses\Account\PaymentAccountResponse;
use Fortifi\FortifiApi\Payment\Responses\Account\PaymentAccountsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class PaymentAccountModel extends FortifiApiModel
{
  /**
   * @param $ownerFid
   * @param $serviceFid
   * @param $configuration
   *
   * @return PaymentAccountResponse
   */
  public function create($ownerFid, $serviceFid, $configuration)
  {
    $payload = new CreatePaymentAccountPayload();
    $payload->ownerFid = $ownerFid;
    $payload->serviceFid = $serviceFid;
    $payload->configuration = $configuration;

    $ep = PaymentAccountEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param $ownerFid
   *
   * @return PaymentAccountsResponse
   */
  public function all($ownerFid)
  {
    $payload = new FidPayload();
    $payload->fid = $ownerFid;

    $ep = PaymentAccountEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param $ownerFid
   * @param $processor
   *
   * @return PaymentAccountsResponse
   */
  public function getByProcessor($ownerFid, $processor)
  {
    $payload = new GetPaymentAccountPayload();
    $payload->fid = $ownerFid;
    $payload->processor = $processor;

    $ep = PaymentAccountEndpoint::bound($this->getApi());
    return $ep->getByProcessor($payload)->get();
  }

  /**
   * @param $accountFid
   *
   * @return PaymentAccountResponse
   */
  public function retrieve($accountFid)
  {
    $payload = new FidPayload();
    $payload->fid = $accountFid;

    $ep = PaymentAccountEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param $accountFid
   *
   * @return BoolResponse
   */
  public function archive($accountFid)
  {
    $payload = new FidPayload();
    $payload->fid = $accountFid;

    $ep = PaymentAccountEndpoint::bound($this->getApi());
    return $ep->archive($payload)->get();
  }

  /**
   * @param $accountFid
   *
   * @return BoolResponse
   */
  public function restore($accountFid)
  {
    $payload = new FidPayload();
    $payload->fid = $accountFid;

    $ep = PaymentAccountEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }

  /**
   * @param $accountFid
   * @param $configuration
   *
   * @return BoolResponse
   */
  public function setConfiguration($accountFid, $configuration)
  {
    $payload = new SetConfigurationPayload();
    $payload->fid = $accountFid;
    $payload->configuration = $configuration;

    $ep = PaymentAccountEndpoint::bound($this->getApi());
    return $ep->setConfiguration($payload)->get();
  }
}
