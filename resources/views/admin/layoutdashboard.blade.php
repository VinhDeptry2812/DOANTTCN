<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>@yield('title')</title>
    <title>Register</title>
</head>

<body class="bg-gray-50 m-0 p-0 h-screen">
    <!-- Toast Message -->
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
            class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded shadow-lg z-50 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-2 text-white hover:text-gray-200">&times;</button>
        </div>
    @endif

    @yield('content')
    <!-- ⚡ Import script Flowbite -->
    <script src="node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    {{-- script de review ảnh khi up từ input dropzone --}}
    <script>
        const input = document.getElementById('dropzone-file');
        const previewContainer = document.getElementById('dropzone-preview');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                // Xóa nội dung cũ
                previewContainer.innerHTML = '';

                // Tạo ảnh
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'absolute top-0 left-0 w-full h-full object-contain';
                // object-contain: ảnh vừa khung, không crop, sẽ có khoảng trống nếu tỉ lệ khác

                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    </script>
    {{-- script upload gallery có preview ảnh --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const wrapper = document.getElementById("gallery-wrapper");

            function createNewDropzone() {
                let clone = wrapper.firstElementChild.cloneNode(true);

                let preview = clone.querySelector(".preview-area");
                let input = clone.querySelector(".gallery-input");

                // Reset preview về trạng thái mặc định
                preview.innerHTML = `
            <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5
                    A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 
                    4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
            </svg>
            <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span></p>
            <p class="text-xs">PNG, JPG, GIF...</p>
        `;

                input.value = "";
                attachPreviewEvent(input);

                wrapper.appendChild(clone);
            }

            function attachPreviewEvent(input) {
                input.addEventListener("change", function(e) {
                    let preview = input.parentElement.querySelector(".preview-area");

                    [...e.target.files].forEach(file => {
                        let reader = new FileReader();

                        reader.onload = evt => {
                            // Ảnh full dropzone
                            preview.innerHTML = `
                        <img src="${evt.target.result}"
                             class="absolute inset-0 w-full h-full object-contain" />
                    `;
                        };

                        reader.readAsDataURL(file);
                    });

                    createNewDropzone();
                });
            }

            attachPreviewEvent(wrapper.querySelector(".gallery-input"));
        });
    </script>
    {{-- Chọn ảnh gallery cho update sp --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const wrapper = document.getElementById('gallery-wrapper');

            function createDropzone() {
                let div = document.createElement("div");
                div.className =
                    "dropzone-item w-28 h-36 relative bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base flex justify-center items-center cursor-pointer overflow-hidden";

                div.innerHTML = `
            <input type="file" name="gallery[]" class="gallery-input hidden" accept="image/*">

            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-2 pointer-events-none">
                <svg class="w-8 h-8 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        d="M12 19V10m0 0l-2 2m2-2 2 2m-9 3h3a3 3 0 010-6h.025a5.5 5.5 0 1110.975.5H17a3 3 0 010 6h-2" />
                </svg>
                <p class="text-xs">Thêm ảnh</p>
            </div>
        `;

                // Gán sự kiện click
                div.addEventListener("click", function() {
                    div.querySelector(".gallery-input").click();
                });

                // Gán sự kiện khi chọn file
                div.querySelector(".gallery-input").addEventListener("change", function(e) {
                    previewImage(e.target, div);
                    wrapper.appendChild(createDropzone()); // tạo ô mới
                });

                return div;
            }

            function previewImage(input, dropzoneDiv) {
                let file = input.files[0];
                if (!file) return;

                let reader = new FileReader();
                reader.onload = function(event) {

                    dropzoneDiv.innerHTML = ""; // clear dropzone

                    let img = document.createElement("img");
                    img.src = event.target.result;
                    img.className = "absolute inset-0 w-full h-full object-contain";

                    dropzoneDiv.appendChild(img);
                };

                reader.readAsDataURL(file);
            }

            // Gán sự kiện cho dropzone mặc định có sẵn trong HTML
            document.querySelectorAll(".dropzone-item").forEach(dz => {
                let input = dz.querySelector(".gallery-input");
                if (!input) return;

                dz.addEventListener("click", () => input.click());

                input.addEventListener("change", function(e) {
                    previewImage(e.target, dz);
                    wrapper.appendChild(createDropzone()); // thêm ô mới
                });
            });
        });

        // Nút xóa
        document.querySelectorAll('.delete-old').forEach(btn => {
            btn.addEventListener('click', function() {
                const wrap = btn.closest('.dropzone-item');
                const input = wrap.querySelector('.delete-input');

                input.disabled = false; // Cho phép gửi id
                wrap.remove(); // Xoá ảnh khỏi giao diện
            });
        });
    </script>


</body>

</html>
