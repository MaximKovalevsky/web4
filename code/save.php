<?php
require_once __DIR__ . "/vendor/autoload.php";

if ("POST" === $_SERVER["REQUEST_METHOD"])
{
    $category = $_POST["category"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $email = $_POST["email"];

    $client = new Google_Client();
    $client->setApplicationName("web4");
    $client->setAuthConfig('credentials.json');
    $client->addScope(Google_Service_Sheets::SPREADSHEETS);
    $client->setAccessType('offline');

    $service = new Google_Service_Sheets($client);

    $spreadsheetId = "1wmplp_wKGbIBPumK6BYvE8pjstuBc2R966ynmLQHdjk";

    $values = [[$email, $category, $title,$description ]];

    $range = "A1:D";
    $body = new Google_Service_Sheets_ValueRange(["values" => $values]);
    $param = ["valueInputOption" => "RAW"];

    $result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $param);
    header("Location: index.php");
    exit;
}
?>