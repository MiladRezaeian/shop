<?php

namespace Modules\Traits;

trait DatabaseSeeders
{
    protected function defineSeeders(): array
    {
        return $this->seedersList;
    }
}
