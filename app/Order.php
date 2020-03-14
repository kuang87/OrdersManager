<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('quantity');
    }

    public function totalPrice()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->pivot->quantity * $product->price;
        }
        return $total;

    }

    public function status($all = false)
    {
        if ($all){
            return [
                '0' => 'new',
                '10' => 'confirmed',
                '20' => 'finished'
            ];
        }
        else{
            switch ($this->status){
                case 0:
                    return 'new';
                case 10:
                    return 'confirmed';
                case 20:
                    return 'finished';
            }
        }
    }
}
