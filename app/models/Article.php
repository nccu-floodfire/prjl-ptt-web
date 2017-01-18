<?php

class Article extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'article';

	public $incrementing = false;

	public function articlelist() {
		return $this->belongsTo('ArticleList', 'id', 'id');
	}

	public function comments() {
		return $this->hasMany('Comment', 'article_id', 'id');
	}
}
