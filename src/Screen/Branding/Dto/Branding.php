<?php

namespace ByTIC\AdminBase\Screen\Branding\Dto;

/**
 *
 */
class Branding
{
    protected $name = 'Admin';

    protected $logo = null;

    protected $section;

    public function __construct()
    {
        if (function_exists('config') && app()->has('config')) {
            $this->name = config('app.name', 'Admin');
        }
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

    public function getSection()
    {
        if (!isset($this->section)) {
            $this->section = $this->generateSection();
        }
        return $this->section;
    }

    protected function generateSection()
    {
        if (!function_exists('app')) {
            return null;
        }
        if (false == app()->has('mvc.sections')) {
            return null;
        }
        return app('mvc.sections')->getCurrent();
    }
}
