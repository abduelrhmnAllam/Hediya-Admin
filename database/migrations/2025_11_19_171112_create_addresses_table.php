<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            // 🔗 ربط العنوان بالمستخدم
            $table->unsignedBigInteger('user_id');

            // 🏷️ نوع العنوان
            $table->enum('type', ['home', 'work', 'other'])->default('home');

            // 🏷️ اسم العنوان
            $table->string('label')->nullable(); // مثال: "شقة عمي"، "مكتب العمل"

            // 👤 بيانات المستلم
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone')->nullable();

            // 🌍 تفاصيل البلد والموقع
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
            $table->string('postal_code')->nullable();

            // 🧭 إرشادات ومعالم قريبة
            $table->text('directions')->nullable();
            $table->string('nearby_landmark')->nullable();

            // 📍 إحداثيات الخريطة
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            // ⭐ هل هذا هو العنوان الافتراضي؟
            $table->boolean('is_default')->default(false);

            $table->timestamps();

            // 🔗 FK
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
