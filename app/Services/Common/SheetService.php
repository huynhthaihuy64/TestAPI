<?php

namespace App\Services\Common;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class SheetService
{
    /**
     * @var Client
     * @var Sheets
     * 
     * @param string $documentID
     * @param string $range
     */
    private $client, $service, $documentId, $range;

    /**
     * GoogleClient constructor.
     * 
     * @var Sheets
     */
    public function __construct()
    {
        $this->client = $this->getclient();
        $this->service = new Sheets($this->client);
        $this->documentId = config('sheet.document_id');
        $this->range = config('sheet.range');
    }

    /**
     * Get data client of Google
     * 
     */
    private function getClient()
    {
        $client = new Client();
        $client->setApplicationName('Google Sheets API');
        $client->setScopes(Sheets::SPREADSHEETS);
        $client->setAuthConfig(public_path('credentials.json'));
        $client->setAccessType('offline');

        return $client;
    }

    /**
     * Read value from sheet
     */
    public function readSheets()
    {
        $doc = $this->service->spreadsheets_values->get($this->documentId, $this->range);

        return response()->json([$doc]);
    }

    /**
     * Append value for google sheet
     * 
     * @param array $value
     * @var ValueRange
     */
    public function appendSheets(array $values)
    {

        $body = new ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $this->service->spreadsheets_values->append($this->documentId, $this->range, $body, $params);
    }

    public function appendCvSheets(array $values)
    {

        $cvId = config('sheet.document_cv_id');
        $body = new ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $this->service->spreadsheets_values->append($cvId, $this->range, $body, $params);
    }

    public function appendConfirmSheets(array $values)
    {
        $confirmId = config('sheet.document_confirm_id');
        $body = new ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $this->service->spreadsheets_values->append($confirmId, $this->range, $body, $params);
    }

    /**
     * Update value for google sheet
     * 
     * @var int $id
     * @param array $value
     * @var ValueRange
     */
    public function updateSheets(array $values)
    {
        $body = new ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];

        return $this->service->spreadsheets_values->update($this->documentId, $this->range, $body, $params);
    }
}
