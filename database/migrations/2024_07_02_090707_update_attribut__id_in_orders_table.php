<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('shipping_method', ['Standard', 'Express', 'Overnight'])->nullable()->change();
            $table->enum('payment_method', [
                'Credit Card', 'Debit Card', 'PayPal', 'Bank Transfer', 'Cash on Delivery (COD)', 'Other'
            ])->nullable()->change();
            $table->enum('payment_status', [
                'Paid', 'Pending', 'Failed', 'Refunded', 'Canceled', 'Authorized', 'Partially Paid'
            ])->default('Pending');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_method')->nullable()->change();
            $table->string('payment_method')->nullable()->change();
            $table->dropColumn('payment_status');
        });
    }
};
