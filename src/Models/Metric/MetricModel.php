<?php
namespace Fortifi\Sdk\Models\Metric;

use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Metrics\Endpoints\MetricEndpoint;
use Fortifi\FortifiApi\Metrics\Payloads\GetMetricsPayload;
use Fortifi\FortifiApi\Metrics\Payloads\UpdateMetricPayload;
use Fortifi\FortifiApi\Metrics\Responses\MetricsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class MetricModel extends FortifiApiModel
{
  /**
   * @param $object
   * @param $metric
   * @param $count
   * @param $timestamp (optional)
   *
   * @return BoolResponse
   */
  public function update(
    $object, $metric, $count, $timestamp = null
  )
  {
    $payload = new UpdateMetricPayload();
    $payload->object = $object;
    $payload->metric = $metric;
    $payload->count = $count;
    $payload->timestamp = $timestamp;

    $ep = MetricEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param $object
   * @param $start
   * @param $end      (optional)
   * @param $metric   (optional)
   * @param $interval (optional)
   *
   * @return MetricsResponse
   */
  public function get(
    $object, $start, $end = null, $metric = null, $interval = null
  )
  {
    $payload = new GetMetricsPayload();
    $payload->object = $object;
    $payload->start = $start;
    $payload->end = $end;
    $payload->metric = $metric;
    $payload->interval = $interval;

    $ep = MetricEndpoint::bound($this->getApi());
    return $ep->get($payload)->get();
  }
}
