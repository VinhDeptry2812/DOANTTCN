@extends('admin.dashboard')

@section('contents')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto px-5 lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Chỉnh sửa banner</h2>
            <form action="{{ route('banner.update', ['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    {{-- Vi tri --}}
                    <div class="sm:col-span-2">
                        <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vị
                            trí</label>
                        <select id="position" name="position" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="header-top" {{ $banner->position == 'header-top' ? 'selected' : '' }}>Header-top
                            </option>
                            <option value="middle-1" {{ $banner->position == 'middle-1' ? 'selected' : '' }}>Middle-1
                            </option>
                            <option value="middle-2" {{ $banner->position == 'middle-2' ? 'selected' : '' }}>Middle-2
                            </option>
                            <option value="middle-3" {{ $banner->position == 'middle-3' ? 'selected' : '' }}>Middle-3
                            </option>
                        </select>
                        @error('position')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Trang thai --}}
                    <div class="sm:col-span-2">
                        <label for="status" class="block mb-2.5 text-sm font-medium text-heading">Cài đặt trạng
                            thái</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                            <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Hinh anh --}}
                    <div class="flex items-center sm:col-span-2 justify-center w-full">
                        <label for="dropzone-file"
                            class="relative flex items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium overflow-hidden">

                            <!-- Nội dung mặc định -->
                            <div id="dropzone-preview"
                                class="flex flex-col items-center justify-center text-body pt-5 pb-6 absolute inset-0">
                                @if ($banner->image)
                                    {{-- Hiển thị ảnh cũ  --}}
                                    <img src="{{ asset($banner->image) }}"
                                        class="absolute inset-0 w-full h-full object-contain bg-white" />
                                @else
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24" id="dropzone-icon">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and
                                        drop
                                    </p>
                                    <p class="text-xs">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                @endif
                            </div>

                            <input id="dropzone-file" type="file" name ="image" class="hidden" accept="image/*" />
                        </label>


                    </div>
                    <button type="submit"
                        class="inline-flex cursor-pointer items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Lưu
                    </button>
                </div>

            </form>
        </div>

    </section>
@endsection
