<?php

namespace App;

class Cart 
{
    //
    public $foods = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
    	if($oldCart){
    		$this->foods = $oldCart->foods;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;

    	}
    }

    public function add($food, $id)
    {
        $food = Food::findorFail($id);
    	$storedFood = ['qty' => 0, 'harga' => $food->harga, 'food' => $food];
    	if ($this->foods){
    		if (array_key_exists($id, $this->foods)) {
    			$storedFood = $this->foods[$id];
    		}
    	}
    	$storedFood['qty']++;
    	$storedFood['harga'] = $food->harga * $storedFood['qty'];
    	$this->foods[$id] = $storedFood;
    	$this->totalQty++;
    	$this->totalPrice += $food->harga;

    }

    public function reduceByOne($id){
        $this->foods[$id]['qty']--;
        $this->foods[$id]['harga'] -= $this->foods[$id]['food']['harga'];
        $this->totalQty--;
        $this->totalPrice -= $this->foods[$id]['food']['harga'];

        if ($this->foods[$id]['qty'] <= 0) {
            unset($this->foods[$id]);
        }
    }

    public function removeItem($id) {
        $this->totalQty -= $this->foods[$id]['qty'];
        $this->totalPrice -= $this->foods[$id]['harga'];
        unset($this->foods[$id]);
    }

}
