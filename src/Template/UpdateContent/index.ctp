<div class="card">
    <div class="card-header">
        Update Content
        <span class="float-right">
            <div class="btn-group">
                <a href="<?= $this->Url->build(['controller' => 'UpdateContent', 'action' => 'downloadChangFileLog'])?>" class="btn btn-secondary">Download Change Logs</a>
</div>
        </span>
    </div>
    <div class="card-body">
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">Commit</th>
                <th scope="col">Commit Hash</th>
                <th scope="col">Files</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($updateLogs as $log): ?>
                <tr>
                    <td><?= $log->commitsMessage ?></td>
                    <td><?= $log->commitsLog ?></td>
                    <td>Files</td>
                    <td><?= $log->date ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>