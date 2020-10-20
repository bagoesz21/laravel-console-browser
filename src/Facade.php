<?php

namespace Bagoesz21\ConsoleBrowser;

use DebugBar\DataCollector\DataCollectorInterface;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Console::class;
    }
}
