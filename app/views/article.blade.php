@extends('scaffold.index')

@section('main')
<?php $comment_sign_array = Comment::$comment_sign_array; ?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">{{{$board_name}}}</h1>
			<h2 class="sub-header">{{{ $article->articlelist->title }}}</h2>
			<article>
			<pre>
			{{{ $article->content }}}
			</pre>
			</article>
			<hr />
			<h3>Comments</h3>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th>Author</th>
						<th>Type</th>
						<th>Time</th>
						<th>Content</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($article->comments as $comment)
					<tr>
					<td><a href="/search_author?term={{{ $comment->author }}}">{{{ $comment->author }}}</a></td>
					<td>{{{ $comment_sign_array[$comment->type] or '?'}}}</td>
					<td>{{{ $comment->ts }}}</td>
					<td>{{{ $comment->content }}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>

@stop