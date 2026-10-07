<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
        $table->string('no_telp')->nullable(); // Add the phone number column
        $table->string('alamat')->nullable(); // Add the address column
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Add a staff account with a phone number and address
        DB::table('users')->insert([
            [
                'name' => 'Ferdy',
                'email' => 'ferdy@gmail.com',
                'password' => Hash::make('12345678'),
                'no_telp' => '0882007203515',
                'alamat' => 'Jl. Srikaloka No.547',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mado',
                'email' => 'mado@gmail.com',
                'password' => Hash::make('12345678'),
                'no_telp' => '081234567891',
                'alamat' => 'Jl. Raya Tajem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rio',
                'email' => 'rio@gmail.com',
                'password' => Hash::make('12345678'),
                'no_telp' => '081234567811',
                'alamat' => 'Jl. Bringin No.31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juliano',
                'email' => 'juliano@gmail.com',
                'password' => Hash::make('12345678'),
                'no_telp' => '081234567800',
                'alamat' => 'Jl. Paingan No.4',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Add a manager account
        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('12345678'),
            'no_telp' => '081385613704',
            'alamat' => 'Jl. Sengkan No.22',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
