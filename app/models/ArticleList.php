<?php

class ArticleList extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'list';

	public $incrementing = false;

	public function article() {
		return $this->hasOne('Article', 'id', 'id');
	}

}
