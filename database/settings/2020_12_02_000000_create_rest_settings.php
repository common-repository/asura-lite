<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateRestSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('rest.secure', false);
    }
}
