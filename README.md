# Admin Base

Components for building admin modules

## Features

### Modern UI Theme
- **Modern Color Palette**: Professional indigo-based primary colors with complementary accents
- **Enhanced Cards**: Subtle shadows, smooth hover effects, and rounded corners
- **Gradient Buttons**: Modern button styles with gradients and smooth transitions
- **Improved Forms**: Better focus states with ring indicators
- **Modern Tables**: Hover effects and improved typography
- **Enhanced Components**: Modernized badges, alerts, dropdowns, modals, and pagination

### Symfony UX Turbo Integration
The package now includes [Symfony UX Turbo](https://turbo.hotwired.dev/) for fast, SPA-like page navigation without the complexity of a JavaScript framework.

#### Features:
- **Instant Navigation**: Pages load without full page refreshes
- **Automatic Page Updates**: Leverage Turbo Streams for real-time updates
- **Form Handling**: Enhanced form submissions with Turbo
- **Progressive Enhancement**: Works with or without JavaScript

## Installation

### Build Assets

1. Install dependencies:
```bash
yarn install
```

2. Build for development:
```bash
yarn run dev
```

3. Build for production:
```bash
yarn run prod
```

## Theme Customization

The modern theme can be customized by overriding SCSS variables in your project:

```scss
// Override modern colors
$primary: #your-color;
$secondary: #your-color;

// Import the admin theme
@import "~bytic/admin-base/resources/themes/bootstrap5/assets/sass/admin";
```

### Color Palette

The default modern color palette includes:
- **Primary**: Modern indigo (#4f46e5)
- **Success**: Emerald green (#10b981)
- **Info**: Modern blue (#3b82f6)
- **Warning**: Amber (#f59e0b)
- **Danger**: Modern red (#ef4444)

## Autocomplete + Create Field (Bootstrap 5)

This package includes reusable backend traits and a Bootstrap 5 field partial for "search and create if missing" flows.

### 1) Controller traits

Use one or both traits from:

- `ByTIC\AdminBase\Library\Controllers\Traits\HasAutocompleteSearchTrait`
- `ByTIC\AdminBase\Library\Controllers\Traits\HasAutocompleteCreateTrait`

You must implement:

- `autocompleteSearchFetchRecords(string $query, int $limit): iterable`
- `autocompleteCreatePersistRecord(string $name): mixed`

Optional extension points:

- duplicate lookup: `autocompleteCreateFindDuplicateRecord(string $name): mixed`
- request parameter names (`q`, `limit`, `name`)
- limits, error messages, and record formatting

### 2) Response contract

Search success:

```json
{
  "success": true,
  "data": [{"id": 1, "label": "Example"}],
  "meta": {"query": "exa", "limit": 10, "count": 1}
}
```

Create success:

```json
{
  "success": true,
  "data": {"id": 1, "label": "Example"},
  "meta": {"created": true}
}
```

Error:

```json
{
  "success": false,
  "error": {"code": "duplicate", "message": "...", "details": {}}
}
```

### 3) View partial

Use field partial:

- `/abstract/modules/item-form/fields/autocomplete_create`

Expected variables:

- required: `field`, `searchUrl`
- optional: `createUrl`, `selectedId`, `selectedLabel`, `label`, `placeholder`, `minChars`, `limit`, `required`, `readonly`

### 4) Frontend behavior

The Bootstrap 5 admin bundle now includes an autocomplete component that:

- debounces search requests
- renders results dropdown
- supports keyboard navigation and selection
- shows inline "create new" when no results
- creates and selects new record via AJAX
- handles Turbo navigation lifecycle cleanup

#### UI INSPIRATION
https://coreui.io/
https://github.com/coreui/coreui-free-bootstrap-admin-template
http://admin.pixelstrap.com/endless/ltr/index.html

#### Framework inspiration
* https://github.com/EasyCorp/EasyAdminBundle
* https://github.com/Sylius/SyliusGridBundle
* https://github.com/the-control-group/voyager
* https://github.com/orchidsoftware/crud
* https://github.com/orchidsoftware/platform