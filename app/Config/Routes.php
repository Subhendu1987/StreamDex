<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login_controller::login');
$routes->post('/', 'Login_controller::login_function');
$routes->get('logout', 'Logout_controller::index');


$routes->group('user', function($routes) {
    $routes->post('system', 'SystemStatus::getStatus');

    
    $routes->get('/', 'User_Controller::dashboard');


    $routes->get('Video', 'User_Controller::Videoview');
    $routes->get('videolfile', 'User_Controller::videofiles');
    $routes->post('upload', 'User_Controller::upload');
    $routes->post('video/delete/(:num)', 'User_Controller::deletemedia/$1');
    $routes->get('video/rename/(:num)', 'User_Controller::renamemedia/$1');
    $routes->post('video/update/(:num)', 'User_Controller::nameupdatemedia/$1');

    $routes->get('playlist', 'User_Controller::playlist');
    $routes->get('load_playlists', 'User_Controller::load_playlists');  
    $routes->post('create_playlist', 'User_Controller::create_playlist');
    $routes->get('playlist/edit/(:num)', 'User_Controller::getPlaylistById/$1');    
    $routes->post('playlist/edit/(:num)', 'User_Controller::updatePlaylistById/$1');
    $routes->post('playlist/delete/(:num)', 'User_Controller::playlist_delete/$1');
    $routes->get('playlist/info/(:num)', 'User_Controller::getPlaylistInfo/$1');
    $routes->post('playlist/addtoplaylist/', 'User_Controller::addMediaToPlaylist');
    $routes->post('playlist/mediaremove/', 'User_Controller::removeMediafromPlaylist');
    $routes->post('playlist/order', 'User_Controller::updatePlaylistOrder');
    $routes->get('playlist/getLinks', 'User_Controller::getLinks');
    $routes->post('playlist/getLinks', 'User_Controller::removeLink');
    $routes->post('playlist/addLinks', 'User_Controller::addLink');



    $routes->post('playlist/startbroadcast', 'User_Controller::startbcast');
    $routes->post('playlist/stopbroadcast', 'User_Controller::stopbcast');


    $routes->get('musicVideo', 'User_Controller::music_video');
    $routes->get('musicVideo/data', 'User_Controller::getMusicVideos');
    $routes->post('musicVideo/create', 'User_Controller::createmusicvideo');
    $routes->get('musicVideo/getLinks', 'User_Controller::getmvLinks');
    $routes->post('musicVideo/addLink', 'User_Controller::addmvLink');
    $routes->post('musicVideo/removeLink', 'User_Controller::mvremoveLink');    
    $routes->get('musicVideo/update/(:num)', 'User_Controller::getmvdtls/$1');
    $routes->post('musicVideo/update', 'User_Controller::updatemv');
    $routes->post('musicVideo/delete', 'User_Controller::deletemv');
    $routes->post('musicVideo/addaudio', 'User_Controller::uploadaudio');
    $routes->post('musicVideo/loadaudiodata', 'User_Controller::loadAudioData');
    $routes->post('musicVideo/updateAudioOrder', 'User_Controller::updateAudioOrder');
    $routes->post('musicVideo/Audiodelete', 'User_Controller::deletemvAudio');

    $routes->post('musicVideo/startstream', 'User_Controller::mvstreamstart');
    $routes->post('musicVideo/stopstream', 'User_Controller::mvstreamstop');

    $routes->get('profile', 'User_Controller::userprofile');
    $routes->post('profile', 'User_Controller::userprofileupdate');


    $routes->get('settings', 'User_Controller::settings');
    $routes->post('settings/backup', 'User_Controller::backup');
    $routes->get('settings/backup/download/(:any)', 'User_Controller::download/$1');
    $routes->get('settings/backup/restore/(:any)', 'User_Controller::restore/$1');
    $routes->post('settings/backup/upload', 'User_Controller::uploadbackup');
    $routes->get('settings/backup/delete/(:any)', 'User_Controller::delete/$1');
    $routes->post('settings/resulation', 'User_Controller::updateResulation');
    $routes->post('settings/stream', 'User_Controller::updatestreamsettings');

    $routes->get('guide', 'User_Controller::guide');

    $routes->post('checkfile', 'User_Controller::checkFileExistence');
});
$routes->group('webhook', function($routes) {
    $routes->post('video/(:any)', 'Webhook_controller::video_stop/$1');
    $routes->post('Musicvideo/(:any)', 'Webhook_controller::music_stop/$1');
});

