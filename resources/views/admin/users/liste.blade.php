@extends('layouts.admin')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Gestion des utilisateurs</h1>
            <div class="text-muted small">Gérez les comptes utilisateurs et leurs rôles.</div>
        </div>
        <div class="ml-auto">
            <button type="button" class="btn btn-success btn-sm" onclick="openAddModal()">
                <i class="fa fa-plus mr-1"></i> Nouvel utilisateur
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-times-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-users mr-2"></i>Liste des utilisateurs</h6>
            <span class="badge badge-secondary">{{ $teUsers->total() }} utilisateur(s)</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width:60px">#</th>
                            <th>Profil</th>
                            <th>Email</th>
                            <th class="text-center">Rôles</th>
                            <th class="text-center">Inscrit</th>
                            <th class="text-center" style="width:140px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teUsers as $item)
                            <tr>
                                <td class="text-center font-weight-bold text-secondary">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" style="width:40px; height:40px; font-size:14px;">
                                            {{ strtoupper(substr($item->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">{{ $item->name }}</div>
                                            <small class="text-muted">ID: {{ $item->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-envelope text-muted mr-1"></i>{{ $item->email }}
                                </td>
                                <td class="text-center">
                                    @foreach ($item->roles as $role)
                                        @if($role->name == 'admin')
                                            <span class="badge badge-danger">{{ ucfirst($role->name) }}</span>
                                        @elseif($role->name == 'manager')
                                            <span class="badge badge-warning">{{ ucfirst($role->name) }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($role->name) }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center"><small>{{ $item->created_at->format('d/m/Y') }}</small></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-sm btn-info text-white mr-1" onclick="openViewModal(this)"
                                            data-name="{{ e($item->name) }}"
                                            data-email="{{ e($item->email) }}"
                                            data-roles="{{ $item->roles->pluck('name')->join(', ') }}"
                                            data-created="{{ $item->created_at->format('d/m/Y H:i') }}"
                                            title="Voir">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-warning text-white mr-1"
                                            data-name="{{ e($item->name) }}"
                                            data-email="{{ e($item->email) }}"
                                            data-roles="{{ json_encode($item->roles->pluck('id')) }}"
                                            data-update-url="{{ route('admin.users.update', $item) }}"
                                            onclick="openEditModal(this)"
                                            title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        @if ($item->id !== auth()->id())
                                            <form id="delete-form-{{ $item->id }}" method="POST" action="{{ route('admin.users.destroy', $item) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->name) }}')" title="Supprimer">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Aucun utilisateur enregistré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $teUsers->links() }}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="viewModalLabel"><i class="fa fa-user mr-2"></i>Détails de l'utilisateur</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body bg-light">
                    <div class="text-center mb-4">
                        <div id="view_avatar" class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width:80px; height:80px; font-size:28px;"></div>
                        <h5 id="view_name" class="mb-1"></h5>
                        <p id="view_email" class="text-muted"></p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted">Rôles</small>
                            <p id="view_roles" class="mb-2"></p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Inscrit le</small>
                            <p id="view_created" class="mb-2"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addModalLabel"><i class="fa fa-user-plus mr-2"></i>Nouvel utilisateur</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="addForm" method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="modal-body bg-light">
                        <div class="form-group">
                            <label for="add_name" class="form-label">Nom *</label>
                            <input type="text" class="form-control" id="add_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="add_email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="add_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="add_password" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" id="add_password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="add_password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                            <input type="password" class="form-control" id="add_password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Rôles</label>
                            <div class="row">
                                @foreach($roles as $role)
                                <div class="col-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="add_role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}">
                                        <label class="custom-control-label" for="add_role_{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check mr-1"></i>Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="editModalLabel"><i class="fa fa-edit mr-2"></i>Modifier l'utilisateur</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body bg-light">
                        <div class="form-group">
                            <label for="edit_name" class="form-label">Nom *</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_password" class="form-label">Nouveau mot de passe <small class="text-muted">(laisser vide pour garder l'actuel)</small></label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="edit_password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Rôles</label>
                            <div class="row">
                                @foreach($roles as $role)
                                <div class="col-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="edit_role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}">
                                        <label class="custom-control-label" for="edit_role_{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openAddModal() {
        $('#addForm')[0].reset();
        $('#addModal').modal('show');
    }

    function openViewModal(btn) {
        const name = btn.getAttribute('data-name');
        const email = btn.getAttribute('data-email');
        const roles = btn.getAttribute('data-roles');
        const created = btn.getAttribute('data-created');

        $('#view_avatar').text(name.substring(0, 2).toUpperCase());
        $('#view_name').text(name);
        $('#view_email').text(email);
        $('#view_roles').text(roles || 'Aucun rôle');
        $('#view_created').text(created);

        $('#viewModal').modal('show');
    }

    function openEditModal(btn) {
        const name = btn.getAttribute('data-name');
        const email = btn.getAttribute('data-email');
        const roles = JSON.parse(btn.getAttribute('data-roles') || '[]');
        const updateUrl = btn.getAttribute('data-update-url');

        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_password').val('');
        $('#edit_password_confirmation').val('');

        // Reset all checkboxes
        $('[id^="edit_role_"]').prop('checked', false);

        // Check appropriate roles
        roles.forEach(function(roleId) {
            $('#edit_role_' + roleId).prop('checked', true);
        });

        $('#editForm').attr('action', updateUrl);
        $('#editModal').modal('show');
    }

    function confirmDelete(id, name) {
        if (confirm('Êtes-vous sûr de vouloir supprimer l\'utilisateur "' + name + '" ?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush
