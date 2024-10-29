<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class SystemStatus extends Controller
{
    protected $session;
    public function __construct()
    {
        $this->session = session();
    }

    // Method to get CPU Load Average
    private function getCpuUsage()
    {
        $load = sys_getloadavg(); // Returns an array of the load averages
        return $load[0]; // Return the 1-minute load average
    }

    // Method to get CPU Model/Name
    private function getCpuModel()
    {
        $cpuInfo = shell_exec('cat /proc/cpuinfo | grep "model name" | uniq');
        $cpuInfo = explode(":", $cpuInfo);
        return trim($cpuInfo[1]); // Return the CPU model name
    }

    // Method to get Uptime
    private function getUptime()
    {
        $uptime = shell_exec('cat /proc/uptime');
        $uptime = explode(" ", $uptime);
        $uptimeSeconds = (int)$uptime[0];

        $days = floor($uptimeSeconds / 86400);
        $hours = floor(($uptimeSeconds % 86400) / 3600);
        $minutes = floor(($uptimeSeconds % 3600) / 60);

        return "$days days, $hours hours, $minutes minutes";
    }

    // Method to get number of running processes
    private function getProcessCount()
    {
        $processCount = shell_exec('ps -e | wc -l');
        return (int)$processCount;
    }

    // Method to get RAM Usage
    private function getRamUsage()
    {
        $free = shell_exec('free -m');
        $free = explode("\n", $free);
        $mem = preg_split('/\s+/', $free[1]);
        return [
            'used' => (int)$mem[2],   // Used memory
            'total' => (int)$mem[1]   // Total memory
        ];
    }

    // Method to get Storage Usage
    private function getStorageUsage()
    {
        $df = shell_exec('df -h /');
        $df = explode("\n", $df);
        $storage = preg_split('/\s+/', $df[1]);
        return [
            'used' => $storage[2],      // Used space (human-readable)
            'available' => $storage[3]  // Available space (human-readable)
        ];
    }

    // Method to get Network Traffic
    private function getNetworkTraffic()
    {
        $output = shell_exec("cat /proc/net/dev");
        $lines = explode("\n", $output);

        $network = 0;

        foreach ($lines as $line) {
            if (preg_match('/^\s*(\w+):\s*(\d+)\s+(\d+)/', $line, $matches)) {
                $network += (int)$matches[2]; // TX bytes
            }
        }

        // Store the current values in session for the next call
        if (!$this->session->has('prev_network')) {
            $this->session->set('prev_network', $network);
        }

        // Calculate differences
        $networkDiff = $network - $this->session->get('prev_network');

        // Update session values for the next calculation
        $this->session->set('prev_network', $network);

        return [
            'network' => $networkDiff   // Difference since last check
        ];
    }

    private function getTotalNetworkUsage()
{
    $output = shell_exec("cat /proc/net/dev");
    $lines = explode("\n", $output);

    $upload = 0; // TX bytes
    $download = 0; // RX bytes

    foreach ($lines as $line) {
        if (preg_match('/^\s*(\w+):\s*(\d+)\s+(\d+)/', $line, $matches)) {
            $download += (int)$matches[2]; // RX bytes
            $upload += (int)$matches[3]; // TX bytes
        }
    }

    // Calculate total usage
    $totalUsageBytes = $upload + $download;

    // Determine if the total usage is in MB or GB
    if ($totalUsageBytes < 1024 * 1024) { // Less than 1 MB
        return round($totalUsageBytes, 2) . ' Bytes';
    } elseif ($totalUsageBytes < 1024 * 1024 * 1024) { // Less than 1 GB
        $totalUsageMB = $totalUsageBytes / (1024 * 1024); // Convert to MB
        return round($totalUsageMB, 2) . ' MB';
    } else { // 1 GB or more
        $totalUsageGB = $totalUsageBytes / (1024 * 1024 * 1024); // Convert to GB
        return round($totalUsageGB, 2) . ' GB';
    }
}

    

    // Method to get System Temperature (if available)
    // private function getSystemTemperature()
    // {
    //     $temp = @file_get_contents('/sys/class/thermal/thermal_zone0/temp');
    //     return $temp ? round($temp / 1000, 2) . '°C' : 'N/A';
    // }
    private function getCpuCoreCount()
    {
        // Execute the nproc command to get the number of CPU cores
        $coreCount = shell_exec('nproc');
    
        // Trim any whitespace from the result
        $coreCount = trim($coreCount);
    
        // Return the core count or 'N/A' if the command fails
        return $coreCount ? $coreCount : 'N/A';
    }
    
    private function totalvid() 
    {
        
        $model = new UserModel();
        $started = $model->totalvid();
        return $started;
        
    }
    private function playliststatus() 
    {
        
        $model = new UserModel();
        $started = $model->getPlaylistStats();
        return $started;
        
    }
    private function MusicVideoCounts() 
    {
        
        $model = new UserModel();
        $started = $model->getMusicVideoCounts();
        return $started;
        
    }
    // Main method to handle AJAX request
    public function getStatus()
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'cpu'           => $this->getCpuUsage(),
                'cpu_model'     => $this->getCpuModel(),
                'uptime'        => $this->getUptime(),
                'processes'     => $this->getProcessCount(),
                'ram'           => $this->getRamUsage(),
                'storage'       => $this->getStorageUsage(),
                'network'       => $this->getNetworkTraffic(),
                'network_uses'  => $this->getTotalNetworkUsage(),
                // 'temperature'   => $this->getSystemTemperature(),
                'cpucount'   => $this->getCpuCoreCount(),

                'totalvid'      => $this->totalvid()->totalvid,
                'totalsiz'      => formatgbFileSize($this->totalvid()->size),
                'totallnt'      => convertHoursminute($this->totalvid()->leng),

                'totalpl'       => $this->playliststatus()->total_playlists,
                'totalpl_ln'    => convertHoursminute($this->playliststatus()->total_duration),
                'totallnk'      => $this->playliststatus()->total_rtmp_links,

                'totalmv'       => $this->MusicVideoCounts()->total_music_videos ?: 0,
                'totalmvaud'    => $this->MusicVideoCounts()->total_audio_count ?: 0,
                'totamvllnk'    => $this->MusicVideoCounts()->total_stream_count ?: 0,
            ]);
        } else {
            // Handle non-AJAX requests (if needed)
            return $this->response->setStatusCode(400)->setBody('Bad Request');
        }
    }

    
}
