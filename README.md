# Resume Website

A simple, modern resume website built with HTML, CSS, and JavaScript that you can customize and host anywhere.

## Features

- ✨ Clean, modern design with gradient header
- 📱 Fully responsive (works on mobile, tablet, and desktop)
- 🎨 Professional color scheme and typography
- 🖨️ Print-friendly (CSS optimized for printing)
- ⚡ Lightweight and fast
- 💻 Built with HTML5, CSS3, and JavaScript (ES6+)
- 🎭 Smooth animations and transitions
- 🔗 No external dependencies

## Getting Started

### Prerequisites
- A modern web browser
- Optional: A local web server or VS Code Live Server extension

### Installation

1. Clone or download this repository
2. Navigate to the project directory
3. Open `index.html` directly in your browser, or
4. Start a local server using your preferred method:

**Using Python 3:**
```bash
python -m http.server 8000
```

**Using Node.js (http-server):**
```bash
npx http-server -p 8000
```

**Using VS Code:**
- Install "Live Server" extension
- Right-click on `index.html` and select "Open with Live Server"

4. Open your browser and visit: `http://localhost:8000`

## Customization

Edit the `index.html` file to update your resume information:

### Personal Information
- Name
- Title/subtitle
- Email, phone, location
- LinkedIn URL

### Sections
- **Professional Summary** - Brief overview of your experience
- **Skills** - Organize your skills by category
- **Experience** - Your work history with achievements
- **Education** - Your degrees and certifications
- **Certifications** - Additional credentials

### Styling
Modify `style.css` to change:
- Colors (look for `#667eea` and `#764ba2` gradient colors)
- Fonts and sizes
- Layout and spacing

## JavaScript Features

The `script.js` file includes:
- **Dynamic Year** - Auto-updating copyright year in the footer using JavaScript
- **Smooth Scrolling** - Smooth scroll behavior for internal links
- **Scroll Animations** - Fade-in animations as sections come into view using Intersection Observer API

### Extend Functionality

You can easily add more features to `script.js`:
- Form validation
- Dark mode toggle
- PDF export functionality
- Contact form submissions
- Theme customization

## Color Scheme

- Primary: `#667eea` (Purple-Blue)
- Secondary: `#764ba2` (Purple)
- Text: `#333` (Dark Gray)
- Background: `#f8f9fa` (Light Gray)

## Deployment

You can deploy this anywhere that serves static files:
- **GitHub Pages** - Free hosting for static sites
- **Netlify** - Easy drag-and-drop deployment
- **Vercel** - Optimized for web projects
- **Any Web Host** - Upload HTML, CSS, and JS files via FTP
- **AWS S3** - Cost-effective static hosting
- **Cloudflare Pages** - Fast global CDN

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## License

Feel free to use this template for your personal resume.
