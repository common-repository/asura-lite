<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateLogActivitySettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('logactivity.enabled', false);
        $this->migrator->add('logactivity.visible', false);
    }
}
