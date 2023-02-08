<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = "bill_detail";
    protected $fillable = ['id_bill', 'id_product', 'qty', 'size', 'price'];
    public function product()
    {
        return $this->belongsTo('App\Products', 'id_product', 'id');
    }
    public function bill()
    {
        return $this->belongsTo('App\Bill', 'id_bill', 'id');
    }
    public function updateProductOrder($requset)
    {

        $qty_pro_order_update = $requset->qty_pro_order_update;
        $id_pro_order_update = $requset->id_pro_order_update;
        $id_bill_update = $requset->id_bill_update;
        $this->where('id_bill', $id_bill_update)->where('id_product', $id_pro_order_update)->update([
            'qty' => $qty_pro_order_update,
        ]);
        $details = Bills::where('bills.id', $id_bill_update)
            ->join('bill_detail', 'bill_detail.id_bill', '=', 'bills.id')
            ->join('products', 'products.id', '=', 'bill_detail.id_product')
            ->get();
        $total = 0;
        foreach ($details as $detail) {
            $total += $detail->qty * $detail->price;
        }
        Bills::where('id', $id_bill_update)->update([
            'total' => $total,
        ]);

    }

    public function saveInfo($billId, $value)
    {
        $this->create([
            'id_bill' => $billId,
            'id_product' => $value->id,
            'qty' => $value->qty,
            'size' => $value->options->size,
            'price' => $value->price,
        ]);
    }
}
