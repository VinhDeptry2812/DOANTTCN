@extends('admin.dashboard')

@section('contents')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto px-5 lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new Voucher</h2>
            <form action="{{route('voucher.store')}}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">

                    <div class="sm:col-span-1">
                        <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Voucher Code
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
                            Voucher Name
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
                            Discount Type
                        </label>
                        <select id="type" name="type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="percent">Giảm %</option>
                            <option value="amount">Giảm tiền</option>
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Discount Value
                        </label>
                        <input type="number" name="value" id="value" value="{{ old('value') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 10 hoặc 50000" required>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="usage_limit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Usage Limit
                        </label>
                        <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 100" required>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="max_discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Max Discount (optional)
                        </label>
                        <input type="number" name="max_discount" id="max_discount" value="{{ old('max_discount') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 50000">
                    </div>

                    <div class="sm:col-span-1">
                        <label for="min_order_value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Min Order Value
                        </label>
                        <input type="number" name="min_order_value" id="min_order_value"
                            value="{{ old('min_order_value') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 200000" required>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Start Date
                        </label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            End Date
                        </label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                    </div>

                </div>

                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-6 text-sm font-medium text-center text-white 
                bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-200 
                dark:focus:ring-primary-900">
                    Create Voucher
                </button>
            </form>
        </div>
    </section>
@endsection
