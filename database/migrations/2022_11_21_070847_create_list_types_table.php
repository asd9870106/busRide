<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        DB::table('list_types')->insert(
            array(
                [
                    'id' => '1',
                    'name' => '無障礙'
                ],
                [
                    'id' => '2',
                    'name' => '孕婦'
                ],
                [
                    'id' => '3',
                    'name' => '年長者'
                ],
                [
                    'id' => '4',
                    'name' => '行動不便'
                ],
                [
                    'id' => '5',
                    'name' => '身心障礙'
                ],
                [
                    'id' => '6',
                    'name' => '幼童'
                ],
                [
                    'id' => '7',
                    'name' => '無'
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_types');
    }
};
