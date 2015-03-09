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
   * @param string $object    FID of the object to retrieve metrics from
   * @param string $metric    click, lead, sale, ...
   * @param int    $count     number to increment by
   * @param int    $timestamp (optional) microtime
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
   * @param string $object   FID of the object to retrieve metrics from
   * @param int    $start    microtime
   * @param int    $end      (optional) microtime
   * @param string $metric   (optional) click, lead, sale, ...
   * @param string $interval (optional) MetricInterval constant
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
