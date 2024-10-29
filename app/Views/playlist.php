<?php include('include/header.php'); ?>
<style>
#loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(33 38 49 / 58%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.spinner {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>
<!-- Playlist Create Modal -->
<div class="modal fade" id="createplaylistModal" tabindex="-1" aria-labelledby="uploadModalLabel" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Create Playlist</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" id="createPlaylistForm" novalidate>
                    <div class="mb-3">
                        <label for="PlaylistName" class="form-label">Playlist Name</label>
                        <input type="text" class="form-control" id="PlaylistName" name="PlaylistName" required>
                        <div class="invalid-feedback">
                            Please enter a playlist name.
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="loop_check" name="loop_check">
                        <label class="form-check-label" for="loop_check">
                            Loop Playback  
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closemodal" data-coreui-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="createplaylist">Create Playlist</button>
            </div>
        </div>
    </div>
</div>
<!-- Playlist edit Modal -->
<div class="modal fade" id="editplaylistModal" tabindex="-1" aria-labelledby="uploadModalLabel" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Edit Playlist</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" id="editPlaylistForm" novalidate>
                <input type="hidden" id="editPlaylistid" >
                    <div class="mb-3">
                        <label for="editPlaylistName" class="form-label">Playlist Name</label>
                        <input type="text" class="form-control" id="editPlaylistName" name="editPlaylistName" required>
                        <div class="invalid-feedback">
                            Please enter a playlist name.
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="loop_check_edit" name="loop_check_edit">
                        <label class="form-check-label" for="loop_check_edit">
                            Loop Playback  
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeeditmodal" data-coreui-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="editplaylist" onclick = "plupdate();">Edit Playlist</button>
            </div>
        
        </div>
    </div>
</div>
<!-- Add link Modal -->

<div class="modal fade" id="addlinkmodal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="addlinkmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addlinkmodalLabel">RTMP Link</h5>
        <button type="button" id = "closelink" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-header">
        
        <div class="container">
        <form id="linkForm" class="needs-validation" novalidate>
        <input type="hidden" id="pl_st_id">
          <div class="row row-cols-lg-auto align-items-center">
            <div class="col-lg-6">
              <input type="text" id="rtmplink" class="form-control" placeholder="RTMP Link" required />
            
            </div>
            <div class="col-lg-5">
              <input type="text" id="rtmpkey" class="form-control" placeholder="RTMP Key" required />
            </div>
            <div class="col-lg-1">
              <button type="button" id="add_link_btn" class="btn btn-danger btn-sm" onclick= "addlink();">Add</button>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col" style = "width: 5%">#</th>
              <th scope="col" style = "width: 45%">Link</th>
              <th scope="col" style = "width: 45%" colspan="2">Key</th>
            </tr>
          </thead>
          <tbody id="link_table_body">
            <!-- Links will be loaded here via AJAX -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- View video modal -->
<div class="modal fade" id="viewstream" tabindex="-1" aria-labelledby="uploadModalLabel" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
            <!-- <video id="player" class="video-js vjs-default-skin"
                controls
                autoplay
                muted
                width="465" height="262">
                <source src="" type="application/x-mpegURL">
            </video> -->
            <video id="player" class="video-js vjs-default-skin" controls preload="auto" width="465" height="262"></video>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="manageModal" tabindex="-1" aria-labelledby="playmanagename" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playmanagename">Mv Name</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" id= "closemvmodal" aria-label="Close"></button>
            </div>
          
            <div class="modal-body">
                <table class="table table-striped " id="managevideoTable">
                        
                        <tbody id="sortable">
                                <tr data-id="1">
                                    <td scope="row" style="width: 5%; cursor: s-resize;">  
                                            <svg class="icon icon-xl drag-handle">
                                                <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-menu') ?>"></use>
                                            </svg>
                                    </td>
                                    <td style="width: 75%">1st video</td>
                                    <td style="width: 10%">00:01:57</td>
                                    <td style="width: 10%"><button type="button" class="btn btn-outline-danger btn-sm">Remove</button></td>
                                </tr>
                        </tbody>
                </table>
            </div>   
            <div class="modal-footer">
                <table class="table table-dark table-borderless" >
                        <input type="hidden" id="manageplid" >
                        <tbody >
                                <tr>
                                    <td style="width: 90%">
                                            <div class="mb-3">
                                                <label for="add_mv_audio" class="form-label">Select Video</label>
                                                    <select class="form-select" aria-label="Default select" id="playlistselectedid" name="playlistselectedid" >
                                                            <option selected="" disabled="" value="">Select Video</option>
                                                    </select>
                                                <div class="invalid-feedback">
                                                    Please Select a valid video.
                                                </div>
                                            </div>

                                    </td>
                                    <td style="width: 10%">
                                            <div class="mb-3">
                                                <label for="add_mv_audio" class="form-label" style="opacity: 0.0; padding-bottom: 3px;">f</label>
                                                <button type="button" id="add_mv_btn" class="btn btn-success btn-sm" onclick = "addtopl()">Add</button>
                                            </div>
                                    </td>
                                </tr>
                        </tbody>
                </table>
            </div> 
          
            
        </div>
    </div>
</div>



<div class="body flex-grow-1">
    <div class="row scrollable-div px-4">
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Playlist</h5>
                    <button class="btn btn-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#createplaylistModal">Create Playlist</button>
                </div>
                <div class="card-body">
                        <table class="table border mb-0" id="playlistTable">
                            <thead class="fw-semibold text-nowrap">
                                <tr class="align-middle">
                                    <th class="bg-body-secondary" style="width: 5%;">#</th>
                                    <th class="bg-body-secondary" style="width: 30%;">Name</th>
                                    <th class="bg-body-secondary" style="width: 15%;">Video</th>
                                    <th class="bg-body-secondary" style="width: 15%;">Duration</th>                                    
                                    <th class="bg-body-secondary" style="width: 10%;">Link</th>
                                    <th class="bg-body-secondary" style="width: 10%;">Loop</th>
                                    <th class="bg-body-secondary" style="width: 10%; padding-left : 20px">Status</th>
                                    <th class="bg-body-secondary" style="width: 5%;">Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <td colspan="8" class="text-center text-body-secondary" >No Playlist Found.</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="loader" style="display: none;">
    <div class="spinner"></div>
    Please wait...
</div>

<?php include('include/footer.php'); ?>

<script>


    // Function to load playlists
    function loadPlaylists() {
        $.ajax({
            url: '<?= base_url('user/load_playlists') ?>',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                let tbody = $('#playlistTable tbody');
                tbody.empty();
                if (response.length > 0) {
                    response.forEach(function (playlist, index) {
                        let videoLabel = playlist.tl_vid < 2 ? 'Video' : 'Videos';
                        let LinkLabel = playlist.ln_count < 2 ? 'Link' : 'Links';
                        tbody.append(`
                                        <tr class="align-middle">
                                            <td>${index + 1}</td>
                                            <td>${playlist.pl_nm}</td>
                                            <td>${playlist.tl_vid} ${videoLabel}</td>
                                            <td>${playlist.vid_len}</td>
                                            <td>${playlist.ln_count} ${LinkLabel}</td>
                                            <td>${playlist.loop_check}</td>
                                                ${playlist.statuscode == 1
                                                            ? `<td>
                                                            <button class="btn p-0 text-success" type="button" onclick= "loadAndPlayM3U8('${playlist.localkey}')" title = "Preview">
                                                            <svg class="icon">
                                                            <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-media-play') ?>"></use>
                                                            </svg> ${playlist.status}</button> </td>` 
                                                            : `<td class="text-danger"><svg class="icon">
                                                            <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-media-stop') ?>"></use>
                                                            </svg> ${playlist.status}</td>`}
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg class="icon">
                                                            <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-options') ?>"></use>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        ${playlist.tl_vid > 0 && playlist.ln_count > 0 && playlist.statuscode == 0
                                                            ? `<button class="dropdown-item" type="button" onclick="startbc('${playlist.pl_id}')">Start Broadcast</button>` 
                                                            : ''}
                                                        ${playlist.statuscode == 1
                                                            ? `<button class="dropdown-item" type="button" onclick="stopbc('${playlist.pl_id}')">Stop Broadcast</button>` 
                                                            : ''}
                                                        ${playlist.statuscode == 0
                                                            ? `<button class="dropdown-item" type="button" onclick="openaddvideo('${playlist.pl_id}')">Manage Link</button>
                                                                <button class="dropdown-item" type="button" onclick="openmanage('${playlist.pl_id}')">Manage Video</button>
                                                                <button class="dropdown-item" type="button" onclick="editplaylist('${playlist.pl_id}')">Edit Playlist</button>
                                                                <button class="dropdown-item text-danger" type="button" onclick="deletemodal('${playlist.pl_id}')">Delete Playlist</button>` 


                                                            : `<button class="dropdown-item" type="button" disabled>Manage Link</button>
                                                                <button class="dropdown-item" type="button" disabled>Manage Video</button>
                                                                <button class="dropdown-item" type="button" disabled>Edit Playlist</button>
                                                                <button class="dropdown-item" type="button" disabled>Delete Playlist</button>`}
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    `);

                    });
                } else {
                    tbody.append(`
                        <tr class="align-middle">
                            <td colspan="8" class="text-center text-body-secondary">No Playlist Found.</td>
                        </tr>
                    `);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error loading playlists:", error);
                console.error("XHR:", xhr);
            }
        });
    }


    loadPlaylists();




    $('#createplaylist').on('click', function () {
        var form = $('#createPlaylistForm')[0];
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $.ajax({
                url: '<?= base_url('user/create_playlist') ?>',
                method: 'POST',
                data: {
                    PlaylistName: $('#PlaylistName').val(),
                    loop_check: $('#loop_check').is(':checked') ? 1 : 0
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        loadPlaylists();
                        $('#createplaylistModal').modal('hide'); 
                        Swal.fire({
                            title: "Success",
                            text: "Playlist Created Successfully!",
                            icon: "success"
                        });
                        document.getElementById('PlaylistName').value = '';
                    } else {
                        Swal.fire({
                        title: "Failed",
                        text: "Playlist Creation Failed!",
                        icon: "error"
                        });
                        document.getElementById('PlaylistName').value = '';
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error creating playlist:", error);
                    console.error("XHR:", xhr);
                }
            });
        }

        form.classList.add('was-validated');
    });

    $('#createplaylistModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('form').removeClass('was-validated');
    });




function editplaylist(data) {
    $.ajax({
        url: '<?= base_url('user/playlist/edit') ?>/' + data,  // URL with the playlist ID
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#editPlaylistid').val(response.id);
            $('#editPlaylistName').val(response.pl_name);
            $('#loop_check_edit').prop('checked', response.is_looped == '1');
        },
        error: function(error) {
            console.error('Error fetching playlist', error);
        }
    });

    $("#editplaylistModal").modal("show");
}

function openmanage(data) {
loadplaylistdetailsdata(data);
}
function loadplaylistdetailsdata(playlistId){
    $.ajax({
    url: '<?= base_url('user/playlist/info') ?>/' + playlistId, 
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        $('#playmanagename').text(data.pl_info.pl_name);
        $('#manageplid').val(data.pl_info.id);

        let tbody = $('#managevideoTable tbody');
        tbody.empty();
        
        if (data.playlist_files.length === 0) {
            tbody.append(`
                <tr>
                    <td colspan="4" style="text-align: center;">No Video Found</td>
                </tr>
            `);
        } else {
            $.each(data.playlist_files, function(index, item) {
                tbody.append(`
                    <tr data-id="${item.id}">
                        <td scope="row" style="width: 5%; cursor: s-resize;">  
                            <svg class="icon icon-xl drag-handle">
                                <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-menu') ?>"></use>
                            </svg>
                        </td>
                        <td style="width: 75%">${item.filename}</td>
                        <td style="width: 10%">${item.vid_len}</td>
                        <td style="width: 10%">
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="dlfromplaylist(${item.id});">Remove</button>
                        </td>
                    </tr>
                `);
            });
        }

        $('#playlistselectedid').empty().append(`
            <option selected disabled value="">Select Video</option>
        `);

        $.each(data.dropdown_select, function(index, item) {
            $('#playlistselectedid').append(
                $('<option>', {
                    value: item.id,
                    text: item.filename
                })
            );
        });

        $('#manageModal').modal('show');
    },
    error: function(xhr, status, error) {
        console.error('Error fetching playlist data:', error);
    }
});
}
function addtopl() {
    'use strict';
    
    var plid = $('#manageplid').val(); 
    var playlistSelect = document.getElementById('playlistselectedid');
    var vidid = $('#playlistselectedid').val();

    if (playlistSelect.value) {
        $.ajax({
            url: '<?= base_url('user/playlist/addtoplaylist') ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                pl_id: plid,
                video_id: vidid
            },
            success: function(response) {
                if (response.success) {
                        loadPlaylists();
                        loadplaylistdetailsdata(plid);
                        Swal.fire({
                        title: "Success",
                        text: "Added to Playlist Successfully!",
                        icon: "success"
                        });
                } else {
                        Swal.fire({
                        title: "Failed",
                        text: "Added to Playlist Failed!",
                        icon: "error"
                        });
                }
            }
        });
    } else {
        playlistSelect.setCustomValidity('Please select a video.');
    }
}


function dlfromplaylist(itemid) {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('user/playlist/mediaremove') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    video_id: itemid
                },
                success: function(response) {
                    if (response.success) {
                        loadPlaylists();
                        loadplaylistdetailsdata($('#manageplid').val());
                        Swal.fire(
                            'Deleted!',
                            'The video has been removed from the playlist.',
                            'success'
                        );
                        $('#managevideoTable tbody').find(`tr[data-id="${itemid}"]`).remove();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Failed to remove the video: ' + response.error,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    Swal.fire(
                        'Error!',
                        'An error occurred: ' + error,
                        'error'
                    );
                }
            });
        }
    });
}



function deletemodal(pl_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            pldelete(pl_id);
        }
    });
}
function pldelete(pl_id){
    $.ajax({
                url: '<?= base_url('user/playlist/delete') ?>/' + pl_id,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#deletemodal').modal('hide'); 
                        Swal.fire('Deleted!', 'Your playlist has been deleted.', 'success');
                        loadPlaylists(); // Reload the playlist table
                    } else {
                        $('#deletemodal').modal('hide'); 
                        Swal.fire('Failed!', 'Playlist deletion failed!', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting playlist', error);
                }
            });
}

function plupdate() {
    var form2 = $('#editPlaylistForm')[0];

    // Check if the form is valid
    if (form2.checkValidity() === false) {
        form2.classList.add('was-validated'); // Show validation styles
    } else {
        // Get the form data
        var playlistId = $('#editPlaylistid').val();
        var playnm = $('#editPlaylistName').val();
        var islooped = $('#loop_check_edit').is(':checked') ? '1' : '0';

        // Make the AJAX call
        $.ajax({
            url: '<?= base_url('user/playlist/edit') ?>/' + playlistId,
            type: 'POST',
            data: { playnm, islooped},
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#editplaylistModal').modal('hide'); 
                    
                        Swal.fire({
                            title: "Success",
                            text: "Playlist Updated Successfully!",
                            icon: "success"
                        });
                        document.getElementById('editPlaylistid').value = '';
                        document.getElementById('editPlaylistName').value = ''; 
                        loadPlaylists();
                } else {
                    $('#editplaylistModal').modal('hide'); 
                    Swal.fire({
                        title: "Failed",
                        text: "Playlist Update Failed!",
                        icon: "error"
                        });
                        document.getElementById('editPlaylistid').value = '';
                        document.getElementById('editPlaylistName').value = ''; 
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating playlist', error);
            }
        });
    }
}


function openaddvideo(plid){
        loadlink(plid);
        $('#pl_st_id').val(plid);
        $('#addlinkmodal').modal('show'); 
    
}
function loadlink(plid){
    $.ajax({
            url: "<?= base_url('user/playlist/getLinks') ?>",
            type: "GET",
            data: { plid: plid },
            dataType: "json",
            success: function(response) {
                var tableBody = '';
                if (response.length > 0) {
                    $.each(response, function(index, link) {
                        tableBody += `<tr>
                                        <th scope="row" style = "width: 5%">${index + 1}</th>
                                        <td style = "width: 45%">${link.rtmp_link}</td>
                                        <td style = "width: 45%">${link.rtmp_key}</td>
                                        <td style = "width: 5%"><button type="button" class="btn btn-outline-danger btn-sm" onclick="removeLink(${link.id});">Remove</button></td>
                                      </tr>`;
                    });
                } else {
                    tableBody = '<tr><td colspan="4" class="text-center">No Links Found</td></tr>';
                }
                $('#link_table_body').html(tableBody);
            }
        });
}

function removeLink(linkId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('user/playlist/getLinks') ?>',
                type: 'POST',
                data: { id: linkId },
                success: function(response) {
                    loadlink($('#pl_st_id').val());
                    loadPlaylists();
                }
            });
        }
    });
}

function addlink(){
    var rtmplink = $('#rtmplink').val().trim();
        var rtmpkey = $('#rtmpkey').val().trim();
        var streamId = $('#pl_st_id').val();
        
        var linkForm = document.getElementById('linkForm'); 

        if (!linkForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        
            if (rtmplink === "") {
                $('#rtmplink').addClass('is-invalid');
            } else {
                $('#rtmplink').removeClass('is-invalid');
            }
            
            if (rtmpkey === "") {
                $('#rtmpkey').addClass('is-invalid');
            } else {
                $('#rtmpkey').removeClass('is-invalid');
            }

            return; 
        }
        $.ajax({
            url: "<?= base_url('user/playlist/addLinks') ?>",
            type: "POST",
            data: {
                stream_id: streamId,
                rtmplink: rtmplink,
                rtmpkey: rtmpkey
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    loadlink($('#pl_st_id').val());
                    loadPlaylists();
                    $('#rtmplink').val('');
                    $('#rtmpkey').val('');
                } else {
                    $('#rtmplink').addClass('is-invalid');
                    $('#rtmpkey').addClass('is-invalid');
                }
            },
            error: function() {
                $('#rtmplink').addClass('is-invalid');
                $('#rtmpkey').addClass('is-invalid');
            }
        });

}

function startbc(plid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to start broadcasting the playlist!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, start broadcast!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('user/playlist/startbroadcast') ?>',
                type: 'POST',
                data: {
                    playlist_id: plid
                },
                success: function(response) {
                    if (response.status) {
                        loadPlaylists();
                        Swal.fire('Broadcast Started!', response.message, 'success');
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'There was an error starting the broadcast. Please try again.', 'error');
                }
            });
        }
    });
}

function stopbc(plid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to stop the broadcast!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, stop broadcast!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('user/playlist/stopbroadcast') ?>',
                type: 'POST',
                data: {
                    playlist_id: plid
                },
                success: function(response) {
                    if (response.status) {
                        loadPlaylists();
                        Swal.fire('Broadcast Stopped!', response.message, 'success');
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'There was an error stopping the broadcast. Please try again.', 'error');
                }
            });
        }
    });
}



</script>


<script>
$(document).ready(function() {
    $("#sortable").sortable({
        handle: '.drag-handle',
        update: function(event, ui) {
            var order = $(this).sortable('toArray', { attribute: 'data-id' });
            $.ajax({
                url: '<?= base_url('user/playlist/order') ?>', 
                type: 'POST',
                data: { order: order }
            });
        }
    });

    $("#sortable").disableSelection();
});
</script>
<script>
$('#viewstream').on('hide.coreui.modal', function (){
    stopAndUnloadVideo();
});

function loadAndPlayM3U8(m3u8Url) {

function tryFetch() {
    $('#loader').show();

    fetch('<?= base_url('user/checkfile/') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ filename: m3u8Url })
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return null;
            }
        })
        .then(data => {
            if (data) {
                if (data.status) {
                    var player = videojs('player');
                    player.src({
                        src: data.filePath,
                        type: 'application/x-mpegURL'
                    });
                    player.play();
                    $('#loader').hide();
                    $('#viewstream').modal('show');
                } else {
                    setTimeout(tryFetch, 4000);
                }
            }
        });
}

tryFetch();
}

function stopAndUnloadVideo() {
    var player = videojs('player');

    if (player && player.readyState()) { 
        player.pause();
        player.src('');
        player.reset();
    }
}
</script>
