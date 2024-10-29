<?php

namespace App\Controllers;
use App\Models\UserModel;
use Config\Database; 
class User_Controller extends BaseController
{
    protected $session;
    protected $backupPath;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        if (empty($this->session->get('user')['username'])) {
            redirect()->to(base_url('logout'))->send();
            exit();
        }
        $this->backupPath = WRITEPATH . 'uploads/backups/';
    }
    private function setpagedata($pagename)
    {
        $pagedata = [
            'user_name'  => $this->session->get('user')['username'],
            'user_Since'  => $this->session->get('user')['Since'],            
            'page_title' => aboutdetails()['sitedetails']['Name'] . ' - ' . $pagename,
            'page_site' => aboutdetails()['sitedetails']['Name'],
            'page_name'  => $pagename
        ];
        return $pagedata;
    }
    private function mergeChunks($uploadDir, $fileName, $totalChunks, $finalFilePath)
    {
        $outputFile = fopen($finalFilePath, 'ab');

        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkPath = $uploadDir . $fileName . '.' . $i;
            $chunkFile = fopen($chunkPath, 'rb');
            while ($buffer = fread($chunkFile, 4096)) {
                fwrite($outputFile, $buffer);
            }
            fclose($chunkFile);
        }

        fclose($outputFile);
    }
    private function mergemvChunks($uploadDir, $file_name, $total_chunks, $finalFilePath) 
    {
        $finalFile = fopen($finalFilePath, 'wb');
    
        for ($i = 1; $i <= $total_chunks; $i++) {
            $chunkFilePath = $uploadDir . $file_name . '_part_' . $i;
            $chunk = fopen($chunkFilePath, 'rb');
            while ($data = fread($chunk, 8192)) {
                fwrite($finalFile, $data);
            }
            fclose($chunk);
        }
    
        fclose($finalFile);
    }        
    private function removemvChunks($uploadDir, $file_name, $total_chunks) 
    {
        for ($i = 1; $i <= $total_chunks; $i++) {
            $chunkFilePath = $uploadDir . $file_name . '_part_' . $i;
            if (file_exists($chunkFilePath)) {
                unlink($chunkFilePath); // Remove each chunk after merging
            }
        }
    }
    private function getVideoLengthsec($filePath)
    {
        $output = [];
        $returnVar = 0;
    
        // Execute FFmpeg command to get video duration in seconds
        exec("ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 " . escapeshellarg($filePath), $output, $returnVar);
        
        if ($returnVar === 0 && isset($output[0])) {
            $duration = (float) $output[0]; // Get duration in seconds
            return $duration; // Return duration in seconds
        }
    
        return 0; // Return 0 if an error occurs
    }
    private function insertFileDetails($fileName, $filePath, $filesize, $videolength)
    {
        $model = new UserModel();

        $data = [
            'filename' => $fileName,
            'path' => $filePath,
            'file_size' => $filesize,
            'file_length' => $videolength
        ];

        $model->saveFile($data);
    }
    private function removeChunks($uploadDir, $fileName, $totalChunks)
    {
        for ($i = 0; $i < $totalChunks; $i++) {
            unlink($uploadDir . $fileName . '.' . $i);
        }
    }
    public function dashboard()
    {
        return view('dashboard', $this->setpagedata('Dashboard'));
    }
    public function Videoview()
    {
        return view('videoview', $this->setpagedata('Video'));
    }
    public function userprofile()
    {    
        
        $model = new UserModel();
        return view('profile', $this->setpagedata('Profile'));
    }
    public function settings()
    {    
        $model = new UserModel();
        helper('filesystem');
        $data['resulations'] = $model->getResulations();
        $data['stm_settings'] = $model->getstmsettings();
        $data['files'] = get_filenames($this->backupPath); 
        $data = array_merge($this->setpagedata('Settings'), $data);
        return view('settings', $data);
    }
    public function guide()
    {    
        
        return view('guide', $this->setpagedata('Guide'));
    }
    public function checkFileExistence()
    {
        $request = $this->request->getJSON();
        $filename = $request->filename; // Access the filename sent in the request body
        
        $filePath = WRITEPATH . 'uploads/hls/' . $filename.'.m3u8';

        if (file_exists($filePath)) {
            return $this->response->setJSON(['status' => true, 'filePath' => base_url('writable/uploads/hls/') . $filename.'.m3u8']);
        } else {
            return $this->response->setJSON(['status' => false, 'filePath' => null]);
        }
    }
    public function updateResulation()
    {
        // Load the model
        $model = new UserModel();
        
        // Get the selected resolution ID from the POST data
        $selectedResulationId = $this->request->getPost('selectedresulation');
        
        if ($selectedResulationId) {
            // Update the active status for the selected resolution
            // Assuming you want to set str_is_active = 1 for the selected one and 0 for others
            $model->setResulationInactive(); // Make all inactive (if necessary)
            $model->setResulationActive($selectedResulationId); // Set selected as active
            
            return redirect()->to(base_url('user/settings'))->with('success', 'Resolution updated successfully!');
        }

        return redirect()->to(base_url('user/settings'))->with('error', 'Please select a resolution.');
    }
    public function updatestreamsettings()
    {
        $model = new UserModel();

        $data = [
            'video_bitrate' => $this->request->getPost('videobitrate'),
            'maximum_bitrate' => $this->request->getPost('maximum_bitrate'),
            'buffer_size' => $this->request->getPost('buffer_size'),
            'audio_bitrate' => $this->request->getPost('audio_bitrate'),
            'audio_sample_rate' => $this->request->getPost('audio_sample_rate'),
            'keyframes' => $this->request->getPost('gop_size_keyframes'),
            'CPUthreads' => $this->request->getPost('cpu_thread')
        ];

        if ($model->setsettings($data)) {
            return redirect()->to(base_url('user/settings'))->with('success', 'Settings updated successfully!');
        } else {
            return redirect()->to(base_url('user/settings'))->with('error', 'Failed to update settings.');
        }
    }
    public function userprofileupdate()
    {
        $userId = session()->get('user')['id'];
        $model = new UserModel();
        $existingUser = $model->gettotaldetails($userId);
        
        $newFullName = $this->request->getPost('full_name');
        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $profilePicture = $this->request->getFile('profile_picture');

        
        if (password_verify($oldPassword, $existingUser->user_password)) {
            $updateData = [];
            if ($existingUser->user_name !== $newFullName) {
                $updateData['user_name'] = $newFullName;
            }
            if ($profilePicture && $profilePicture->isValid()) {

                if (file_exists(FCPATH . 'public/assets/img/defult.jpg')) {
                    unlink(FCPATH . 'public/assets/img/defult.jpg');
                }

                $image = \Config\Services::image()
                    ->withFile($profilePicture)
                    ->fit(128, 128, 'center')
                    ->save(FCPATH . 'public/assets/img/defult.jpg');   

                session()->setFlashdata('success', 'Profile updated successfully.');  
            }
            if (!empty($newPassword)) {
                $updateData['user_password'] = password_hash($newPassword, PASSWORD_BCRYPT);
            }
            if (!empty($updateData)) {
                $model->updateUser($userId, $updateData);
                $data['userdetails'] = $model->gettotaldetails($this->session->get('user')['id']);
                $sessionData = [
                    'id'       => $data['userdetails']->id,
                    'username' => $data['userdetails']->user_name,
                    'Since'     => (new \DateTime($data['userdetails']->Created_on))->format('jS F, Y')
                ];
                $changePass = getenv('changepass');
                if (empty($changePass) || strtolower($changePass) === 'false') {
                    $this->updateEnvFile('changepass', 'true');
                }
                session()->set("user", $sessionData);
                session()->setFlashdata('success', 'Profile updated successfully.');
               
            } 
           
        } else {
            session()->setFlashdata('error', 'Current  password is incorrect.');
        }
        return redirect()->to(base_url('user/profile') );
       
    }
    private function updateEnvFile($key, $value)
    {
        $envFilePath = FCPATH . '.env';
        $envContents = file_get_contents($envFilePath);
        if (strpos($envContents, $key) !== false) {
            $envContents = preg_replace("/^{$key}=(.*)$/m", "{$key}={$value}", $envContents);
        } else {
            $envContents .= "\n{$key}={$value}";
        }
        file_put_contents($envFilePath, $envContents);
    }
    public function videofiles()
    {   
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $files = $model->videofiles();
            $processedFiles = [];

            foreach ($files as $file) {
                $fileData = [];            
                $fileData['id'] = $file['id'];
                $fileData['file_name'] = $file['filename'];
                $fileData['uploaded_on'] = date("jS M, Y H:i:s", strtotime($file['upload_on']));
                $fileData['video_length'] = gmdate("H:i", (int) floor($file['file_length']));
                $fileData['file_size'] = formatgbFileSize($file['file_size']);

                $processedFiles[] = $fileData;
            }
            return $this->response->setJSON($processedFiles);
            return view('videoview', $this->setpagedata('Video'));
        }else{
            redirect()->to(base_url('user/Video'))->send();
            exit();
        }
    }
    public function upload()
    {   
            $file = $this->request->getFile('file');
            $chunkIndex = $this->request->getPost('chunkIndex');
            $totalChunks = $this->request->getPost('totalChunks');
            $originalFileName = $this->request->getPost('fileName');
            $originalExtension = $this->request->getPost('fileExtension');
            $customname = $this->request->getPost('customname');
            
        
        
            $uploadDir = WRITEPATH . 'uploads/chunks/';
            $finalVideoPath = WRITEPATH . 'uploads/videos/';
        
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            if (!is_dir($finalVideoPath)) {
                mkdir($finalVideoPath, 0777, true);
            }
        
            if ($file->isValid()) {
                $filePath = $uploadDir . $originalFileName . '.' . $chunkIndex;
                $file->move($uploadDir, $originalFileName . '.' . $chunkIndex);
                if ($chunkIndex == $totalChunks - 1) {
                    $uniqueFileName = uniqid() . '.' . $originalExtension;
                    $finalFilePath = $finalVideoPath . $uniqueFileName;
                    $this->mergeChunks($uploadDir, $originalFileName, $totalChunks, $finalFilePath);
                    $this->removeChunks($uploadDir, $originalFileName, $totalChunks);
                    $filesize = filesize($finalFilePath);
                    $videolength = $this->getVideoLengthsec($finalFilePath);
                    $this->insertFileDetails($customname, $finalFilePath, $filesize, $videolength);            
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Video uploaded successfully']);
                }
            }
            return $this->response->setJSON(['status' => 'partial']);
        
    }
    public function deletemedia($id)
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $video = $model->getemedia($id);
    
            if ($video) {
                $filePath = $video->path;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                if ($model->deletemedia($id)) {
                    $model->deleteplmedia($id);
                    return $this->response->setJSON(['status' => true]);
                } else {
                    return $this->response->setJSON(['status' => false]);
                }
            } else {
                return $this->response->setJSON(['success' => false]);
            }
        } else {
            redirect()->to(base_url('user/Video'))->send();
            exit();
        }
    }
    public function renamemedia($id)
    {
        if ($this->request->isAJAX()) {
            $userFileModel = new UserModel(); 
            $fileData = $userFileModel->getmediaById($id);
            if ($fileData) {
                return $this->response->setJSON($fileData);
            } else {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Video not found']);
            }
        }else{
            return redirect()->to(base_url('user/video'));
        }
    }
    public function nameupdatemedia($id)
    {
        if ($this->request->isAJAX()) {
            $data = [
                'name' => $this->request->getPost('playnm')
            ];
            $model = new UserModel();
            $updateResult = $model->updatemedia($id, $data);
    
            if ($updateResult) {
                return $this->response->setJSON(['success' => 'Video updated successfully']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update video'])->setStatusCode(500);
            }
        }
    
        return redirect()->to(base_url('user/video'));
    }
    public function playlist()
    {
        return view('playlist', $this->setpagedata('Video Playlist'));
    }
    public function load_playlists()
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $playlist = $model->loadPlaylistDetails();
            $processedFiles = [];
    
            foreach ($playlist as $pl) {
                $plData = [];            
                $plData['pl_id'] = $pl['playlist_id'];
                $plData['pl_nm'] = $pl['pl_name'];
                $plData['tl_vid'] = $pl['total_videos'];
                $plData['vid_len'] = gmdate("H:i", (int) $pl['total_duration']);
                $plData['ln_count'] = $pl['rtmp_link_count'];
                $plData['loop_check'] = ($pl['is_looped'] == 1) ? 'Yes' : 'No';
                $plData['status'] = ($pl['status'] == 1) ? 'Playing' : 'Stoped';
                $plData['statuscode'] = $pl['status'];
                $plData['localkey'] = $pl['uniq_identity'];
    
                $processedFiles[] = $plData;
            }
    
            // Return all processed playlists
            if ($processedFiles) {
                return $this->response->setJSON($processedFiles);
            } else {
                return $this->response->setJSON([]);  // Return an empty array if no playlists
            }
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function create_playlist()
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $plname = $this->request->getPost('PlaylistName');
            $loop_check = $this->request->getPost('loop_check');
            $playlist = $model->insertPlaylist($plname, $loop_check);

            if ($playlist) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['error' => 'Failed to create playlist']);
            }
         
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function getPlaylistById($plid)
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $playlist = $model->getPlaylistById($plid);


            if ($playlist) {
                return $this->response->setJSON($playlist);
            } else {
                return $this->response->setJSON(['error' => 'Playlist not found']);
            }
         
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function updatePlaylistById($id)
    {
        if ($this->request->isAJAX()) {
            // Retrieve the posted data
            $data = [
                'pl_name' => $this->request->getPost('playnm'), // Ensure this matches your database column
                'is_looped' => $this->request->getPost('islooped') // Ensure this is either '0' or '1'
            ];
    
            $model = new UserModel();
            $updateResult = $model->updatePlaylist($id, $data);
            
            if ($updateResult) {
                return $this->response->setJSON(['success' => 'Playlist updated successfully']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update playlist'])->setStatusCode(500);
            }
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }  
    public function playlist_delete($id)
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $deleted = $model->deletePlaylist( $id);
            if ($deleted) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to delete playlist']);
            }
        }else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function getPlaylistInfo($pl_id)
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $playlist = $model->getPlaylistMedia($pl_id);
            $dropdown_select = $model->getUnassignedVideos($pl_id);
            $playlistname_id = $model->getPlaylistnameById($pl_id);
            $playlist_files = [];
    
            foreach ($playlist as $pl) {
                $plData = [];
                $plData['id'] = $pl['id'];
                $plData['filename'] = $pl['filename'];
                $plData['vid_len'] = gmdate("H:i", (int)$pl['file_length']);

    
                $playlist_files[] = $plData;
            }
    
            $dataArray = [
                'playlist_files' => $playlist_files,
                'dropdown_select' => $dropdown_select,
                'pl_info' => $playlistname_id

            ];
    
            return $this->response->setJSON($dataArray);
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function addMediaToPlaylist()
    {
        if ($this->request->isAJAX()) {
            $plId = $this->request->getPost('pl_id');
            $videoId = $this->request->getPost('video_id');
            
            $model = new UserModel();
            
            $result = $model->addVideoToPlaylist($plId, $videoId);
            
            if ($result) {
                return $this->response->setJSON(['success' => 'Video added to playlist successfully']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to add video to playlist'])->setStatusCode(500);
            }
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function removeMediafromPlaylist()
    {
        if ($this->request->isAJAX()) {
            $videoId = $this->request->getPost('video_id');
            
            $model = new UserModel();
            $result = $model->removeVideoFromPlaylist($videoId);
            
            if ($result) {
                return $this->response->setJSON(['success' => 'Video removed from playlist successfully']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to remove video from playlist'])->setStatusCode(500);
            }
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function updatePlaylistOrder()
    {
        if ($this->request->isAJAX()) {
            $order = $this->request->getPost('order'); 
            if (!empty($order)) {
                $model = new UserModel();
                foreach($order as $index => $id){
                    $model->updatePlaylistOrder($id, ($index + 1));
                }
        
            }
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function getLinks() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();

            $plid = $this->request->getGet('plid');
    
            $links = $model->getStreamLinks($plid);
    
            return $this->response->setJSON($links);
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
        
    }
    public function removeLink() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $linkId = $this->request->getPost('id');
            $deleted = $model->deleteStreamLink($linkId);

            return $this->response->setJSON(['success' =>  'Link deleted successfully']);
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function addLink() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $streamId = $this->request->getPost('stream_id');
            $rtmplink = $this->request->getPost('rtmplink');
            $rtmpkey = $this->request->getPost('rtmpkey');

            $data = [
                'pl_id' => $streamId,
                'rtmp_link' => $rtmplink,
                'rtmp_key' => $rtmpkey
            ];

            $inserted = $model->addStreamLink($data);

            return $this->response->setJSON(['success' => $inserted]);
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function music_video()
    {
        return view('music', $this->setpagedata('Music Video'));
    }
    public function getMusicVideos()
    {
  
        $model = new UserModel();
        $music_videos = $model->MusicVideoslistWithCounts();
        
        return $this->response->setJSON(['status' => 'success', 'data' => $music_videos]);
    }
    public function loadAudioData()
    {
        $model = new UserModel();
        $music_id = $this->request->getPost('music_id');
        
        $audioData = $model->getMusicVideoAudio($music_id);
        $mvname = $model->getmvname($music_id);
        
        foreach ($audioData as &$audio) {
            // Convert audio length to hours/minutes/seconds
            $audio['audio_length'] = convertHours($audio['audio_length']);
            
            // Format file size in GB or MB
            $audio['file_size'] = formatgbFileSize($audio['file_size']);
        }
        
        $response = [
            'mvname' => $mvname, // Add the music video name
            'audioData' => $audioData, // Add the audio data
        ];
        return $this->response->setJSON($response);
    }
    public function createmusicvideo()
    {
        // Get the file data and chunk info from the request
        $file = $this->request->getFile('file');
        $chunkIndex = $this->request->getPost('chunkIndex');
        $totalChunks = $this->request->getPost('totalChunks');
        $originalFileName = $this->request->getPost('fileName');
        $originalExtension = $this->request->getPost('fileExtension');
        $customname = $this->request->getPost('customname');

        // Get the checkbox value for is_loop
        $isLooped = $this->request->getPost('is_loop') ? 1 : 0;

        // Path for chunk uploads in writable folder
        $uploadDir = WRITEPATH . 'uploads/chunks/';
        // Final video path in 'upload/music_video/Video/'
        $finalVideoPath = WRITEPATH . 'uploads/music_video/Video/';
        
        // Create directories if they don't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if (!is_dir($finalVideoPath)) {
            mkdir($finalVideoPath, 0777, true);
        }
        // Save the chunk
        if ($file->isValid()) {
            $filePath = $uploadDir . $originalFileName . '.' . $chunkIndex;
            $file->move($uploadDir, $originalFileName . '.' . $chunkIndex);


          
        
            // Check if all chunks are uploaded
            if ($chunkIndex == $totalChunks - 1) {
                // Generate a unique filename with the original extension
                $uniqueFileName = uniqid() . '.' . $originalExtension; // e.g., '66f2c8f2c7c2b.mp4'
                $finalFilePath = $finalVideoPath . $uniqueFileName;
        
                // Merge chunks into the final file
                $this->mergeChunks($uploadDir, $originalFileName, $totalChunks, $finalFilePath);
        
                // Remove chunk files after merging
                $this->removeChunks($uploadDir, $originalFileName, $totalChunks);
          
                // Get file size and video length
                $filesize = filesize($finalFilePath);
                $videolength = $this->getVideoLengthsec($finalFilePath); // Assuming this method exists
        
                // Insert the file details into the 'music_video' table
                $model = new UserModel();

                $musicVideoData = [
                    'music_name'    => $customname,
                    'video_path'    => $finalFilePath,
                    'is_loop'       => $isLooped,
                    'uniq_identity' => generateUniqueTag()
                ];
    
                if ($model->insertMusicVideo($musicVideoData)) {
                    return $this->response->setJSON(['status' => 'success', 'message' => 'File uploaded and saved successfully']);
                } else {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save video']);
                }
               
                
            }

        }
    
        return $this->response->setJSON(['status' => 'partial', 'message' => 'Chunk uploaded']);
    }
    public function getmvdtls($mvid)
    {
        if ($this->request->isAJAX()) {
            
            $model = new UserModel();
            $response = $model->getmvinfo($mvid);

            return $this->response->setJSON($response);

        }else{
            return redirect()->to(base_url('user/musicVideo'));
        }
    }
    public function updatemv()
    {
        $file = $this->request->getFile('file');
        $editmv_id = $this->request->getPost('editmv_id');
        $chunkIndex = $this->request->getPost('chunkIndex');
        $totalChunks = $this->request->getPost('totalChunks');
        $originalFileName = $this->request->getPost('fileName');
        $originalExtension = $this->request->getPost('fileExtension');
        $customname = $this->request->getPost('customname');
    
        $isLooped = $this->request->getPost('is_loop') ? 1 : 0;
    
        if (!$file) {
            $model = new UserModel();
    
            $musicVideoData = [
                'music_name'    => $customname,
                'is_loop'       => $isLooped
            ];
    
            if ($model->updatemvdata($editmv_id, $musicVideoData)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Video details updated successfully']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update video details']);
            }
        }
    
        $uploadDir = WRITEPATH . 'uploads/chunks/';
        $finalVideoPath = WRITEPATH . 'uploads/music_video/Video/';
    
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if (!is_dir($finalVideoPath)) {
            mkdir($finalVideoPath, 0777, true);
        }
    
        if ($file->isValid()) {
            $filePath = $uploadDir . $originalFileName . '.' . $chunkIndex;
            $file->move($uploadDir, $originalFileName . '.' . $chunkIndex);
        
            if ($chunkIndex == $totalChunks - 1) {
                $uniqueFileName = uniqid() . '.' . $originalExtension;
                $finalFilePath = $finalVideoPath . $uniqueFileName;
        
                $this->mergeChunks($uploadDir, $originalFileName, $totalChunks, $finalFilePath);
        
                $this->removeChunks($uploadDir, $originalFileName, $totalChunks);
        
                $filesize = filesize($finalFilePath);
                $videolength = $this->getVideoLengthsec($finalFilePath);
                $model = new UserModel();

                $oldVideoData = $model->getMusicVideoById($editmv_id);
                $oldFilePath = $oldVideoData['video_path'];
                $musicVideoData = [
                    'music_name'    => $customname,
                    'video_path'    => $finalFilePath,
                    'is_loop'       => $isLooped,
                    'uniq_identity' => generateUniqueTag()
                ];
        
                if ($model->updatemvdata($editmv_id, $musicVideoData)) {
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
        
                    return $this->response->setJSON(['status' => 'success', 'message' => 'File uploaded and saved successfully, old file deleted']);
                } else {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save video']);
                }
            }
        }
    
        return $this->response->setJSON(['status' => 'partial', 'message' => 'Chunk uploaded']);
    }
    public function deletemv() 
    {
        if ($this->request->isAJAX()) {
            $stream_id = $this->request->getPost('stream_id');
            $model = new UserModel();
            $oldVideoData = $model->getMusicVideoById($stream_id);

            if ($oldVideoData) {
                $oldFilePath = $oldVideoData['video_path'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
                $associatedAudios = $model->getAssociatedAudios($stream_id);
                foreach ($associatedAudios as $audio) {
                    if (file_exists($audio['music_path'])) {
                        unlink($audio['music_path']);
                    }
                }
                $model->deleteAssociatedAudio($stream_id);
                $model->deleteStreamLinks($stream_id);


                if ($model->deletemv($stream_id)) {
                    echo json_encode(['success' => 'Video deleted successfully']);
                } else {
                    echo json_encode(['error' => 'Failed to delete video']);
                }

            } else {
                echo json_encode(['error' => 'Video not found']);
            }

        } else {
            return redirect()->to(base_url('user/musicVideo'));
        }
    }
    public function uploadaudio() 
    {
        $mvid = $this->request->getPost('mvid');
        $audioname = $this->request->getPost('audioname');        
        $chunk_number = $this->request->getPost('chunk_number');
        $total_chunks = $this->request->getPost('total_chunks');
        $file = $this->request->getFile('file');
        $file_name = $this->request->getPost('file_name');
        $editmv_id = $this->request->getPost('editmv_id'); // Assuming this is provided if editing
        $customname = $this->request->getPost('music_name'); // Assuming this comes from the form
    

        // Define paths
        $uploadDir = WRITEPATH . 'uploads/chunks/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
    
        // Move each chunk to the temporary directory
        if ($file->isValid() && !$file->hasMoved()) {
            $chunkFileName = $file_name . '_part_' . $chunk_number;
            if ($file->move($uploadDir, $chunkFileName)) {
                // Check if all chunks are uploaded
                if ($chunk_number == $total_chunks) {
                    $originalExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                    $finalAudioPath = WRITEPATH . 'uploads/music_video/Audio/'; // Final destination for merged audio
                    if (!is_dir($finalAudioPath)) {
                        mkdir($finalAudioPath, 0755, true);
                    }
    
                    // Create a unique file name for the merged file
                    $uniqueFileName = uniqid() . '.' . $originalExtension;
                    $finalFilePath = $finalAudioPath . $uniqueFileName;
    
                    // Merge chunks into the final file
                    $this->mergemvChunks($uploadDir, $file_name, $total_chunks, $finalFilePath);
    
                    // Remove chunk files after merging
                    $this->removemvChunks($uploadDir, $file_name, $total_chunks);
    

                    $filesize = filesize($finalFilePath);
                    $videolength = $this->getVideoLengthsec($finalFilePath);

                    $model = new UserModel();
                    $userId = session()->get('user')['id'];
                    $orderindex = $model->getNextOrderIndex($mvid);

                   
                    $musicVideoData = [
                        'music_id'      => $mvid,
                        'Audio_name'    => $audioname,
                        'music_path'    => $finalFilePath,
                        'audio_length'  => $videolength,
                        'file_size'     => $filesize,
                        'order_index'   => $orderindex

                    ];
    
                    if ($model->insertMusicVideoAudio($musicVideoData)) {
                        
                        return $this->response->setJSON(['status' => 'success', 'message' => 'File uploaded and saved successfully']);
                    } else {
                        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save audio']);
                    }
                }
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Error moving chunk'], 500);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid file or already moved'], 500);
        }
    }
    public function updateAudioOrder()
    {
        if ($this->request->isAJAX()) {
            $sortedIDs = $this->request->getPost('sortedIDs'); 
            $music_id = $this->request->getPost('music_id');
        
            if (!empty($sortedIDs)) {
                $model = new UserModel();
                $orderIndex = 1;
        
                foreach ($sortedIDs as $id) {
                    $model->updateAudioOrder($id, $orderIndex, $music_id);
                    $orderIndex++; 
                }
        
                return $this->response->setJSON(['status' => 'success']);
            }
        
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data']);
        }else{
            return redirect()->to(base_url('user/musicVideo'));
        }
    }
    public function deletemvAudio() 
    {
        if ($this->request->isAJAX()) {
            $audioId = $this->request->getPost('audio_id');
            $model = new UserModel();
            $oldFilePath = $model->deletemvAudio($audioId);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }else{
            return redirect()->to(base_url('user/musicVideo'));
        }
    }
    public function getmvLinks() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();

            $streamId = $this->request->getGet('stream_id');

            $links = $model->getmvStreamLinks($streamId); 

            return $this->response->setJSON($links);
        }else{
            return redirect()->to(base_url('user/musicVideo'));
        }
    }
    public function addmvLink() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $streamId = $this->request->getPost('stream_id');
            $rtmplink = $this->request->getPost('rtmplink');
            $rtmpkey = $this->request->getPost('rtmpkey');

            $data = [
                'music_id' => $streamId,
                'mv_link' => $rtmplink,
                'mv_key' => $rtmpkey
            ];
            $inserted = $model->addmvStreamLink($data);

            return $this->response->setJSON(['success' => $inserted]);
        }else{
            return redirect()->to(base_url('user/musicVideo'));
        }
    }
    public function mvremoveLink() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $linkId = $this->request->getPost('id');
            $deleted = $model->deletemvStreamLink($linkId);

            return $this->response->setJSON(['success' =>  'Link deleted successfully']);
        }else{
            return redirect()->to(base_url('user/musicVideo'));
        }
    }
    public function backup()
    {
        $backupPath =$this->backupPath;
        $db = Database::connect();
        $filePath = $db->getDatabase();
        if (!$filePath) {
            return redirect()->to(base_url('user/settings'))->send();
        }
        $backupFileName = 'sqlite_backup_' . date('Y-m-d_H-i-s') . '.sqlite';
        $backupFilePath = $backupPath . $backupFileName;
        if (!is_dir($backupPath)) { 
            mkdir($backupPath, 0755, true);
        }
        copy($filePath, $backupFilePath);
        return redirect()->to(base_url('user/settings'))->with('success', 'Data backup created successfully!');
    }
    public function download($filename)
    {
        $filePath = $this->backupPath . $filename;
        return $this->response->download($filePath, null);
    }
    public function restore($filename)
    {
        $backupFilePath = $this->backupPath . $filename;
        
        $dbFilePath = WRITEPATH . 'database/sitedb.db';
        if (!file_exists($backupFilePath)) {
            return redirect()->to(base_url('user/settings'))->with('error', 'Backup file not found.');
        }
    
        copy($backupFilePath, $dbFilePath);
    
        return redirect()->to(base_url('user/settings'))->with('success', 'Backup restored successfully!');
    }
    public function delete($filename)
    {
       
        $filename = basename($filename);
        
        $filePath = $this->backupPath . $filename;

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                session()->setFlashdata('success', 'Backup file deleted successfully.');
            } else {
                session()->setFlashdata('error', 'Failed to delete backup file.');
            }
        } else {
            session()->setFlashdata('error', 'File not found.');
        }

        return redirect()->to(base_url('user/settings'));
    }
    public function uploadbackup()
    {
        $file = $this->request->getFile('sqlfile');
    
        if (!$file) {
            return redirect()->to(base_url('user/settings'))->with('error', 'No file uploaded!');
        }
    
        if ($file->isValid() && !$file->hasMoved()) {
    
            $fileExtension = $file->getClientExtension(); 
    
            $fileMimeType = $file->getMimeType(); 
    
            if ($fileExtension === 'sqlite') {
    
                $originalName = pathinfo($file->getName(), PATHINFO_FILENAME);
    
                $newName = $originalName . '_' . date('Y-m-d_H-i-s') . '.sqlite';
                
                $uploadPath = $this->backupPath; 
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                if ($file->move($uploadPath, $newName)) {
                    return redirect()->to(base_url('user/settings'))->with('success', 'File uploaded successfully.');
                } else {
                    return redirect()->to(base_url('user/settings'))->with('error', 'Failed to move file!');
                }
            } else {
                return redirect()->to(base_url('user/settings'))->with('error', 'Invalid file type. Only .sql files are allowed.');
            }
        } else {
            $error = $file->getErrorString();
            return redirect()->to(base_url('user/settings'))->with('error', 'File upload failed! Error: ' . $error);
        }
    }

    public function startbcast() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $plid = $this->request->getPost('playlist_id');
          
                streamstartcmd($plid);
            
            return $this->response->setJSON(['status' => true]);
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function stopbcast() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $plid = $this->request->getPost('playlist_id');
           
                streamstopcmd($plid);

            return $this->response->setJSON(['status' => true]);
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function mvstreamstart() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $plid = $this->request->getPost('mvid');
            
                startMVCommand($plid);

            return $this->response->setJSON(['status' => true]);
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }
    public function mvstreamstop() 
    {
        if ($this->request->isAJAX()) {
            $model = new UserModel();
            $plid = $this->request->getPost('mvid');
            
                stopMVCommand($plid);

            return $this->response->setJSON(['status' => true]);
        } else {
            return redirect()->to(base_url('user/playlist'))->send();
        }
    }

}
