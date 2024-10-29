<?php

namespace App\Controllers;
use App\Models\LoginModel;

class testcontroller extends BaseController
{
   
    public function test()
    {
        // Connect to the database
        $db = \Config\Database::connect();
    
        // Fetch all table names
        $tablesQuery = $db->query("SELECT name FROM sqlite_master WHERE type='table'");
        $tables = $tablesQuery->getResultArray(); // Fetch results as an associative array
    
        // Check if a POST request was made
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedTable = $this->request->getPost('table_name');
            if ($selectedTable) {
                // Redirect to the same page with the selected table as a GET parameter to avoid resubmission
                return redirect()->to(current_url() . '?table=' . urlencode($selectedTable));
            }
        }
    
        // If redirected via GET, retrieve the selected table from the query parameter
        $selectedTable = $this->request->getGet('table');
        
        echo '<form method="POST">';
        echo '<label for="table_name">Select a table:</label>';
        echo '<select name="table_name" id="table_name" onchange="this.form.submit()">';
        echo '<option value="">-- Select Table --</option>';
    
        // Populate the dropdown with table names
        foreach ($tables as $table) {
            $isSelected = ($selectedTable === $table['name']) ? 'selected' : '';
            echo '<option value="' . esc($table['name']) . '" ' . $isSelected . '>' . esc($table['name']) . '</option>';
        }
    
        echo '</select>';
        echo '</form>';
    
        // If a table was selected, display its data
        if ($selectedTable) {
            // Fetch data from the selected table
            $query = $db->query("SELECT * FROM $selectedTable");
            $links = $query->getResultArray(); // Fetch results as an associative array
    
            // Fetch column names
            $columnQuery = $db->query("PRAGMA table_info($selectedTable)"); // Get table info
            $columns = $columnQuery->getResultArray(); // Fetch results as an associative array
    
            echo "<h3>Selected Table: $selectedTable</h3>";
            echo '<pre>';
    
            // Display column names
            echo "Column Names:\n";
            foreach ($columns as $column) {
                echo $column['name'] . "\n"; // Print each column name
            }
    
            // Display table data
            echo "\nTable Data:\n";
            print_r($links);
        }
    }
    public function chk(){
      
        // print_r (startMVCommand(3));
        print_r(testmv(5));
        
    }

    public function strt(){
        // $keyforlocal = 'live1';
        // $rtmp[]= "rtmps://live-api-s.facebook.com:443/rtmp/FB-1070468514669522-0-Abw5KfFRCK2qGVhe";


        // print_r(createstreamlink($keyforlocal,$rtmp ));

        print_r(streamstartcmd(1));
        

    }
    public function stop(){
        $keyforlocal = 'live1';


        print_r(stopStream($keyforlocal));
        

    }
    
}
