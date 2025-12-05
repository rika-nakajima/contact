<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
        $table->id();
        $table->string('name', 8);              // お名前（最大8文字）
        $table->tinyInteger('gender');          // 性別（1:男性, 2:女性, 3:その他）
        $table->string('email');                // メールアドレス
        $table->string('tel', 11);               // 電話番号（最大5桁）
        $table->string('address');              // 住所
        $table->unsignedInteger('category_id'); // お問い合わせの種類
        $table->string('message', 120);         // お問い合わせ内容（最大120文字）
        
        $table->timestamps();                   // created_at / updated_at
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
}
