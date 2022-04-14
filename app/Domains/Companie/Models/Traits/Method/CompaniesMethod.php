<?php

namespace App\Domains\Companie\Models\Traits\Method;

/**
 * Trait CompaniesMethod.
 */
trait CompaniesMethod
{
    /**
     * @return string|null
     */
    public function getLogo()
    {
        if (isset($this->logo) && $this->logo !== null) {
            if ($result = $this->getFile($this->logo)) {
                return $result;
            }
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getBanner()
    {
        if (isset($this->banner) && $this->banner !== null) {
            if ($result = $this->getFile($this->banner)) {
                return $result;
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public function getPictures()
    {
        if (isset($this->pictures) && $this->pictures !== null) {
            $data = [];
            foreach ($this->pictures as $picture) {
                if ($result = $this->getFile($picture)) {
                    array_push($data, $result);
                }
            }
        }

        return $data;
    }

    /**
     * @param array $file
     *
     * @return string
     */
    protected function getFile($file)
    {
        if (isset($file['imgur']) && $file['imgur'] !== null) {
            return $file['imgur'];
        }

        if (isset($file['storage']) && $file['storage'] !== null) {
            return asset('storage/' . $file['storage']);
        }

        if (isset($file['local']) && $file['local'] !== null) {
            return asset($file['local']);
        }

        return false;
    }
}
