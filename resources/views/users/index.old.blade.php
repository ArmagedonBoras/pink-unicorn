<x-app-layout>
    <x-slot name="title">
        Användare
    </x-slot>
    <table class="table table-striped table-bordered">
        <thead>
            <th>Användarnamn</th>
            <th>Tillhör medlem</th>
            <th>Status</th>
            <th>E-post</th>
            <th>Senaste inloggning</th>
            <th>Näst senaste inloggning</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></td>
                    <td>
                        @if ($user->member)
                            <a href="{{ route('members.show', $user->member->id) }}">{{ $user->member->id }}:
                                {{ $user->member->name }}
                        @endif
                    </td>
                    <td>
                        @if ($user->locked)
                            Inaktiv
                        @else
                            Aktiv
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->login_at }}</td>
                    <td>{{ $user->previous_login_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
