<?php
namespace Fortifi\FortifiApi\Foundation\Responses;

class DataNodeResponse extends FidResponse
{
  public $id;
  public $viewPolicy;
  public $editPolicy;
  /**
   * @gotype int64
   */
  public $dateCreated;
  /**
   * @gotype int64
   */
  public $dateModified;
  /**
   * @gotype int64
   */
  public $dateStateChanged;
  public $displayName;
  public $description;
  /**
   * @gotype int
   */
  public $currentState;

  public function __construct($fid = null)
  {
    parent::__construct($fid);
  }

  /**
   * All is good with the world
   *
   * @return bool
   */
  public function isNodeActive()
  {
    return (int)$this->currentState === 0;
  }

  /**
   * Has this node been deleted
   *
   * @return bool
   */
  public function isNodeArchived()
  {
    return (int)$this->currentState === 1;
  }

  /**
   * Is this data node still being formed
   * (Usually part of a multi stage setup process)
   *
   * @return bool
   */
  public function isNodePending()
  {
    return (int)$this->currentState === 2;
  }

  /**
   * Is this data node known to be corrupt
   * Data should be taken with a pinch of salt
   *
   * Best to retry accessing this data at a later date, as is queued for repair
   *
   * @return bool
   */
  public function isNodeCorrupt()
  {
    return (int)$this->currentState === 3;
  }

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->dateCreated = (int)$this->dateCreated;
    $this->dateModified = (int)$this->dateModified;
    $this->dateStateChanged = (int)$this->dateStateChanged;
    $this->currentState = (int)$this->currentState;
  }

}
