<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('types')->insert([
                    [
                        'id' => 1,
                        'name' => 'Книга',
                    ],
                    [
                        'id' => 2,
                        'name' => 'Статья',
                    ],
                    [
                        'id' => 3,
                        'name' => 'Видео',
                    ],
                    [
                        'id' => 4,
                        'name' => 'Сайт/Блог',
                    ],
                    [
                        'id' => 5,
                        'name' => 'Подборка',
                    ],
                    [
                        'id' => 6,
                        'name' => 'Ключевые идеи книги',
                    ],
                ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
