@extends('admin.dashboard')

@section('contents')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto px-5 lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Thêm mới mã giảm giá</h2>
            <form action="{{ route('voucher.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">

                    <div class="sm:col-span-1">
                        <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Code giảm giá
                        </label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                        dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="VD: SALE2025" required>
                        @error('code')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tên mã giảm giá
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                        dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="VD: Giảm giá cuối năm" required>
                        @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Loại giảm
                        </label>
                        <select id="type" name="type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="percent">Giảm %</option>
                            <option value="amount">Giảm tiền</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Giá giảm (0-100 cho %)
                        </label>
                        <input type="number" name="value" id="value" value="{{ old('value') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 10 hoặc 50000" required>
                        @error('value')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="usage_limit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Giới hạn số lượng sử dụng
                        </label>
                        <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 100" required>
                        @error('usage_limit')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="max_discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Giảm tối đa (optional)
                        </label>
                        <input type="number" name="max_discount" id="max_discount" value="{{ old('max_discount') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 50000">
                        @error('max_discount')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="min_order_value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Giá tối thiểu để áp dụng mã giảm
                        </label>
                        <input type="number" name="min_order_value" id="min_order_value"
                            value="{{ old('min_order_value') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 200000" required>
                        @error('min_order_value')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Ngày bắt đầu
                        </label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                        @error('start_date')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Ngày kết thúc
                        </label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                        @error('end_date')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-6 text-sm font-medium text-center text-white 
                bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-200 
                dark:focus:ring-primary-900">
                    Tạo mã giảm giá
                </button>
            </form>
        </div>
    </section>
    <script>
        const typeSelect = document.getElementById('type');
        const valueInput = document.getElementById('value');
        const maxDiscountInput = document.getElementById('max_discount');

        function handleTypeChange() {
            if (typeSelect.value === 'amount') {
                // Nếu là tiền, max_discount không được sửa
                maxDiscountInput.disabled = true;
                maxDiscountInput.value = ''; // optional: xóa giá trị
            } else {
                maxDiscountInput.disabled = false;
            }
        }

        typeSelect.addEventListener('change', handleTypeChange);

        // chạy lần đầu khi load trang
        handleTypeChange();
    </script>
@endsection
