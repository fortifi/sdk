<?php
namespace Fortifi\FortifiCo\Applications\Notification\Models;

use Fortifi\FortifiApi\Foundation\Payloads\PaginatedPayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Notification\Endpoints\NotificationEndpoint;
use Fortifi\FortifiApi\Notification\Payloads\NotificationPayload;
use Fortifi\FortifiApi\Notification\Responses\UserNotificationResponse;
use Fortifi\FortifiApi\Notification\Responses\UserNotificationsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class NotificationModel extends FortifiApiModel
{
  /**
   * @param int $page
   * @param int $limit
   * @param string $sortField
   * @param string $sortDirection
   * @param string $filter
   *
   * @return UserNotificationsResponse
   */
  public function all($page = 1, $limit = 5, $sortField = null,
    $sortDirection = null, $filter = null
  )
  {
    $payload = new PaginatedPayload();
    $payload->page          = $page;
    $payload->limit         = $limit;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->filter        = $filter;

    $ep = NotificationEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param $objectFid
   * @param $microtime
   *
   * @return UserNotificationResponse
   */
  public function retrieve($objectFid, $microtime)
  {
    $payload = new NotificationPayload();
    $payload->objectFid = $objectFid;
    $payload->microtime = $microtime;
    $ep = NotificationEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param $objectFid
   * @param $microtime
   *
   * @return BoolResponse
   */
  public function viewed($objectFid, $microtime)
  {
    $payload = new NotificationPayload();
    $payload->hasViewed = true;
    $payload->objectFid = $objectFid;
    $payload->microtime = $microtime;
    $ep = NotificationEndpoint::bound($this->getApi());
    return $ep->viewed($payload)->get();
  }

  /**
   * @return BoolResponse
   */
  public function test()
  {
    $ep = NotificationEndpoint::bound($this->getApi());
    return $ep->test()->get();
  }
}