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
        $query = Attendance::with(['student', 'subject']);
    
        // Filter by date range if provided
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }
    
        // Filter by subject if provided
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
    
        // Get attendance records and paginate
        $attendances = $query->paginate(10); // Renamed variable to 'attendances'
    
        // Fetch all subjects for the filter dropdown
        $subjects = Subject::all();
    
        // Return the view with attendances and subjects
        return view('attendance.index', compact('attendances', 'subjects')); // Pass 'attendances' to the view
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
        'student_name' => 'required|string',
        'subject_name' => 'required|string',
        'status' => 'required|string',
        'date' => 'required|date',
    ]);

    // Create a new attendance record
    Attendance::create([
        'student_name' => $request->student_name,
        'subject_name' => $request->subject_name,
        'status' => $request->status,
        'date' => $request->date,
    ]);

    return redirect()->route('attendance.index')->with('success', 'Attendance marked successfully');
}

    

}
