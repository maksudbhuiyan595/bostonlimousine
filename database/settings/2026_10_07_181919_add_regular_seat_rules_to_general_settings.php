<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.regular_Seat_rules', 0);
    }

    public function down(): void
    {
        $this->migrator->delete('general.regular_Seat_rules');
    }
};
