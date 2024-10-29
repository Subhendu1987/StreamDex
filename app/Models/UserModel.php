<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
   
    public function videofiles()
    {
        $builder = $this->db->table('Video_file');

        $query = $builder->get();

        return $query->getResultArray();
    }
    public function saveFile($data)
    {
      
        return $this->db->table('Video_file')->insert($data);
    }
    public function getemedia($id)
    {
        $builder = $this->db->table('Video_file');
        $query = $builder->where('id', $id)->get();
        return $query->getRow();
    }
    public function gettotaldetails($id)
    {
        $builder = $this->db->table('site_user');
        $query = $builder->where('id', $id)->get();
        return $query->getRow();
    }
    public function updateUser($id, $data)
    {
        return $this->db->table('site_user')
            ->where('id', $id)
            ->update($data);
    }
    
    
    public function deletemedia($id)
    {
        $builder = $this->db->table('Video_file');
        $video = $builder->where('id', $id)->get()->getRow();
        if ($video) {
            return $builder->delete(['id' => $id]);
        }        
        return false;
    }
    public function deleteplmedia($id)
    {
        $builder = $this->db->table('playlist_media');
        $video = $builder->where('video_id', $id)->get()->getRow();
        
        if ($video) {
            return $builder->where('video_id', $id)->delete(); 
        }        
        return false;
    }
    

    public function getmediaById($id)
    {
        return $this->db->table('Video_file') 
                        ->select('filename')
                        ->where('id', $id)
                        ->get()
                        ->getRowArray();
    }
    public function updatemedia($id, $data)
    {
        $builder = $this->db->table('Video_file');    
        return $builder->set('filename', $data['name'])
                        ->where('id', $id)
                        ->update();
    }


    public function loadPlaylistDetails()
    {
        $builder = $this->db->table('Playlist p');
        $builder->select('
            p.id AS playlist_id, 
            p.pl_name, 
            p.is_looped,
            p.status,
            p.uniq_identity,
            COALESCE(COUNT(pm.id), 0) AS total_videos, 
            COALESCE(CAST(SUM(vf.file_length) AS INTEGER), 0) AS total_duration,
            COALESCE((
                SELECT COUNT(rl.id)
                FROM rtmp_link rl
                WHERE rl.pl_id = p.id
            ), 0) AS rtmp_link_count
        ');
        $builder->join('playlist_media pm', 'p.id = pm.pl_id', 'left');
        $builder->join('Video_file vf', 'pm.video_id = vf.id', 'left');
        $builder->groupBy('p.id, p.pl_name, p.is_looped, p.status');
        $query = $builder->get();
    
        return $query->getResultArray();
    }
    

    public function insertPlaylist($pl_name, $loop_check)
    {
        $builder = $this->db->table('Playlist');
        $data = [
            'pl_name' => $pl_name,
            'is_looped' => $loop_check,
            'uniq_identity' => generateUniqueTag()
        ];
        $builder->insert($data);
        return $this->db->insertID() !== 0;
    }
    public function getPlaylistById($id)
    {
        $this->setTable('Playlist');
        $builder = $this->select('id, pl_name, is_looped') ->where('id', $id) ->first();
        return $builder; 
    }
    public function updatePlaylist($pl_id, $pl_name)
    {
        $builder = $this->db->table('Playlist');
    
        $builder->where('id', $pl_id);
        $builder->update($pl_name);
        return $this->db->affectedRows() > 0;
    }
    public function deletePlaylist($id)
    {
        $builder = $this->db->table('Playlist');
        $builder->where('id', $id);
        $builder->delete();
        return $this->db->affectedRows() > 0;
    }
    public function getPlaylistMedia($pl_id)
    {
        $builder = $this->db->table('playlist_media a');
        $builder->select('a.id, b.filename, b.file_length');
        $builder->join('Video_file b', 'b.id = a.video_id');
        $builder->where('a.pl_id', $pl_id);
        $builder->orderBy('a.order_index');
        
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getUnassignedVideos($pl_id)
    {
        $subQuery = $this->db->table('playlist_media')
                            ->select('video_id')
                            ->where('pl_id', $pl_id);
        
        $builder = $this->db->table('Video_file');
        $builder->select('id, filename');
        $builder->whereNotIn('id', $subQuery);
        
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getPlaylistnameById($id)
    {
        $builder = $this->db->table('Playlist');
        $builder->select('id, pl_name');
        $builder->where('id', $id);
        $query = $builder->get(); 
        return $query->getRowArray();
    }
    public function addVideoToPlaylist($playlistId, $videoId)
    {
        $builder = $this->db->table('playlist_media');
        $builder->select('COALESCE(MAX(order_index) + 1, 1) AS next_index');
        $builder->where('pl_id', $playlistId);
        $query = $builder->get();
        $row = $query->getRow();
        
        $nextIndex = isset($row->next_index) ? $row->next_index : 1;
        
        $data = [
            'pl_id'      => $playlistId,
            'video_id'   => $videoId,
            'order_index'=> $nextIndex
        ];
    
        return $this->db->table('playlist_media')->insert($data);
    }
    public function removeVideoFromPlaylist($videoId)
    {
        return $this->db->table('playlist_media')
            ->where('id', $videoId)
            ->delete();
    }

    public function updatePlaylistOrder($id, $index)
    {
        
            $builder = $this->db->table('playlist_media');
            $builder->set('order_index', $index)
                        ->where('id', $id)
                        ->update();
            return $this->db->affectedRows() > 0;
    }

    public function getStreamLinks($pl_id) {
            $builder = $this->db->table('rtmp_link');
            $builder->where('pl_id', $pl_id);
            $query = $builder->get(); 
            return $query->getResultArray();
    }
    public function deleteStreamLink($linkId) 
    {
            return $this->db->table('rtmp_link')
                ->where('id', $linkId)
                ->delete();   
    }
    public function addStreamLink($data)
    {
            $builder = $this->db->table('rtmp_link');
            $builder->insert($data);
            return $this->db->insertID() !== 0;
    }


    public function MusicVideoslistWithCounts()
    {
        $userId = session()->get('user')['id'];
        $builder = $this->db->table('music_video a');
    
        $builder->select('
            a.id,
            a.music_name,
            CASE 
                WHEN a.is_loop IS 0 THEN \'No\'  
                WHEN a.is_loop IS 1 THEN \'Yes\'
            END AS is_loop, 
            a.created_on,  
            a.mv_stream_status AS livestatus,
            a.uniq_identity as vidid,
            CASE 
                WHEN a.mv_stream_status IS NULL THEN \'Stopped\'  
                WHEN a.mv_stream_status IS NOT NULL THEN \'Playing\'
            END AS livestatustext, 
            (SELECT COUNT(b.id) FROM music_video_audio b WHERE b.music_id = a.id ) AS audio_count, 
            (SELECT COUNT(c.id) FROM music_stream_link c WHERE c.music_id = a.id) AS stm_count
        ')
        ->groupBy('a.id');
    
        return $builder->get()->getResultArray();
    }
    
    public function getMusicVideoAudio($music_id)
    {
        $builder = $this->db->table('music_video_audio');
        $builder->select('id, Audio_name, audio_length, file_size, Created_on, order_index');
        $builder->where('music_id', $music_id);
        $builder->orderBy('order_index', 'ASC');
        
        return $builder->get()->getResultArray(); 
    }
    public function getmvname($musicId)
    {
        $query = $this->db->table('music_video')
                        ->select('music_name')
                        ->where('id', $musicId)
                        ->get();
        return $query->getRow()->music_name;
    }
    public function insertMusicVideo($data)
    {
        $builder = $this->db->table('music_video');
        return $builder->insert($data);
    }
    public function getmvinfo($mv_id) {
        return $this->db->table('music_video')
                    ->where('id', $mv_id)->get()->getRowArray();
    }
    public function updatemvdata($mvid, $data)
    {
        $builder = $this->db->table('music_video');
        $builder->where('id', $mvid);
        
        $updateStatus = $builder->update($data);
    
        return $updateStatus; 
    }
    public function getMusicVideoById($editmv_id)
    {
        $builder = $this->db->table('music_video');
        
        $builder->select('video_path')
                ->where('id', $editmv_id);
        
        return $builder->get()->getRowArray();
    }

    public function getAssociatedAudios($music_id)
    {
        return $this->db->table('music_video_audio')
                        ->select('id, music_path')
                        ->where('music_id', $music_id)
                        ->get()
                        ->getResultArray();
    }

    public function deleteAssociatedAudio($music_id)
    {
        return $this->db->table('music_video_audio')
                        ->where('music_id', $music_id)
                        ->delete();
    }


    public function deleteStreamLinks($music_id)
    {
        return $this->db->table('music_stream_link')
                        ->where('music_id', $music_id)
                        ->delete();
    }


    public function deletemv($stream_id)
    {
        return $this->db->table('music_video')
                        ->where('id', $stream_id)
                        ->delete();
    }
    
    public function getNextOrderIndex($musicId)
    {
        $builder = $this->db->table('music_video_audio')
                        ->select('IFNULL(MAX(order_index) + 1, 1) as orderindex')
                        ->where('music_id', $musicId)
                        ->get();

        return $builder->getRow()->orderindex;
    }
    public function insertMusicVideoAudio($data)
    {
        $this->db->table('music_video_audio')->insert($data);
        return $this->db->affectedRows() > 0;
    }
    public function updateAudioOrder($id, $orderIndex, $music_id)
    {
        $this->db->table('music_video_audio')
                ->where('id', $id)
                ->where('music_id', $music_id)
                ->update(['order_index' => $orderIndex]);
    }
    public function deletemvAudio($audioId)
    {
  
        $builder = $this->db->table('music_video_audio');
        $audiopathQuery = $builder->select('music_path')->where('id', $audioId)->get();
        
        if ($audiopathQuery->getNumRows() > 0) {
            $audiopath = $audiopathQuery->getRow()->music_path;
            $builder->where('id', $audioId);
            $builder->delete();
            return $audiopath;
        }
        return null;
    }


    public function getmvStreamLinks($streamId) {
        $builder = $this->db->table('music_stream_link');
        $builder->select('id, mv_link, mv_key');
        $builder->where('music_id', $streamId);
        return $builder->get()->getResultArray(); 
    }
    public function addmvStreamLink($data) {
        return $this->db->table('music_stream_link')->insert($data);
    }
    
    public function deletemvStreamLink($linkId) {
        $builder = $this->db->table('music_stream_link');
        $builder->where('id', $linkId);
        $result = $builder->delete();
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    
    }

    public function getResulations() {
        return $this->db->table('resulation')->get()->getResultArray();
    }
    public function getstmsettings() {
        return $this->db->table('stream_settings')->where('id', 1)->get()->getRow();
    }
    public function setResulationInactive()
    {
        return $this->db->table('resulation')->set('str_is_active', 0)->update();
    }
    public function setsettings($data)
    {
        if (!empty($data)) {
            return $this->db->table('stream_settings')->set($data)->where('id', 1)->update();
        }
        return false;
    }

    public function setResulationActive($id)
    {
        return $this->db->table('resulation')->where('id', $id)->set('str_is_active', 1)->update();
    }
    public function totalvid()
    {
        $builder = $this->db->table('Video_file');    
        $query = $builder->select('COUNT(id) as totalvid, SUM(file_size) as size, SUM(file_length) as leng')
                     ->get();
        return $query->getRow();
    }
    public function getPlaylistStats()
    {
        $builder = $this->db->table('Playlist p');
        $builder->select('
            COUNT(DISTINCT p.id) AS total_playlists,
            COALESCE(SUM(vf.file_length), 0) AS total_duration,
            COALESCE(COUNT(DISTINCT rl.id), 0) AS total_rtmp_links
        ');
        $builder->join('playlist_media pm', 'p.id = pm.pl_id', 'left');
        $builder->join('Video_file vf', 'pm.video_id = vf.id', 'left');
        $builder->join('rtmp_link rl', 'rl.pl_id = p.id', 'left');

        $query = $builder->get();
        return $query->getRow();
    }

    public function getMusicVideoCounts()
    {
        $builder = $this->db->table('music_video a');

        $builder->select('
            COUNT(a.id) AS total_music_videos,
            SUM(audio_counts.audio_count) AS total_audio_count,
            SUM(stream_counts.stm_count) AS total_stream_count
        ');

        $builder->join('(
            SELECT music_id, COUNT(id) AS audio_count 
            FROM music_video_audio 
            GROUP BY music_id
        ) audio_counts', 'audio_counts.music_id = a.id', 'left');

        $builder->join('(
            SELECT music_id, COUNT(id) AS stm_count 
            FROM music_stream_link 
            GROUP BY music_id
        ) stream_counts', 'stream_counts.music_id = a.id', 'left');

        return $builder->get()->getRow(); // return a single row
    }

}
