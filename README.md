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