<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Weidner\Goutte\GoutteFacade as GoutteFacade;

class AtodeyomuController extends Controller
{
  public function index()
  {
    return view('index');
  }

  public function register(Request $req)
  {
    $url = $req->siteUrlInput;
    $goutte = GoutteFacade::request('GET', $url);
    $anchors = $goutte->filter('#personal-public-article-body')->filter('a');
    $links = $anchors->each(function ($node) {
      return $node->attr("href");
    });
    $links = array_filter($links, function ($link) {
      return preg_match('/^http:\/\/.*/', $link)
        && !preg_match('/.*\.png.*/', $link)
        && !preg_match('/^http:\/\/192.168\..*/', $link);
    });

    return view('atodeyomu', compact('url', 'links'));
  }
}
