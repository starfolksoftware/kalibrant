<?php

namespace StarfolkSoftware\Setting\Contracts;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Support\Responsable;
use StarfolkSoftware\Setting\Settings;
use Symfony\Component\HttpFoundation\Response;

interface RendersResponse
{
    public function redirect(
        Settings $settings
    ): Response | Responsable | Renderable;

    public function redirectWithError(
        Settings $settings,
        ?string $error = null
    ): Response | Responsable | Renderable;
}