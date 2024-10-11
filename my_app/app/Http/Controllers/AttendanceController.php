<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
{
    $query = Attendance::query();

    // Filter by subject if provided
    if ($request->filled('subject_name')) {
        $query->where('subject_name', $request->subject_name);
    }

    // Filter by date range if provided
    if ($request->filled('date_from') && $request->filled('date_to')) {
        $query->whereBetween('date', [$request->date_from, $request->date_to]);
    }

    // Get attendance records with pagination
    $attendances = $query->paginate(10);

    // Get distinct subjects for the filter dropdown
    $subjects = Attendance::select('subject_name')->distinct()->get();

    // Calculate attendance percentage for each student
    $attendanceData = [];
    foreach ($attendances as $attendance) {
        if (!isset($attendanceData[$attendance->student_name])) {
            $attendanceData[$attendance->student_name] = [
                'total' => 0,
                'present' => 0,
                'subject_name' => $attendance->subject_name // Assuming the same subject for all records
            ];
        }
        $attendanceData[$attendance->student_name]['total']++;
        if ($attendance->status === 'present') {
            $attendanceData[$attendance->student_name]['present']++;
        }
    }

    // Calculate percentage for each student
    foreach ($attendanceData as $studentName => $data) {
        $attendanceData[$studentName]['percentage'] = $data['total'] > 0 ? ($data['present'] / $data['total']) * 100 : 0;
    }

    return view('attendance.index', compact('attendances', 'subjects', 'attendanceData'));
}

    


    
    public function create()
{
    $subjects = Subject::all();  // Fetch all subjects
    $students = Student::with('subjects')->get();  // Fetch all students with their related subjects

    return view('attendance.create', compact('subjects', 'students'));
}

    
// Fetch students enrolled in a specific subject via AJAX
public function fetchStudents($subjectId)
{
    // Fetch students who are enrolled in the given subject
    $students = Student::whereHas('subjects', function($query) use ($subjectId) {
        $query->where('id', $subjectId);
    })->get();

    // Return the students as JSON
    return response()->json($students);
}


public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'subject_id' => 'required|exists:subjects,id', // Ensure the subject ID is valid
        'attendance' => 'required|array', // Ensure attendance data is provided
    ]);

    // Fetch the subject name based on the selected ID
    $subject = Subject::findOrFail($request->subject_id);

    // Loop through each student's attendance status and save
    foreach ($request->attendance as $studentId => $status) {
        Attendance::create([
            'student_name' => Student::findOrFail($studentId)->name, // Fetch student name based on ID
            'subject_name' => $subject->name, // Store the subject name directly
            'status' => $status === 'present' ? 'present' : 'absent', // Determine attendance status
            'date' => now()->toDateString(), // Store today's date
        ]);
    }

    return redirect()->route('attendance.index')->with('success', 'Attendance marked successfully!');
}



    

}
