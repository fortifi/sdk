<?php
namespace Fortifi\FortifiCo\Applications\Tags\Models;

use Fortifi\FortifiApi\Edge\Payloads\EdgePayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;
use Fortifi\FortifiApi\Foundation\Responses\DynamicDataNodesResponse;
use Fortifi\FortifiApi\Foundation\Responses\FidsResponse;
use Fortifi\FortifiApi\Tags\Endpoints\TagEndpoint;
use Fortifi\FortifiApi\Tags\Payloads\CreateTagPayload;
use Fortifi\FortifiApi\Tags\Payloads\RenameTagPayload;
use Fortifi\FortifiApi\Tags\Payloads\SetTagStylePayload;
use Fortifi\FortifiApi\Tags\Payloads\TagLinkPayload;
use Fortifi\FortifiApi\Tags\Payloads\TagPayload;
use Fortifi\FortifiApi\Tags\Payloads\TagsPaginatedPayload;
use Fortifi\FortifiApi\Tags\Responses\TagResponse;
use Fortifi\FortifiApi\Tags\Responses\TagsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class TagModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param bool   $showDeleted
   *
   * @return TagsResponse
   */
  public function all(
    $limit = 10, $page = 1, $sortField = null, $sortDirection = null,
    $showDeleted = false
  )
  {
    $payload = new TagsPaginatedPayload();
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted = $showDeleted;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return TagResponse
   */
  public function retrieve($fid)
  {
    $payload = new TagPayload();
    $payload->fid = $fid;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $name
   * @param string $icon
   * @param string $colour
   *
   * @return DataNodeResponse
   */
  public function create($name, $icon, $colour)
  {
    $payload = new CreateTagPayload();
    $payload->name = $name;
    $payload->icon = $icon;
    $payload->colour = $colour;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $name
   *
   * @return BoolResponse
   */
  public function rename($fid, $name)
  {
    $payload = new RenameTagPayload();
    $payload->fid = $fid;
    $payload->name = $name;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->rename($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $icon
   * @param string $colour
   *
   * @return BoolResponse
   */
  public function setStyle($fid, $icon, $colour)
  {
    $payload = new SetTagStylePayload();
    $payload->fid = $fid;
    $payload->icon = $icon;
    $payload->colour = $colour;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->setStyle($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BoolResponse
   */
  public function delete($fid)
  {
    $payload = new TagPayload();
    $payload->fid = $fid;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $objectFid
   * @param bool   $loadRefs
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   *
   * @return TagsResponse|FidsResponse
   */
  public function getTags(
    $objectFid, $loadRefs = true, $limit = 10, $page = 1, $sortField = null,
    $sortDirection = null
  )
  {
    $payload = new EdgePayload();
    $payload->fid = $objectFid;
    $payload->loadRefs = $loadRefs;
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->getTags($payload)->get();
  }

  /**
   * @param string $fid
   * @param bool   $loadRefs
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   *
   * @return DynamicDataNodesResponse
   */
  public function getObjects(
    $fid, $loadRefs = true, $limit = 10, $page = 1, $sortField = null,
    $sortDirection = null
  )
  {
    $payload = new EdgePayload();
    $payload->fid = $fid;
    $payload->loadRefs = $loadRefs;
    $payload->limit = $limit;
    $payload->page = $page;
    $payload->sortField = $sortField;
    $payload->sortDirection = $sortDirection;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->getObjects($payload)->get();
  }

  /**
   * @param string $tagFid
   * @param string $objectFid
   *
   * @return BoolResponse
   */
  public function addObject($tagFid, $objectFid)
  {
    $payload = new TagLinkPayload();
    $payload->fid = $tagFid;
    $payload->objectFid = $objectFid;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->addObject($payload)->get();
  }

  /**
   * @param string $tagFid
   * @param string $objectFid
   *
   * @return BoolResponse
   */
  public function removeObject($tagFid, $objectFid)
  {
    $payload = new TagLinkPayload();
    $payload->fid = $tagFid;
    $payload->objectFid = $objectFid;

    $ep = TagEndpoint::bound($this->getApi());
    return $ep->removeObject($payload)->get();
  }

  /**
   * @param string   $tagFid
   * @param string[] $objects
   *
   * @return $this
   */
  public function addObjects($tagFid, $objects)
  {
    // todo, use batch requests
    foreach($objects as $object)
    {
      $this->addObject($tagFid, $object);
    }
    return $this;
  }

  /**
   * @param string   $tagFid
   * @param string[] $objects
   *
   * @return $this
   */
  public function removeObjects($tagFid, $objects)
  {
    // todo, use batch requests
    foreach($objects as $object)
    {
      $this->removeObject($tagFid, $object);
    }
    return $this;
  }

  /**
   * @param string   $objectFid
   * @param string[] $tags
   *
   * @return $this
   */
  public function addTags($objectFid, $tags)
  {
    foreach($tags as $tag)
    {
      $this->addObject($tag, $objectFid);
    }
    return $this;
  }

  /**
   * @param string   $objectFid
   * @param string[] $tags
   *
   * @return $this
   */
  public function removeTags($objectFid, $tags)
  {
    foreach($tags as $tag)
    {
      $this->removeObject($tag, $objectFid);
    }
    return $this;
  }
}
