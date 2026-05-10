@extends('layouts.app')

@section('title', 'Tambah Program Studi')

@section('content')
<x-form.form-card title="Tambah Program Studi" :backUrl="route('programs.index')">
    <form
        action="{{ route('programs.store') }}"
        method="POST"
        class="space-y-6"
        x-data="programForm()"
    >
        @csrf

        <x-form.input
            label="Nama Program"
            name="name"
            placeholder="Masukkan nama program studi"
            :value="old('name')"
            required
        />

        <x-form.textarea
            label="Deskripsi Program"
            name="description"
            placeholder="Deskripsi singkat program studi"
            :value="old('description')"
            rows="4"
        />

        <x-form.input
            label="Daya Tampung (Kapasitas Peserta)"
            name="capacity"
            type="number"
            placeholder="Jumlah peserta maksimal"
            min="0"
            :value="old('capacity')"
        />

        <x-form.checkbox
            label="Aktif"
            name="is_active"
            :checked="old('is_active', true)"
        />

        {{-- Pengaturan Portofolio --}}
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 dark:border-slate-700/50 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Pengaturan Portofolio</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Atur apakah portofolio diperlukan untuk program ini dan berapa bobotnya.</p>

            <div class="mt-6 space-y-4">
                <x-form.checkbox
                    label="Portofolio Wajib"
                    name="portfolio_required"
                    :checked="old('portfolio_required')"
                    x-model="portfolioRequired"
                />

                <div x-show="portfolioRequired" x-cloak class="space-y-4">
                    <x-form.textarea
                        label="Deskripsi Portofolio"
                        name="portfolio_description"
                        placeholder="Deskripsikan jenis portofolio yang diminta"
                        :value="old('portfolio_description')"
                        rows="4"
                        x-bind:disabled="!portfolioRequired"
                    />

                    <x-form.input
                        label="Bobot Portofolio (%)"
                        name="portfolio_weight"
                        type="number"
                        placeholder="0"
                        step="0.01"
                        min="0"
                        max="100"
                        :value="old('portfolio_weight')"
                        x-model="portfolioWeight"
                        x-bind:disabled="!portfolioRequired"
                    />
                </div>
            </div>
        </div>

        {{-- Bobot Subtes --}}
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 dark:border-slate-700/50 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Bobot Subtes</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Masukkan bobot (%) untuk setiap subtes. Total bobot subtes harus sama dengan 100% dikurangi bobot portofolio.
            </p>

            {{-- Indikator Total Bobot Subtes --}}
            <div
                class="mt-3 flex flex-wrap items-center justify-between gap-2 rounded-xl border px-4 py-3 text-sm transition-colors duration-200"
                :class="isValid()
                    ? 'border-emerald-200 bg-emerald-50 dark:border-emerald-800/50 dark:bg-emerald-900/20'
                    : 'border-amber-200 bg-amber-50 dark:border-amber-800/50 dark:bg-amber-900/20'"
            >
                <span class="text-slate-600 dark:text-slate-400">Total bobot subtes saat ini:</span>
                <span
                    class="font-semibold tabular-nums"
                    :class="isValid()
                        ? 'text-emerald-600 dark:text-emerald-400'
                        : 'text-amber-600 dark:text-amber-400'"
                >
                    <span x-text="subtestTotal().toFixed(2)"></span>%
                    <span class="ml-2 font-normal text-slate-500 dark:text-slate-400">
                        (target: <span x-text="remainingTarget().toFixed(2)"></span>%)
                    </span>
                    <span x-show="isValid()" x-cloak class="ml-1">✓</span>
                    <span x-show="!isValid()" class="ml-1">⚠</span>
                </span>
            </div>

            @error('weights')
                <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    {{ $message }}
                </div>
            @enderror

            @if($subtests->isEmpty())
                <p class="mt-4 text-sm text-amber-500">Belum ada subtes/ujian. Tambahkan subtes terlebih dahulu.</p>
            @endif

            <div class="mt-6 space-y-4">
                @foreach($subtests as $subtest)
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_180px] md:items-center">
                        <div>
                            <p class="font-medium text-slate-700 dark:text-slate-100">{{ $subtest->name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $subtest->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>

                        <x-form.input
                            label="Bobot (%)"
                            name="weights[{{ $subtest->id }}]"
                            type="number"
                            placeholder="0"
                            step="0.01"
                            min="0"
                            max="100"
                            :value="old('weights.' . $subtest->id)"
                            x-model="weights[{{ $subtest->id }}]"
                        />
                    </div>
                @endforeach
            </div>
        </div>

        <x-form.form-actions :cancelUrl="route('programs.index')" />
    </form>
</x-form.form-card>

<script>
function programForm() {
    return {
        portfolioRequired: @json((bool) old('portfolio_required', false)),
        portfolioWeight: @json((float) old('portfolio_weight', 0)),
        weights: @json(collect($subtests)->mapWithKeys(fn($s) => [$s->id => (float) old('weights.' . $s->id, 0)])),

        subtestTotal() {
            return Object.values(this.weights).reduce(function(sum, w) {
                return sum + (parseFloat(w) || 0);
            }, 0);
        },

        remainingTarget() {
            var pw = this.portfolioRequired ? (parseFloat(this.portfolioWeight) || 0) : 0;
            return 100 - pw;
        },

        isValid() {
            return Math.abs(this.subtestTotal() - this.remainingTarget()) < 0.01;
        }
    }
}
</script>
@endsection