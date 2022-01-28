<?php

namespace ByTIC\AdminBase\Screen\Branding\Dto;

/**
 *
 */
class Branding
{
    protected $name = 'Admin';

    protected $logo = null;

    public function __construct()
    {
        $this->name = config('app.name', 'Admin');
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Branding
     */
    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param null $logo
     * return Branding
     */
    public function withLogo($logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    public function hasLogo(): bool
    {
        return !empty($this->logo);
    }
}
