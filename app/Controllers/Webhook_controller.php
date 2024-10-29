<?php

namespace App\Controllers;
use App\Models\Webhook_model;

class Webhook_controller extends BaseController
{
    

    public function video_stop($uniqid)
    {
        $model = new Webhook_model();
        $playlist = $model->plidbyuniq($uniqid);
        if($playlist){
            $model->stopvideo($playlist->id);
            return $this->response->setContentType('text/plain')->setBody('');
        }else{
            return $this->response->setContentType('text/plain')->setBody('');
        }      
    }
    public function music_stop($uniqid)
    {
        $model = new Webhook_model();
        $mvid = $model->mvidbyuniq($uniqid);
        if($mvid){
            $model->stopmusicvideo($mvid->id);
            return $this->response->setContentType('text/plain')->setBody('');
        }else{
            return $this->response->setContentType('text/plain')->setBody('');
        }
    }

}
