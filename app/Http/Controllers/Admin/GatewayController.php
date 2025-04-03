<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use Illuminate\Support\Facades\DB;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class GatewayController extends Controller
{
  // In your GatewaySideController.php
  public function index()
  {
      // Get appointments with user information
      $appointments = DB::table('appointments')
          ->join('users', 'appointments.user_id', '=', 'users.id')
          ->select('appointments.*', 'users.name as user_name')
          ->get();
          
      return view('admin.gateway.index', compact('appointments'));
  }

  public function sendReminder($id)
{
    $appointment = DB::table('appointments')->where('id', $id)->first();
    
    if (!$appointment) {
        return redirect()->back()->with('error', 'Appointment not found');
    }
    
    try {
        // Format phone number
        $phoneNumber = $appointment->contact;
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '+63' . substr($phoneNumber, 1);
        }
        
        // Create the message
        $message = "Hello {$appointment->fullname}, this is a reminder for your upcoming appointment at CLSU-VETLIFE on {$appointment->appointment_date} at {$appointment->appointment_time}.";
        
        // Use cURL directly as a last resort
        $data = [
            'api_key' => env('VONAGE_KEY'),
            'api_secret' => env('VONAGE_SECRET'),
            'to' => $phoneNumber,
            'from' => 'CLSU-VETLIFE',
            'text' => $message
        ];
        
        $ch = curl_init('https://rest.nexmo.com/sms/json');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only for development!
        
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        
        if ($err) {
            \Log::error('cURL Error', ['error' => $err]);
            return redirect()->back()->with('error', 'Error sending reminder: ' . $err);
        }
        
        $responseData = json_decode($response, true);
        \Log::info('API Response', ['response' => $responseData]);
        
        if (isset($responseData['messages'][0]['status']) && $responseData['messages'][0]['status'] == '0') {
            return redirect()->back()->with('success', 'Reminder sent to ' . $appointment->fullname);
        } else {
            $errorMsg = isset($responseData['messages'][0]['error-text']) ? $responseData['messages'][0]['error-text'] : 'Unknown error';
            return redirect()->back()->with('error', 'Failed to send reminder: ' . $errorMsg);
        }
    } catch (\Exception $e) {
        \Log::error('SMS exception', ['exception' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Error sending reminder: ' . $e->getMessage());
    }
}
}