<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>endpoint</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{breadcrumb_home_url}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Api Api_management</li>
                    <li class="breadcrumb-item active">endpoint</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Endpoint Management</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEndpointModal">
                        <i class="fa fa-plus"></i> endpoint
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-striped" id="basic-1">
                        <caption>List of API Endpoints</caption>
                        <thead>
                            <tr>
                                <th>Endpoint</th>
                                <th>Get</th>
                                <th>Post</th>
                                <th>Put</th>
                                <th>Delete</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($endpoints as $endpoint): ?>
                                <tr >
                                    <td><?= $endpoint->path ?></td>
                                    <td>
                                        <input style="height: 18px; width: 18px;" type="checkbox" disabled class="form-check-input" value="<?= $endpoint->get ?>" <?= !empty($endpoint->get) ? 'checked' : '' ?>>
                                    </td>
                                    <td>
                                        <input style="height: 18px; width: 18px;" type="checkbox" disabled class="form-check-input" value="<?= $endpoint->post ?>" <?= !empty($endpoint->post) ? 'checked' : '' ?>>
                                    </td>
                                    <td>
                                        <input style="height: 18px; width: 18px;" type="checkbox" disabled class="form-check-input" value="<?= $endpoint->put ?>" <?= !empty($endpoint->put) ? 'checked' : '' ?>>
                                    </td>
                                    <td>
                                        <input style="height: 18px; width: 18px;" type="checkbox" disabled class="form-check-input" value="<?= $endpoint->delete ?>" <?= !empty($endpoint->delete) ? 'checked' : '' ?>>
                                    </td>
                                    <td>
                                        <!-- <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editEndpointModal" data-path="<?= $endpoint->path ?>">Edit</button> -->
                                        <button class="btn btn-sm btn-danger delbtn" data-path="<?= $endpoint->path ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Endpoint -->
<div class="modal fade" id="addEndpointModal" tabindex="-1" aria-labelledby="addEndpointModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="<?= site_url('admin/api_management/add_endpoint') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEndpointModalLabel">Tambah Endpoint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="apiVersion" class="form-label">API Version</label>
                        <select class="form-select" id="apiVersion" name="version" required>
                            <option value="" disabled selected>Pilih versi API</option>
                            <option value="v1">v1</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="endpointPath" class="form-label">Endpoint Path</label>
                        <div class="input-group">
                            <span class="input-group-text" id="endpointPrefix">/api/<span id="ipiv">{{version}}/</span></span>
                            <input type="text" class="form-control" id="endpointPath" name="path" aria-describedby="endpointPrefix" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="endpointMethod" class="form-label">HTTP Method</label>
                        <div class="d-flex gap-3 flex-wrap">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="methods[]" value="GET" id="methodGET">
                                <label class="form-check-label" for="methodGET">GET</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="methods[]" value="POST" id="methodPOST">
                                <label class="form-check-label" for="methodPOST">POST</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="methods[]" value="PUT" id="methodPUT">
                                <label class="form-check-label" for="methodPUT">PUT</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="methods[]" value="DELETE" id="methodDELETE">
                                <label class="form-check-label" for="methodDELETE">DELETE</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Container-fluid Ends-->
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const apiVersionSelect = document.getElementById('apiVersion');
        const endpointPrefix = document.getElementById('endpointPrefix');
        const ipiv = document.getElementById('ipiv');

        apiVersionSelect.addEventListener('change', function () {
            const selectedVersion = this.value;
            if(selectedVersion === '') {
                endpointPrefix.textContent = "{{version}}/";
                return;
            }
            ipiv.textContent = selectedVersion + '/';
        });

        const delbtns = document.querySelectorAll('.delbtn');
        delbtns.forEach(function (delbtn) {
            delbtn.addEventListener('click', function () {
                const path = this.getAttribute('data-path');
                if (confirm('Are you sure you want to delete the endpoint: ' + path + '?')) {
                    let clean_path = path.replace(/\//g, '~');
                    window.location.href = "<?= site_url('admin/api_management/delete_endpoint/') ?>" + clean_path;
                }
            });
        });

    });
</script>