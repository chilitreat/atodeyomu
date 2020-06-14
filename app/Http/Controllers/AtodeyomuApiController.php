<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Weidner\Goutte\GoutteFacade as GoutteFacade;

class AtodeyomuApiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $url = $request->input('url');
    $goutte = GoutteFacade::request('GET', $url);
    $anchors = $goutte->filter('#personal-public-article-body')->filter('a');
    $links = $anchors->each(function ($node) {
      return $node->attr("href");
    });

    $filteredLinks = array_filter($links, function ($link) {
      return preg_match('/^(http|https):\/\/.*/', $link)
        && !preg_match('/^http:\/\/localhost.*/', $link)
        && !preg_match('/.*\.png.*/', $link)
        && !preg_match('/^http:\/\/192.168\..*/', $link);
    });

    return json_encode(array_values($filteredLinks));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
