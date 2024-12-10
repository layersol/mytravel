<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\airlines;
use App\Models\identity;
use App\Models\ContactDetail;
use App\Models\Inquiry;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class SearchController extends Controller
{
    
    public function search(Request $request)
    {
            $inquiry=false;
            $name=$email=$mobile=null; 
        if ($request->query('inquiry') && $request->query('inquiry')=='yes') {
            $name=$request->query('name') ?? null;
            $email=$request->query('email') ?? null;
            $mobile=$request->query('mobile') ?? null;
            $inquiry=true;
        }
        $query = [
            'departure_full' => $request->query('departure_full'),
            'departure_code' => $request->query('departure_code'),
            'arrival_full'   => $request->query('arrival_full'),
            'arrival_code'   => $request->query('arrival_code'),
            'departure_date' => $request->query('departure_date'),
            'return_date'    => $request->query('return_date'),
            'adult'          => $request->query('adult'),
            'child'          => $request->query('child'),
            'infant'         => $request->query('infant'),
            'travel_class'   => $request->query('travel_class'),
            'name'=>$name,
            'email'=>$email,
            'mobile'=>$mobile,
        ];
        if (!$request->query('departure_code')) {
            return redirect()->route('home');
        }
   
        Session::put('searchParams',$query);

        // inserting the inquiry in table in case 
            if ($inquiry && !is_null($name) && !is_null($email)) {
                
                $this->insertInquiry($query);
           }
        try {
            $response = $this->apiCall($query);
    
            // Check if the response has a 2xx status code (indicating success)
            if ($response instanceof Response && $response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                $responseData = json_decode($response->getBody());
                    if(isset($responseData->errors)){
                     
                      return redirect()->back()->with('customErrors',$responseData->errors);

                    }
                    // echo "<pre>";print_r($responseData);exit;
                // Your code to handle successful response data
                return view('frontend/flight/list', ['data' => $responseData]);
               
            } else {
                // Handle non-successful response (e.g., 4xx or 5xx status code)
                $errorResponse = json_decode($response->getBody());
                
                return redirect()->back()->with('customError',$errorResponse);
            }
    
        } catch (RequestException $exception) {
            // Handle GuzzleException (API request failure)
            if ($exception->getResponse()) {
                $errorResponse = json_decode($exception->getResponse()->getBody());
                return redirect()->back()->with('customError',$errorResponse);

            }
        }
    }
    

}
