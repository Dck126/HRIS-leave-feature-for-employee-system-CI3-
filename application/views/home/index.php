<div class="container m-lg-auto p-5">
    <!-- Check if there is a flash message -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('flash'); ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Form Data Karyawan
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" required>
                                <small class="form-text text-danger"><?= form_error('first_name'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" required>
                                <small class="form-text text-danger"><?= form_error('last_name'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" required>
                                <small class="form-text text-danger"><?= form_error('email'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <!-- <input type="tel" name="phone" class="form-control" id="phone" required> -->
                                <input type="tel" name="phone" class="form-control" id="phone" required onkeypress="return isNumber(event)">
                                <small class="form-text text-danger"><?= form_error('phone'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="hire_date">Hire Date</label>
                                <input type="date" name="hire_date" class="form-control" id="hire_date" required>
                                <small class="form-text text-danger"><?= form_error('hire_date'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="job_title">Job Title</label>
                                <input type="text" name="job_title" class="form-control" id="job_title" required>
                                <small class="form-text text-danger"><?= form_error('job_title'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select class="form-control" id="department_id" name="department_id">
                                    <?php foreach ($departments as $department) : ?>
                                        <option value="<?= $department['id']; ?>"><?= $department['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="form-text text-danger"><?= form_error('department_id'); ?></small>
                            </div>

                            <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>