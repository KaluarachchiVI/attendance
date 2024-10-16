<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
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
        label {
            display: block;
            margin: 10px 0 5px;
        }
        select, input[type="text"], input[type="date"], button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
        .student-row {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Mark Attendance</h1>

    <a href="{{ route('attendance.index') }}">Back to Attendance List</a> <!-- Back button -->

    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf

        <!-- Subject selection -->
        <label for="subject_id">Select Subject:</label>
        <select name="subject_id" id="subject_id" required>
            <option value="">Select a subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>

        <!-- Students selection (filtered dynamically based on subject) -->
        <div id="students-list">
            <label>Select Students:</label>
            @foreach($students as $student)
                <div class="student-row" data-subject-ids="{{ implode(',', $student->subjects->pluck('id')->toArray()) }}">
                    <label>
                        <input type="checkbox" name="attendance[{{ $student->id }}]" value="present">
                        {{ $student->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit">Submit Attendance</button>
    </form>

    <script>
        document.getElementById('subject_id').addEventListener('change', function() {
            const subjectId = this.value;

            // Show/hide students based on selected subject
            document.querySelectorAll('.student-row').forEach(function(row) {
                const subjectIds = row.getAttribute('data-subject-ids').split(',');
                if (subjectIds.includes(subjectId)) {
                    row.style.display = 'block'; // Show students related to selected subject
                } else {
                    row.style.display = 'none'; // Hide students not related to selected subject
                }
            });
        });
    </script>
</body>
</html>
