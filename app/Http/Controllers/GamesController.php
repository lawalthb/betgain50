<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GamesAddRequest;
use App\Http\Requests\GamesEditRequest;
use App\Models\Games;
use Illuminate\Http\Request;
use Exception;

class GamesController extends Controller
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
		$view = "pages.games.list";
		$query = Games::query();
		$limit = $request->limit ?? 20;
		if ($request->search) {
			$search = trim($request->search);
			Games::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "games.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if ($fieldname) {
			$query->where($fieldname, $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Games::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
	 * Select table record by ID
	 * @param string $rec_id
	 * @return \Illuminate\View\View
	 */
	function view($rec_id = null)
	{
		$query = Games::query();
		$record = $query->findOrFail($rec_id, Games::viewFields());
		return $this->renderView("pages.games.view", ["data" => $record]);
	}


	/**
	 * Display Master Detail Pages
	 * @param string $rec_id //master record id
	 * @return \Illuminate\View\View
	 */
	function masterDetail($rec_id = null)
	{
		return View("pages.games.detail-pages", ["masterRecordId" => $rec_id]);
	}


	/**
	 * Display form page
	 * @return \Illuminate\View\View
	 */
	function add()
	{
		return $this->renderView("pages.games.add");
	}


	/**
	 * Save form record to the table
	 * @return \Illuminate\Http\Response
	 */
	function store(GamesAddRequest $request)
	{
		$modeldata = $this->normalizeFormData($request->validated());

		//save Games record
		$record = Games::create($modeldata);
		$rec_id = $record->id;

		return $this->redirect("games", "Record added successfully");
	}


	/**
	 * Update table record with form data
	 * @param string $rec_id //select record by table primary key
	 * @return \Illuminate\View\View;
	 */
	function edit(GamesEditRequest $request, $rec_id = null)
	{
		$query = Games::query();
		$record = $query->findOrFail($rec_id, Games::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("games", "Record updated successfully");
		}
		return $this->renderView("pages.games.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Games::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}


	//get list of last 7 games
	public function lastgames()
	{
		$lastgames = Games::where('statusa', 'crashed')->orderBy('created_at', 'desc')->skip(1)->limit(7)->get();
		return response()->json($lastgames);
	}
}
