<?php

namespace Tests\Feature;

use App\Providers\Filament\AdminPanelProvider;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Tests\TestCase;

class AdminPanelProviderTest extends TestCase
{
    public function test_admin_panel_is_registered_as_the_default_panel(): void
    {
        $panel = Filament::getPanel('admin');

        $this->assertSame('admin', $panel->getId());
        $this->assertSame('admin', $panel->getPath());
        $this->assertTrue($panel->isDefault());
        $this->assertTrue($panel->hasLogin());
    }

    public function test_admin_panel_registers_dashboard_page_and_default_widgets(): void
    {
        $panel = Filament::getPanel('admin');

        $this->assertContains(Dashboard::class, $panel->getPages());
        $this->assertContains(AccountWidget::class, $panel->getWidgets());
        $this->assertContains(FilamentInfoWidget::class, $panel->getWidgets());
    }

    public function test_provider_is_loaded_by_the_application(): void
    {
        $this->assertNotNull($this->app->getProvider(AdminPanelProvider::class));
    }

    public function test_admin_login_page_is_reachable(): void
    {
        $this->get('/admin/login')->assertOk();
    }
}
