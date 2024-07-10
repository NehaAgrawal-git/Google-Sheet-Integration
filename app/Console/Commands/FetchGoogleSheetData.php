<?php

// app/Console/Commands/FetchGoogleSheetData.php

// app/Console/Commands/FetchGoogleSheetData.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Google\Client;
use Google\Service\Sheets;

class FetchGoogleSheetData extends Command
{
    protected $signature = 'fetch:googlesheet';
    protected $description = 'Fetch data from Google Sheets and store in database';

    public function handle()
    {
        $client = new Client();
        $client->setApplicationName('Google Sheets and PHP');
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));

        $service = new Sheets($client);

        $spreadsheetId = '15GVpGXT1TpOkDH-5kN5yPMtalaLcHy7n9e27O28qWCQ';
        $range = 'Sheet1!A2:C';

        try {
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();

            if (empty($values)) {
                $this->info("No data found.");
                return;
            }

            foreach ($values as $row) {
                User::updateOrCreate(
                    ['email' => $row[2]],
                    ['firstname' => $row[0], 'lastname' => $row[1]]
                );
            }

            $this->info('Data fetched and stored successfully.');
        } catch (\Google\Service\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}

