<?php

namespace App\Models;

use CodeIgniter\Model;

class Webhook_model extends Model
{
   

    public function plidbyuniq($uniqid)
    {
        $builder = $this->db->table('Playlist');
        $builder->select('id');
        $builder->where('uniq_identity', $uniqid);
        return $builder->get()->getRow();
    }
    public function stopvideo($id)
    {
        $builder = $this->db->table('Playlist');
        $builder->set('status', 0);
        $builder->where('id', $id);
        return $builder->update();
    }
    public function mvidbyuniq($uniqid)
    {
        $builder = $this->db->table('music_video');
        $builder->select('id');
        $builder->where('uniq_identity', $uniqid);
        return $builder->get()->getRow();
    }
    public function stopmusicvideo($id)
    {
        $builder = $this->db->table('music_video');
        $builder->set('mv_stream_status', null);
        $builder->where('id', $id);
        return $builder->update();
    }

}
