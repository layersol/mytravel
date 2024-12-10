<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Ticket;
use App\Models\Passenger;
use Illuminate\Support\Str;
use App\Models\identity;
use App\Models\SectionsContent;
use App\Models\ContactDetail;
use App\Models\Countries;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class BookingController extends Controller
{
     
    public function book(Request $request)
    {
        if ($request->isMethod('post')) {

            $selectedData = json_decode($request->input('selectedData'));
            $dictionaries = json_decode($request->input('dictionaries'));
           Session::put('selectedData',$selectedData);
           Session::put('dictionaries',$dictionaries);
           
            // Redirect to the booking page
            return redirect()->route('/flight-book');
        } elseif(session()->has('selectedData')) {
            // Retrieve the selected data from the session
            $selectedData = Session::get('selectedData');
            $dictionaries = Session::get('dictionaries');
            $countries=Countries::all();
            // echo "<pre>";print_r($selectedData);exit;

             // Display the booking page with the selected data
            return view('frontend/flight/proceed', compact('selectedData','dictionaries','countries'));
        }else{
            return redirect()->route('home');
        }
    }


    //********* booking form method *************\\
    public function bookingForm(Request $request){

        $searchSess=Session::get('searchParams');
        $selectedData=Session::get('selectedData');
        $dictionaries = Session::get('dictionaries');

        if($searchSess['return_date']!=''){
            $tripType='round';
            $destinations=$searchSess['departure_code'].'-'.$searchSess['arrival_code'].'-'.$searchSess['departure_code'];

        }else{
            $tripType='single';
            $destinations=$searchSess['departure_code'].'-'.$searchSess['arrival_code'];
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email'],
            'contact_no' => ['required', 'string', 'max:30'],
            'passType.*' => ['required', 'string'],
            'title.*' => ['required', 'string'],
            'gender.*' => ['required', 'in:MALE,FEMALE'],
            'name.*' => ['required', 'string'],
            'surname.*' => ['required', 'string'],
            'pidno.*' => ['sometimes','nullable', 'string'],
            'pied.*' => [
                'sometimes','nullable',
                'date',
                'after:' . now()->format('Y-m-d'), // Ensures the date is in the future
            ],
            'dob.*' => [
                'sometimes','nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $index = str_replace('dob.', '', $attribute);
                    $passType = $request->input("passType.$index");
        
                    $dob = new \DateTime($value);
                    $today = new \DateTime();
                    $age = $today->diff($dob)->y;
        
                    if ($passType === 'ADULT') {
                        if ($age < 12) {
                            $fail('The passenger must be 12 or older on the date of departure for ADULT type.');
                        }
                    } elseif ($passType === 'CHILD') {
                        if ($age <= 2 || $age >= 12) {
                            $fail('The passenger must be older than 2 and younger than 12 on the date of departure for CHILD type.');
                        }
                    } elseif ($passType === 'HELD_INFANT') {
                        if ($age > 2) {
                            $fail('The passenger must be 2 or younger on the date of departure for HELD_INFANT type.');
                        }
                    }
                },
            ],
            'country.*' => ['sometimes','nullable', 'string'],
        ]);
        
        // Additional check for a single adult passenger
        if (count($request->passType) == 1 && $request->passType[0] === 'ADULT') {
            $request->validate([
                'dob.0' => ['sometimes','nullable', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            ]);
        }
        
        $client=new Client;
        $token=$this->getToken($client); // generating token 
        
        // Check if the token retrieval was successful
        if ($token instanceof Response && ($token->getStatusCode() < 200 || $token->getStatusCode() >= 300)) {

            return redirect()->back()->with('error','Token not found. Please try back shortly');

        }
       
        $confirmPrice=$this->confirmPrice($selectedData,json_decode($token)->access_token); // confirming the price

            if(!isset($confirmPrice['data']['flightOffers'])){
                
            return redirect()->back()->with('error','There is a problem while matching the price with airline. Please try back shortly');

            }

            Session::put('confirmedPriceData',$confirmPrice);

            // continue to booking on amadeus api 
            $bookingResult = $this->liveBooking($confirmPrice, json_decode($token)->access_token, $request->input());
            
            if ($bookingResult['errors'] !== null) {
                // Dump and die with errors
                  return redirect()->back()->with('errors',json_decode($bookingResult['errors']));

            }
            $results=json_decode($bookingResult['response'],true);

            if(!isset($results['data']['associatedRecords'])){
                return redirect()->back()->with('error','There is a problem while creating PNR with airline');
            }
          
        $pnr=$results['data']['associatedRecords'][0]['reference'];
        $queId=$results['data']['queuingOfficeId'];
        $userId = null;

        // Check if the user is authenticated
        if (auth()->check()) {
            $userId = auth()->user()->id;
        } else {
            // Check if a user with the given email exists in the users table
            $userByEmail = User::where('email', $request->input('email'))->first();
        
            if ($userByEmail) {
                $userId = $userByEmail->id;
            } else {
                // Create a new user
                $newUser = User::create([
                    'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password'=>Hash::make(12345678),
                    'status'=>'inactive'
                ]);
        
                $userId = $newUser->id;
            }
        }

        $ticket = new Ticket;
        $ticket->user_id = $userId;
        $ticket->pnr_no = $pnr;
        $ticket->queuingOfficeId=$queId;
        $ticket->details = json_encode(Session::get('selectedData'));
        $ticket->live_details = json_encode($results);
        $ticket->p_name=$request->input('first_name');
        $ticket->p_surname=$request->input('last_name');
        $ticket->contact_no=$request->input('contact_no');
        $ticket->total_amount=$results['data']['flightOffers'][0]['price']['total'];
        $ticket->currency=$results['data']['flightOffers'][0]['price']['currency'];
        $ticket->email=$request->input('email');
        $ticket->departure_date=$searchSess['departure_date'];
        $ticket->return_date=$searchSess['return_date'];
        $ticket->tripType=$tripType;
        $ticket->destinations=$destinations;
        $ticket->last_ticketing_date=$results['data']['flightOffers'][0]['lastTicketingDate'];
        $ticket->status='pending';
        $ticket->payment_status='pending';
        $ticket->save();

        $lastInsertedId = $ticket->id;
        for ($i=0; $i < count($request->input('title')) ; $i++) { 
            $passenger=new Passenger;
            $passenger->ticket_id =$lastInsertedId;
            $passenger->title=$request->title[$i];
            $passenger->name=$request->name[$i];
            $passenger->surname=$request->surname[$i];
            $passenger->passType=$request->passType[$i];
            $passenger->gender=$request->gender[$i];
            $passenger->dob=$this->getDobBasedOnPassType($request->dob[$i],$request->passType[$i]);
            // adding dummy data if orignal not available
            $passenger->pidno=strtoupper(isset($request->pidno[$i]) &&  $request->pidno[$i] !== null &&  $request->pidno[$i] !== '' ?  $request->pidno[$i] : "abc123");

            $passenger->pied=isset($request->pied[$i]) && $request->pied[$i] !== null && $request->pied[$i] !== '' ? $request->pied[$i] : date('Y-m-d');

            $passenger->country=strtoupper(isset($request->country[$i]) && $request->country[$i] !== null &&   $request->country[$i] !== '' ?   $request->country[$i] : "US");
            $passenger->save();
        }
        Session::put('ticket_id',$lastInsertedId);
        return redirect()->route('/flight-final',$lastInsertedId);
    
    }


    private function liveBooking($flightsData, $token, $postData)
    {

        $endpoint = 'https://test.api.amadeus.com/v1/booking/flight-orders';
        $uriParam = [
            "forceClass" => 'false',
        ];

        $remarks = [
            "general" => [
                [
                    "subType" => "GENERAL_MISCELLANEOUS",
                    "text" => "ONLINE BOOKING FROM MYTRAVEL"
                ]
            ]
        ];
        $ticketingAgreement = [
            "option" => "DELAY_TO_CANCEL",
            "delay" => "6D"
        ];

        $contacts = [
            "addresseeName" => [
                "firstName" => "MY",
                "lastName" => "TRAVEL"
            ],
            "companyName" => "MYTRAVEL",
            "purpose" => "INVOICE",
            "phones" => [
                [
                    "deviceType" => "LANDLINE",
                    "countryCallingCode" => "1",
                    "number" => "771626247"
                ],
                [
                    "deviceType" => "MOBILE",
                    "countryCallingCode" => "1",
                    "number" => "950379967"
                ]
            ],
            "emailAddress" => "info@mytravel.com",
            "address" => [
                "lines" => [
                    "test address"
                ],
                "postalCode" => "12345",
                "cityName" => "test city",
                "countryCode" => "US"
            ]
        ];
        $travelers_array = [];

        for ($i = 0; $i < count($postData['name']); $i++) {
            $travelers_array []= [
                "id" => $i + 1,
                "dateOfBirth" => $this->getDobBasedOnPassType($postData['dob'][$i],$postData['passType'][$i]),
                "name" => [
                    "firstName" => strtoupper($postData['name'][$i]),
                    "lastName" => strtoupper($postData['surname'][$i])
                ],
                "gender" => strtoupper($postData['gender'][$i]),
                "contact" => [
                    "emailAddress" => strtoupper($postData['email']),
                    "phones" => [
                        [
                            "deviceType" => "MOBILE",
                            "countryCallingCode" => "92",
                            "number" => '1234567890'
                        ]
                    ]
                ],
                "documents" => [
                    [
                        "documentType" => "PASSPORT",
                        "number" => strtoupper(isset($postData['pidno'][$i]) && $postData['pidno'][$i] !== null && $postData['pidno'][$i] !== '' ? $postData['pidno'][$i] : "abc123"),
                        "expiryDate" => isset($postData['pied'][$i]) && $postData['pied'][$i] !== null && $postData['pied'][$i] !== '' ? $postData['pied'][$i] : date('Y-m-d'),
                        "issuanceCountry" => strtoupper(isset($postData['country'][$i]) && $postData['country'][$i] !== null && $postData['country'][$i] !== '' ? $postData['country'][$i] : "US"),
                        "validityCountry" => strtoupper(isset($postData['country'][$i]) && $postData['country'][$i] !== null && $postData['country'][$i] !== '' ? $postData['country'][$i] : "US"),
                        "nationality" => strtoupper(isset($postData['country'][$i]) && $postData['country'][$i] !== null && $postData['country'][$i] !== '' ? $postData['country'][$i] : "US"),
                        "holder" => true
                    ]
                ]
                

            ];
        }
        $travel=[];
        foreach ($travelers_array as $key => $value) {
            $travel[]=$value;
        }

        $body = json_encode([
            "data" => [
                "type" => "flight-order",
                "flightOffers" => [$flightsData['data']['flightOffers'][0]],
                "travelers" => $travel,
                "remarks" => $remarks,
                "ticketingAgreement" => $ticketingAgreement,
                "contacts" => [$contacts],
            ],
        ]);

        $params = http_build_query($uriParam);
        $url = $endpoint . '?' . $params;

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];

        try {
            $response = Http::withHeaders($headers)->timeout(40)->post($url, json_decode($body, true));

            return ['response' => $response->body(), 'errors' => null];
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return ['response' => null, 'errors' => $exception->response->body()];
        }
    }

    private function confirmPrice($flightsData, $token)
    {
        $endpoint = 'https://test.api.amadeus.com/v1/shopping/flight-offers/pricing';
        $uriParam = [
            "forceClass" => 'true',
        ];
    
        $body = json_encode([
            "data" => [
                "type" => "flight-offers-pricing",
                "flightOffers" => [$flightsData],
            ],
        ]);
    
        $params = http_build_query($uriParam);
        $url = $endpoint . '?' . $params;
    
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];
    
        $response = Http::withHeaders($headers)->post($url, json_decode($body, true));
    
        return json_decode($response->body(),true);
    }
    
    private function getToken($client)
    {
        $url = 'https://test.api.amadeus.com/v1/security/oauth2/token';
        try {
            $response = $client->post($url, [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => env('AMADEUS_API_KEY'),
                    'client_secret' => env('AMADEUS_API_SECRET')
                ]
            ]);
            $response = $response->getBody();
            $access_token = json_decode($response)->access_token;
            return $response;
        } catch (RequestException  $exception) {
            if ($exception->hasResponse()) {
                return $exception->getResponse();
            } else {
                return $exception->getMessage();
            }
       }
    } 

    //********* final Page view  *************\\
    public function final($id){
        $sessId=Session::get('ticket_id');
        if($id!=$sessId){
            return redirect()->back();

        }else{
            $result = Ticket::with('passengers')->find($id);
            $amount=$result->total_amount*100;
		
		$stripe= new \Stripe\StripeClient([
		   'api_key'=>env('STRIP_SECRET_KEY'),
		   ]);
		   $pyamentIntent= $stripe->paymentIntents->create(
			[
			  'description' => 'Flight Booking details',
			  'shipping' => [
				'name' => $result->p_name,
				'address' => [
				  'line1' => 'jhonson street',
				  'postal_code' => '98140',
				  'city' => 'Paris',
				  'state' => 'state',
				  'country' => 'US',
				  
				],
			  ],
			  'amount' => $amount,
			  'currency' => $result->currency,
			  'payment_method_types' => ['card'],
			  'receipt_email'=>$result->email,
			  
			]
		  );
           $selectedData= Session::get('selectedData');
           $confirmedPriceData= Session::get('confirmedPriceData');
            return view('frontend/flight/checkout',compact('selectedData','confirmedPriceData','pyamentIntent','result'));
        }
    }


        //********* payment success method  *************\\
        public function paymentProceed($id){
          
            $sessId=Session::get('ticket_id');
            if($id!=$sessId){
                return redirect()->back();
            }else{
                
                $ticketUpdate = Ticket::find($id);

                $stripe= new \Stripe\StripeClient([
                	'api_key'=>'sk_test_51M7Z55ISOsxBdZn7bpqqZAz5eQlAMUCtWfPA8PfdzJDdAUf2TtkHXXQtTRYYHsVkRpuOH0eRTSC3U8ZnMyaJ4CmG00kvfmLiVc',
                	]);
                $paymentIntent=$stripe->paymentIntents->retrieve($_GET['payment_intent']);
                
               $selectedData= Session::get('selectedData');
               
               if ($ticketUpdate) {
                // Update the payment_method field
                if($ticketUpdate->payment_status!=='succeeded'){

                $ticketUpdate->payment_method = 'card';
                $ticketUpdate->payment_status = $paymentIntent->status;
                $ticketUpdate->txn_id = $paymentIntent->id;
                $ticketUpdate->paid_amount = $ticketUpdate->total_amount;
                $ticketUpdate->paid_amount_currency = $paymentIntent->paid_amount_currency;
                // Save the changes
                $ticketUpdate->save();
               }
                $ticketDetails = Ticket::with('passengers')->find($id);
                // dd($ticketDetails);

                   return view('frontend/flight/success',compact('selectedData','id','ticketDetails'));
               } else {
                    return redirect()->route('home')->with('error','Ticket data not found');
               }

    
            }
        }
       

        public function getDobBasedOnPassType($dob, $passType) {
            if (empty($dob) || is_null($dob) || $dob == '') {
                switch ($passType) {
                    case 'ADULT':
                        // Set dynamic date for an adult (over 18 years old)
                        return Carbon::now()->subYears(20)->format('Y-m-d');
                    case 'CHILD':
                        // Set dynamic date for a child (between 2 and 12 years old)
                        return Carbon::now()->subYears(6)->format('Y-m-d');
                    case 'HELD_INFANT':
                        // Set dynamic date for an infant (less than 2 years old)
                        return Carbon::now()->subYears(1)->format('Y-m-d');
                    default:
                        // Set a default dynamic date for other cases
                        return Carbon::now()->subYears(20)->format('Y-m-d');
                }
            }
        
            return $dob;
        }
        
        
    
}
