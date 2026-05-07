@extends('layouts.app')

@section('title', 'Detail Subtes')

@section('content')
<x-page-header
    title="Detail Subtes"
    subtitle="Informasi lengkap subtes"
    action-label="Edit Subtes"
    :action-url="route('subtests.edit', $subtest->id)"
/>

@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

<div class="grid gap-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $subtest->name }}</h2>
        <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">{{ $subtest->description ?? 'Tidak ada deskripsi subtes.' }}</p>
    </div>
</div>
@endsection
