<?php include('include/header.php'); ?>
<div class="body flex-grow-1">
    <div class="row px-4">
        <div class="col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?= base_url('public/assets/img/defult.jpg') ?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                        <div class="mt-3">
                            <h4><?= esc($user_name) ?></h4>
                            <p class="text-secondary mb-1">Member Since</p>
                            <p class="text-muted font-size-sm"><?= esc($user_Since); ?></p>
                        </div>
                    </div>							
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('user/profile') ?>" method="POST" enctype="multipart/form-data" id="profileForm">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">User Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="full_name" value="<?= esc($user_name) ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Profile Picture</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="file" class="form-control" name="profile_picture">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">New Password</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="password" class="form-control" id = "new_password" name="new_password">
                            </div>
                        </div>
                        <div class="row">
                        <input type="hidden" id="old_password" name="old_password"> 
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const newPasswordField = document.getElementById('new_password');
        const oldPasswordField = document.getElementById('old_password');

        newPasswordField.addEventListener('input', function() {
            if (newPasswordField.value.length > 0) {
                oldPasswordField.setAttribute('required', 'required');
            } else {
                oldPasswordField.removeAttribute('required');
            }
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('profileForm').addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Enter your current password',
            input: 'password',
            inputLabel: 'Please enter your current password for verification',
            inputPlaceholder: 'Enter your current password',
            inputAttributes: {
                maxlength: 50,
                autocapitalize: 'off',
                autocorrect: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            preConfirm: (inputValue) => {
                if (inputValue) {
                    document.getElementById('old_password').value = inputValue;
                    document.getElementById('profileForm').submit();
                } else {
                    Swal.showValidationMessage('Please enter your current password');
                }
            }
        });
    });
});


</script>



