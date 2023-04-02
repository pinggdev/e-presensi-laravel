@extends('pages.master')

@section('content')
    @if ($distance >= $max_distance)
        <div class="card-body">
            <div class="alert alert-danger">Berada di luar jangkauan, tidak bisa absen</div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Aturan</h4>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-content">
                    <div class="card-body">
                        <p>Pagi : dimulai pukul 04.00 WIB - 07.00 WIB (senin - Jum'at)</p>
                        <p>Sore : dimulai pukul 15.30 WIB - 22.30 WIB (senin - Kamis)</p>
                        <p>Sore : dimulai pukul 14.00 WIB - 21.00 WIB (Jum'at)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Absen Masuk</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('presences.store') }}" method="POST" class="form form-horizontal">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                            <div class="col-md-4">
                                <label>Jam Masuk</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="time" class="form-control" name="" value=@if ($checkIn)
                                {{ $checkIn->check_in_time }}
                                @else
                                {{ now()->format('H:i') }}
                                @endif disabled>
                            </div>
                            <input type="hidden" class="form-control" name="check_in_time" value="{{ now()->format('H:i') }}">
                            <div class="col-md-4">
                                <label>Keterangan Masuk</label>
                            </div>
                            <fieldset class=" col-md-8 form-group">
                                <select class="form-select @error('keterangan_masuk') {{ 'is-invalid' }} @enderror" id="basicSelect" name="keterangan_masuk" @if ($distance >= $max_distance || $checkIn)
                                    {{ "disabled" }}
                                @endif>
                                    <option value="">Pilih...</option>    
                                    <option value="t" @if ($keteranganMasuk === "t")
                                        selected
                                    @endif>Terlambat</option> 
                                    <option value="a" @if ($keteranganMasuk === "a")
                                        selected
                                    @endif>Alpha</option> 
                                    <option value="h" @if ($keteranganMasuk === "h")
                                        selected
                                    @endif>Hadir</option> 
                                    <option value="tam" @if ($keteranganMasuk === "tam")
                                        selected
                                    @endif>Tidak Absen Masuk</option> 
                                    <option value="tap" @if ($keteranganMasuk === "tap")
                                        selected
                                    @endif>Tidak Absen Pulang</option> 
                                    <option value="p" @if ($keteranganMasuk === "p")
                                        selected
                                    @endif>Pulang Cepat</option> 
                                    <option value="tp" @if ($keteranganMasuk === "tp")
                                        selected
                                    @endif>Terlambat dan Pulang Cepat</option> 
                                    <option value="tamp" @if ($keteranganMasuk === "tamp")
                                        selected
                                    @endif>Tidak Absen Masuk dan Pulang Cepat</option> 
                                    <option value="tapt" @if ($keteranganMasuk === "tapt")
                                        selected
                                    @endif>Tidak Absen Pulang dan Terlambat</option> 
                                </select>
                                @error('keterangan_masuk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1" 
                                @if ($distance >= $max_distance || $checkIn)
                                    {{"disabled"}}
                                @endif>Tambah</button>
                                @if (!$checkIn)
                                    <a href="/" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($checkIn)
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Absen Pulang</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('presences.update', $checkIn->id) }}" method="POST" class="form form-horizontal">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Jam Pulang</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="time" class="form-control" name="" value=@if ($checkOut)
                                {{ $checkOut->check_out_time }}
                                @else
                                {{ now()->format('H:i') }}
                                @endif disabled>
                            </div>
                            <input type="hidden" class="form-control" name="check_out_time" value="{{ now()->format('H:i') }}">
                            <div class="col-md-4">
                                <label>Keterangan Pulang</label>
                            </div>
                            <fieldset class=" col-md-8 form-group">
                                <select class="form-select @error('keterangan_pulang') {{ 'is-invalid' }} @enderror" id="basicSelect" name="keterangan_pulang" @if ($distance >= $max_distance || $checkOut)
                                    {{ "disabled" }}
                                @endif>
                                    <option value="">Pilih...</option>    
                                    <option value="t" @if ($keteranganPulang === "t")
                                    selected
                                @endif>Terlambat</option> 
                                    <option value="a" @if ($keteranganPulang === "a")
                                    selected
                                @endif>Alpha</option> 
                                    <option value="h" @if ($keteranganPulang === "h")
                                    selected
                                @endif>Hadir</option> 
                                    <option value="tam" @if ($keteranganPulang === "tam")
                                    selected
                                @endif>Tidak Absen Masuk</option> 
                                    <option value="tap" @if ($keteranganPulang === "tap")
                                    selected
                                @endif>Tidak Absen Pulang</option> 
                                    <option value="p" @if ($keteranganPulang === "p")
                                        selected
                                    @endif>Pulang Cepat</option> 
                                    <option value="tp" @if ($keteranganPulang === "tp")
                                    selected
                                @endif>Terlambat dan Pulang Cepat</option> 
                                    <option value="tamp" @if ($keteranganPulang === "tamp")
                                    selected
                                @endif>Tidak Absen Masuk dan Pulang Cepat</option> 
                                    <option value="tapt" @if ($keteranganPulang === "tapt")
                                    selected
                                @endif>Tidak Absen Pulang dan Terlambat</option> 
                                </select>
                                @error('keterangan_pulang')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1" 
                                @if ($distance >= $max_distance || $checkOut)
                                    {{"disabled"}}
                                @endif>Tambah</button>
                                @if (!$checkOut)
                                    <a href="{{ route('users.index') }}" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection