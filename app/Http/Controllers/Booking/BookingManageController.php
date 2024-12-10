<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\airlines;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Passenger;
use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BookingManageController extends Controller
{
    public function index(Request $resuest){

        if (auth()->user()->hasPermissionTo('manage bookings')) {
            // The authenticated user has the 'manage bookings' permission
            $tickets = Ticket::with('user')->get();
        } else {
            // Retrieve only the tickets associated with the authenticated user
            $tickets = Ticket::with('user')->where('user_id', auth()->id())->get();
        }
    
        return view('backend/bookings/booking-list', compact('tickets'));
    }

public function viewTicket($id)
{
    // Retrieve the ticket by ID with passengers
    $ticket = Ticket::with('passengers')->find($id);

    // If the user doesn't have the 'manage bookings' permission
    if (!auth()->user()->hasPermissionTo('manage bookings')) {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== auth()->id()) {
            // Redirect or handle unauthorized access as needed
            return redirect()->route('/booking-list')->with('error','You are not authorized for this.');

        }
    }

//    echo "<pre>"; print_r(json_decode($ticket->live_details));exit;
    return view('backend/bookings/ticket-view', compact('ticket'));
}

    public function editTicket($id){
        $ticket=Ticket::with('passengers')->findorfail($id);
        return view('backend/bookings/ticket-edit',compact('ticket'));
    }

    public function updateTicket(Request $request ,$id){
        $ticket=Ticket::findorfail($id);
        $rules = [
            'pnr_no' => ['sometimes', 'string', 'nullable', 'max:255', Rule::unique('tickets')->ignore($ticket->id)],
            'destinations' => ['sometimes', 'string', 'nullable', 'max:255'],
            'departure_date' => ['sometimes', 'nullable', 'string'],
            'return_date' => ['sometimes', 'nullable', 'string'],
            'bags' => ['sometimes', 'nullable', 'string', 'max:15'],
            'tripType' => ['sometimes', 'nullable', 'string',Rule::in(['round', 'single'])],
            'ticket_status' => ['sometimes', 'nullable', 'string', 'max:50'],
            'total_amount' => ['sometimes', 'nullable', 'string', 'max:50'],
            'payment_status' => ['sometimes', 'nullable', 'string' ,Rule::in(['completed', 'pending'])],

        ];
        $validatedData = $request->validate($rules);

        // Update the ticket data with the validated data
        $ticket->update($validatedData);

        return redirect()->route('/booking-list')->with('success','Ticket data updated');
    }


    public function updatePassengers(Request $request, $id)
    {
        $passengerData = $request->only(['title', 'name', 'surname']);
        $ticket=Ticket::find($id);
        foreach ($passengerData['title'] as $index => $title) {
            $passengerId = $request->input('passenger_ids')[$index];
            $ticket->passengers()->where('id', $passengerId)->update([
                'title' => $title,
                'name' => $passengerData['name'][$index],
                'surname' => $passengerData['surname'][$index],
            ]);
        }
    
        return redirect()->route('/booking-list')->with('success','Passengers data updated');

    }

    
    public function bookingInquiry($id = null)
    {
        // Get the authenticated user ID
        $authUserId = Auth::id();
    
        if ($id) {
            // Fetch the inquiry by ID with the 'viewedBy' relationship
            $inquiries = Inquiry::with('viewedBy')->find($id);
    
            if ($inquiries) {
                // Set the status to 'inactive'
                $inquiries->status = 'inactive';
    
                // Set the 'view_by' column to the authenticated user's ID
                $inquiries->view_by = $authUserId;
    
                // Save the changes
                $inquiries->save();
            }
    
            return view('backend/bookingInquiry/inquiry-single', compact('inquiries'));
        } else {
            // Fetch all inquiries with the 'viewedBy' relationship
            $inquiries = Inquiry::with('viewedBy')->orderBy('created_at')->get();
    
            return view('backend/bookingInquiry/inquiry-list', compact('inquiries'));
        }
    }
    
    public function bookingInquiryUpdate(Request $request,$id){
        $request->validate([
            'comment' => 'sometimes|string|nullable',
        
        ]);
        $inquiry=Inquiry::findOrfail($id);
        $inquiry->comment=$request->input('comment');
        $inquiry->view_by=Auth::id();
        $inquiry->save();
        return redirect()->route('booking-inquiry')->with('success','Inquiry Updated Successfully');
    }
    
}
