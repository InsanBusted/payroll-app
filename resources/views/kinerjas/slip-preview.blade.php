<x-app-layout>
    <x-slot name="title">Preview Slip Gaji</x-slot>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">

        @include('kinerjas.slip-content')

        <div class="mt-6">
            <a href="{{ route('kinerjas.slip.download', $kinerja->id) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                Download PDF
            </a>
        </div>

    </div>

</x-app-layout>
