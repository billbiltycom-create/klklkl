<?php
// अपनी शेयर्ड होस्टिंग की वेबसाइट पर इस फ़ाइल का उपयोग करें।

// Render.com से मिला अपना URL यहाँ डालें:
$renderUrl = 'https://YOUR-APP-NAME.onrender.com/generate-pdf';

$htmlData = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        h1 { color: #0056b3; }
        p { font-size: 16px; color: #333; }
    </style>
</head>
<body>
    <h1>सफलतापूर्वक PDF जनरेट हुई!</h1>
    <p>यह PDF शेयर्ड होस्टिंग से भेजी गई रिक्वेस्ट के द्वारा Render.com Chromium सेवा से बनाई गई है।</p>
</body>
</html>
';

$ch = curl_init($renderUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['html' => $htmlData]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$pdfData = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="downloaded-doc.pdf"');
    echo $pdfData;
    exit;
} else {
    echo "त्रुटि: PDF जनरेट नहीं हो सकी। HTTP Status Code: " . $httpCode;
}
?>
