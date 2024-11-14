<?php
// Replace with your actual ZeroGPT API key
$api_key = "API Key";

// Get the text input from the frontend
$data = json_decode(file_get_contents('php://input'), true);
$input_text = $data['text'] ?? '';

// Prepare the request body with required fields
$request_data = [
    "input_text" => $input_text,
    "originalParagraph" => "string",
    "textWords" => 0,
    "aiWords" => 0,
    "fakePercentage" => 0,
    "sentences" => [],
    "h" => [],
    "collection_id" => 0,
    "fileName" => "string",
    "feedback" => "string"
];

// Set up the API endpoint URL
$api_url = "https://api.zerogpt.com/api/detect/detectText";

// Initialize cURL session
$ch = curl_init($api_url);

// Configure cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "ApiKey: $api_key"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo json_encode(['error' => 'Request Error: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

// Close the cURL session
curl_close($ch);

// Send the entire API response back to the frontend
header('Content-Type: application/json');
echo $response;
