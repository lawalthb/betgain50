<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WalletsAddRequest;
use App\Http\Requests\WalletsEditRequest;
use App\Models\Wallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
class WalletsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.wallets.list";
		$query = Wallets::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Wallets::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "wallets.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Wallets::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Wallets::query();
		$record = $query->findOrFail($rec_id, Wallets::viewFields());
		return $this->renderView("pages.wallets.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.wallets.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WalletsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Wallets record
		$record = Wallets::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("wallets", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WalletsEditRequest $request, $rec_id = null){
		$query = Wallets::query();
		$record = $query->findOrFail($rec_id, Wallets::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("wallets", "Record updated successfully");
		}
		return $this->renderView("pages.wallets.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Wallets::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function list_mywallet(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.wallets.list_mywallet";
		$query = Wallets::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Wallets::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "wallets.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("user_id", "=" , auth()->user()->id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Wallets::listMywalletFields());
		return $this->renderView($view, compact("records"));
	}
    /**
     * Endpoint action
     * @return \Illuminate\Http\Response
     */
    public function deposit(Request $request){
        //$public_key = DB::table('paystack_settings')->where('is_active', 'Yes')->pluck('public_key');
        //dd($request);
        $secret_key = DB::table('paystack_settings')->where('is_active', 'Yes')->value('secret_key');
         $url = 'https:/'.'/api.paystack.co/transaction/initialize';
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
      'headers' => [
        'Authorization' => 'Bearer '.$secret_key,
        'Content-Type' => 'application/json',
      ],
      'json' => [
      'amount' => ($request->amount)*100,
        'email' => $request->email,
        'callback_url' => url('/wallets/callback'),
      ],
    ]);
    $data = json_decode($response->getBody(), true);
    return redirect($data['data']['authorization_url']);
  }
    /**
     * Endpoint action
     * @return \Illuminate\Http\Response
     */
     public function callback(Request $request){
         $secret_key = DB::table('paystack_settings')->where('is_active', 'Yes')->value('secret_key');
       $reference = $request->input('reference');
        $s_key = $secret_key;
        // Verify payment
        $url  = 'https:/'.'/api.paystack.co/transaction/verify/';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url. $reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $s_key",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response;
            $data = json_decode($response, true);
            //dd($data);
            if ($data) {
                $gateway_response = $data['data']['gateway_response'];
                $channel          = $data['data']['channel'];
                $paid_at          = $data['data']['paid_at'];
                $paystack_other   = $response;
                $status           = 'success';
                $amount_charged   = ($data['data']['amount'])/100;
 $channel = $data['data']['channel'];    
 $currency = $data['data']['currency'];  
$ip_address    = $data['data']['ip_address'];  
$metadata      = $data['data']['metadata'];  
$pstatus       = $data['data']['status'];   
$domain        = $data['data']['domain']; 
$authorization = $data['data']['authorization'];   
$others        = $data['data'];   
                $user_id   = Auth::id();
                $modeldata = ['user_id' => $user_id,
                'reference' =>  $reference,
                'amount' =>$amount_charged,   
                'gateway_response' =>$gateway_response,  
                'paid_at' =>$paid_at,  
                'channel' =>$channel,  
                'currency' =>$currency,  
                'ip_address' =>$ip_address,  
              'pstatus' =>$pstatus,  
          'domain' =>$domain,    
                ];
                //dd($modeldata);
                $new_balance = (Auth::user()->wallet_balance + $amount_charged );
        DB::table('transactions')->insert($modeldata);
        DB::table('users')->where('id',  $user_id)->update(['wallet_balance' => $new_balance]);
        return redirect()->away(url('/'));
            } else {
                dd('error');
            }
        }
    }
}
