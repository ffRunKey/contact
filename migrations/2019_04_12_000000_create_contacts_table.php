<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->integer('user_id')->unsigned();
			$table->integer('modified_user_id')->unsigned();
			$table->string('work_company', 200);
			$table->string('department', 100);
			$table->string('work_qq', 100);
			$table->string('phone_mobile', 100);
			$table->string('primary_address', 200);
            $table->timestamps();
            $table->timestamp('removed_at')->nullable();	

            $table->unique(['user_id']);			

        });
    },
    'down' => function (Builder $schema) {
        $schema->drop('contacts');
    },
];

