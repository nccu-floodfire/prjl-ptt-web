@extends('scaffold.index')

@section('main')
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">All Forums</h1>
<!--
			<div class="row placeholders">
				<div class="col-xs-6 col-sm-3 placeholder">
					<img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
					<h4>TBD</h4>
					<span class="text-muted">補上一些圖表監測 Crawler 狀況</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder">
					<img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
					<h4>TBD</h4>
					<span class="text-muted">TBD</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder">
					<img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
					<h4>TBD</h4>
					<span class="text-muted">TBD</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder">
					<img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
					<h4>TBD</h4>
					<span class="text-muted">TBD</span>
				</div>
			</div>
-->
			<h2 class="sub-header">Articles in all forums</h2>
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
					@foreach ($articles as $article)
					<tr>
					<td>{{{ $article->forum }}}</td>
					<td class="hidden-xs hidden-sm">{{{ $article->id }}}</td>
					<td><a href="/search_author?term={{{$article->author}}}">{{{ $article->author }}}</a></td>
					<td class="hidden-xs">{{{ $article->ts }}}</td>
					<td><a href="/board/{{{$article->forum}}}/{{{$article->id}}}">{{{ $article->articlelist->title }}}</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
				<?php echo $articles->appends(Input::except(array('page')))->links(); ?>
			</div>
		</div>

@stop
