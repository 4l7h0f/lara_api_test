<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $nama = $request->query('NAMA');
        $nim = $request->query('NIM');
        $ymd = $request->query('YMD');
        $perPage = (int) $request->query('per_page', 10);
        $page = (int) $request->query('page', 1);

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

        $filteredData = [];

        foreach ($rows as $row) {
            $cols = explode("|", $row);
            if (count($cols) !== count($header)) {
                continue;
            }

            $entry = array_combine($header, $cols);

            // Apply case-insensitive filters
            if (
                ($nama && !Str::contains(Str::lower($entry['NAMA']), Str::lower($nama))) ||
                ($nim && strtolower($entry['NIM']) !== strtolower($nim)) ||
                ($ymd && $entry['YMD'] !== $ymd)
            ) {
                continue;
            }

            $filteredData[] = $entry;
        }

        // If no results found
        if (empty($filteredData)) {
            return response()->json([
                'message' => 'Data is not available with the given criteria.'
            ], 404);
        }

        // Create LengthAwarePaginator instance
        $offset = ($page - 1) * $perPage;
        $paginated = new LengthAwarePaginator(
            array_slice($filteredData, $offset, $perPage),
            count($filteredData),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return response()->json($paginated);
    }
}
