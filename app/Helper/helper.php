<?php

if (!function_exists('format_price')) {
    /**
     * Format số thành VNĐ, ví dụ 199000 => 199.000₫
     */
    function format_price($price) {
        return number_format($price, 0, ',', '.') . '₫';
    }
}
