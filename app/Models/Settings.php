<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Settings extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'settings';
	

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
		'id','email','site_description','allow_reg','max_deposit','mim_deposit','deduction_percent','referral_amount','max_crash','start_count','paystack_key','paystack_screte','maintenance_mode','updated_by'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				id LIKE ?  OR 
				email LIKE ?  OR 
				site_description LIKE ?  OR 
				paystack_key LIKE ?  OR 
				paystack_screte LIKE ?  OR 
				updated_by LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id",
			"email",
			"site_description",
			"allow_reg",
			"max_deposit",
			"mim_deposit",
			"deduction_percent",
			"referral_amount",
			"max_crash",
			"start_count",
			"paystack_key",
			"paystack_screte",
			"maintenance_mode",
			"updated_by",
			"updated_at" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"email",
			"site_description",
			"allow_reg",
			"max_deposit",
			"mim_deposit",
			"deduction_percent",
			"referral_amount",
			"max_crash",
			"start_count",
			"paystack_key",
			"paystack_screte",
			"maintenance_mode",
			"updated_by",
			"updated_at" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"email",
			"site_description",
			"allow_reg",
			"max_deposit",
			"mim_deposit",
			"deduction_percent",
			"referral_amount",
			"max_crash",
			"start_count",
			"paystack_key",
			"paystack_screte",
			"maintenance_mode",
			"updated_by",
			"updated_at" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"email",
			"site_description",
			"allow_reg",
			"max_deposit",
			"mim_deposit",
			"deduction_percent",
			"referral_amount",
			"max_crash",
			"start_count",
			"paystack_key",
			"paystack_screte",
			"maintenance_mode",
			"updated_by",
			"updated_at" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id",
			"email",
			"site_description",
			"allow_reg",
			"max_deposit",
			"mim_deposit",
			"deduction_percent",
			"referral_amount",
			"max_crash",
			"start_count",
			"paystack_key",
			"paystack_screte",
			"maintenance_mode",
			"updated_by" 
		];
	}
}
