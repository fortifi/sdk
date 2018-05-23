<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Pixels;

use Fortifi\FortifiApi\Affiliate\Enums\PixelType;
use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PixelResponse extends FortifiApiResponse
{
  public $visitorId;
  public $url;
  public $method;
  public $content;

  /**
   * Get the pixel content ready to be rendered to the page
   *
   * @return null|string
   */
  public function render()
  {
    switch($this->method)
    {
      case PixelType::HTML:
        return $this->content;
      case PixelType::IFRAME:
        return $this->_renderIframe();
      case PixelType::IMAGE:
      case 'image':
        return $this->_renderImage();
      case PixelType::JS:
      case 'javascript':
        return $this->_renderJavascript();
      default:
        return null;
    }
  }

  protected function _renderIframe()
  {
    $data = '<iframe src="' . $this->url . '" ';
    $data .= 'width="1" height="1" frameborder="0"></iframe>';
    return $data;
  }

  protected function _renderImage()
  {
    $data = '<img src="' . $this->url . '" ';
    $data .= 'width="1" height="1" border="0"/>';
    return $data;
  }

  protected function _renderJavascript()
  {
    $data = '<script type="text/javascript" src="' . $this->url . '">';
    $data .= '</script>';
    return $data;
  }

  public function __toString()
  {
    return $this->render();
  }
}
