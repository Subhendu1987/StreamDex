
<?php include('include/header.php'); ?>
<div class="body flex-grow-1" >
    <div class="row scrollable-div px-4">
           




        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                        <div class="card mb-4">
                                
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Stream Resulation</h5>
                                    <lebel>Current Resulation : <span class ="text-warning" >      
                                        <?php foreach ($resulations as $res):  if ($res['str_is_active'] == 1): echo $res['name']; endif; endforeach; ?>                          
                                        </span></lebel>
                                </div>                                
                                <div class="card-body">
                                        <div class="mb-3 row d-flex justify-content-between align-items-center">
                                                <label class="col-12 col-xxl-4 col-form-label" for="sqlfile">Select Stream Resulation</label>                                                
                                                <div class="col-12 col-xxl-5 col-form-label">
                                                <form action="<?= base_url('user/settings/resulation') ?>" method="post">
                                                <select class="form-select" aria-label="Default select" id="selectedresulation" name="selectedresulation" >
                                                                            <option selected="" disabled="" value="">Select Resulation</option>
                                                                            <?php if (!empty($resulations)): ?>
                                                                                <?php foreach ($resulations as $res): ?>
                                                                                    <option value="<?= $res['id']; ?>" <?= $res['str_is_active'] == 1 ? 'selected' : ''; ?>>
                                                                                        <?= $res['name'].' - ( '.$res['str_resulution_height'].' X '.$res['str_resulution_width'].' )'; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>

                                                                    </select>
                                                </div>
                                                <div class="col-12 col-xxl-3 col-form-label">
                                                <button type="submit" class="btn btn-primary w-100">Update</button>
                                                </div>
                                                </form>
                                        </div>
                                </div>
                                
                        </div>
                        <div class="card mb-4">
                                
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Stream Settings</h5>
                                </div> 
                                <form action="<?= base_url('user/settings/stream') ?>" method="post" id="strset">                          
                                <div class="card-body">                                   
                                        <div class="mb-3 row">
                                                <label class="col-12 col-xxl-3 col-form-label" for="videobitrate">Video Bitrate</label>                                                
                                                <div class="col-10 col-xxl-7 col-form-label">
                                                <input type="text" class="form-control numonly" id="videobitrate" name="videobitrate" value="<?= esc($stm_settings->video_bitrate) ?>" required="">
                                                </div>
                                                <label class="col-2 col-xxl-2 col-form-label" for="videobitrate">Kbps</label>   
                                        </div>
                                        <div class="mb-3 row">
                                                <label class="col-12 col-xxl-3 col-form-label" for="maximum_bitrate">Maximum Bitrate</label>                                                
                                                <div class="col-10 col-xxl-7 col-form-label">
                                                <input type="text" class="form-control numonly" id="maximum_bitrate" name="maximum_bitrate" value="<?= esc($stm_settings->maximum_bitrate) ?>" required="">
                                                </div>
                                                <label class="col-2 col-xxl-2 col-form-label" for="maximum_bitrate">Kbps</label>   
                                        </div>
                                        <div class="mb-3 row">
                                                <label class="col-12 col-xxl-3 col-form-label" for="buffer_size">Buffer Size</label>                                                
                                                <div class="col-10 col-xxl-7 col-form-label">
                                                <input type="text" class="form-control numonly" id="buffer_size" name="buffer_size" value="<?= esc($stm_settings->buffer_size) ?>" required="">
                                                </div>
                                                <label class="col-2 col-xxl-2 col-form-label" for="buffer_size">Kbps</label>   
                                        </div>
                                        <div class="mb-3 row">
                                                <label class="col-12 col-xxl-3 col-form-label" for="audio_bitrate">Audio Bitrate</label>                                                
                                                <div class="col-10 col-xxl-7 col-form-label">
                                                <input type="text" class="form-control numonly" id="audio_bitrate" name="audio_bitrate" value="<?= esc($stm_settings->audio_bitrate) ?>" required="">
                                                </div>
                                                <label class="col-2 col-xxl-2 col-form-label" for="audio_bitrate">Kbps</label>   
                                        </div>
                                        <div class="mb-3 row">
                                                <label class="col-12 col-xxl-3 col-form-label" for="audio_sample_rate">Audio Sample Rate</label>                                                
                                                <div class="col-10 col-xxl-7 col-form-label">
                                                <input type="text" class="form-control numonly" id="audio_sample_rate" name="audio_sample_rate" value="<?= esc($stm_settings->audio_sample_rate) ?>" required="">
                                                </div>
                                                <label class="col-2 col-xxl-2 col-form-label" for="audio_sample_rate">Hz</label>   
                                        </div>
                                        <div class="mb-3 row">
                                                <label class="col-12 col-xxl-3 col-form-label" for="gop_size_keyframes">GOP Size For Keyframes</label>                                                
                                                <div class="col-10 col-xxl-7 col-form-label">
                                                <input type="text" class="form-control numonly" id="gop_size_keyframes" name="gop_size_keyframes" value="<?= esc($stm_settings->keyframes) ?>" required="">
                                                </div>
                                                <label class="col-2 col-xxl-2 col-form-label" for="gop_size_keyframes">Fps</label>   
                                        </div>
                                        <div class="mb-3 row">
                                                <label class="col-12 col-xxl-3 col-form-label" for="cpu_thread">CPU threads</label>                                                
                                                <div class="col-10 col-xxl-7 col-form-label">
                                                <select class="form-select" aria-label="Default select" id="cpu_thread" name="cpu_thread" >
                                                                            <option selected="" disabled="" value="">Select Max Core</option>
                                                                            <?php
                                                                                $availableThreads = shell_exec('nproc');
                                                                                $availableThreads = intval(trim($availableThreads));
                                                                                for ($i = 1; $i <= $availableThreads; $i++) {
                                                                                    if($stm_settings->CPUthreads == $i){
                                                                                        echo "<option value=\"$i\" selected>$i Core</option>";
                                                                                    }else{
                                                                                        echo "<option value=\"$i\">$i Core</option>";
                                                                                    }
                                                                                    
                                                                                }
                                                                            ?>
                                                                    </select>
                                                </div>
                                                <label class="col-2 col-xxl-2 col-form-label" for="cpu_thread">Max</label>   
                                        </div>
        
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" onclick="$('#strset')[0].reset();">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                </form>
                        </div>
            </div>   
            <div class="col-12 col-sm-6 col-md-6">
            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Backup / Restore Data</h5>
                                    <form action="<?= base_url('user/settings/backup') ?>" method="post">
                                        <button type="submit" class="btn btn-primary btn-sm">Create Backup</button>
                                    </form>
                                </div>                                
                                <div class="card-body">
                                    <table class="table border mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 90%;">File Name</th>
                                                <th style="width: 5%;">Activity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($files)): ?>
                                                <?php $i = 1; foreach ($files as $file): ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= esc($file) ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <svg class="icon">
                                                                        <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-options') ?>"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a href="<?= base_url('user/settings/backup/download/' . esc($file)); ?>" class="dropdown-item btn text-info">Download</a>
                                                                    <a href="<?= base_url('user/settings/backup/restore/' . esc($file)); ?>" class="dropdown-item btn text-warning">Restore</a>
                                                                    <button class="dropdown-item btn text-danger" 
                                                                            onclick="event.preventDefault(); confirmDelete('<?= base_url('user/settings/backup/delete/' . esc($file)); ?>')">
                                                                        Delete
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">No backup found</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                        
                                </div>
                                <div class="card-footer">                              
                                        <div class="mb-3 row">
                                                <label class="col-12 col-xxl-3 col-form-label" for="sqlfile">Upload SQL file</label>                                                
                                                <div class="col-12 col-xxl-6 col-form-label">
                                                <form action="<?= base_url('user/settings/backup/upload') ?>" method="post" enctype="multipart/form-data">
                                                <input class="form-control" type="file" name="sqlfile" id="sqlfile" required="" accept=".sqlite">
                                                </div>
                                                <div class="col-12 col-xxl-3 col-form-label">
                                                <button type="submit" class="btn btn-primary w-100">Upload</button>
                                                </div>
                                                </form>
                                        </div>
                                </div>
                        </div>
                        
            </div>           
                        
        </div>


        
    </div>
</div>    
<?php include('include/footer.php'); ?>


<script>
function confirmDelete(url) {
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
             window.location.href = url;
        } 
    });
}
</script>
<script>
    $(document).ready(function () {
        $('#strset').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Validate inputs
            var isValid = true;
            $(this).find('input, select').each(function () {
                if (!$(this).val()) {
                    isValid = false;
                    return false; // Exit the loop on first invalid input
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please fill in all fields.',
                });
                return;
            }

            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form
                }
            });
        });
    });
</script>
