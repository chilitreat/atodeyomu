<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Http;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class LinkPreviewController extends Controller
{
  public function index(Request $request)
  {
    $urls = new Collection($request->input('urls'));
    return $urls->map(function($url) {
      $linkPreview = [];
      $goutte = GoutteFacade::request('GET', $url);

      $linkPreview['url']         = $url;
      $linkPreview['title']       = $this->getTitle($goutte);
      $linkPreview['description'] = $this->getDescription($goutte);
      $linkPreview['image']       = $this->getImage($goutte);
      $linkPreview['siteName']    = $this->getSiteName($goutte);

      return $linkPreview;
    });
  }

  private function getTitle($goutte): string {
    $title = $goutte->filter('title');
    if($title->text()) {
      return $title->text();
    }
    return '';
  }

  private function getDescription($goutte): string {
    $description = $goutte->filterXPath('//meta[@property="og:description"]');
    if($description->evaluate('count(@content)')) {
      return $description->attr("content");
    }

    $description = $goutte->filterXPath('//meta[@name="description"]');
    if($description->evaluate('count(@content)')) {
      return $description->attr("content");
    }
    return '';
  }

  private function getImage($goutte): string {
    $imageLink = $goutte->filterXPath('//meta[@property="og:image"]');
    if($imageLink->evaluate('count(@content)')) {
      return $imageLink->attr("content");
    }

    $images = $goutte->filter('img');
    if(count($images)) {
      $result = parse_url($images->first()->getUri());
      $uri = $result['scheme']."://".$result['host'];
      $path = $images->first()->attr("src");
      return $uri.$path;
    }

    return asset('image/m_e_others_500.png');
  }

  private function getSiteName($goutte): string {
    $siteName = $goutte->filterXPath('//meta[@property="og:site_name"]');
    if(!$siteName->evaluate('count(@content)')) {
      return '';
    }
    return $siteName->attr("content");
  }

}
