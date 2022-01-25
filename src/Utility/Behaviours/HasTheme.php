<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasTheme
{
    /**
     * The card theme (light, dark, primary, secondary, info, success,
     * warning, danger or any other AdminLTE color like lighblue or teal).
     *
     * @var string
     */
    public $theme;


    /**
     * @param string $theme
     */
    public function withTheme(string $theme): self
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * The theme mode (full or outline).
     *
     * @var string
     */
    public $themeMode;

    public function themePrimary(): self
    {
        return $this->withTheme('primary');
    }

    public function themeSecondary(): self
    {
        return $this->withTheme('secondary');
    }

    public function themeSuccess(): self
    {
        return $this->withTheme('success');
    }

    public function themeInfo(): self
    {
        return $this->withTheme('info');
    }

    public function themeWarning(): self
    {
        return $this->withTheme('warning');
    }

    public function themeDanger(): self
    {
        return $this->withTheme('danger');
    }

    public function themeLight(): self
    {
        return $this->withTheme('light');
    }

    public function themeDark(): self
    {
        return $this->withTheme('dark');
    }

    public function themeModeFull(): self
    {
        return $this->withThemeMode('full');
    }

    /**
     * @param string $themeMode
     */
    public function withThemeMode(string $themeMode): self
    {
        $this->themeMode = $themeMode;
        return $this;
    }

    public function themeModeOutline(): self
    {
        return $this->withThemeMode('outline');
    }
}