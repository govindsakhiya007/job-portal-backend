<!DOCTYPE html>
<html>
<head>
    <title>Job Application Received</title>
</head>
    <body>
        <h2>Dear {{ $jobEmployer }},</h2>
        
        <p>You have received a new job application.</p>

        <p><strong>Applicant:</strong> {{ $applicantName }}</p>
        <p><strong>Job Title:</strong> {{ $jobTitle }}</p>

        <p>Please check your dashboard for more details.</p>

        <p>Best regards,<br>Job Portal Team</p>
    </body>
</html>
