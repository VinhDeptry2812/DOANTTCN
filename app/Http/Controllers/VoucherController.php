<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Http\Requests\VoucherRequestEdit;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.voucher.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.voucher.create');
    }

    public function store(VoucherRequest $req)
    {
        Voucher::create([
            'code'            => $req->code,
            'name'            => $req->name,
            'type'            => $req->type,
            'value'           => $req->value,
            'max_discount'    => $req->max_discount,
            'min_order_value' => $req->min_order_value,
            'usage_limit'     => $req->usage_limit,
            'usage_count'     => 0,
            'start_date'      => $req->start_date,
            'end_date'        => $req->end_date,
            'status'          => 1,
        ]);

        return redirect()->route('voucher.index')->with('success', 'Them voucher thanh cong!');
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.edit', compact('voucher'));
    }

    public function update($id, VoucherRequestEdit $req)
    {
        $voucher = Voucher::findOrFail($id);


        $voucher->update([
            'code'            => $req->code,
            'name'            => $req->name,
            'type'            => $req->type,
            'value'           => $req->value,
            'max_discount'    => $req->max_discount,
            'min_order_value' => $req->min_order_value,
            'usage_limit'     => $req->usage_limit,
            'usage_count'     => 0,
            'start_date'      => $req->start_date,
            'end_date'        => $req->end_date,
            'status'          => $req->status,
        ]);


        return redirect()->route('voucher.index')->with('success', 'Voucher updated successfully!');
    }

    public function delete($id)
    {

        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        return back()->with('success', 'Xoa voucher thanh cong');
    }
}
