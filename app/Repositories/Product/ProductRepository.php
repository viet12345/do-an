<?php

namespace App\Repositories\Product;

use App\Products;
use App\Repositories\BaseRopository;

class ProductRepository extends BaseRopository
{
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Products::class;
    }

    public function addOrSubNumber($id, $old_number, $number,$price, $type)
    {
        $product = $this->find($id);
        if($type == ADD){
            $product->increment('qty_pro', $qty_pro);
        }
        else{
            $product->increment('qty_pro', $number - $old_number);
        }
        $oldPrice = $product->unit_price;
        if($oldPrice != $price){
            $product->update([
                'unit_price' => $price,
                'promotion_price' => 0
            ]);
        }
    }
}
