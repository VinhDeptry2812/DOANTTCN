@extends('component.mainlayout')
@section('title', 'Giỏ hàng')
@section('content')
    {{-- MAIN CONTENT: GIỎ HÀNG --}}
    <main class="pt-15">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-10 py-8">

            {{-- breadcrumb + title --}}
            <div class="mb-6">
                <nav class="text-xs text-gray-500 mb-1">
                    <a href="{{ url('/') }}" class="hover:underline">Trang chủ</a>
                    <span class="mx-1">/</span>
                    <span>Giỏ hàng</span>
                </nav>
                <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 uppercase">
                    Giỏ hàng của bạn
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kiểm tra lại sản phẩm trước khi đặt hàng.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- DANH SÁCH SẢN PHẨM --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
                    @if (count($cartItems) === 0)
                        <div class="p-6 text-center text-gray-500">
                            Giỏ hàng của bạn đang trống.
                            <a href="{{ url('/') }}" class="text-[#ff9b0d] font-semibold hover:underline ml-1">
                                Mua sắm ngay
                            </a>
                        </div>
                    @else
                        {{-- header row --}}
                        <div class="px-4 py-3 border-b border-gray-100 hidden md:flex text-xs font-semibold text-gray-500">
                            <div class="w-2/5">SẢN PHẨM</div>
                            <div class="w-1/5 text-center">GIÁ</div>
                            <div class="w-1/5 text-center">SỐ LƯỢNG</div>
                            <div class="w-1/5 text-right">THÀNH TIỀN</div>
                        </div>

                        <div>
                            @foreach ($cartItems as $item)
                                <div id="item-{{ $item['id'] }}"
                                    class=".cart-item-row px-4 py-4 border-b border-gray-100 flex flex-col md:flex-row items-center md:items-stretch gap-3">
                                    {{-- ảnh + info --}}
                                    <div class="w-full md:w-2/5 flex">
                                        <div
                                            class="w-20 h-24 flex-shrink-0 rounded border border-gray-200 overflow-hidden bg-gray-50">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div class="ml-3 flex flex-col justify-between">
                                            <div>
                                                <h3 class="text-sm font-semibold text-gray-800">
                                                    {{ $item['name'] }}
                                                </h3>
                                                {{-- <p class="text-xs text-gray-500 mt-1">
                                                    Màu: <span class="font-medium">{{ $item['color'] ?? '—' }}</span> ·
                                                    Size: <span class="font-medium">{{ $item['size'] ?? '—' }}</span>
                                                </p> --}}
                                            </div>
                                            <button class="remove-item text-xs text-red-500" data-id="{{ $item['id'] }}">
                                                Xoá khỏi giỏ
                                            </button>

                                        </div>
                                    </div>

                                    {{-- giá --}}
                                    <div class="w-full md:w-1/5 text-center text-sm font-semibold text-gray-800">
                                        {{ format_price($item['discount_price']) }}
                                    </div>

                                    {{-- số lượng --}}
                                    <div class="w-full md:w-1/5 flex justify-center">
                                        <div
                                            class="inline-flex items-center border border-gray-300 rounded-full overflow-hidden bg-white">
                                            <button class="qty-minus px-3 py-2 text-lg font-semibold hover:bg-gray-100"
                                                data-id="{{ $item['id'] }}">
                                                -
                                            </button>

                                            <input id="qty-{{ $item['id'] }}" value="{{ $item['quantity'] }}" readonly
                                                class="w-12 text-center outline-none border-l border-r border-gray-200 py-2">

                                            <button class="qty-plus px-3 py-2 text-lg font-semibold hover:bg-gray-100"
                                                data-id="{{ $item['id'] }}">
                                                +
                                            </button>
                                        </div>
                                    </div>


                                    {{-- thành tiền --}}
                                    <div id="total-{{ $item['id'] }}">
                                        {{ format_price($item['discount_price'] * $item['quantity']) }}
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- TÓM TẮT ĐƠN HÀNG --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-5 h-fit">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 uppercase">
                        Thông tin đơn hàng
                    </h2>

                    <div class="space-y-2 text-sm text-gray-700">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span id="subtotal">{{ format_price($subtotal) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Phí vận chuyển</span>
                            <span id="ship">{{ $ship > 0 ? format_price($ship) : '—' }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-2 mt-2 flex justify-between text-base font-bold">
                            <span>Tổng cộng</span>
                            <span id="total">{{ format_price($total) }}</span>
                        </div>
                    </div>

                    <p class="mt-3 text-xs text-gray-500">
                        Bằng việc đặt hàng, bạn đồng ý với
                        <a href="#" class="text-[#ff9b0d] hover:underline">Chính sách mua hàng</a>
                        của YODY.
                    </p>

                    <a href="{{ route('checkout.index') }}">
                        <button
                            class="mt-4 w-full py-3 rounded-full bg-[#ff9b0d] hover:bg-[#f79400] text-white font-semibold text-sm uppercase tracking-wide"
                            type="button">
                            Tiến hành đặt hàng
                        </button>
                    </a>

                    <a href="{{ url('/') }}" class="mt-2 block text-center text-xs text-gray-500 hover:underline">
                        ← Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    </main>

    {{-- Xu li tang giam so luong --}}
    <script>
        document.querySelectorAll('.qty-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                updateQty(this.dataset.id, 'plus');
            });
        });

        document.querySelectorAll('.qty-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                updateQty(this.dataset.id, 'minus');
            });
        });

        function updateQty(id, type) {
            fetch("{{ route('cart.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id,
                        type
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // Cập nhật số lượng trên input
                    document.querySelector(`#qty-${id}`).value = data.qty;

                    // Cập nhật thành tiền của từng SP
                    document.querySelector(`#total-${id}`).innerText =
                        new Intl.NumberFormat().format(data.qty * data.item_price) + "₫";

                    // Cập nhật tạm tính
                    document.querySelector('#subtotal').innerText =
                        new Intl.NumberFormat().format(data.subtotal) + "₫";

                    // Cập nhật ship
                    document.querySelector('#ship').innerText =
                        data.ship > 0 ? new Intl.NumberFormat().format(data.ship) + "₫" : "—";

                    // Cập nhật tổng cộng
                    document.querySelector('#total').innerText =
                        new Intl.NumberFormat().format(data.total) + "₫";
                });
        }
    </script>

    {{-- Xu li xoa san pham --}}
    <script>
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                let id = this.dataset.id;

                fetch("{{ route('cart.remove') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id
                        })
                    })
                    .then(res => res.json())
                    .then(data => {

                        // 1. XÓA SẢN PHẨM KHỎI HTML
                        document.querySelector(`#item-${id}`).remove();

                        // 2. UPDATE TỔNG TIỀN
                        document.querySelector('#subtotal').innerText =
                            new Intl.NumberFormat().format(data.subtotal) + "₫";

                        document.querySelector('#ship').innerText =
                            data.ship > 0 ? new Intl.NumberFormat().format(data.ship) + "₫" : "—";

                        document.querySelector('#total').innerText =
                            new Intl.NumberFormat().format(data.total) + "₫";
                    });
            });
        });
    </script>


@endsection
