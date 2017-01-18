<?php

class Comment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comment';

	public static $comment_sign_array = array(
		'+' => '推',
		'-' => '噓',
		'=' => '→',
	);

	//public $incrementing = false;

	public function articlelist() {
		return $this->belongsTo('ArticleList', 'article_id', 'id');
	}

	public function article() {
		return $this->belongsTo('Article', 'article_id', 'id');
	}

}
