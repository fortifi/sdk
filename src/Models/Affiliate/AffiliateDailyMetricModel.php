<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliateDailyMetricEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\DailyMetrics\ListAffiliateDailySummaryPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\DailyMetrics\ListAffiliateMetricsDurationPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\DailyMetrics\ListAffiliateStatsDurationPayload;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateConversionMetricsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateDailySummaryResponse;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateFinanceMetricsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateSalesOverviewResponse;
use Fortifi\FortifiApi\Affiliate\Responses\DailyMetrics\AffiliateTopAffiliatesResponse;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliateDailyMetricModel extends FortifiApiModel
{
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
   * @return AffiliateSalesOverviewResponse|FortifiApiRequestInterface
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

  /**
   * @param int $days
   *
   * @return AffiliateConversionMetricsResponse|FortifiApiRequestInterface
   */
  public function conversionMetrics($days = 30)
  {
    $payload = new ListAffiliateMetricsDurationPayload();
    $payload->days = $days;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->conversionMetrics($payload)->get();
  }

  /**
   * @param int $days
   *
   * @return AffiliateFinanceMetricsResponse|FortifiApiRequestInterface
   */
  public function financeMetrics($days = 30)
  {
    $payload = new ListAffiliateMetricsDurationPayload();
    $payload->days = $days;

    $ep = AffiliateDailyMetricEndpoint::bound($this->getApi());
    return $ep->financeMetrics($payload)->get();
  }
}
