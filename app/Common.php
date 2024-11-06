<?php
function checkFirstRun()
{
    $envPath = ROOTPATH . '.env';
    $message = '<p>Default Username: <strong>admin</strong> <br>Default Password: <strong>123456</strong> <br> Reset password after login. </p>';

    if (file_exists($envPath)) {
        $envContents = file_get_contents($envPath);

        if (strpos($envContents, 'firstrun=true') !== false) {
            $updatedEnvContents = str_replace('firstrun=true', 'firstrun=false', $envContents);
            file_put_contents($envPath, $updatedEnvContents);
            return $message;
        }
        elseif (strpos($envContents, 'firstrun=false') === false) {
            $updatedEnvContents = $envContents . PHP_EOL . 'firstrun=false';
            file_put_contents($envPath, $updatedEnvContents);
            return $message;
        }
    }
    return null;
}


function formatgbFileSize($fileSize)
{
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($fileSize >= 1024 && $i < count($units) - 1) {
            $fileSize /= 1024;
            $i++;
        }

        return round($fileSize, 2) . ' ' . $units[$i]; 
}
function generateUniqueTag() 
{
    return 'id_' . time() . '_' . mt_rand(100000, 999999);
}
function convertHours($seconds) 
{
    $hours = (int)floor($seconds / 3600);
    $minutes = (int)floor(($seconds % 3600) / 60);
    
    return sprintf("%02d : %02d", $hours, $minutes);
}
function convertHoursminute($seconds) 
{
    $hours = (int)floor($seconds / 3600);
    $minutes = (int)floor(($seconds % 3600) / 60);
    
    return sprintf("%dHr %dMin", $hours, $minutes);
}
function aboutdetails() 
{
    $adt = [
        'gitdetails' => [
            'Name' => "GitHub - Streamdex",
            'Link' => "https://github.com/your-repo-link"
        ],
        'emaildetails' => [
            'Name' => "Streamdex",
            'Link' => "support@streamdex.com"
        ],
        'ytdetails' => [
            'Name' => "Your Channel",
            'Link' => "https://www.youtube.com/your-channel-link"
        ],
        'sitedetails' => [
            'Name' => "Streamdex",
            'Org' => "Dex Corp",
            'Link' => "https://www.dexcorp.com"
        ],
        'version' => "1.1.2 (beta)"

    ];
    
    return $adt;
}



function streamstartcmd($plid)
{
    // Check if user session exists
    if (!session()->get('user')) {
        return ""; // Return a message if no user session
    }
    $db = \Config\Database::connect();
    
    // Fetch the playlist information
    $Playlistinfo = $db->query("SELECT id, is_looped, status, uniq_identity FROM Playlist WHERE id= ".$plid)->getRow();

    // Check if the playlist exists
    if ($Playlistinfo) {
        // Fetch media information if playlist exists
        $mediainfo = $db->query("SELECT vf.path as file_path FROM playlist_media pl JOIN Video_file vf on vf.id = pl.video_id WHERE pl.pl_id = ".$Playlistinfo->id." ORDER BY pl.order_index;")->getResultArray();

        // Fetch RTMP link information if playlist exists
        $linkinfo = $db->query("SELECT rtmp_link, rtmp_key  FROM rtmp_link WHERE pl_id = ".$Playlistinfo->id)->getResultArray();
        
        // Fetch Resolution
        $Resulationinfo = $db->query("SELECT str_resulution_height, str_resulution_width  FROM resulation WHERE str_is_active = 1")->getRow();
        
        // Fetch Settings
        $settingsinfo = $db->query("SELECT video_bitrate, maximum_bitrate, buffer_size, audio_bitrate, audio_sample_rate, keyframes, CPUthreads  FROM stream_settings WHERE id = 1")->getRow();

        if(!empty($mediainfo) && !empty($linkinfo)){
            // Initialize the FFmpeg command
            $ffmpegCommand = "ffmpeg -re -fflags +genpts ";

            // Handle looping logic
            if ($Playlistinfo->is_looped == 1) {
                $ffmpegCommand .= "-stream_loop -1 ";
            }
            // Sequentially add each file as an input
            foreach ($mediainfo as $file) {
                $ffmpegCommand .= "-re -i " . escapeshellarg($file['file_path']) . " ";
            }
            // Add encoding and performance optimization parameters
            $ffmpegCommand .= "-c:v libx264 ";                                          // Use H.264 video codec
            $ffmpegCommand .= "-preset ultrafast ";                                     // Set encoding preset to 'ultrafast' for speed
            $ffmpegCommand .= "-tune zerolatency ";                                     // Optimize for low latency
            $ffmpegCommand .= "-b:v ".$settingsinfo->video_bitrate."k ";                // Set target video bitrate
            $ffmpegCommand .= "-maxrate ".$settingsinfo->maximum_bitrate."k ";          // Set maximum bitrate
            $ffmpegCommand .= "-bufsize ".$settingsinfo->buffer_size."k ";              // Set buffer size
            $ffmpegCommand .= "-vf 'scale=".$Resulationinfo->str_resulution_height.":".$Resulationinfo->str_resulution_width."' ";  // Set video resolution
            $ffmpegCommand .= "-c:a aac ";                                              // Use AAC audio codec
            $ffmpegCommand .= "-b:a ".$settingsinfo->audio_bitrate."k ";                // Set audio bitrate to 128 kbps
            $ffmpegCommand .= "-ar ".$settingsinfo->audio_sample_rate." ";              // Set audio sample rate to 44.1 kHz
            $ffmpegCommand .= "-g ".$settingsinfo->keyframes." ";                       // Set GOP size for keyframes (1 keyframe every 60 frames)
            $ffmpegCommand .= "-threads ".$settingsinfo->CPUthreads." ";                // Use specified CPU threads for encoding


            
            $ffmpegCommand .= "-f flv rtmp://localhost/live/{$Playlistinfo->uniq_identity} ". " ";
            
    
            $db->query("UPDATE Playlist SET status = 1 WHERE id = ".$plid); 
            
            if($Playlistinfo->is_looped != 1){
                $ffmpegCommand = "nohup sh -c \" " .$ffmpegCommand." && curl -X POST '".base_url('webhook/video/')."".$Playlistinfo->uniq_identity."'\" > /dev/null 2>&1 & disown";
            }else{
                $ffmpegCommand .= " > /dev/null 2>&1 &";                                
            }
            // Add RTMP stream output links
            foreach ($linkinfo as $link) {
                $localStreamUrl = "rtmp://localhost/live/{$Playlistinfo->uniq_identity}";
                $rtmplink = rtrim($link['rtmp_link'], '/') . "/" . $link['rtmp_key'];
                $strmcret = "ffmpeg -re -i $localStreamUrl -c copy -f flv {$rtmplink} > /dev/null 2>&1 & echo $!";
                exec($strmcret);
            }
            exec(trim($ffmpegCommand));
            return trim($ffmpegCommand);
        } 
    }
}



function startMVCommand($musicVideoId) {
    $db = \Config\Database::connect();

    // Fetch music video info
    $musicVideo = $db->query("SELECT id, is_loop, video_path, uniq_identity FROM music_video WHERE id= ".$musicVideoId)->getRow();
    
    // Fetch resolution
    $Resulationinfo = $db->query("SELECT str_resulution_height, str_resulution_width FROM resulation WHERE str_is_active = 1")->getRow();
    
    // Fetch stream settings
    $settingsinfo = $db->query("SELECT video_bitrate, maximum_bitrate, buffer_size, audio_bitrate, audio_sample_rate, keyframes, CPUthreads FROM stream_settings WHERE id = 1")->getRow();
    
    if (!$musicVideo) {
        return "";
    }
    
    // Fetch audio files associated with the video
    $musicAudio = $db->query("SELECT music_path FROM music_video_audio WHERE music_id= ".$musicVideoId." ORDER BY order_index")->getResultArray();
    
    if (!$musicAudio) {
        return "";
    }
    
    $audioInputs = [];
    foreach ($musicAudio as $audio) {
        $audioInputs[] = $audio['music_path'];
    }
    
    // Fetch RTMP stream links
    $musicLink = $db->query("SELECT mv_link, mv_key FROM music_stream_link WHERE music_id = ".$musicVideoId)->getResultArray();
    if (!$musicLink) {
        return "";
    }

    // Prepare the FFmpeg command
    $command = "ffmpeg -re -fflags +genpts ";

    // Video input
    $videoPath = $musicVideo->video_path;

    // Check if it's a video or image
    $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $videoPath);
    $isVideo = preg_match('/\.(mp4|avi|mov|mkv)$/i', $videoPath);

    // Add video input command
    if ($isVideo) {
        $command .= "-stream_loop -1 -i " . escapeshellarg($videoPath) . " ";
    } elseif ($isImage) {
        $command .= "-loop 1 -framerate 30 -i " . escapeshellarg($videoPath) . " ";
    }

    // Handle based on looping behavior and number of audio files
    if ($musicVideo->is_loop == 1) {
        if (count($audioInputs) == 1) {
            // One audio, infinite loop
            $command .= "-i " . escapeshellarg($audioInputs[0]) . " ";
            $command .= '-filter_complex "[1:a]aloop=loop=-1:size=2e+9[audio]; [0:v]scale=' . $Resulationinfo->str_resulution_height . ':' . $Resulationinfo->str_resulution_width . '[video]" ';
            $command .= '-map "[video]" -map "[audio]" ';
        } else {
            // Multiple audio files, infinite loop
            // Add all audio inputs dynamically
            $command .= implode(' ', array_map(fn($audioPath) => "-i " . escapeshellarg($audioPath), $audioInputs)) . " ";
        
            // Prepare filter_complex for multiple audio concatenation
            $filterComplex = '';
            $concatInputs = '';
            
            for ($i = 1; $i <= count($audioInputs); $i++) {
                $concatInputs .= "[$i:a]";
            }
            
            // Concatenate and loop audio files indefinitely
            $filterComplex .= $concatInputs . "concat=n=" . count($audioInputs) . ":v=0:a=1,aloop=loop=-1:size=2e+9[audio]; ";
            
            // Scale the video input
            $filterComplex .= "[0:v]scale=" . $Resulationinfo->str_resulution_height . ":" . $Resulationinfo->str_resulution_width . "[video]";
            
            $command .= '-filter_complex "' . $filterComplex . '" ';
            
            // Map video and audio streams
            $command .= '-map "[video]" -map "[audio]" ';
        }
    } else {
        if (count($audioInputs) == 1) {
            // One audio, play once
            $command .= "-i " . escapeshellarg($audioInputs[0]) . " ";
            $command .= '-map 0:v -map 1:a -vf "scale=' . $Resulationinfo->str_resulution_height . ':' . $Resulationinfo->str_resulution_width . '" ';
            $command .= '-shortest ';
        } else {
            // Multiple audio files, play once
            $command .= implode(' ', array_map(fn($audioPath) => "-i " . escapeshellarg($audioPath), $audioInputs)) . " ";

            $filterComplex = [];
            foreach (range(1, count($audioInputs)) as $i) {
                $filterComplex[] = "[$i:a]";
            }
            $command .= '-filter_complex "' . implode('', $filterComplex) . 'concat=n=' . count($audioInputs) . ':v=0:a=1[audio]; ';
            $command .= '[0:v] scale=' . $Resulationinfo->str_resulution_height . ':' . $Resulationinfo->str_resulution_width . '[video]; [video][audio]concat=n=1:v=1:a=1[v][a]" -map "[v]" -map "[a]" -shortest ';            
        }
    }

    // Add encoding settings from the database
    $command .= "-c:v libx264 -preset ultrafast -tune zerolatency ";
    $command .= "-b:v " . $settingsinfo->video_bitrate . "k ";
    $command .= "-maxrate " . $settingsinfo->maximum_bitrate . "k ";
    $command .= "-bufsize " . $settingsinfo->buffer_size . "k ";
    $command .= "-c:a aac -b:a " . $settingsinfo->audio_bitrate . "k ";
    $command .= "-ar " . $settingsinfo->audio_sample_rate . " ";
    $command .= "-g " . $settingsinfo->keyframes . " ";
    $command .= "-threads " . $settingsinfo->CPUthreads . " ";

    
    
    $uniqueTag = $musicVideo->uniq_identity;  

    $command .= "-f flv rtmp://localhost/live/{$uniqueTag} ";

    if($musicVideo->is_loop != 1){
        
        $command = "nohup sh -c ' " . $command . " && curl -X POST \"" . base_url('webhook/Musicvideo/') . $uniqueTag . "\"' > /dev/null 2>&1 & disown";
    }else{
        $command .= " > /dev/null 2>&1 &";                                
    }


    // RTMP stream link and key
    foreach ($musicLink as $streamLink) {
        $localStreamUrl = "rtmp://localhost/live/{$uniqueTag}";
        $rtmplink = rtrim($streamLink['mv_link'], '/') . "/" . $streamLink['mv_key'];
        $strmcret = "ffmpeg -re -i $localStreamUrl -c copy -f flv {$rtmplink} > /dev/null 2>&1 & echo $!";
        exec($strmcret);
    }

    exec(trim($command));
    
    // Update stream status
    $db->query("UPDATE music_video SET mv_stream_status = 1 WHERE id = " . $musicVideoId);
    return (trim($command));
}

function streamstopcmd($plid) 
{
    // Check if user session exists
    if (!session()->get('user')) {
        return ""; // Return a message if no user session
    }
    
    // Get the database instance
    $db = \Config\Database::connect(); 
    // Get the unique stream identifier
    $Playlistidentity = $db->query("SELECT uniq_identity FROM Playlist WHERE id= ".$plid)->getRow();
    if($Playlistidentity){
        // Generate the stop command to kill the process associated with the unique tag
        $stopCommand = "ps aux | grep ffmpeg | grep " . escapeshellarg($Playlistidentity->uniq_identity) . " | grep -v grep | awk '{print $2}' | xargs kill -9";
        $db->query("UPDATE Playlist SET status = 0 WHERE id = ".$plid); 
        exec(trim($stopCommand)); // Return the stop command
    }           
    
}

function stopMVCommand($musicVideoId) {
    // Check if user session exists
    if (!session()->get('user')) {
        return ""; // Return a message if no user session
    }
    // Get the database instance
    $db = \Config\Database::connect(); 
    $stream = $db->query("SELECT uniq_identity FROM music_video WHERE id= ".$musicVideoId)->getRow();
    

    // Check if stream exists
    if (!$stream) {
        return ""; // Return a message if the stream is not found
    }

    // Get the unique stream identifier
    $uniqueTag = $stream->uniq_identity;

    // Generate the stop command to kill the process associated with the unique tag
    $stopCommand = "ps aux | grep ffmpeg | grep " . escapeshellarg($uniqueTag) . " | grep -v grep | awk '{print $2}' | xargs kill -9";
    $db->query("UPDATE music_video SET mv_stream_status = null WHERE id = ".$musicVideoId); 
    exec(trim($stopCommand));
}



