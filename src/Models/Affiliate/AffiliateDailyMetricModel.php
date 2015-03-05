<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateDailyMetricEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\DailyMetrics\ListAffiliateDailySummaryPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\DailyMetrics\ListAffiliateStatsDurationPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\DailyMetrics\RetrieveAffiliateDailyMetricPayload;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateDailyMetricResponse;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateDailyMetricsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateDailySummaryResponse;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateTopAffiliatesResponse;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
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
  public function all(
    $limit = 10, $page = 1, $sortField = null,
    $sortDirection = null, $showDeleted = false, $filter = null
  )
  {
    $payload = new PaginatedDataNodePayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;
    $payload->filter = $filter;

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
    $payload = new RetrieveAffiliateDailyMetricPayload();
    $payload->affiliateFid = $affiliateFid;
    $payload->date = $date;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $affiliateFid
   * @param int    $summariseDays
   *
   * @return AffiliateDailySummaryResponse|FortifiApiRequestInterface
   */
  public function summary($affiliateFid, $summariseDays = 30)
  {
    $payload = new ListAffiliateDailySummaryPayload();
    $payload->affiliateFid = $affiliateFid;
    $payload->summariseDays = $summariseDays;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->summary($payload)->get();
  }

  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param string $filter
   * @param int    $days
   *
   * @return AffiliateTopAffiliatesResponse|FortifiApiRequestInterface
   */
  public function topAffiliates(
    $limit = 10, $page = 1, $days = 30, $sortField = null,
    $sortDirection = null, $filter = null
  )
  {
    $payload = new ListAffiliateStatsDurationPayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->filter = $filter;
    $payload->days = $days;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->topAffiliates($payload)->get();
  }

  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param string $filter
   * @param int    $days
   *
   * @return AffiliateTopAffiliatesResponse|FortifiApiRequestInterface
   */
  public function salesOverview(
    $limit = null, $page = 1, $days = 7, $sortField = null,
    $sortDirection = null, $filter = null
  )
  {
    $payload = new ListAffiliateStatsDurationPayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->filter = $filter;
    $payload->days = $days;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->salesOverview($payload)->get();
  }
}
