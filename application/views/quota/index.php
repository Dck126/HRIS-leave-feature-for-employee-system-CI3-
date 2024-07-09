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
                        Form Add Quota
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="employee_id">Employee</label>
                                <select class="form-control" id="employee_id" name="employee_id">
                                    <?php foreach ($employees as $emp) : ?>
                                        <option value="<?= $emp['id']; ?>"><?= $emp['email']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="form-text text-danger"><?= form_error('employee_id'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="year">Tahun</label>
                                <input type="number" name="year" class="form-control" id="year" required min="2024" max="<?= date('Y'); ?>" onkeypress="return isNumber(event)">
                                <small class="form-text text-danger"><?= form_error('year'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="total_days">Total Days</label>
                                <input type="tel" name="total_days" class="form-control" id="total_days" required onkeypress="return isNumber(event)">
                                <small class="form-text text-danger"><?= form_error('year'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="used_days">Used Days</label>
                                <input type="tel" name="used_days" class="form-control" id="used_days" required onkeypress="return isNumber(event)">
                                <small class="form-text text-danger"><?= form_error('year'); ?></small>
                            </div>

                            <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Output Tabel Leaves Quotas -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Daftar Quota</h3>
                <?php if (empty($quotas)) : ?>
                    <div class="alert alert-danger" role="alert">
                        Data quota cuti tidak ditemukan.
                    </div>
                <?php else : ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee ID</th>
                                <th>Year</th>
                                <th>Total Days</th>
                                <th>Used Days</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($quotas as $quota) : ?>
                                <tr>
                                    <td><?= $quota['id']; ?></td>
                                    <td><?= $quota['employee_email']; ?></td>
                                    <td><?= $quota['year']; ?></td>
                                    <td><?= $quota['total_days']; ?></td>
                                    <td><?= $quota['used_days']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>