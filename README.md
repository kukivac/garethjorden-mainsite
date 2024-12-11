# Garethjorden Mainsite

**Garethjordern Mainsite** is a personal portfolio website for a UK-based photographer, designed to showcase his work in a familiar, Instagram-inspired layout. This project provides greater flexibility in how images and content are presented, all while maintaining a sleek, mobile-friendly design.

## Overview

The site aims to replicate the clean, grid-like feel of Instagram’s feed while offering additional customization options tailored for a professional photography portfolio. Images are prominently displayed, and the overall layout focuses on visual storytelling.

## Key Features

- **Instagram-Inspired Design:** Presents photographs in a grid-based format, similar to Instagram’s feed, ensuring a clean and intuitive browsing experience.
- **Custom MVC Framework:** Utilizes a proprietary PHP 8.1 framework with a custom controller-based routing system to ensure scalability and maintainability.
- **Latte Templating:** Leverages Latte for view rendering, enabling clean and flexible template structures.
- **SCSS Frontend:** Implements SCSS for styling, providing a modular and maintainable approach to stylesheet management.
- **Flexible Configuration:** Offers greater control over layout and content arrangement, empowering the photographer to adjust the look and feel without extensive code changes.

## Technologies Used

- **Backend:** PHP 8.1 (Custom MVC Framework)
- **Templating:** Latte
- **Routing:** Custom controller-based routing
- **Frontend:** SCSS

## Getting Started

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/garethjordern-mainsite.git
   ```

2. **Install Dependencies:**
   Ensure that you have PHP 8.1 and Composer installed. Then run:
   ```bash
   composer install
   ```

3. **Configuration:**
   Configure any required settings (database, paths, etc.) in the project’s configuration files, typically found in a `config` or `.env` file. Make sure your web server points to the public-facing directory (often `public`).

4. **Build Styles:**
   If you need to recompile the SCSS files:
   ```bash
   npm install
   npm run build
   ```

5. **Run the Application:**
   Start your local development server or configure your preferred server environment. For a quick start, you can use PHP’s built-in server:
   ```bash
   php -S localhost:8000 -t public
   ```

6. **Access the Site:**
   Open your browser and visit:
   ```
   http://localhost:8000
   ```

## Contributing

Contributions are welcome! Feel free to open a pull request or issue for any improvements, suggestions, or bug fixes. Please ensure code is well-documented, and follow standard GitHub workflows.

## License

This project is licensed under the [MIT License](LICENSE).

---

*Crafted to showcase the artistry of photography, Garethjordern Mainsite combines a familiar aesthetic with robust custom architecture, delivering a unique and flexible platform for visual storytelling.*
