<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateDailyMetricEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\DailyMetrics\AffiliateDailyMetricPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\DailyMetrics\RetrieveAffiliateDailyMetricPayload;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateDailyMetricResponse;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateDailyMetricsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateDailyMetricModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   * @param string $filter
   *
   * @return AffiliateDailyMetricsResponse|FortifiApiRequestInterface
   */
  public function all($limit = 10, $page = 1, $sortField = null,
    $sortDirection = null, $showDeleted = false, $filter = null
  )
  {
    $payload                = new PaginatedDataNodePayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->filter        = $filter;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $affiliateFid
   * @param string $date
   *
   * @return AffiliateDailyMetricResponse|FortifiApiRequestInterface
   */
  public function retrieve($affiliateFid, $date)
  {
    $payload                = new RetrieveAffiliateDailyMetricPayload();
    $payload->affiliateFid  = $affiliateFid;
    $payload->date          = $date;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $affiliateFid
   * @param string $date
   * @param int    $joins
   * @param int    $sales
   * @param int    $reversals
   * @param int    $revenue
   * @param int    $commissionAmount
   * @param int    $reversalAmount
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function create($affiliateFid, $date, $joins, $sales,
    $reversals, $revenue, $commissionAmount, $reversalAmount
  )
  {
    $payload                   = new AffiliateDailyMetricPayload();
    $payload->affiliateFid     = $affiliateFid;
    $payload->date             = $date;
    $payload->joins            = $joins;
    $payload->sales            = $sales;
    $payload->reversals        = $reversals;
    $payload->revenue          = $revenue;
    $payload->commissionAmount = $commissionAmount;
    $payload->reversalAmount   = $reversalAmount;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $affiliateFid
   * @param string $date
   * @param int    $joins
   * @param int    $sales
   * @param int    $reversals
   * @param int    $revenue
   * @param int    $commissionAmount
   * @param int    $reversalAmount
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($affiliateFid, $date, $joins, $sales,
    $reversals, $revenue, $commissionAmount, $reversalAmount
  )
  {
    $payload                   = new AffiliateDailyMetricPayload();
    $payload->affiliateFid     = $affiliateFid;
    $payload->date             = $date;
    $payload->joins            = $joins;
    $payload->sales            = $sales;
    $payload->reversals        = $reversals;
    $payload->revenue          = $revenue;
    $payload->commissionAmount = $commissionAmount;
    $payload->reversalAmount   = $reversalAmount;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }
}
