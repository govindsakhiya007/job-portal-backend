<!DOCTYPE html>
<html>
<head>
    <title>New Job Application</title>
</head>
<body>
    <h2>Hello {{ $job->employer->name }},</h2>
    <p>{{ $applicant->name }} has applied for the job: <strong>{{ $job->title }}</strong>.</p>
    <p>Check the application in your dashboard.</p>
    <p>Thanks!</p>
</body>
</html>
