<?php include('include/header.php'); ?>



<!-- Video Upload Modal -->
<div class="modal fade" id="uploadVideoModal" tabindex="-1" aria-labelledby="uploadModalLabel" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Video</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" id="uploadForm" novalidate>
                    <div class="mb-3">
                        <label for="videoName" class="form-label">Video Name</label>
                        <input type="text" class="form-control" id="videoName" name="videoName" required>
                        <div class="invalid-feedback">
                            Please enter a video name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Select Video File</label>
                        <input type="file" class="form-control" id="fileInput" name="fileInput" accept="video/*" required>
                        <div class="invalid-feedback">
                            Please select a valid video file.
                        </div>
                    </div>
                    <div class="progress" style = "display: none;">
                        <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">                
                <div class="me-auto" >
                </div>
                <button type="button" class="btn btn-secondary" id="closemodal" data-coreui-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="uploadButton">Upload Video</button>
            </div>
        </div>
    </div>
</div>


<!-- editmediaModal edit Modal -->
<div class="modal fade" id="editmediaModal" tabindex="-1" aria-labelledby="uploadModalLabel" data-coreui-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Rename Video</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" id="editmediaForm" novalidate>
                <input type="hidden" id="editmediaid" >
                    <div class="mb-3">
                        <label for="editmediaName" class="form-label">Video Name</label>
                        <input type="text" class="form-control" id="editmediaName" name="editmediaName" required>
                        <div class="invalid-feedback">
                            Please enter a Video name.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeeditmodal" data-coreui-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="editmedia" onclick = "plupdate();">Rename</button>
            </div>
        
        </div>
    </div>
</div>


<div class="body flex-grow-1">
    <div class="row scrollable-div px-4">
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Videos</h5>
                    <button class="btn btn-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#uploadVideoModal">Add Video</button>
                </div>
                <div class="card-body">
                        <table class="table border mb-0">
                            <thead class="fw-semibold text-nowrap">
                                <tr class="align-middle">
                                    <th class="bg-body-secondary" style="width: 5%;">#</th>
                                    <th class="bg-body-secondary" style="width: 70%;">Name</th>
                                    <th class="bg-body-secondary" style="width: 10%;">Length</th>
                                    <th class="bg-body-secondary" style="width: 10%;">Size</th>
                                    <th class="bg-body-secondary" style="width: 5%;">Activity</th>
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



<?php include('include/footer.php'); ?>

<style>
    /* Add hover effect for rows */
    .table tbody tr:hover {
        background-color: #f8f9fa; /* Light gray background */
    }
</style>
<script>
    // Function to fetch user files and populate the table
    function fetchUserFiles() {
        $.ajax({
            url: '<?= base_url("user/videolfile") ?>', // Update with the correct route
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                const tableBody = $('table tbody');
                tableBody.empty();

                // Populate the table with the received data
                if (data.length > 0) {
                    data.forEach(function (file, index) {
                        const row = `
                            <tr class="align-middle">
                                <td>${index + 1}</td>
                                <td>
                                    <div class="text-nowrap">${file.file_name}</div>
                                    <div class="small text-body-secondary text-nowrap"><span>Upload:</span> ${file.uploaded_on}</div>
                                </td>
                                <td>${file.video_length}</td>
                                <td>${file.file_size}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="icon">
                                                <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-options') ?>"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <button class="dropdown-item" type="button" onclick="editvideo(${file.id})">Rename</button>
                                            <button class="dropdown-item text-danger" type="button" onclick="deleteconfirm(${file.id})">Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                } else {
                    tableBody.append('<tr><td colspan="5" class="text-center text-body-secondary">No Video found.</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching user files:', error);
                Swal.fire({
                    title: "Error",
                    text: "Failed to fetch user files. Please try again.",
                    icon: "error"
                });
            }
        });
    }

    $(document).ready(function () {
        // Call fetchUserFiles when the document is ready
        fetchUserFiles();

        // Form validation and submission
        (function () {
            'use strict';

            const form = document.getElementById('uploadForm');
            const uploadButton = document.getElementById('uploadButton');

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

            uploadButton.addEventListener('click', function () {
                form.dispatchEvent(new Event('submit'));
            });
        })();
    });

    // Function to upload the file with validation in place
    function uploadFile() {
        const videoName = document.getElementById('videoName').value;
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];

        if (!file) {
            return;
        }
      
        
        const chunkSize = 1 * 1024 * 1024; // 1MB
        const totalChunks = Math.ceil(file.size / chunkSize);
        let chunkIndex = 0;
        const progressBar = document.getElementById('progressBar');
        const fileExtension = file.name.split('.').pop(); // Extract file extension
        $('.progress').show();
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

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= base_url("user/upload") ?>', true);

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
                        document.getElementById('videoName').value = '';
                        document.getElementById('fileInput').value = ''; 
                        progressBar.style.width = '0%';
                        progressBar.innerHTML = '0%'; 
                        $('.progress').hide();
                        $("#closemodal").attr("disabled", false);
                        $("#uploadButton").attr("disabled", false);

                        fetchUserFiles();
                    }
                } else {
                    $('#uploadVideoModal').modal('hide');
                    Swal.fire({
                        title: "Failed",
                        text: "Video Upload Failed!",
                        icon: "error"
                    });
                    document.getElementById('videoName').value = '';
                    document.getElementById('fileInput').value = ''; 
                    progressBar.style.width = '0%';
                    progressBar.innerHTML = '0%'; 
                    $('.progress').hide();
                    $("#closemodal").attr("disabled", false);
                    $("#uploadButton").attr("disabled", false);
                }
            };

            xhr.send(formData);
        }

        uploadNextChunk();
    }


function deleteconfirm(fileId) {
    // Show SweetAlert confirmation dialog
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
            // If confirmed, call the actual delete function or make an AJAX call
            mediadelete(fileId);
        }
    });
}
function mediadelete(mediaid) {
    $.ajax({
        url: '<?= base_url('user/video/delete') ?>/' + mediaid,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                Swal.fire('Deleted!', 'Successfully delete the video.', 'success');
                fetchUserFiles();
            } else {
                Swal.fire('Failed!','Failed to delete Video!', 'error');
            }
        }
    });
}

function editvideo(data){
    $.ajax({
            url: '<?= base_url('user/video/rename') ?>/'+ data,  // URL with the playlist ID
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#editmediaName').val(data.filename);
            },
            error: function(error) {
                console.error('Error fetching ', error);
            }
        });
    $('#editmediaid').val(data);
    $('#editmediaModal').modal('show');
}
function plupdate() {
    var form2 = $('#editmediaForm')[0];

    if (form2.checkValidity() === false) {
        form2.classList.add('was-validated');
    } else {
        var playlistId = $('#editmediaid').val();
        var playnm = $('#editmediaName').val();
        $.ajax({
            url: '<?= base_url('user/video/update') ?>/' + playlistId,
            type: 'POST',
            data: { playnm},
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#editmediaModal').modal('hide'); 
                    
                        Swal.fire({
                            title: "Success",
                            text: "Video Rename Successfully!",
                            icon: "success"
                        });
                        document.getElementById('editmediaName').value = '';
                        document.getElementById('editmediaid').value = ''; 
                        fetchUserFiles();
                } else {
                    $('#editmediaModal').modal('hide'); 
                    Swal.fire({
                        title: "Failed",
                        text: "Video Rename Failed!",
                        icon: "error"
                        });
                        document.getElementById('editmediaName').value = '';
                        document.getElementById('editmediaid').value = ''; 
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating ', error);
            }
        });
    }
}

$(document).ready(function() {
    
    $('.modal').on('hidden.coreui.modal', function() {
        $(this).find('form')[0].reset();
        $(this).find('.form-control').removeClass('is-invalid');
    });
});


    document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('fileInput');
    const videoNameInput = document.getElementById('videoName');

    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0]; // Get the selected file

        if (file) {
            const fileName = file.name; // Get the file name
            const fileExtension = fileName.split('.').pop(); // Get the file extension
            const baseFileName = fileName.slice(0, -fileExtension.length - 1); // Remove extension

            // Check if videoName input is empty
            if (!videoNameInput.value) {
                videoNameInput.value = baseFileName; // Set video name without extension
            }
        }
    });
});

</script>
