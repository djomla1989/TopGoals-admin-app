<?php

namespace App\Services\DefaultData\Icon;

use Illuminate\Database\Eloquent\Model;

class DefaultIconProvider implements DefaultIconProviderInterface
{
    const DEFAULT_ICON_ROOT_PATH = 'images/';
    private DefaultIconStrategyFactoryInterface $factory;

    public function __construct(DefaultIconStrategyFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function getDefaultIcon(Model $model): ?string
    {
        $strategy = $this->factory->getStrategyForModel($model);

        $imagePath = $strategy->getDefaultIcon($model);

        if (empty($imagePath)) {
            return null;
        }

        return self::DEFAULT_ICON_ROOT_PATH . $imagePath;
    }
}
