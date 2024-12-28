@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Edit Transaksi</h1>
    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $transaction->date }}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Jenis</label>
            <select name="type" id="type" class="form-control" required>
                <option value="income" {{ $transaction->type === 'income' ? 'selected' : '' }}>Penerimaan</option>
                <option value="expense" {{ $transaction->type === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ $transaction->amount }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control">{{ $transaction->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
