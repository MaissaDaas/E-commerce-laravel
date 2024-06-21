<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Product; 
use App\Models\Order; 

class DashbordController extends Controller
{

    private function calculatePercentage($total, $goal)
    {
        return ($total / $goal) * 100;
    }

    public function showdashbord()
    {
        $totalCategories = Category::count();
        // $totalProducts = Product::count();
        $totalOrders = Order::count();
        $goal = 100;

        $categoryPercentage = $this->calculatePercentage($totalCategories, $goal);
        // $productPercentage = $this->calculatePercentage($totalProducts, $goal);
        $orderPercentage = $this->calculatePercentage($totalOrders, $goal);

        return view('dashbord.dashbord', compact('totalCategories', 'categoryPercentage',  'totalOrders', 'orderPercentage'));
    }
}
