@extends('pages.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit User</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="form form-horizontal">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('name') {{ 'is-invalid' }} @enderror" name="name" value="{{ old('name') ?? $user->name ?? '' }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>NIP</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control @error('nip') {{ 'is-invalid' }} @enderror" name="nip" value="{{ old('nip') ?? $user->nip ?? '' }}">
                                @error('nip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Role</label>
                            </div>
                            <fieldset class=" col-md-8 form-group">
                                <select class="form-select @error('role') {{ 'is-invalid' }} @enderror" id="basicSelect" name="role">
                                    <option value="">Pilih...</option>    
                                    <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>    
                                    <option value="kepala_sekolah" @if($user->role == 'kepala_sekolah') selected @endif>Kepala Sekolah</option>    
                                    <option value="guru" @if($user->role == 'guru') selected @endif>Guru</option>    
                                    <option value="tata_usaha" @if($user->role == 'tata_usaha') selected @endif>Tata Usaha</option>    
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="email" class="form-control @error('email') {{ 'is-invalid' }} @enderror" name="email" value="{{ old('email') ?? $user->email ?? '' }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Jenis Kelamin</label>
                            </div>
                            <fieldset class=" col-md-8 form-group">
                                <select class="form-select @error('jenis_kelamin') {{ 'is-invalid' }} @enderror" id="basicSelect" name="jenis_kelamin">
                                    <option value="">Pilih...</option>    
                                    <option value="laki_laki" @if($user->jenis_kelamin == 'laki_laki') selected @endif>Laki-Laki</option>    
                                    <option value="perempuan" @if($user->jenis_kelamin == 'perempuan') selected @endif>Perempuan</option>    
                                </select>
                                @error('jenis_kelammin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <div class="col-md-4">
                                <label>Password</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="password" class="form-control @error('password') {{ 'is-invalid' }} @enderror" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Edit</button>
                                <a href="{{ route('users.index') }}" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                            </div>
                        </div>
                    </div>
                </form
            </div>
        </div>
    </div>
@endsection