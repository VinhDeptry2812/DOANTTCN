@extends('admin.dashboard')

@section('contents')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto px-5 lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Thêm danh mục mới</h2>
            <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên danh
                            mục</label>
                        <input type="text" name="name" id="name" value="{{ $category->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type category name" required="">
                        @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô
                            tả</label>
                        <textarea id="description" name="decription" rows="5"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your description here">{{ $category->decription }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2 ">
                        <div class="mt-2 ">
                            @if ($category->image)
                                <label for="oldImage"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ảnh cũ</label>
                                <div id="oldImage" class="relative w-24 h-24">
                                    <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Current Image"
                                        class="w-24 h-24 object-cover rounded-lg border " />
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Chưa có hình ảnh</p>
                            @endif


                        </div>
                    </div>


                    <div class="" x-data="{ images: [] }">
                        <!-- icons -->
                        <div class="icons flex text-gray-500 mb-7">
                            <label id="select-image" class="text-body bg-neutral-secondary-medium box-border 
                            border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading 
                            focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-lg 
                            text-sm px-4 py-2.5 focus:outline-none">    
                                Đổi ảnh khác
                                    


                                <input name="image" hidden type="file" multiple
                                    @change="images = Array.from($event.target.files).map(file => ({url: URL.createObjectURL(file), name: file.name, preview: ['jpg', 'jpeg', 'png', 'gif'].includes(file.name.split('.').pop().toLowerCase()), size: file.size > 1024 ? file.size > 1048576 ? Math.round(file.size / 1048576) + 'mb' : Math.round(file.size / 1024) + 'kb' : file.size + 'b'}))"
                                    x-ref="fileInput">

                            </label>
                        </div>

                        <!-- Preview image here -->
                        <div id="preview" class="my-4 flex">
                            <template x-for="(image, index) in images" :key="index">
                                <div class="relative w-32 h-32 object-cover rounded ">
                                    <div x-show="image.preview" class="relative w-24 h-24 object-cover rounded">
                                        <img :src="image.url" class="w-24 h-24 object-cover rounded">
                                        <button @click="images.splice(index, 1)"
                                            class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span
                                                class="mx-auto">×</span></button>
                                        <div x-text="image.size" class="text-xs text-center p-2"></div>
                                    </div>
                                    <div x-show="!image.preview" class="relative w-32 h-32 object-cover rounded">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-white stroke-indigo-500" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg> -->
                                        <svg class="fill-current  w-32 h-32 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                                        </svg>
                                        <button @click="images.splice(index, 1)"
                                            class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span
                                                class="mx-auto">×</span></button>
                                    </div>

                                </div>
                            </template>
                        </div>
                    </div>



                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Edit
                </button>
                <a href="{{ route('categories.index') }}"
                    class="text-red-600 hover:cursor-pointer inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">

                    Back
                </a>
            </form>
        </div>
    </section>
@endsection
