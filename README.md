## About

bfg-fleet-list is a web-based fleet builder for the Battlefleet Gothic tabletop game. It helps players build, manage, and reference fleets by assigning ships, applying refits, and tracking points in a clear, interactive interface.

The application is based on the **Battlefleet Gothic Remastered official rulebook v1.10** and is designed as a community tool for public use. In addition to fleet building, it can export fleet data into a readable PDF format for use during games, whether digitally or as a printed reference sheet.

The goal of the project is to provide a more complete and visually polished alternative to the usual fleet list tools, while covering the game's rules and special cases as fully as possible.

### Key features

- Fleet building with faction and fleet list selection
- Ship assignment and refit support
- Points tracking and detailed ship information
- Readable PDF export for tabletop use
- UI-focused presentation with ship-card-inspired exports
- Built around the BFG Remastered official ruleset

### Current status

The project is still in development and is not yet feature complete. Planned and missing functionality includes support for ship staff/officers/admirals, their modifiers, and fleet ship limiters for conditions that restrict certain ship types.

### Demo

The project is publicly hosted at [braceforimpact.site](https://www.braceforimpact.site).

### Notes

This project currently includes some temporary artwork and UI assets used during development. Asset usage may change as the project evolves.

## Setup

Install packages:
```
composer install
npm install
```
Generate app key:
```
php artisan key:generate
```

Run migrations and seed default BFG data:
```
php artisan migrate
php artisan db:seed
```

Project needs symlink `public/images -> resources/images` to please both Blade and Vite.

## Runtime
Necessary for fleet builder functionality:
* For development:
```
npm run dev
```
* For production:
```
npm ci
npm run build
```
