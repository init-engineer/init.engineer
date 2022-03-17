<?php

namespace App\Models\Traits;

/**
 * Trait Config.
 */
trait Config
{
    /**
     * @return array
     */
    public function getConfig(): array
    {
        if ($this->config !== null) {
            return $this->config;
        }

        return [];
    }

    /**
     * @return string
     */
    public function getConfigName(): string
    {
        return property_exists($this, 'configName') ? $this->configName : 'config';
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function setConfig(array $data): bool
    {
        $config = $this->config;
        $result = array_merge($config, $data);
        $this->config = $result;

        return $this->save();
    }

    /**
     * Use Laravel bootable traits.
     *
     * @return void
     */
    protected static function bootConfig(): void
    {
        static::creating(function ($model) {
            if (!$model->{$model->getConfigName()}) {
                $model->{$model->getConfigName()} = [];
            }
        });
    }
}
