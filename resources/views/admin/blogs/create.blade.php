@extends('admin.dashboard')

@section('contents')
    <section class="bg-gray-50 dark:bg-gray-900 p-4 sm:p-6">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">
                ✏️ Thêm bài viết mới
            </h2>

            <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Tiêu đề -->
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                        Tiêu đề bài viết
                    </label>
                    <input type="text" name="title"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-primary-500 focus:border-primary-500 
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5"
                        placeholder="Nhập tiêu đề..." required>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                        Ảnh Thumbail
                    </label>
                </div>
                <div class="flex items-center sm:col-span-2 justify-center w-full">
                    <label for="dropzone-file"
                        class="relative flex items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium overflow-hidden">
                        <!-- Nội dung mặc định -->
                        <div id="dropzone-preview"
                            class="flex flex-col items-center justify-center text-body pt-5 pb-6 absolute inset-0">
                            <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24" id="dropzone-icon">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>

                        <input id="dropzone-file" type="file" name ="image" class="hidden" accept="image/*" />
                    </label>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                        Chọn danh mục
                    </label>

                    <select name="category_id"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-primary-500 focus:border-primary-500 
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5">

                        @foreach ($categories as $cate)
                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                        Trạng thái
                    </label>

                    <select name="status"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-primary-500 focus:border-primary-500
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5">

                        <option value="1" selected>Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>

                <!-- Nội dung -->
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                        Nội dung bài viết
                    </label>

                    <textarea name="content" rows="6"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-primary-500 focus:border-primary-500 
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3"
                        placeholder="Nhập nội dung..." required></textarea>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="px-5 py-2.5 text-white bg-primary-600 hover:bg-primary-700 
                focus:ring-4 focus:ring-primary-300 rounded-lg text-sm font-medium
                dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-900">
                    💾 Lưu bài viết
                </button>
            </form>
        </div>
    </section>
@endsection
