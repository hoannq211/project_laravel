<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceLogStoreRequest;
use App\Models\AttendanceLog;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttendanceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendanceLogs = AttendanceLog::with(["user", "timeEntries"])->paginate(10);

        return view("admin.attendance-logs.index")->with([
            "attendanceLogs" => $attendanceLogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        return view("admin.attendance-logs.create")->with([
            "users" => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceLogStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $attendanceLog = AttendanceLog::create([
                "user_id" => $request->user_id,
                "date" => $request->date
            ]);

            if ($request->has('time_logs') && is_array($request->time_logs)) {
                foreach ($request->time_logs as $index => $timeLog) {
                    $timeEntry = [
                        "start_time" => $timeLog['start_time'],
                        "end_time" => $timeLog['end_time'],
                        "attendance_log_id" => $attendanceLog['id']
                    ];
                    if (isset($request->file('time_logs')[$index]['image'])) {
                        $file = $request->file('time_logs')[$index]['image'];
                        $path = $file->store('uploads/attendanceLogs', 'public');

                        $timeEntry['image_path']= $path;
                    }

                    TimeEntry::create($timeEntry);
                }
            }

            DB::commit();
            return redirect()->route('admin.attendance-log.index')
                ->with('success', 'Tạo bản ghi điểm danh thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendanceLog = AttendanceLog::findOrFail($id);
        $users = User::get();

        return view("admin.attendance-logs.show")->with([
            'attendanceLog' => $attendanceLog,
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::select('id', 'name')->get();
        $attendanceLog = AttendanceLog::findOrFail($id);
        return view('admin.attendance-logs.edit', compact('attendanceLog', 'users'));
    }

    public function update(AttendanceLogStoreRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $attendanceLog = AttendanceLog::findOrFail($id);
            $attendanceLog->update([
                'user_id' => $request->user_id,
                'date' => $request->date
            ]);

            $attendanceLog->timeEntries()->delete();

            if ($request->has('time_logs') && is_array($request->time_logs)) {
                foreach ($request->time_logs as $index => $timeLog) {
                    $timeEntry = [
                        "start_time" => $timeLog['start_time'],
                        "end_time" => $timeLog['end_time'],
                        "attendance_log_id" => $attendanceLog['id']
                    ];

                    if (isset($request->file('time_logs')[$index]['image'])) {
                        $file = $request->file('time_logs')[$index]['image'];
                        $path = $file->store('uploads/attendanceLogs', 'public');

                        $timeEntry['image_path']= $path;
                    }

                    TimeEntry::create($timeEntry);
                }
            }

            DB::commit();
            return redirect()->route('admin.attendance-log.index')
                ->with('success', 'Cập nhật bản ghi điểm danh thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendanceLog = AttendanceLog::findOrFail($id);
        $attendanceLog->delete();

        return redirect()->route('admin.attendance-log.index')->with('success', 'Xóa mềm thành công.');
    }

    public function trash()
    {
        $attendanceLogs = AttendanceLog::with('user', 'images')->onlyTrashed()->paginate(10);

        return view('admin.attendance-logs.trash', compact('attendanceLogs'));
    }

    public function restore($id)
    {
        $attendanceLog = AttendanceLog::onlyTrashed()->findOrFail($id);
        $attendanceLog->restore();

        return redirect()->back()->with('success', 'Khôi phục thành công.');
    }

    public function forceDelete($id)
    {
        $attendanceLog = AttendanceLog::onlyTrashed()->findOrFail($id);
        foreach ($attendanceLog->images as $image) {
            Storage::disk('public')->delete($image->url);
            $image->delete();
        }

        $attendanceLog->forceDelete();

        return redirect()->back()->with('success', 'Xóa vĩnh viễn thành công.');
    }
}
