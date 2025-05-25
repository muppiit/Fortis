<div class="create-user-container animated">
    <div class="form-header">
        <h2>Edit User</h2>
        <p>Perbarui informasi pengguna</p>
    </div>

    @if ($errors->any())
        <div class="error-container animated">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.update-user', $user->nip) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-body">
            <div class="form-row">
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control"
                        value="{{ old('nip', $user->nip) }}" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                        value="{{ old('nama', $user->name) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password <small>(Kosongkan jika tidak ingin diubah)</small></label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    @php
                        $currentLevel = auth()->user()->role->level;
                    @endphp
                    @foreach ($roles as $role)
                        @if (
                            $currentLevel === 'super_super_admin' ||
                                ($currentLevel === 'super_admin' && in_array($role->level, ['admin', 'user'])) ||
                                ($currentLevel === 'admin' && $role->level === 'user'))
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $role->level)) }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if ($currentLevel === 'super_super_admin')
                <div class="form-group">
                    <label for="department_id">Departemen</label>
                    <select name="department_id" id="department_id" class="form-control" required>
                        <option value="">Pilih Departemen</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}"
                                {{ old('department_id', $user->teamDepartment->department_id ?? '') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->department }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                {{-- Hidden input untuk tetap mengirim department_id --}}
                <input type="hidden" name="department_id" value="{{ $user->teamDepartment->department_id }}">
                <div class="form-group">
                    <label for="department_id">Departemen</label>
                    <input type="text" class="form-control" value="{{ $user->teamDepartment->department->department }}"
                        disabled>
                </div>
            @endif

            @if ($currentLevel === 'super_super_admin')
                <div class="form-group">
                    <label for="team_department_id">Team Departemen</label>
                    <select name="team_department_id" id="team_department_id" class="form-control" required>
                        <option value="">Pilih Team Departemen</option>
                    </select>
                </div>
            @elseif ($currentLevel === 'super_admin')
                <div class="form-group">
                    <label for="team_department_id">Team Departemen</label>
                    <select name="team_department_id" id="team_department_id" class="form-control" required>
                        <option value="">Pilih Team Departemen</option>
                        @foreach ($teamDepartments as $team)
                            @if ($team->department_id == auth()->user()->teamDepartment->department_id)
                                <option value="{{ $team->id }}"
                                    {{ old('team_department_id', $user->team_department_id) == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="team_department_id" value="{{ $user->team_department_id }}">
                <div class="form-group">
                    <label for="team_department_id">Team Departemen</label>
                    <input type="text" class="form-control"
                        value="{{ $user->teamDepartment->name }}"
                        disabled>
                </div>
            @endif

        </div>

        <div class="form-footer">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>

    @if ($currentLevel === 'super_super_admin')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const departmentSelect = document.getElementById('department_id');
                const teamSelect = document.getElementById('team_department_id');

                const allTeams = @json($teamDepartments);

                function populateTeams(departmentId, selectedTeamId = null) {
                    teamSelect.innerHTML = '<option value="">Pilih Team Departemen</option>';

                    allTeams.forEach(team => {
                        if (team.department_id == departmentId) {
                            const option = document.createElement('option');
                            option.value = team.id;
                            option.text = team.name;

                            if (selectedTeamId && selectedTeamId == team.id) {
                                option.selected = true;
                            }

                            teamSelect.appendChild(option);
                        }
                    });
                }

                if (departmentSelect.value) {
                    populateTeams(departmentSelect.value,
                    '{{ old('team_department_id', $user->team_department_id) }}');
                }

                departmentSelect.addEventListener('change', function() {
                    populateTeams(this.value);
                });
            });
        </script>
    @endif

</div>
