<?php
libxml_use_internal_errors(true);

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to clean text
function cleanText($text) {
    return trim(preg_replace('/\s+/', ' ', $text));
}

try {
    // Get the HTML content
    $html = file_get_contents('http://mtc.sapd.ir/classlinks');
    if ($html === false) {
        throw new Exception('Failed to fetch the webpage');
    }

    // Create DOM document
    $doc = new DOMDocument();
    $doc->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING);
    
    // Create XPath
    $xpath = new DOMXPath($doc);
    
    // Find the table rows (excluding header row)
    $rows = $xpath->query('//table/tbody/tr');
    
    if ($rows->length === 0) {
        throw new Exception('No table rows found');
    }

    $data = [];
    
    foreach ($rows as $row) {
        $cols = $row->getElementsByTagName('td');
        
        // Skip if not enough columns
        if ($cols->length < 9) {
            continue;
        }

        $rowData = [
            "code_offer" => cleanText($cols->item(0)->textContent),
            "code_course" => cleanText($cols->item(1)->textContent),
            "title" => cleanText($cols->item(2)->textContent),
            "students" => cleanText($cols->item(3)->textContent),
            "day" => cleanText($cols->item(4)->textContent),
            "time" => cleanText($cols->item(5)->textContent),
            "room" => cleanText($cols->item(6)->textContent),
            "teacher" => cleanText($cols->item(7)->textContent),
            "exam_date" => cleanText($cols->item(8)->textContent)
        ];

        // Only add if we have valid data
        if (!empty($rowData['code_offer']) && !empty($rowData['title'])) {
            $data[] = $rowData;
        }
    }

    if (empty($data)) {
        throw new Exception('No valid data found in the table');
    }

    // Set headers and output JSON
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
} 