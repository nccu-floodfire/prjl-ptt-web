@extends('scaffold.index')

@section('main')
<?php $comment_sign_array = Comment::$comment_sign_array; ?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Search Results</h1>

			<h2 class="sub-header"><code>{{{$term}}}</code> 的文章</h2>
			<div class="table-responsive">
				<?php echo $articles->appends(Input::except(array('page')))->links(); ?>
				<table class="table table-striped">
					<thead>
					<tr>
						<th>Forum</th>
						<th class="hidden-xs hidden-sm">ID</th>
						<th>Author</th>
						<th class="hidden-xs">Time</th>
						<th>Subject</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($articles as $article_list)
					<?php
					if (!$article_list->article) {
						continue;
					}
					?>
					<tr>
					<td>{{{ $article_list->article->forum }}}</td>
					<td class="hidden-xs hidden-sm">{{{ $article_list->article->id }}}</td>
					<td><a href="/search_author?term={{{$article_list->article->author}}}">{{{ $article_list->article->author }}}</a></td>
					<td class="hidden-xs">{{{ $article_list->article->ts }}}</td>
					<td><a href="/board/{{{$article_list->article->forum}}}/{{{$article_list->id}}}">{{{ $article_list->title }}}</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
				<?php echo $articles->appends(Input::except(array('page')))->links(); ?>
			</div>

			<hr />
			<h2><code>{{{$term}}}</code> 的推文</h2>
			<div class="table-responsive">
			<?php echo $comments->appends(Input::except(array('page')))->links(); ?>
				<table class="table table-striped">
					<thead>
					<tr>
						<th>Forum</th>
						<th>Subject</th>
						<th>Type</th>
						<th>Time</th>
						<th>Content</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($comments as $comment)
					<tr>
					<td>{{{ $comment->article->forum }}}</td>
					<td><a href="/board/{{{$comment->article->forum}}}/{{{$comment->article_id}}}">{{{ $comment->articlelist->title }}}</a></td>
					<td>{{{ $comment_sign_array[$comment->type] or '?'}}}</td>
					<td>{{{ $comment->ts }}}</td>
					<td>{{{ $comment->content }}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
				<?php echo $comments->appends(Input::except(array('page')))->links(); ?>
			</div>

		</div>

@stop
