@extends('scaffold.index')

@section('main')
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">API Document</h1>
			<article>
			<section>
				<h3>List articles in a forum on a specific date</h3>
				<p>
					<h4>- /api/v1/forum/<em>{board_name}</em>/date/<em>{date_string}</em></h4>
				</p>
				<p>
					eg. <code>http://140.119.24.27:8080/api/v1/forum/<b>Gossiping</b>/date/<b>2014-11-22</b></code>
				</p>
			</section>
			<hr />
			<section>
				<h3>Get single article</h3>
				<p>
		            <h4>- /api/v1/article/<em>{article_id}</em></h4>
	            </p>
	            <p>
		            eg. <code>http://140.119.24.27:8080/api/v1/article/<b>M.1416671967.A.333</b></code>
	            </p>
            </section>
            <section>
            <div class="alert alert-warning" role="alert">
            Notice: Each forum has a 4 days delay, this means you is not able to query the latest posts.
            </div>
            </section>
			</article>
		</div>
@stop
