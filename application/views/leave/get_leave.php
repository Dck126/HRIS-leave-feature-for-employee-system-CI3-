<div class="container mt-5">
    <!-- Check if there is a flash message -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('flash'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <h3>Daftar Leave</h3>
            <?php if (empty($leaves)) : ?>
                <div class="alert alert-danger" role="alert">
                    Data leave tidak ditemukan.
                </div>
            <?php else : ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <th>Pilih Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leaves as $leave) : ?>
                            <tr>
                                <td><?= $leave['id']; ?></td>
                                <td><?= $leave['employee_email']; ?></td>
                                <td><?= $leave['start_date']; ?></td>
                                <td><?= $leave['end_date']; ?></td>
                                <td><?= $leave['location']; ?></td>
                                <td>
                                    <select name="status" class="form-control">
                                        <option value="Pending" <?= ($leave['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="Approved" <?= ($leave['status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                                        <option value="Rejected" <?= ($leave['status'] == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>