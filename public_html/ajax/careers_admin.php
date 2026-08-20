<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/db.php';

$action = $_POST['action'] ?? '';
$jsonData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($action)) {
    $rawInput = @file_get_contents('php://input');
    if (!empty($rawInput)) {
        $jsonData = @json_decode($rawInput, true);
        if (is_array($jsonData)) {
            $action = $jsonData['action'] ?? '';
        }
    }
}

// If this is an administrative action or a GET inquiry, enforce authentication guard
$isPublicAction = ($action === 'create_applicant' || $action === 'register_alert');
if (!$isPublicAction) {
    require_once __DIR__ . '/../includes/auth_guard.php';
}

$applicantsFile = __DIR__ . '/../data/job_applicants.json';
$careersFile = __DIR__ . '/../data/careers.json';

if (!is_dir(dirname($applicantsFile))) {
    mkdir(dirname($applicantsFile), 0755, true);
}

$applicants = [];
if (file_exists($applicantsFile)) {
    $applicants = json_decode(file_get_contents($applicantsFile), true) ?? [];
}

$jobs = [];
if (file_exists($careersFile)) {
    $jobs = json_decode(file_get_contents($careersFile), true) ?? [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Enforce CSRF token validation for administrative actions
    if (!$isPublicAction) {
        $token = $jsonData['csrf_token'] ?? $_POST['csrf_token'] ?? '';
        if (!validate_csrf_token($token)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Forbidden: Invalid or missing CSRF security token.']);
            exit;
        }
    }

    // 1. CREATE APPLICANT / CANDIDATE REGISTRATION (PUBLIC)
    if ($action === 'create_applicant' || $action === 'register_alert') {
        $name = trim($jsonData['fullName'] ?? $jsonData['name'] ?? $_POST['fullName'] ?? '');
        $email = trim($jsonData['email'] ?? $_POST['email'] ?? '');
        $specialty = trim($jsonData['specialty'] ?? $_POST['specialty'] ?? 'Engineering');
        $portfolioUrl = trim($jsonData['portfolioUrl'] ?? $jsonData['url'] ?? $_POST['portfolioUrl'] ?? '');

        if (empty($name) || empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Please provide both your name and email.']);
            exit;
        }

        $newApplicant = [
            'id' => time(),
            'fullName' => $name,
            'email' => $email,
            'specialty' => $specialty,
            'portfolioUrl' => $portfolioUrl ?: 'https://github.com',
            'status' => 'PENDING',
            'date' => date('M d, Y'),
            'notes' => 'Registered via Careers & Talent Pool modal.'
        ];

        array_unshift($applicants, $newApplicant);
        file_put_contents($applicantsFile, json_encode($applicants, JSON_PRETTY_PRINT));

        echo json_encode(['success' => true, 'message' => 'Candidate registered successfully for Talent Pool!']);
        exit;
    }

    // 2. UPDATE APPLICANT STATUS (ADMIN)
    if ($action === 'update_applicant_status') {
        $id = intval($jsonData['id'] ?? $_POST['id'] ?? 0);
        $status = strtoupper(trim($jsonData['status'] ?? $_POST['status'] ?? 'SHORTLISTED'));

        $found = false;
        foreach ($applicants as &$app) {
            if (intval($app['id']) === $id) {
                $app['status'] = $status;
                $found = true;
                break;
            }
        }
        unset($app);

        if ($found) {
            file_put_contents($applicantsFile, json_encode($applicants, JSON_PRETTY_PRINT));
            echo json_encode(['success' => true, 'message' => "Candidate status updated to {$status}.", 'applicants' => $applicants]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Candidate not found.']);
        }
        exit;
    }

    // 3. DELETE APPLICANT (ADMIN)
    if ($action === 'delete_applicant') {
        $id = intval($jsonData['id'] ?? $_POST['id'] ?? 0);
        $applicants = array_values(array_filter($applicants, function($a) use ($id) {
            return intval($a['id']) !== $id;
        }));
        file_put_contents($applicantsFile, json_encode($applicants, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'message' => 'Candidate removed from talent pool.', 'applicants' => $applicants]);
        exit;
    }

    // 4. SAVE / CREATE / UPDATE JOB OPENING (ADMIN)
    if ($action === 'save_job') {
        $id = intval($jsonData['id'] ?? $_POST['id'] ?? 0);
        $title = trim($jsonData['title'] ?? $_POST['title'] ?? '');
        $dept = trim($jsonData['department'] ?? $_POST['department'] ?? 'Engineering');
        $location = trim($jsonData['location'] ?? $_POST['location'] ?? 'Remote (Global)');
        $status = trim($jsonData['status'] ?? $_POST['status'] ?? 'Announcement Coming Soon');
        $description = trim($jsonData['description'] ?? $_POST['description'] ?? '');
        $tags = is_array($jsonData['tags'] ?? null) ? $jsonData['tags'] : explode(',', trim($jsonData['tags'] ?? 'Rust, Go, Cloud'));

        if (empty($title)) {
            echo json_encode(['success' => false, 'message' => 'Job title is required.']);
            exit;
        }

        if ($id > 0) {
            foreach ($jobs as &$job) {
                if (intval($job['id']) === $id) {
                    $job['title'] = $title;
                    $job['department'] = $dept;
                    $job['location'] = $location;
                    $job['status'] = $status;
                    $job['description'] = $description;
                    $job['tags'] = $tags;
                    break;
                }
            }
            unset($job);
        } else {
            $newJobId = count($jobs) > 0 ? (max(array_column($jobs, 'id')) + 1) : 1;
            $newJob = [
                'id' => $newJobId,
                'title' => $title,
                'department' => $dept,
                'location' => $location,
                'status' => $status,
                'description' => $description,
                'tags' => $tags
            ];
            array_unshift($jobs, $newJob);
        }

        file_put_contents($careersFile, json_encode($jobs, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'message' => 'Job opening saved successfully!', 'jobs' => $jobs]);
        exit;
    }

    // 5. DELETE JOB OPENING (ADMIN)
    if ($action === 'delete_job') {
        $id = intval($jsonData['id'] ?? $_POST['id'] ?? 0);
        $jobs = array_values(array_filter($jobs, function($j) use ($id) {
            return intval($j['id']) !== $id;
        }));
        file_put_contents($careersFile, json_encode($jobs, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'message' => 'Job opening removed.', 'jobs' => $jobs]);
        exit;
    }

} else {
    // GET REQUEST (Protected admin data)
    echo json_encode([
        'success' => true,
        'applicants' => $applicants,
        'jobs' => $jobs
    ]);
    exit;
}
