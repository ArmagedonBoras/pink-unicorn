<x-app-layout>
    <x-slot name="title">
        Redigera rättigheter
    </x-slot>
    <form method="POST" action="{{ route('permissions.store') }}">
        @csrf

        <table class="table table-striped table-bordered">
            <thead>
                <th class="col splitted-cell-background">
                    Rättigheter <x-bs-icon name="arrow down" />
                </th>
                <th>
                    Roller <x-bs-icon name="arrow-right" />
                </th>
                @foreach ($roles as $role)
                    <th class="col text-nowrap">
                        {{ $role->label }}
                        @can('roles-update')
                            &nbsp;<a href="{{ route('roles.edit', $role->id) }}"
                                class="fw-bolder text-decoration-none text-dark">
                                <x-bs-icon name="pencil-square" />&nbsp;
                            </a>
                        @endcan
                    </th>
                @endforeach
            </thead>
            <tbody>
                @foreach ($permissions as $group => $permission_list)
                    <tr>
                        <th colspan="{{ $roles->count() + 1 }}">{{ empty($group) ? 'Okategoriserat' : $group }}</th>
                    </tr>
                    @foreach ($permission_list as $permission)
                        <tr>
                            <td colspan="2"><span>{{ $permission->label ?? $permission->name }}&nbsp;<a
                                        href="{{ route('permissions.edit', $permission->id) }}"
                                        class="fw-bolder text-decoration-none text-dark">
                                        <x-bs-icon name="pencil-square" />&nbsp;
                                    </a></span></td>
                            @foreach ($roles as $role)
                                <td class="text-center">
                                    <input type="checkbox" name="permissions-{{ $role->id }}[]"
                                        value="{{ $permission->id }}" class="form-check-input ml-1"
                                        id="permission-{{ $role->id }}-{{ $permission->id }}"
                                        {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}
                                        {{ $role->id == 1 || $role->id == 2 ? 'disabled' : '' }}>
                                    <label for="permission-{{ $role->id }}-{{ $permission->id }}"
                                        class="form-check-label ml-4">&nbsp;</label>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
            </tbody>



        </table>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary ml-4">Spara</button>
            <a href="{{ route('roles.create') }}" class="btn btn-primary me-1">Skapa roll</a>

        </div>
    </form>
</x-app-layout>
