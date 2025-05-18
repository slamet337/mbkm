<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Access Control</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{breadcrumb_home_url}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Api Api_management</li>
                    <li class="breadcrumb-item active">Access Control</li>
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
                    <div class="form-group mb-0">
                        <label for="filterRole" class="form-label mb-0 me-2">Filter Role:</label>
                        <select id="filterRole" class="form-select d-inline-block w-auto">
                            <option value="all">All Roles</option>
                            <?php 
                                $lastpath = $this->uri->segment(4);
                            ?>
                            <?php foreach ($roles as $role): ?>

                                <option value="<?= htmlspecialchars($role->name) ?>" <?= (isset($lastpath) && $lastpath == $role->name) ? 'selected' : '' ?>><?= htmlspecialchars($role->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEndpointModal">
                        <i class="fa fa-plus"></i> Kelola Akses
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-striped" id="basic-1">
                        <caption>List of API Access Control</caption>
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Endpoint</th>
                                <th>Get</th>
                                <th>Post</th>
                                <th>Put</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($role_permissions as $endpoint): ?>
                                
                                <tr >
                                    <td><?= $endpoint->role ?></td>
                                    <td><?= $endpoint->endpoint ?></td>
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
    <div class="modal-dialog modal-lg">
        <form method="post" action="<?= site_url('admin/api_management/add_access') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEndpointModalLabel">Tambah Access</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="" selected disabled>-- Select Role --</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= htmlspecialchars($role->id) ?>"><?= htmlspecialchars($role->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <br>
                        <?php foreach ($endpoints as $endpoint): ?>
                                <div class="mb-3 d-flex align-items-center justify-content-between flex-wrap">
                                    <div>
                                        <label class="form-label mb-0"><?= htmlspecialchars($endpoint->path) ?></label>
                                    </div>
                                    <div class="d-flex gap-3 flex-wrap">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" value="on" type="checkbox" id="<?= str_replace('/','' ,$endpoint->path)."_GET" ?>" name="role_permission[<?= md5($endpoint->path .  'GET'   ) ?>]" <?= ($endpoint->get) ? '' : 'readonly disabled' ?> >
                                            <label class="form-check-label" for="<?= str_replace('/','' ,$endpoint->path)."_GET" ?>">GET</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" value="on" type="checkbox" id="<?= str_replace('/','' ,$endpoint->path)."_POST" ?>" name="role_permission[<?= md5($endpoint->path .  'POST'   ) ?>]" <?= ($endpoint->post) ? '' : 'readonly disabled' ?> >
                                            <label class="form-check-label" for="<?= str_replace('/','' ,$endpoint->path)."_POST" ?>">POST</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" value="on" type="checkbox" id="<?= str_replace('/','' ,$endpoint->path)."_PUT" ?>" name="role_permission[<?= md5($endpoint->path .  'PUT'   ) ?>]" <?= ($endpoint->put) ? '' : 'readonly disabled' ?> >
                                            <label class="form-check-label" for="<?= str_replace('/','' ,$endpoint->path)."_PUT" ?>">PUT</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" value="on" type="checkbox" id="<?= str_replace('/','' ,$endpoint->path)."_DELETE" ?>" name="role_permission[<?= md5($endpoint->path .  'DELETE'   ) ?>]" <?= ($endpoint->delete) ? '' : 'readonly disabled' ?> >
                                            <label class="form-check-label" for="<?= str_replace('/','' ,$endpoint->path)."_DELETE" ?>">DELETE</label>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; ?>
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
    const selectRole = document.getElementById('role');
    const filterRole = document.getElementById('filterRole');
    const filterRoleValue = filterRole.value;
    filterRole.addEventListener('change', function () {
        if (this.value === 'all') {
            window.location.href = "<?= base_url('admin/Api_management/access_control/') ?>";
        } else {
            window.location.href = "<?= base_url('admin/Api_management/access_control/') ?>" + this.value;
        }
    });

    selectRole.addEventListener('change', function () {
        const selectedRole = this.value;
        console.log('Selected Role:', selectedRole);
        const role_permissions = <?= json_encode($role_permissions) ?>;

        const rolePermision = role_permissions.filter(function (item) {
            return item.role_id === selectedRole;
        });
        
        let modal = document.getElementById('addEndpointModal');
        let checkboxes = modal.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = false;
            checkbox.value = 'on';
            checkbox.removeAttribute('checked');
        });
        
        if (rolePermision.length > 0) {
            rolePermision.forEach(function (endpoint) {
                let endpointPath = endpoint.endpoint;
                let endpointId = endpoint.endpoint_id;
                let endpointRole = endpoint.role;

                let idCheckboxGet = endpoint.endpoint.replaceAll('/', '') + "_GET";
                let idCheckboxPost = endpoint.endpoint.replaceAll('/', '') + "_POST";
                let idCheckboxPut = endpoint.endpoint.replaceAll('/', '') + "_PUT";
                let idCheckboxDelete = endpoint.endpoint.replaceAll('/', '') + "_DELETE";

                let checkboxGet = document.getElementById(idCheckboxGet);
                let checkboxPost = document.getElementById(idCheckboxPost);
                let checkboxPut = document.getElementById(idCheckboxPut);
                let checkboxDelete = document.getElementById(idCheckboxDelete);
                
                if (checkboxGet) {
                    checkboxGet.checked = endpoint.get ? true : false;
                    checkboxGet.value = (endpoint.get? endpoint.get : 'on')  ;
                }
                if (checkboxPost) {
                    checkboxPost.checked = endpoint.post ? true : false;
                    checkboxPost.value = (endpoint.post? endpoint.post : 'on')  ;
                }
                if (checkboxPut) {
                    checkboxPut.checked = endpoint.put ? true : false;
                    checkboxPut.value = (endpoint.put? endpoint.put : 'on')  ;
                }
                if (checkboxDelete) {
                    checkboxDelete.checked = endpoint.delete ? true : false;
                    checkboxDelete.value = (endpoint.delete? endpoint.delete : 'on')  ;
                }
            });
        } else {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false;
                checkbox.value = 'on';
                checkbox.removeAttribute('checked');
            });
            
        }
    });

</script>