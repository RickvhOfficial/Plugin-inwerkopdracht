# Developing Theme - WordPress

Een modern WordPress thema gebouwd met Tailwind CSS en Advanced Custom Fields (ACF) Blocks. Dit thema biedt een flexibele basis voor het bouwen van websites met een componentgebaseerde aanpak.

## 🛠 Tech Stack

- PHP 8.2+
- WordPress 6.0+
- Composer voor PHP dependencies
- Node.js & NPM voor frontend tooling
- Tailwind CSS voor styling
- ACF Pro voor aangepaste blocks
- Flowbite voor UI componenten

## 🚀 Quick Start

```bash
# Clone repository
git clone [repository-url]

# Installeer PHP dependencies
composer install

# Installeer Node modules
npm install

# Start development (Tailwind watch)
npm run watch
```

## 📁 Project Structuur

```
developing-theme/
├── assets/                 # Frontend assets
│   ├── css/               # Tailwind & custom CSS
│   ├── js/                # JavaScript modules
│   └── images/            # Theme images
├── includes/              # PHP classes & functions
│   ├── theme-setup.php    # Theme registratie en setup
│   ├── enqueue-scripts.php # Scripts en styles
│   ├── class-custom-walker.php # Aangepaste menu walker
│   ├── acf-blocks-loader.php # ACF blocks loader
│   ├── popup-scripts.php  # Scripts voor popups
│   ├── theme-customizer.php # Theme customizer instellingen
│   ├── editor-styles.php  # Editor styling
│   └── acf-block-examples.php # Voorbeelden van ACF blocks
├── resources/             # Theme resources
│   └── blocks/            # ACF blocks
├── template-parts/        # Herbruikbare template delen
└── vendor/                # Composer packages
```

## 🧩 ACF Blocks

Het thema bevat de volgende ACF blocks:

- Background Cover Image
- Blog Card With Image
- Carousel Slider
- Contact Form With Location
- Content Card Images
- Content Section With CTA
- Content Section With Image And Features
- Content With Maps
- CTA With Tabs
- Default Blog Card
- Default Contact Form
- Default Feature List Centered
- Email CTA
- FAQ Accordion
- Features Cards Section
- Grid Testimonial Cards
- Image CTA Button
- Image With Feature List
- Images With Heading Description
- Overlay Cards With Zoom
- Visual Image With Heading

## 🎨 Frontend Development

### Tailwind CSS

```bash
# Watch mode
npm run watch
```

Custom Tailwind configuratie in `tailwind.config.js`:
```javascript
module.exports = {
  darkMode: 'false',
  content: [
    "./*.php",
    "./templates/**/*.php",
    "./template-parts/**/*.php",
    "./assets/js/**/*.js",
    "./includes/popups/**/*.php",
    "./includes/acf-fields/**/*.php",
    "./resources/blocks/*.php",
    "./resources/blocks/**/*.php",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter','Segoe UI','sans-serif !important']
      },
      colors: {
        primary: {"50":"#FDF8E9","100":"#FCF3D7","200":"#F8E7B0","300":"#F5DB89","400":"#F1CF62","500":"#E7BE46","600":"#DDB03A","700":"#C49B2A","800":"#A37E1E","900":"#7F5F19","950":"#5C4210"}
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
};
```

## 📦 Dependencies

### PHP Packages
- ACF Pro (niet in composer, moet apart geïnstalleerd worden)

### NPM Packages
- `tailwindcss`: ^3.4.17
- `@tailwindcss/typography`: ^0.5.15
- `flowbite`: ^2.5.2
- `slick-carousel`: ^1.8.1
- `@betahuhn/feedback-js`: ^2.1.25

## 🔍 Gebruik van het thema

1. Installeer WordPress en activeer het thema
2. Zorg dat ACF Pro geïnstalleerd en geactiveerd is
3. Gebruik de Gutenberg editor om pagina's te bouwen met de beschikbare ACF blocks
4. Pas de thema-instellingen aan via de WordPress Customizer

## 🧩 Blocks toevoegen

Om een nieuwe ACF block toe te voegen:

1. Maak een nieuwe map in `resources/blocks/[block-naam]/`
2. Voeg een PHP bestand toe met dezelfde naam als de map
3. Registreer de block in `acf_blocks.php`
4. Voeg de ACF velden toe via de ACF interface

## 📝 License

Proprietary - © ReDecem
