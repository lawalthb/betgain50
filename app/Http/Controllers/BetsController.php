<?php

namespace App\Http\Controllers;

use App\Events\BetHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\BetsAddRequest;
use App\Http\Requests\BetsEditRequest;
use App\Models\Bets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class BetsController extends Controller
{


	/**
	 * List table records
	 * @param  \Illuminate\Http\Request
	 * @param string $fieldname //filter records by a table field
	 * @param string $fieldvalue //filter value
	 * @return \Illuminate\View\View
	 */
	function index(Request $request, $fieldname = null, $fieldvalue = null)
	{
		$view = "pages.bets.list";
		$query = Bets::query();
		$limit = $request->limit ?? 20;
		if ($request->search) {
			$search = trim($request->search);
			Bets::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "bets.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if ($fieldname) {
			$query->where($fieldname, $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Bets::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
	 * Select table record by ID
	 * @param string $rec_id
	 * @return \Illuminate\View\View
	 */
	function view($rec_id = null)
	{
		$query = Bets::query();
		$record = $query->findOrFail($rec_id, Bets::viewFields());
		return $this->renderView("pages.bets.view", ["data" => $record]);
	}


	/**
	 * Display form page
	 * @return \Illuminate\View\View
	 */
	function add()
	{
		return $this->renderView("pages.bets.add");
	}


	/**
	 * Save form record to the table
	 * @return \Illuminate\Http\Response
	 */
	function store(BetsAddRequest $request)
	{
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['user_id'] = $user_id;

		//save Bets record
		$record = Bets::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("", "Record added successfully");
	}


	/**
	 * Update table record with form data
	 * @param string $rec_id //select record by table primary key
	 * @return \Illuminate\View\View;
	 */
	function edit(BetsEditRequest $request, $rec_id = null)
	{
		$query = Bets::query();
		$record = $query->findOrFail($rec_id, Bets::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("bets", "Record updated successfully");
		}
		return $this->renderView("pages.bets.edit", ["data" => $record, "rec_id" => $rec_id]);
	}


	/**
	 * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma
	 * @return \Illuminate\Http\Response
	 */
	function delete(Request $request, $rec_id = null)
	{
		$arr_id = explode(",", $rec_id);
		$query = Bets::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	/**
	 * Endpoint action
	 * @return \Illuminate\Http\Response
	 */
	public function Placebet(Request $request)
	{
		// $sqltext = "SELECT column FROM table WHERE column=:param1";
		// $query_params = ["param1" => "value"];
		// $records = DB::select($sqltext, $query_params);
		// return $records;
		// Validate the request data
		$validatedData = $request->validate([
			'bet_amount' => 'required|numeric',
			'current_game_id' => 'required|numeric',
			'crash_point' => 'required|string',
		]);
		//check wallet balance
		$user_id = $_COOKIE['user_id'];
		$username = $_COOKIE['username'];


		$userBalance =  User::where('id', $user_id)->value('wallet_balance');
		//$userBalance -=50;
		if ($userBalance < $validatedData['bet_amount']) {
			$msg = 'Insufficient Balance, Your current balance is ' . $userBalance;
			return response()->json(['message' =>	$msg, 'success' => false], 400);
		} else {

			$secretKey = 'BetGain';
			$gameParameters = [
				'bet_amount' => $validatedData['bet_amount'],
				'crash_point' =>  $validatedData['crash_point'],
				'current_game_id' =>  $validatedData['current_game_id'],
			];
			$hash = hash_hmac('sha256', serialize($gameParameters), $secretKey);
			$modeldata['user_id'] = $user_id;
			$modeldata['username'] = $username;
			$modeldata['stake_amount'] = $validatedData['bet_amount'];
			$modeldata['bet'] = $validatedData['crash_point'];
			$modeldata['game_id'] = $validatedData['current_game_id'];
			$modeldata['hash'] = $hash;
			// Process the bet submission (e.g., save to database, etc.)
			$bet = Bets::create($modeldata);
			if ($bet) {
				$userBalance -= $validatedData['bet_amount'];
				$user = User::find($user_id);
				$user->wallet_balance = $userBalance;
				$user->save();

				event(new BetHistory($this->recent_history()));
			}
		}
		// Return a response
		return response()->json(['message' => 'Bet placed successfully', 'success' => true, 'user_balance' => $userBalance], 200);
	}

	public function cashout(Request $request)
	{

		$cashAmt =  trim($_GET['cashAmt']);

		//check wallet balance.
		$user_id = $_COOKIE['user_id'];
		$userBalance =		User::where('id', $user_id)->value('wallet_balance');;
		$userBalance += $cashAmt;
		$user = User::find($user_id);
		$user->wallet_balance = $userBalance;
		$user->save();

		// Return a response
		if ($user) {
			return response()->json(['message' => 'Cash out successfully', 'success' => true, 'user_balance' => $userBalance], 200);
		}
	}


	public function recent_history()
	{
		$recent_bets = Bets::with('user')->orderBy('id', 'desc')->take(10)->get();
		return $recent_bets;
	}
}
