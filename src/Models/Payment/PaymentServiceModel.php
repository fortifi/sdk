<?php
namespace Fortifi\Sdk\Models\Payment;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\GetByEnumPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Payloads\ToggleFidPayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Payment\Endpoints\PaymentServiceEndpoint;
use Fortifi\FortifiApi\Payment\Enums\PaymentServiceDirection;
use Fortifi\FortifiApi\Payment\Enums\PaymentServiceProcessor;
use Fortifi\FortifiApi\Payment\Payloads\Services\CreatePaymentServicePayload;
use Fortifi\FortifiApi\Payment\Payloads\Services\SetPaymentServiceRequiredFormsPayload;
use Fortifi\FortifiApi\Payment\Payloads\SetConfigurationPayload;
use Fortifi\FortifiApi\Payment\Responses\Services\PaymentServiceResponse;
use Fortifi\FortifiApi\Payment\Responses\Services\PaymentServicesResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class PaymentServiceModel extends FortifiApiModel
{
  /**
   * @param       $name
   * @param       $direction
   * @param       $processor
   * @param       $configuration
   * @param bool  $selectable
   * @param array $requiredForms
   * @param bool  $enabled
   *
   * @return PaymentServiceResponse
   */
  public function create(
    $name, $direction, $processor, $configuration, $selectable = false,
    array $requiredForms = [], $enabled = true
  )
  {
    $payload = new CreatePaymentServicePayload();
    $payload->name = $name;
    $payload->direction = $direction;
    $payload->processor = $processor;
    $payload->configuration = $configuration;
    $payload->selectable = $selectable;
    $payload->requiredForms = $requiredForms;
    $payload->enabled = $enabled;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param null $limit
   * @param null $page
   * @param null $sortField
   * @param null $sortDirection
   * @param null $showDeleted
   * @param null $filter
   *
   * @return PaymentServicesResponse
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = null, $filter = null
  )
  {
    $payload = new PaginatedDataNodePayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;
    $payload->filter = $filter;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $processor
   *
   * @return PaymentServicesResponse
   */
  public function getByProcessor(
    $processor = PaymentServiceProcessor::BLACKHOLE
  )
  {
    $payload = new GetByEnumPayload();
    $payload->value = $processor;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->getByProcessor($payload)->get();
  }

  /**
   * @param string $direction
   *
   * @return PaymentServicesResponse
   */
  public function getByDirection(
    $direction = PaymentServiceDirection::INBOUND
  )
  {
    $payload = new GetByEnumPayload();
    $payload->value = $direction;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->getByDirection($payload)->get();
  }

  /**
   * @param $serviceFid
   *
   * @return PaymentServiceResponse
   */
  public function retrieve($serviceFid)
  {
    $payload = new FidPayload();
    $payload->fid = $serviceFid;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param $serviceFid
   *
   * @return BoolResponse
   */
  public function archive($serviceFid)
  {
    $payload = new FidPayload();
    $payload->fid = $serviceFid;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->archive($payload)->get();
  }

  /**
   * @param $serviceFid
   *
   * @return BoolResponse
   */
  public function restore($serviceFid)
  {
    $payload = new FidPayload();
    $payload->fid = $serviceFid;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }

  /**
   * @param $serviceFid
   *
   * @return BoolResponse
   */
  public function enable($serviceFid)
  {
    $payload = new FidPayload();
    $payload->fid = $serviceFid;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->enable($payload)->get();
  }

  /**
   * @param $serviceFid
   *
   * @return BoolResponse
   */
  public function disable($serviceFid)
  {
    $payload = new FidPayload();
    $payload->fid = $serviceFid;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->disable($payload)->get();
  }

  /**
   * @param      $serviceFid
   * @param bool $selectable
   *
   * @return BoolResponse
   */
  public function setSelectable($serviceFid, $selectable = true)
  {
    $payload = new ToggleFidPayload();
    $payload->fid = $serviceFid;
    $payload->state = $selectable;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->setSelectable($payload)->get();
  }

  /**
   * @param $serviceFid
   * @param $configuration
   *
   * @return BoolResponse
   */
  public function setConfiguration($serviceFid, $configuration)
  {
    $payload = new SetConfigurationPayload();
    $payload->fid = $serviceFid;
    $payload->configuration = $configuration;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->setConfiguration($payload)->get();
  }

  /**
   * @param       $serviceFid
   * @param array $forms
   *
   * @return BoolResponse
   */
  public function setRequiredForms($serviceFid, array $forms = [])
  {
    $payload = new SetPaymentServiceRequiredFormsPayload();
    $payload->fid = $serviceFid;
    $payload->requiredForms = $forms;

    $ep = PaymentServiceEndpoint::bound($this->getApi());
    return $ep->setRequiredForms($payload)->get();
  }
}
