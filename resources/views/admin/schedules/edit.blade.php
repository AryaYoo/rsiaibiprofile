@extends('layouts.admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Edit Jadwal Layanan</h2>
        <p class="text-sm text-gray-500 mt-1">Perbarui jadwal praktek dokter atau layanan</p>
    </div>
    <a href="{{ route('admin.schedules.index') }}" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-3xl">
    <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Doctor Name -->
            <div>
                <label for="doctor_name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Dokter / Tenaga Medis <span class="text-red-500">*</span></label>
                <input type="text" name="doctor_name" id="doctor_name" value="{{ old('doctor_name', $schedule->doctor_name) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-shadow">
                @error('doctor_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Specialty -->
            <div>
                <label for="specialty" class="block text-sm font-semibold text-gray-700 mb-2">Poliklinik / Spesialisasi</label>
                <input type="text" name="specialty" id="specialty" value="{{ old('specialty', $schedule->specialty) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-shadow">
                @error('specialty') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Day -->
                <div>
                    <label for="day" class="block text-sm font-semibold text-gray-700 mb-2">Hari Praktek <span class="text-red-500">*</span></label>
                    <input type="text" name="day" id="day" value="{{ old('day', $schedule->day) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-shadow">
                    @error('day') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Time -->
                <div>
                    <label for="time" class="block text-sm font-semibold text-gray-700 mb-2">Jam Praktek <span class="text-red-500">*</span></label>
                    <input type="text" name="time" id="time" value="{{ old('time', $schedule->time) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-shadow">
                    @error('time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Foto Dokter (Opsional)</label>
                
                @if($schedule->image)
                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-2">Foto Saat Ini:</p>
                    <img src="{{ asset('storage/' . $schedule->image) }}" alt="Current Image" class="h-32 w-32 object-cover rounded-lg border border-gray-200">
                </div>
                @endif

                <div class="flex items-center justify-center w-full">
                    <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                            <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk ganti foto</span> atau drag and drop</p>
                            <p class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah foto saat ini.</p>
                        </div>
                        <input id="image" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
                    </label>
                </div>
                <div id="image-preview-container" class="mt-4 hidden">
                    <p class="text-sm text-gray-500 mb-2">Preview Foto Baru:</p>
                    <img id="image-preview" class="h-32 w-32 object-cover rounded-lg border border-gray-200" src="#" alt="Preview" />
                </div>
                @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $schedule->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500">
                <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">Jadwal Aktif / Ditampilkan</label>
            </div>
        </div>

        <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-lg font-semibold transition-colors flex items-center">
                <i class="fas fa-save mr-2"></i> Perbarui Jadwal
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const container = document.getElementById('image-preview-container');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            container.classList.add('hidden');
        }
    }
</script>
@endsection
