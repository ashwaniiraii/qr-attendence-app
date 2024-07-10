<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class qrController extends Controller
{
    public function generate($id)
    {
        $user = User::findOrFail($id);
        $randomString = Str::random(10);
        $user->qr_token = $randomString;
        $user->save();

        $qrCode = QrCode::size(300)->generate(route('qr.scan', ['id' => $user->id, 'token' => $randomString]));

        return view('layout.qrcode', compact('qrCode', 'user', 'randomString'));
    }

    public function scan(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $token = $request->query('token');
        if ($user->qr_token !== $token) {
            return response()->json(['message' => 'Invalid QR code'], 400);
        }

        $currentDate = Carbon::now()->format('Y-m-d');

        $attendance = Attendence::where('user_id', $user->id)
            ->where('date', $currentDate)
            ->first();

        if ($attendance) {
            $attendance->checkout = Carbon::now()->format('H:i:s');
            $attendance->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $checkinTime = Carbon::createFromFormat('H:i:s', $attendance->checkin);
            $updatedAtTime = Carbon::createFromFormat('Y-m-d H:i:s', $attendance->updated_at);
            $timeDifference = $updatedAtTime->diffInHours($checkinTime);
            if ($timeDifference >= 8) {
                $attendance->status = 'Present';
            } else {
                $attendance->status = '--';
            }

        } else {
            $attendance = new Attendence();
            $attendance->user_id = $user->id;
            $attendance->name = $user->name;
            $attendance->email = $user->email;
            $attendance->date = $currentDate;
            $attendance->checkin = Carbon::now()->format('H:i:s');
            if (! $attendance->created_at) {
                $attendance->created_at = Carbon::now()->format('Y-m-d H:i:s');
            }
        }

        $attendance->save();

        return response()->json(['message' => 'Attendance recorded successfully']);
    }

    public function alluser()
    {
        $users = User::all();

        return view('layout.alluser', compact('users'));
    }

    public function myattendence()
    {
        $userId = Auth::id();
        $myattendences = Attendence::where('user_id', $userId)->get();
        // dd($myattendences);
        foreach ($myattendences as $attendance) {
            $attendance->formatted_date = Carbon::parse($attendance->date)->format('j F Y');
            $attendance->formatted_checkin = Carbon::parse($attendance->checkin)->setTimezone('Asia/Kolkata')->format('h:i A');
            if ($attendance->checkout) {
                $attendance->formatted_checkout = Carbon::parse($attendance->checkout)->setTimezone('Asia/Kolkata')->format('h:i A');
                // Calculate the total time
                $checkinTime = Carbon::parse($attendance->checkin)->setTimezone('Asia/Kolkata');
                $checkoutTime = Carbon::parse($attendance->checkout)->setTimezone('Asia/Kolkata');
                $totalTime = $checkinTime->diff($checkoutTime);

                $attendance->total_time = $totalTime->format('%h hours %i minutes');
            } else {
                $attendance->formatted_checkout = 'Not Checked Out';
                $attendance->total_time = 'N/A';
            }
        }

        return view('layout.myattendence', compact('myattendences'));
    }
}
