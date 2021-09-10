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
    public function getConfig()
    {
        if ($this->config !== null) {
            return $this->config;
        }

        return array();
    }

    /**
     * @return string
     */
    public function getConfigName()
    {
        return property_exists($this, 'configName') ? $this->configName : 'config';
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function setConfig(array $data)
    {
        $config = $this->config;
        $result = array_merge($config, $data);
        $this->config = $result;

        return $this->save();
    }

    /**
     * Use Laravel bootable traits.
     */
    protected static function bootConfig()
    {
        static::creating(function ($model) {
            if (!$model->{$model->getConfigName()}) {
                $model->{$model->getConfigName()} = '{}';
            }
        });
    }
}
