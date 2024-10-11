<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAttendancesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('attendances');
    }

    public function down()
    {
        // You could define how to recreate the table here if necessary
    }
}
