<div class="container mt-5 p-10 shadow d-flex justify-content-center align-items-center">
    <!-- Check if there is a flash message -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('flash'); ?>
        </div>
    <?php endif; ?>
    <section class="leave-request">
        <header class="text-center mb-5">
            <i class="bi bi-person-fill display-1 text-primary" style="font-size: 10rem"></i>
            <h1 class="display-1 h1">Leave request form</h1>
        </header>
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <form id="LeaveRequestForm" method="POST">

            <div class="row mb-4">
                <div class="form-group">
                    <label for="employee_id">Select Employee</label>
                    <select class="form-control" id="employee_id" name="employee_id">
                        <?php foreach ($employees as $emp) : ?>
                            <option value="<?= $emp['id']; ?>"><?= $emp['email']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-text text-danger"><?= form_error('employee_id'); ?></small>
                </div>
                <div class="col">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" class="form-control" id="start_date" value="<?= date('Y-m-d'); ?>" required>
                    <small class="form-text text-danger"><?= form_error('start_date'); ?></small>
                </div>

                <div class="col">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" class="form-control" id="end_date" required>
                    <small class="form-text text-danger"><?= form_error('end_date'); ?></small>
                </div>
                <div class="col">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="address..">
                    <small class="form-text text-danger"><?= form_error('location'); ?></small>
                    <div id="map" style="height: 150px; width: 100%; border-radius:5px;"></div>
                </div>

                <div class="button-container">
                    <button type="submit" name="tambah" class="btn btn-primary">Submit</button>
                </div>

        </form>
    </section>
</div>