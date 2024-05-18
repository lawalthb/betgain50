<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bets extends Model
{


	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'bets';


	/**
	 * The table primary key field
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';


	/**
	 * Table fillable fields
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'game_id', 'stake_amount', 'bet', 'hash', 'username'
	];
	public $timestamps = false;



	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}



	/**
	 * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
	 */
	public static function search($query, $text)
	{
		//search table record
		$search_condition = '(
				id LIKE ?
		)';
		$search_params = [
			"%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}


	/**
	 * return list page fields of the model.
	 *
	 * @return array
	 */
	public static function listFields()
	{
		return [
			"id",
			"user_id",
			"game_id",
			"win_amount",
			"multiplier_at_bet",
			"bet",
			"statusa",
			"stake_amount",
			"username"
		];
	}


	/**
	 * return exportList page fields of the model.
	 *
	 * @return array
	 */
	public static function exportListFields()
	{
		return [
			"id",
			"user_id",
			"game_id",
			"win_amount",
			"multiplier_at_bet",
			"bet",
			"status",
			"stake_amount"
		];
	}


	/**
	 * return view page fields of the model.
	 *
	 * @return array
	 */
	public static function viewFields()
	{
		return [
			"id",
			"user_id",
			"game_id",
			"win_amount",
			"multiplier_at_bet",
			"bet",
			"status",
			"stake_amount"
		];
	}


	/**
	 * return exportView page fields of the model.
	 *
	 * @return array
	 */
	public static function exportViewFields()
	{
		return [
			"id",
			"user_id",
			"game_id",
			"win_amount",
			"multiplier_at_bet",
			"bet",
			"status",
			"stake_amount"
		];
	}


	/**
	 * return edit page fields of the model.
	 *
	 * @return array
	 */
	public static function editFields()
	{
		return [
			"user_id",
			"game_id",
			"stake_amount",
			"bet",
			"id"
		];
	}
}
