<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $nama = $request->query('NAMA');
        $nim = $request->query('NIM');
        $ymd = $request->query('YMD');

        // Fetch raw JSON
        $response = file_get_contents('https://bit.ly/48ejMhW');
        $json = json_decode($response, true);

        if (!isset($json['DATA'])) {
            return response()->json([
                'message' => 'Invalid data format from source.'
            ], 500);
        }

        // Split the DATA string into rows
        $rows = explode("\n", $json['DATA']);
        $header = explode("|", array_shift($rows));

        $data = [];

        foreach ($rows as $row) {
            $cols = explode("|", $row);
            if (count($cols) !== count($header)) {
                continue;
            }

            $entry = array_combine($header, $cols);

            // Apply filters
            if (
                ($nama && !Str::contains($entry['NAMA'], $nama)) ||
                ($nim && $entry['NIM'] !== $nim) ||
                ($ymd && $entry['YMD'] !== $ymd)
            ) {
                continue;
            }

            $data[] = $entry;
        }

        return response()->json([
            'count' => count($data),
            'results' => $data,
        ]);
    }
}
