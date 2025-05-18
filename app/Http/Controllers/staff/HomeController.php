<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use App\Models\TimeEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $attendanceLogs = AttendanceLog::where('user_id', Auth::id())->paginate(10);
        $user = Auth::user();
        // dd($attendanceLogs);
        return view("client.attendance-logs.index")->with([
            "attendanceLogs" => $attendanceLogs,
            'user' => $user
        ]);
    }

    public function timekeeping()
    {
        $user = Auth::user();
        $today = now()->toDateString();

        $hasCheckedIn = false;
        $hasCheckedOut = false;

        $attendanceLog = AttendanceLog::where('user_id', $user['id'])
            ->where('date', $today)
            ->first();
        $timeEntries = collect();
        if ($attendanceLog) {
            $timeEntries = $attendanceLog->timeEntries()->get();
            
            $lastEntry = $attendanceLog->timeEntries()->latest()->first();
            if ($lastEntry && $lastEntry->start_time && !$lastEntry->end_time) {
                $hasCheckedIn = true;  // Đã check-in nhưng chưa check-out
            } elseif ($lastEntry && $lastEntry->end_time) {
                $hasCheckedOut = true; // Đã check-out rồi
            }
        }


        return view('client.attendance-logs.timekeeping')->with([
            "user" => $user,
            "timeEntries" => $timeEntries,
            "hasCheckedIn" => $hasCheckedIn,
            "hasCheckedOut" => $hasCheckedOut
        ]);
    }

    public function timekeepingPost(Request $request)
    {
        try {
            DB::beginTransaction();
            $userId = Auth::id();
            $today = now()->toDateString();
            $time = now()->format("H.i"); // giờ hiện tại
            $timekeeping = AttendanceLog::firstOrCreate([
                "user_id" => $userId,
                "date" => $today
            ]);

            if ($request->action == 'check-in') {
                $timekeeping->timeEntries()->create([
                    "start_time" => $time,
                    "end_time" => null
                ]);

                DB::commit();
                return redirect()->back()->with('success', 'Bạn đã checkin thành công');
            }

            if ($request->action == 'check-out') {

                $latestEntry = $timekeeping->timeEntries()->whereNull('end_time')->latest()->first();

                if (!$latestEntry) {
                    return redirect()->back()->with('error', 'Bạn chưa check-in để có thể check-out.');
                }

                $latestEntry->update([
                    'end_time' => $time,
                ]);


                DB::commit();
                return redirect()->back()->with('success', 'Check-out thành công!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }
}
