@extends('layouts.admin')
@section('title', 'Donation #' . $donation->reference_number ?? '')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.donations.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Donation {{ $donation->reference_number }}</h1>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
        <div class="grid grid-cols-2 gap-5 text-sm">
            <div><div class="text-gray-500 text-xs uppercase tracking-wide">Donor</div><div class="font-semibold text-gray-900 mt-1">{{ $donation->donor_name }}</div><div class="text-gray-500">{{ $donation->donor_email }}</div></div>
            <div><div class="text-gray-500 text-xs uppercase tracking-wide">Amount</div><div class="text-3xl font-bold text-green-600 mt-1">${{ number_format($donation->amount, 2) }}</div></div>
            <div><div class="text-gray-500 text-xs uppercase tracking-wide">Category</div><div class="font-medium text-gray-900 mt-1">{{ $donation->category?->name ?? 'General Fund' }}</div></div>
            <div><div class="text-gray-500 text-xs uppercase tracking-wide">Payment Method</div><div class="font-medium text-gray-900 mt-1">{{ ucfirst(str_replace('_',' ',$donation->payment_method)) }}</div></div>
            <div><div class="text-gray-500 text-xs uppercase tracking-wide">Date</div><div class="font-medium text-gray-900 mt-1">{{ $donation->created_at->format('F j, Y g:i A') }}</div></div>
        </div>
        <form method="POST" action="{{ route('admin.donations.update', $donation) }}" class="border-t border-gray-100 pt-5 flex gap-3">
            @csrf @method('PATCH')
            <select name="status" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
                @foreach(['pending','completed','failed','refunded'] as $s)<option value="{{ $s }}" {{ $donation->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>@endforeach
            </select>
            <button type="submit" class="px-6 py-3 text-white font-bold rounded-xl hover:opacity-90 text-sm" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Update</button>
        </form>
    </div>
</div>
@endsection