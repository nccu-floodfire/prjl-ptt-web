<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	public function showWelcome()
	{
		View::share(array('active' => 'index'));

		$articles = Article::with('articlelist')->orderBy('id', 'desc')->paginate(50);
		return View::make('index', compact('articles'));
	}

	public function showBoard($board_name)
	{
		$articles = Article::with('articlelist')->where('forum', '=', $board_name)->orderBy('id', 'desc')->paginate(50);
		View::share(array('active' => $board_name));
		return View::make('board', compact('board_name', 'articles'));
	}

	public function showArticle($board_name, $article_id)
	{
		$article = Article::with('articlelist')->findOrFail($article_id);
		View::share(array('active' => $board_name));
		return View::make('article', compact('board_name', 'article'));
	}

	public function apiListBoardArticleByDate($board_name, $date = null)
	{
		$date_ts = strtotime($date);
		$date_end = $date_ts + 86400;
		$date_end = date('Y-m-d', $date_end);

		$articles = DB::table('article')
			->join('list', 'article.id', '=', 'list.id')
			->select('article.*', 'list.title')
			->where('article.forum', '=', $board_name)
			->whereBetween('article.ts', array($date, $date_end))
			->orderBy('article.id', 'desc')
			->get();

		return Response::json($articles);
	}

	public function apiShowArticle($article_id)
	{
		$article = DB::table('article')
			->join('list', 'article.id', '=', 'list.id')
			->select('article.*', 'list.title')
			->where('article.id', '=', $article_id)
			->get();

		$comments = Comment::where('article_id', '=', $article_id)
			->select('type', 'content', 'ts', 'author')
			->orderBy('id', 'desc')
			->get();
		$article_res = $article[0];
		$article_res->comments = $comments;
		return Response::json($article_res);
	}

	public function export()
	{
		return "TBD.";
	}

	public function search()
	{
		$term = Input::get('term', null);
		if (empty($term)) {
			return Redirect::to('/');
		}
		View::share(array('active' => ''));

		$articles = ArticleList::with('article')->where('title', 'like', "%$term%")->orderBy('id', 'desc')->paginate(50);
		return View::make('search', compact('articles', 'term'));
	}

	public function searchAuthor()
	{
		$term = Input::get('term', null);
		if (empty($term)) {
			return Redirect::to('/');
		}
		View::share(array('active' => ''));

		$articles = ArticleList::with('article')->where('author', '=', $term)->orderBy('id', 'desc')->paginate(50);
		$comments = Comment::with('article')->where('author', '=', $term)->orderBy('id', 'desc')->paginate(50);
		return View::make('searchauthor', compact('articles', 'term', 'comments'));
	}


	public function apiDoc()
	{
		View::share(array('active' => ''));
		return View::make('apidoc');
	}

}
