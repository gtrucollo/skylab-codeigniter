<?= $this->extend('includes/layout_logged') ?>

<?= $this->section('container') ?>
<div ng-app="users" ng-controller="usersController as vm">
    <!-- Section: Basic examples -->
    <section>
        <h3 class="dark-grey-text font-weight-bold text-center"><i class="fas fa-user"></i> Cadastro de Usuários</h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-10">
                        <label>Pesquisar</label>
                        <input type="text" class="form-control" ng-model="vm.search">
                    </div>
                    <div class="col-sm-2 text-right mt-4">
                        <a type="button" class="btn-floating btn-info" ng-click="vm.showNewModal()"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table id="main-table" class="table table-hover table-striped table-bordered" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="80px">Sequencial</th>
                                <th>Nome</th>
                                <th width="140px">CPF</th>
                                <th width="100px" class="text-center">Permissão</th>
                                <th width="120px" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="user in vm.users | filter:vm.search">
                            <td>{{ user.user_id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.doc_cpf}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm m-0" ng-class="user.user_administrator == 1 ? 'btn-danger' : 'btn-info'">
                                    {{ user.user_administrator == 1 ? 'Administrador' : 'Comum' }}
                                </button>
                            </td>
                            <td>
                                <div class="text-center">
                                    <a type="button" class="btn-floating btn-sm btn-amber" ng-click="vm.showEditModal(user)"><i class="far fa-edit"></i></a>
                                    <a type="button" id="remove" class="btn-floating btn-sm btn-danger" ng-click="vm.delete(user)"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Form modal -->
    <div class="modal fade" id="formModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-lg">
            <div class="modal-content">
                <div class="modal-header info-color-dark text-white">
                    <h5 class="heading lead"><i class="fa fa-user"></i> Cadastro de Usuários</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <form method="post" action="<?= base_url('user/save')?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="md-form col-sm-4 md-outline">
                                <input type="text" id="user_id" name="user_id" class="form-control" readonly value="{{vm.user.user_id}}">
                                <label for="user_id">Sequencial</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="md-form col-sm-12 md-outline">
                                <input type="text" id="name" name="name" maxlength="100" class="form-control" value="{{vm.user.name}}" required>
                                <label for="name">Nome Completo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="md-form col-sm-4 md-outline">
                                <input type="text" id="doc_cpf" name="doc_cpf" maxlength="100" class="form-control" value="{{vm.user.doc_cpf}}" required>
                                <label for="doc_cpf">CPF</label>
                            </div>
                            <div class="md-form col-sm-4">
                                <select id="user_administrator" name="user_administrator" class="browser-default custom-select" required>
                                    <option
                                            ng-repeat="permission in vm.permissions track by permission.value"
                                            value="{{permission.value}}"
                                            ng-selected="permission.value == vm.user.user_administrator" >{{permission.description}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="md-form col-sm-12 md-outline">
                                <input type="email" id="email" name="email" maxlength="100" class="form-control" value="{{vm.user.email}}">
                                <label for="email">E-Mail</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script type="text/javascript" src="<?= base_url('assets/js/angular.min.js'); ?>"></script>
<script>
    angular.module('users', []);
    angular.module('users').controller('usersController', function($scope ,$http) {
        const vm = this;

        vm.getAll = () => {
            $http.get('<?= base_url('user/getAll') ?>')
                .then(function(response){
                    vm.users = response.data;
                })
                .catch(function(error){
                    toastr.error(error);
                });
        }

        vm.delete = (register) => {
            $http.delete('<?= base_url('user') ?>/' + register.user_id)
                .then(function(response){
                    toastr.success('Registro excluído com sucesso!');
                    vm.getAll();
                })
                .catch(function(error){
                    toastr.error(error.data);
                });
        }

        vm.showEditModal = (register) => {
            $http.get('<?= base_url('user') ?>/' + register.user_id)
                .then(function(response){
                    vm.user = response.data;
                })
                .catch(function(error){
                    toastr.error(error);
                });

            $('#formModal').modal('show');
        }

        vm.showNewModal = () =>{
            vm.user = [];
            $('#formModal').modal('show');
        }

        $(document).on('shown.bs.modal', function (e) {
            $('#name').focus()
        })

        vm.getAll();

        vm.permissions = [
            {value: 0, description: 'Comum'},
            {value: 1, description: 'Administrador'}
        ];
    });
</script>

<?= $this->endSection() ?>
