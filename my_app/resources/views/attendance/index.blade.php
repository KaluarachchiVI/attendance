<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
</head>
<body>
    <h1>Attendance List</h1>
    <a href="{{ route('attendance.create') }}">Add Attendance</a>
    <table>
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Subject Name</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->student_name }}</td>
                <td>{{ $attendance->subject_name }}</td>
                <td>{{ $attendance->date }}</td>
                <td>{{ $attendance->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


    {{ $attendances->links() }} <!-- Pagination links -->
</body>
</html>
