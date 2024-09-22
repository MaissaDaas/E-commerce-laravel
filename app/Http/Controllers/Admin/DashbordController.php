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
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $goal = 100;

        $productsInStock = Product::where('in_stock', 1)->count();
        $productsOutOfStock = Product::where('in_stock', 0)->count();

        $categoryPercentage = $this->calculatePercentage($totalCategories, $goal);
        $productPercentage = $this->calculatePercentage($totalProducts, $goal);
        $orderPercentage = $this->calculatePercentage($totalOrders, $goal);
        $inStockPercentage = $this->calculatePercentage($productsInStock, $goal);
        $outOfStockPercentage = $this->calculatePercentage($productsOutOfStock, $goal);

        // Count orders by status
        $statuses = ['new', 'processing', 'shipped', 'delivered', 'canceled'];
        $orderCountsByStatus = [];
        foreach ($statuses as $status) {
            $orderCountsByStatus[$status] = Order::where('status', $status)->count();
        }

        $orderStatusCounts = Order::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('dashbord.dashbord', 
            compact('totalCategories', 
            'categoryPercentage', 
            'totalProducts', 
            'productPercentage',  
            'totalOrders', 
            'orderPercentage' , 
            'productsInStock',
            'productsOutOfStock',
            'inStockPercentage',
            'outOfStockPercentage',
            'orderCountsByStatus',
            'orderStatusCounts',
        ));
    }
}
