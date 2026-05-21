@extends('layouts.admin')
@section('title', 'Donations')
@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Donations</h1>
        <p class="text-gray-500 text-sm mt-1">Total: ${{ number_format($totalAmount, 2) }} &nbsp;|&nbsp; This Month: ${{ number_format($monthlyAmount, 2) }}</p>
    </div>
    <a href="{{ route('admin.donations.export') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl text-sm hover:bg-gray-50 transition-colors">Export CSV</a>
</div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200"><tr><th class="text-left px-5 py-4 font-semibold text-gray-600">Reference</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Donor</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Amount</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Category</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Method</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Status</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Date</th></tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($donations as $d)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 font-mono text-xs text-blue-600"><a href="{{ route('admin.donations.show', $d) }}">{{ $d->reference_number }}</a></td>
                <td class="px-5 py-4"><div class="font-medium text-gray-900">{{ $d->donor_name }}</div><div class="text-xs text-gray-400">{{ $d->donor_email }}</div></td>
                <td class="px-5 py-4 font-bold text-gray-900">${{ number_format($d->amount, 2) }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $d->category?->name ?? 'General' }}</td>
                <td class="px-5 py-4 text-gray-600">{{ ucfirst(str_replace('_',' ',$d->payment_method)) }}</td>
                <td class="px-5 py-4"><span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold {{ $d->status === 'completed' ? 'bg-green-100 text-green-700' : ($d->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-600') }}">{{ ucfirst($d->status) }}</span></td>
                <td class="px-5 py-4 text-gray-500 text-xs">{{ $d->created_at->format('M j, Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-5 py-12 text-center text-gray-400">No donations yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($donations->hasPages())<div class="mt-5">{{ $donations->links() }}</div>@endif
@endsection