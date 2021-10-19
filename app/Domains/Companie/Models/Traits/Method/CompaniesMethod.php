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
            $data = array();
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
        if (isset($this->file['imgur']) && $this->file['imgur'] !== null) {
            return $this->file['imgur'];
        }

        if (isset($this->file['storage']) && $this->file['storage'] !== null) {
            return asset('storage/' . $this->file['storage']);
        }

        if (isset($this->file['local']) && $this->file['local'] !== null) {
            return asset($this->file['local']);
        }

        return false;
    }
}
