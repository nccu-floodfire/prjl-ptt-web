@extends('scaffold.index')

@section('main')
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<!--<h1 class="page-header">{{{ $board_name }}}</h1>-->

			<h2 class="sub-header">Articles in {{{ $board_name }}}</h2>
			<div class="table-responsive">
				<?php echo $articles->appends(Input::except(array('page')))->links(); ?>
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="hidden-xs hidden-sm">ID</th>
						<th>Author</th>
						<th class="hidden-xs">Time</th>
						<th>Subject</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($articles as $article)
					<tr>
					<td class="hidden-xs hidden-sm">{{{ $article->id }}}</td>
					<td><a href="/search_author?term={{{$article->author}}}">{{{ $article->author }}}</a></td>
					<td class="hidden-xs">{{{ $article->ts }}}</td>
					<td><a href="/board/{{{$board_name}}}/{{{$article->id}}}">{{{ $article->articlelist->title }}}</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
				<?php echo $articles->appends(Input::except(array('page')))->links(); ?>
			</div>
		</div>

@stop