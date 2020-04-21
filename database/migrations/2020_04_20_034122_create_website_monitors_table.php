<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_monitors', function (Blueprint $table) {
            $table->id();

            $table->mediumText('url');
            $table->text('date_selector');
            $table->text('content_selector');
            $table->enum('status', ['new', 'updated', 'ok'])->default('new');
            $table->dateTime('source_updated_at');
            $table->longText('page_content');
            $table->longText('page_content_previous')->nullable();
            $table->timestamp('crawled_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_monitors');
    }
}
