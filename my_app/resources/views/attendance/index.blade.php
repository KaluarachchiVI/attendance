<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            margin-bottom: 10px;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form input, .filter-form select {
            padding: 10px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Attendance List</h1>
    <a href="{{ route('attendance.create') }}">Add Attendance</a>

    <!-- Filter Form -->
    <form class="filter-form" action="{{ route('attendance.index') }}" method="GET">
        <label for="subject_name">Subject:</label>
        <select name="subject_name" id="subject_name">
            <option value="">All Subjects</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->subject_name }}" {{ request('subject_name') == $subject->subject_name ? 'selected' : '' }}>
                    {{ $subject->subject_name }}
                </option>
            @endforeach
        </select>

        <label for="date_from">Date From:</label>
        <input type="date" name="date_from" id="date_from" value="{{ request('date_from', now()->subWeek()->toDateString()) }}">

        <label for="date_to">Date To:</label>
        <input type="date" name="date_to" id="date_to" value="{{ request('date_to', now()->toDateString()) }}">

        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Subject Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Attendance Percentage</th> <!-- New Column for Percentage -->
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->student_name }}</td>
                    <td>{{ $attendance->subject_name }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td>{{ round(($attendanceData[$attendance->student_name]['percentage'] ?? 0), 2) }}%</td> <!-- Show Percentage -->
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $attendances->links() }} <!-- Pagination links -->
</body>
</html>
