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
                <th>Student</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Attended</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->student->name }}</td>
                    <td>{{ $attendance->subject->name }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->attended ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $attendances->links() }} <!-- Pagination links -->
</body>
</html>
