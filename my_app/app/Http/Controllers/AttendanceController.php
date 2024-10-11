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


    // Store attendance records
    public function store(Request $request)
{
    $subjectId = $request->input('subject_id');
    $attendances = $request->input('attendance', []);

    // Loop through all students' attendance and store it in the database
    foreach ($attendances as $studentId => $status) {
        Attendance::create([
            'student_id' => $studentId,
            'subject_id' => $subjectId,
            'status' => $status,
            'date' => now(),
        ]);
    }

    return redirect()->route('attendance.index')->with('success', 'Attendance marked successfully');
}

}
