@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar User</h5>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>
                </div>

                <div class="card-body">
                    {{-- @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif --}}

                    <div class="mb-3">
                        <form method="GET" action="{{ route('users.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau NIM..." value="{{ request('search') }}">
                                <button class="btn btn-search" type="submit"><i class="fas fa-search"></i> Cari</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NIM</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nim ?: '-' }}</td>
                                        <td>{{ ucfirst($user->role) }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data user</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<x-js.modalConfirHapus />
<x-js.modalSuccesError/>
@endsection

<style>
    .btn-search {
        background-color: #008000;
        border: 1px solid #008000;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-search:hover {
        background-color: #006400;
        border-color: #006400;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 128, 0, 0.3);
    }
</style> 