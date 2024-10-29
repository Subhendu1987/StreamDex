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
<!-- create stream Modal -->
<div class="modal fade" id="uploadVideoModal" tabindex="-1" aria-labelledby="cretstrm" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cretstrm">Create Video</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" id="createform" novalidate action="javascript:void(0);" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="videoName" class="form-label">Video Name</label>
                        <input type="text" class="form-control" id="videoName" name="videoName" required>
                        <div class="invalid-feedback">
                            Please enter a video name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Select Video Or Image</label>
                        <input type="file" class="form-control" id="fileInput" name="fileInput" accept="video/*,image/*" required>
                        <div class="invalid-feedback">
                            Please upload a valid video or image file.
                        </div>
                    </div>
                    <div class="form-check" style="padding-bottom: 10px;">
                        <input class="form-check-input" type="checkbox" value="1" id="loop_check" name="loop_check">
                        <label class="form-check-label" for="loop_check">
                            Loop Playback
                        </label>
                    </div>
                    
                    <div class="progress" style = "display:none;">
                        <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closemodal" data-coreui-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="stm_crt_btn" >Create Video</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="edit_stream" tabindex="-1" aria-labelledby="editstrm" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editstrm">Edit Video</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" id="editform" novalidate action="<?= base_url("user/stream/update") ?>" method="post">
                <input type="hidden" name="edit_mv_id" id="edit_mv_id">
                <div class="modal-body">
                <div class="mb-3">
                        <label for="edit_videoName" class="form-label">Video Name</label>
                        <input type="text" class="form-control" id="edit_videoName" name="edit_videoName" required>
                        <div class="invalid-feedback">
                            Please enter a video name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_fileInput" class="form-label">Select Video Or Image</label>
                        <input type="file" class="form-control" id="edit_fileInput" name="edit_fileInput" accept="video/*,image/*" >
                        <div class="invalid-feedback">
                            Please upload a valid video or image file.
                        </div>
                    </div>
                    <div class="form-check" style="padding-bottom: 10px;">
                        <input class="form-check-input" type="checkbox" value="1" id="edit_loop_check" name="edit_loop_check">
                        <label class="form-check-label" for="edit_loop_check">
                            Loop Playback
                        </label>
                    </div>
                    <div class="progress" style = "display:none;">
                        <div id="edit_progressBar" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeeditmodal" data-coreui-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="edituploadButton" >Update Video</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add link Modal -->

<div class="modal fade" id="addlinkmodal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="addlinkmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addlinkmodalLabel">Stream Link</h5>
        <button type="button" id = "closelink" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-header">
        <input type="hidden" id="stm_id_list">
        <div class="container">
        <form id="linkForm">
          <div class="row row-cols-lg-auto align-items-center">
            <div class="col-lg-6">
              <input type="text" id="rtmplink" class="form-control" placeholder="RTMP Link" required />
            </div>
            <div class="col-lg-5">
              <input type="text" id="rtmpkey" class="form-control" placeholder="RTMP Key" required />
            </div>
            <div class="col-lg-1">
              <button type="button" id="add_link_btn" class="btn btn-danger btn-sm">Add</button>
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
<!-- Manage Audio Modal -->
<div class="modal fade" id="addaudio" tabindex="-1" aria-labelledby="playmanagename" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playmanagename">Mv Name</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" id= "closemvmodal" aria-label="Close"></button>
            </div>
          
            <div class="modal-body">
                <table class="table table-striped " id="manageaudioTable">
                        
                        <tbody id="sortable">
                                
                        </tbody>
                </table>
            </div>   
            <div class="modal-footer">
                
                <table class="table table-dark table-borderless" >
                        <form class="needs-validation" id="addaudiomv" novalidate  method="post">
                        <input type="hidden" id="managemvid" >
                        <tbody>
                                <tr>
                                    <td style="width: 45%">
                                            <div class="mb-3">
                                                <label for="audioName" class="form-label">Audio Name</label>
                                                <input type="text" class="form-control" id="audioName" name="audioName" required>
                                                <div class="invalid-feedback">
                                                    Please enter a audio name.
                                                </div>
                                            </div>
                                    </td>
                                    <td style="width: 45%">
                                            <div class="mb-3">
                                                <label for="add_mv_audio" class="form-label">Select Audio</label>
                                                <input type="file" class="form-control" id="add_mv_audio" name="add_mv_audio" accept="audio/*" required>
                                                <div class="invalid-feedback">
                                                    Please upload a valid Audio file.
                                                </div>
                                            </div>

                                    </td>
                                    <td style="width: 10%">
                                           
                                            <div class="mb-3">
                                                <label for="add_mv_audio" class="form-label" style="opacity: 0.0;">ffffffffffff</label>
                                                <button type="submit" id="add_mv_btn" class="btn btn-success btn-sm">Add</button>
                                            </div>
                                    </td>
                                </tr>
                        </tbody>
                        </form>
                </table>
            </div> 
            <div class="progress" style = "display:none;">
                <div id="mv_audio_progressBar" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
            </div>  
          
            
        </div>
    </div>
</div>
<!-- View video modal -->
<div class="modal fade" id="viewstream" tabindex="-1" aria-labelledby="uploadModalLabel" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
            <video id="player" class="video-js vjs-default-skin" controls preload="auto" width="465" height="262"></video>

            </div>
        </div>
    </div>
</div>
<div class="body flex-grow-1">
        <div class="row scrollable-div px-4">
            <div class="col-md-12">
                <div class="card col-md-12">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Music Video Streams</h5>
                        <button class="btn btn-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#uploadVideoModal">Create Video </button>
                    </div>
                    <div class="card-body">
                    <table class="table table-striped" id = "stm_list_tbl">
                      <thead>
                        <tr>
                          <th scope="col"  style = "width:5%;">#</th>
                          <th scope="col" style = "width:25%;">Name</th>  
                          <th scope="col" style = "width:10%;">Loop</th> 
                          <th scope="col"  style = "width:10%;">Audio</th>                     
                          <th scope="col"  style = "width:10%;">Link</th> 
                          <th scope="col"  style = "width:10%; padding-left : 20px">Status</th> 
                          <th scope="col"  style = "width:25%;">Created On</th> 
                          <th scope="col"  style = "width:5%;">Activity</th>
                        </tr>
                      </thead>
                      <tbody>
        
                                  
                               
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

<?php 
if(session()->getFlashdata('success')){
    echo '<script>
                        Swal.fire({
                            title: "Success",
                            text: "'.session()->getFlashdata('success').'",
                            icon: "success"
                        });
            </script>';
}
if(session()->getFlashdata('error')){
    echo '<script>
                        Swal.fire({
                            title: "Failed",
                            text: "'.session()->getFlashdata('error').'",
                            icon: "error"
                        });
            </script>';
}
?>
<script>
$(document).ready(function () {
    loadStreams(); // Call loadStreams when document is ready
});

// Define loadStreams in the global scope
function loadStreams() {
    $.ajax({
        url: "<?= base_url('user/musicVideo/data') ?>",
        type: "GET",
        dataType: "json",
        success: function (response) {
            var tableBody = '';
            if (response.data.length > 0) {
                $.each(response.data, function (index, stream) {
                    tableBody += `<tr>
                                    <th scope="row">${index + 1}</th>
                                    <td>${stream.music_name}</td>
                                    <td>${stream.is_loop}</td>
                                    <td>${stream.audio_count}</td>
                                    <td>${stream.stm_count}</td>`;
                                    tableBody += stream.livestatus == 1 
                                        ? `<td class="text-success"><button class="btn p-0 text-success" type="button" onclick= "loadAndPlayM3U8('${stream.vidid}')" title = "Preview">
                                                            <svg class="icon">
                                                            <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-media-play') ?>"></use>
                                                            </svg> ${stream.livestatustext}</button> </td>` 
                                        : `<td class="text-danger"><svg class="icon">
                                                            <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-media-stop') ?>"></use>
                                                            </svg> ${stream.livestatustext}</td>`;
                                    tableBody += 
                                    `<td>${new Date(stream.created_on).toLocaleDateString('en-US', {
                                        year: 'numeric', 
                                        month: 'short', 
                                        day: 'numeric', 
                                        hour: '2-digit', 
                                        minute: '2-digit',
                                        second: '2-digit'
                                    })}</td>
                                    <td>   
                                        <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg class="icon">
                                                    <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-options') ?>"></use>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">`;

                                            if(stream.audio_count != 0 && stream.stm_count != 0 ){
                                                if(stream.livestatus == null){
                                                    tableBody += `<button class="dropdown-item" type="button" onclick="startstream(${stream.id})">Start Stream</button>`;
                                                }else{
                                                    tableBody += `<button class="dropdown-item" type="button" onclick="stopstream(${stream.id})">Stop Stream</button>`;
                                                }
                                            }

                                            
                                            if (stream.livestatus == null) {
                                                
                                                tableBody += `
                                                <button class="dropdown-item" type="button" onclick="addaudio(${stream.id})">Manage Audio</button>
                                                <button class="dropdown-item" type="button" onclick="streamlink(${stream.id})">Stream Link</button>
                                                <button class="dropdown-item" type="button" onclick="editstream(${stream.id})">Edit</button>
                                                <button class="dropdown-item text-danger" type="button" onclick="deleteconfirm(${stream.id})">Delete</button>`
                                               
                                            }else{
                                                tableBody += `
                                                <button class="dropdown-item" type="button" disabled>Manage Audio</button>
                                                <button class="dropdown-item" type="button" disabled>Stream Link</button>
                                                <button class="dropdown-item" type="button" disabled>Edit</button>
                                                <button class="dropdown-item" type="button"  disabled>Delete</button>`
                                            };
                                
                                            
                                            tableBody += `</div>
                                                        </div>
                                                    </td>
                                                </tr>`;
                });

            } else {
                tableBody = `
                <tr class="align-middle">
                            <td colspan="8" class="text-center text-body-secondary">No Video Found.</td>
                        </tr>
                        `;
              
            }


            $('#stm_list_tbl tbody').html(tableBody);
        }
    });
}

$(document).ready(function () {

        // Form validation and submission
        (function () {
            'use strict';

            const form = document.getElementById('createform');
            const uploadButton = document.getElementById('stm_crt_btn');

            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault(); // Prevent normal form submission
                    uploadFile(); // Call your upload function
                }
                form.classList.add('was-validated');
            }, false);

          
        })();
    });

function uploadFile() {
    const videoName = document.getElementById('videoName').value;
    const isloop = document.getElementById('loop_check').checked;
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];



    const chunkSize = 1 * 1024 * 1024; // 1MB
    const totalChunks = Math.ceil(file.size / chunkSize);
    let chunkIndex = 0;
    const progressBar = document.getElementById('progressBar');
    $('.progress').show();
    const fileExtension = file.name.split('.').pop(); // Extract file extension

    // Disable buttons during upload
    $("#closemodal").attr("disabled", true);
    $("#uploadButton").attr("disabled", true);

    function uploadNextChunk() {
        const start = chunkIndex * chunkSize;
        const end = Math.min(start + chunkSize, file.size);
        const chunk = file.slice(start, end);

        const formData = new FormData();
        formData.append('file', chunk);
        formData.append('chunkIndex', chunkIndex);
        formData.append('totalChunks', totalChunks);
        formData.append('fileName', file.name);
        formData.append('fileExtension', fileExtension);
        formData.append('customname', videoName);
        formData.append('is_loop', isloop ? 1 : 0);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url("user/musicVideo/create") ?>', true);

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                const percentComplete = ((chunkIndex + (e.loaded / e.total)) / totalChunks) * 100;
                progressBar.style.width = percentComplete + '%';
                progressBar.innerHTML = Math.floor(percentComplete) + '%';
            }
        };

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'partial') {
                    chunkIndex++;
                    if (chunkIndex < totalChunks) {
                        uploadNextChunk();
                    }
                } else if (response.status === 'success') {
                    $('#uploadVideoModal').modal('hide');
                    Swal.fire({
                        title: "Success",
                        text: "Video Uploaded Successfully!",
                        icon: "success"
                    });
                    resetUploadForm();
                    loadStreams();
                }
            } else {
                
                $('#uploadVideoModal').modal('hide');
                Swal.fire({
                    title: "Failed",
                    text: "Video Upload Failed!",
                    icon: "error"
                });
                resetUploadForm();
            }
        };

        xhr.send(formData);
    }

    uploadNextChunk();
}

function resetUploadForm() {
    document.getElementById('videoName').value = '';
    document.getElementById('fileInput').value = ''; 
    progressBar.style.width = '0%';
    progressBar.innerHTML = '0%'; 
    $('.progress').hide();
    $("#closemodal").attr("disabled", false);
    $("#uploadButton").attr("disabled", false);
}









function editstream(streamId) {
    $.ajax({
        url: "<?= base_url('user/musicVideo/update/') ?>" + streamId,
        type: "GET",
        dataType: "json",
        success: function (response) {
            $('#edit_mv_id').val(response.id);
            $('#edit_videoName').val(response.music_name);
            $('#edit_loop_check').prop('checked', response.is_loop == 1);
            $('#edit_stream').modal('show');
        }
    });
}


function deleteconfirm(data) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            streamdelete(data);
        }
    });
}
function streamdelete(id){
    $.ajax({
                url: '<?= base_url('user/musicVideo/delete') ?>',
                type: 'POST',
                data: {
                    stream_id: id
                },
                dataType: 'json',
                success: function(response) {
                    loadStreams();
                    Swal.fire({
                        title: "Success",
                        text: "Stream deleted successfully!",
                        icon: "success"
                    });

                    loadStreams(); 
                },
                error: function(xhr) {
                    $('#deletemodal').modal('hide');
                    Swal.fire({
                        title: "Failed",
                        text: "Failed to delete stream.",
                        icon: "error"
                    });
                }
            });
}

    function streamlink(data){
        $('#stm_id_list').val(data);
    
        var streamId = data;
            loadStreamLinks(streamId);
            $('#addlinkmodal').modal('show');
    }
   

    function loadStreamLinks(streamId) {
        $.ajax({
            url: "<?= base_url('user/musicVideo/getLinks') ?>",
            type: "GET",
            data: { stream_id: streamId },
            dataType: "json",
            success: function(response) {
                var tableBody = '';
                if (response.length > 0) {
                    $.each(response, function(index, link) {
                        tableBody += `<tr>
                                        <th scope="row" style = "width: 5%">${index + 1}</th>
                                        <td style = "width: 45%">${link.mv_link}</td>
                                        <td style = "width: 45%">${link.mv_key}</td>
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

    
$('#closelink').on('click', function() {
    $('#linkForm')[0].reset(); 
    $('#rtmplink').removeClass('is-invalid'); 
$('#rtmpkey').removeClass('is-invalid'); 
});


// Your existing code for adding a link
$('#add_link_btn').on('click', function(event) {
    var rtmplink = $('#rtmplink').val().trim();
    var rtmpkey = $('#rtmpkey').val().trim();
    var streamId = $('#stm_id_list').val();
    
    // Select the form for validation
    var linkForm = document.getElementById('linkForm'); 

    // Prevent form submission if the form is invalid
    if (!linkForm.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        // Add Bootstrap's invalid class for validation
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

        return; // Exit if the form is invalid
    }

    // Proceed with AJAX if validation is successful
    $.ajax({
        url: "<?= base_url('user/musicVideo/addLink') ?>", // URL to add the link
        type: "POST",
        data: {
            stream_id: streamId,
            rtmplink: rtmplink,
            rtmpkey: rtmpkey
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                loadStreamLinks(streamId); // Reload links after adding
                $('#rtmplink').val(''); // Clear inputs
                $('#rtmpkey').val('');
                loadStreams(); 
            } else {
                // Handle failure in adding link
                $('#rtmplink').addClass('is-invalid');
                $('#rtmpkey').addClass('is-invalid');
            }
        },
        error: function() {
            $('#rtmplink').addClass('is-invalid');
            $('#rtmpkey').addClass('is-invalid');
        }
    });
});

// Optional: Clear the invalid class on input change
$('#rtmplink, #rtmpkey').on('input', function() {
    $(this).removeClass('is-invalid');
});



    // Function to remove a stream link
    window.removeLink = function(linkId) {
    // Use SweetAlert for the confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this link!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url('user/musicVideo/removeLink') ?>",
                type: "POST",
                data: { id: linkId },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        var streamId = $('#stm_id_list').val();
                        loadStreamLinks(streamId); 
                        loadStreams(); 
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The link has been deleted.',
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            title: "Failed",
                            text: "Failed to remove link.",
                            icon: "error"
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: "Failed",
                        text: "Error removing link.",
                        icon: "error"
                    });
                }
            });
        }
    });
};
function startstream(data){
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
                url: '<?= base_url('user/musicVideo/startstream') ?>',
                type: 'POST',
                data: {
                    mvid: data
                },
                success: function(response) {
                    if (response.status) {
                        loadStreams();
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
function stopstream(data){
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
                url: '<?= base_url('user/musicVideo/stopstream') ?>',
                type: 'POST',
                data: {
                    mvid: data
                },
                success: function(response) {
                    if (response.status) {
                        loadStreams();
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

$(document).ready(function () {
    (function () {
        'use strict';

        const form = document.getElementById('editform');
        const uploadButton = document.getElementById('edituploadButton');
        const fileInput = document.getElementById('edit_fileInput'); // File input ID

        form.addEventListener('submit', function (event) {
            // Prevent normal form submission initially
            event.preventDefault();
            let isValid = true;

            // Check form validity without file validation
            if (!form.checkValidity()) {
                isValid = false;
            }

            // Validate file input only if a file is selected
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const validTypes = [
                    'image/jpeg', // JPEG images
                    'image/png',   // PNG images
                    // 'image/gif',   // GIF images
                    'video/mp4',   // MP4 videos
                    'video/x-m4v', // M4V videos
                    'video/avi',   // AVI videos
                    'video/mpeg',  // MPEG videos
                    'video/webm'   // WebM videos
                ]; // Add more types as needed
                
                // If the selected file type is not valid, set error message
                if (!validTypes.includes(file.type)) {
                    isValid = false;
                    fileInput.setCustomValidity('Please upload a valid video or image file.'); // Custom error message
                } else {
                    fileInput.setCustomValidity(''); // Clear custom validity if valid
                }
            }

            // If the form is valid, call your upload function
            if (isValid) {
                updatemv(); 
                form.classList.remove('was-validated');
            }

            form.classList.add('was-validated'); // Add the class for Bootstrap validation styles
        }, false);

        uploadButton.addEventListener('click', function () {
            form.dispatchEvent(new Event('submit')); // Trigger the form submit event
        });
    })();
});









function updatemv() {
    
    const editmv_id = document.getElementById('edit_mv_id').value;
    const videoName = document.getElementById('edit_videoName').value;
    const isloop = document.getElementById('edit_loop_check').checked;
    const fileInput = document.getElementById('edit_fileInput');
    const file = fileInput.files[0];

    const progressBar = document.getElementById('edit_progressBar');

    if (!file) {
        
        // No file selected, update the video name and loop status without uploading a file
        const formData = new FormData();
        formData.append('editmv_id', editmv_id);
        formData.append('customname', videoName);
        formData.append('is_loop', isloop ? 1 : 0);

        $.ajax({
            url: '<?= base_url("user/musicVideo/update") ?>',  // Separate route for updating without file
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    $('#edit_stream').modal('hide');
                    Swal.fire({
                        title: "Success",
                        text: "Video Data Updated Successfully!",
                        icon: "success"
                    });
                    // reseteditUploadForm();
                    loadStreams();
                } else {
                    Swal.fire({
                        title: "Failed",
                        text: "Video Data Update Failed!",
                        icon: "error"
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: "Failed",
                    text: "An error occurred while updating video data.",
                    icon: "error"
                });
            }
        });
    } else {
        // File is selected, proceed with chunked upload
        const chunkSize = 1 * 1024 * 1024; // 1MB
        const totalChunks = Math.ceil(file.size / chunkSize);
        let chunkIndex = 0;
        const progressBar = document.getElementById('edit_progressBar');
        $('.progress').show();
        const fileExtension = file.name.split('.').pop(); // Extract file extension

        // Disable buttons during upload
        $("#closeeditmodal").attr("disabled", true);
        $("#edituploadButton").attr("disabled", true);
        

        function uploadNextChunk() {
            const start = chunkIndex * chunkSize;
            const end = Math.min(start + chunkSize, file.size);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            formData.append('file', chunk);
            formData.append('chunkIndex', chunkIndex);
            formData.append('totalChunks', totalChunks);
            formData.append('fileName', file.name);
            formData.append('fileExtension', fileExtension);
            formData.append('customname', videoName);
            formData.append('editmv_id', editmv_id);
            formData.append('is_loop', isloop ? 1 : 0);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= base_url("user/musicVideo/update") ?>', true);

            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) {
                    const percentComplete = ((chunkIndex + (e.loaded / e.total)) / totalChunks) * 100;
                    progressBar.style.width = percentComplete + '%';
                    progressBar.innerHTML = Math.floor(percentComplete) + '%';
                }
            };

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'partial') {
                        chunkIndex++;
                        if (chunkIndex < totalChunks) {
                            uploadNextChunk();
                        }
                    } else if (response.status === 'success') {
                        $('#edit_stream').modal('hide');
                        Swal.fire({
                            title: "Success",
                            text: "Video Uploaded Successfully!",
                            icon: "success"
                        });
                        // reseteditUploadForm();
                        loadStreams();
                    }
                } else {
                    $('#edit_stream').modal('hide');
                    Swal.fire({
                        title: "Failed",
                        text: "Video Upload Failed!",
                        icon: "error"
                    });
                    // reseteditUploadForm();
                }
            };

            xhr.send(formData);
        }

        uploadNextChunk();
    }
}

function reseteditUploadForm() {
    document.getElementById('edit_videoName').value = '';
    document.getElementById('edit_fileInput').value = ''; 
    progressBar.style.width = '0%';
    progressBar.innerHTML = '0%'; 
    $('.progress').hide();
    $("#closeeditmodal").attr("disabled", false);
    $("#edituploadButton").attr("disabled", false);
}

function addaudio(data){
    $('#managemvid').val(data);
    loadAudioTable(data);
    $('#addaudio').modal('show');


}
function loadAudioTable(music_id) {
    $.ajax({
        url: "<?= base_url('user/musicVideo/loadaudiodata'); ?>",
        type: "POST",
        data: { music_id: music_id },
        dataType: "json",
        success: function (response) {
            $('#playmanagename').text(response.mvname);
            var tableBody = $('#sortable');
            tableBody.empty();

            if (response.audioData.length > 0) {
                $.each(response.audioData, function (index, audio) {
                    var row = `<tr data-id="${audio.id}">
                                    <td scope="row" style="width: 5%; cursor: s-resize;">  
                                        <svg class="icon icon-xl drag-handle">
                                            <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-menu'); ?>"></use>
                                        </svg>
                                    </td>
                                    <td style="width: 65%">${audio.Audio_name}</td>
                                    <td style="width: 20%">${audio.audio_length}</td>
                                    <td style="width: 10%">
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="dlfrommvlist(${audio.id});">Remove</button>
                                    </td>
                                </tr>`;
                    tableBody.append(row);
                });
                

                $("#sortable").sortable({
                    handle: ".drag-handle",
                    update: function(event, ui) {
                        var sortedIDs = $("#sortable").sortable("toArray", { attribute: 'data-id' });
                        updateAudioOrder(sortedIDs, music_id);
                    }
                });
            } else {
                tableBody.append('<tr><td colspan="6" class="text-center">No Audio Found</td></tr>');
            }
        },
        error: function (xhr, status, error) {
            alert('Error loading audio data');
            console.error(xhr.responseText);
        }
    });
}

function updateAudioOrder(sortedIDs, music_id) {
    $.ajax({
        url: "<?= base_url('user/musicVideo/updateAudioOrder'); ?>",
        type: "POST",
        data: {
            sortedIDs: sortedIDs,
            music_id: music_id
        }
    });
}
function dlfrommvlist(audioId, musicId) {
    // Show SweetAlert confirmation modal
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
            deleteAudio(audioId);
            loadStreams();
        }
    });
}

function deleteAudio(audioId) {
    
    $.ajax({
    url: "<?= base_url('user/musicVideo/Audiodelete'); ?>",
    type: "POST",
    data: { audio_id: audioId },
    success: function() {
        loadAudioTable($('#managemvid').val());
    }
});

}


function formatDate(dateString) {
    var date = new Date(dateString);
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
}


$(document).ready(function () {
    // Form validation and submission
    (function () {
        'use strict';

        const form = document.getElementById('addaudiomv');
        const uploadButton = document.getElementById('add_mv_btn');

        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                event.preventDefault(); // Prevent normal form submission
                uploadaudio(); // Call your upload function

                // Reset the form and validation state after submission
                form.reset(); // Reset all form fields
                form.classList.remove('was-validated'); // Remove validation classes

               
            }
            form.classList.add('was-validated'); // Add validation class if not valid
        }, false);

    })();
});


function uploadaudio() {
    var audioname =  document.getElementById('audioName').value;
    var mvid =  document.getElementById('managemvid').value;
    var file = document.getElementById('add_mv_audio').files[0];
    var chunkSize = 1 * 1024 * 1024;
    $('.progress').show();
    var totalChunks = Math.ceil(file.size / chunkSize);
    var chunkNumber = 0;

    function uploadChunk(start) {
        $('#add_mv_btn').prop('disabled', true);
        $('#closemvmodal').prop('disabled', true);        
        document.getElementById('audioName').value = '';
        document.getElementById('add_mv_audio').value = ''; 
        var nextChunkStart = start + chunkSize;
        var chunk = file.slice(start, nextChunkStart);

        var formData = new FormData();
        formData.append('audioname', audioname);
        formData.append('mvid', mvid);
        formData.append('file', chunk);
        formData.append('file_name', file.name);
        formData.append('chunk_number', chunkNumber + 1);
        formData.append('total_chunks', totalChunks);

        $.ajax({
            url: "<?= base_url('user/musicVideo/addaudio'); ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                chunkNumber++;
                var progress = Math.round((chunkNumber / totalChunks) * 100);
                $('#mv_audio_progressBar').css('width', progress + '%').text(progress + '%');
                
                if (chunkNumber < totalChunks) {
                    uploadChunk(nextChunkStart);
                } else {
                    $('.progress').hide();
                    loadAudioTable(mvid);
                    loadStreams();
                    $('#closemvmodal').prop('disabled', false);
                    $('#add_mv_btn').prop('disabled', false);
                  
                    Swal.fire({
                            title: "Success",
                            text: "Audio Uploaded Successfully!",
                            icon: "success"
                        });
                    $('#mv_audio_progressBar').css('width', '0%').text('');
                }
            },
            error: function (xhr, status, error) {
                $('.progress').hide();
                $('#add_mv_btn').prop('disabled', false);
                $('#closemvmodal').prop('disabled', false);
                Swal.fire({
                        title: "Failed",
                        text: "Audio Upload Failed!",
                        icon: "error"
                    });
                $('#mv_audio_progressBar').css('width', '0%').text('');
            }
        });
    }

    uploadChunk(0);
}


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
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const createFileInput = document.getElementById('fileInput');
    const createVideoNameInput = document.getElementById('videoName');

    createFileInput.addEventListener('change', function (event) {
        const file = event.target.files[0]; // Get the selected file

        if (file) {
            const fileName = file.name; // Get the file name
            const fileExtension = fileName.split('.').pop(); // Get the file extension
            const baseFileName = fileName.slice(0, -fileExtension.length - 1); // Remove extension

            // Check if videoName input is empty
            if (!createVideoNameInput.value) {
                createVideoNameInput.value = baseFileName; // Set video name without extension
            }
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const audioFileInput = document.getElementById('add_mv_audio');
    const audioNameInput = document.getElementById('audioName');

    audioFileInput.addEventListener('change', function (event) {
        const file = event.target.files[0]; // Get the selected file

        if (file) {
            const fileName = file.name; // Get the file name
            const fileExtension = fileName.split('.').pop(); // Get the file extension
            const baseFileName = fileName.slice(0, -fileExtension.length - 1); // Remove extension

            // Check if audioName input is empty
            if (!audioNameInput.value) {
                audioNameInput.value = baseFileName; // Set audio name without extension
            }
        }
    });
});

</script>