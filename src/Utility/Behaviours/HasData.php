<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

use Nip\Collections\Collection;

/**
 *
 */
trait HasData
{
    protected Collection|null $data = null;

    public function setDataFromArray(array $data): void
    {
        foreach ($data as $k => $v) {
            $this->setDataItem($k, $v);
        }
    }

    /**
     * @param string $key
     * @param $value
     * @return HasData|self
     */
    public function setDataItem(string $key, $value): self
    {
        $this->checkData()
            ->set($key, $value);
        return $this;
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function getDataItem(string $key, $default = null): mixed
    {
        return $this->checkData()->get($key, $default);
    }

    public function getData(): Collection
    {
        return $this->checkData();
    }

    protected function checkData(): ?Collection
    {
        if (!isset($this->data)) {
            $this->data = new Collection([]);
        }
        return $this->data;
    }

}
