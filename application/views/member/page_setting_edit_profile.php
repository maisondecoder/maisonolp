<div class="container p-4">
    <h3 class="mt-2 mb-2 text-white"><a href="<?= base_url('user'); ?>" class="me-3 text-white"><i class="fas fa-arrow-left"></i></a>Edit Profile</h3>
</div>
<div class="container bg-white p-4 mb-3" style="border-radius: 16px; margin-bottom:100px !important;">
    <span class="text-danger"><?php echo validation_errors(); ?></span>
    <form action="<?= base_url('user/edit_profile/'); ?>" method="post">
        <div class="mb-4">
            <label for="first-input" class="form-label">First Name</label>
            <input type="text" class="form-control mb-2" name="first-input" id="first-input" minlength="3" maxlength="32" placeholder="John" value="<?= $profile['profile_first_name']; ?>" required>

            <label for="last-input" class="form-label">Last Name</label>
            <input type="text" class="form-control mb-2" name="last-input" id="last-input" minlength="3" maxlength="32" placeholder="Doe" value="<?= $profile['profile_last_name']; ?>" required>
            
            <label for="gender-input" class="form-label">Gender</label>
            <select class="form-select mb-2" name="gender-input">
                <option value="1" <?php if($profile['gender_id']==1){ echo "selected"; } ?>>Female</option>
                <option value="2" <?php if($profile['gender_id']==2){ echo "selected"; } ?>>Male</option>
            </select>

            <label for="birth-input" class="form-label">Date of Birth</label>
            <input type="date" class="form-control mb-2" name="birth-input" id="birth-input" value="<?= $profile['date_of_birth']; ?>" required>

            <label for="celebrate-input" class="form-label">I Celebrate</label>
            <select class="form-select mb-2" name="celebrate-input">
                <option value="0" selected>Select an Option...</option>
                <option value="1" <?php if($profile['celebrate_id']==1){ echo "selected"; } ?>>Chinese New Year</option>
                <option value="2" <?php if($profile['celebrate_id']==2){ echo "selected"; } ?>>Christmas</option>
                <option value="3" <?php if($profile['celebrate_id']==3){ echo "selected"; } ?>>Eid Al-Fitr / Ramadhan</option>
                <option value="4" <?php if($profile['celebrate_id']==4){ echo "selected"; } ?>>Nyepi</option>
                <option value="5" <?php if($profile['celebrate_id']==5){ echo "selected"; } ?>>Vesak</option>
            </select>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn cus-dark-btn">Save My Profile</button>
        </div>
    </form>
</div>