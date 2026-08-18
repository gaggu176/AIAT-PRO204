<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>John Doe</h1>
            <p class="subtitle">Full Stack Developer | PHP Enthusiast</p>
            <div class="contact-info">
                <span>📧 john.doe@email.com</span>
                <span>📱 (555) 123-4567</span>
                <span>📍 New York, NY</span>
                <span>💼 <a href="https://linkedin.com" target="_blank">LinkedIn</a></span>
            </div>
        </header>

        <!-- Professional Summary -->
        <section class="section">
            <h2 class="section-title">Professional Summary</h2>
            <p>
                Dedicated and experienced Full Stack Developer with 5+ years of experience in building web applications 
                using PHP, JavaScript, and modern frameworks. Passionate about creating clean, maintainable code and 
                delivering high-quality solutions.
            </p>
        </section>

        <!-- Skills -->
        <section class="section">
            <h2 class="section-title">Skills</h2>
            <div class="skills">
                <div class="skill-category">
                    <h3>Backend</h3>
                    <ul>
                        <li>PHP 7/8</li>
                        <li>Laravel</li>
                        <li>MySQL</li>
                        <li>REST APIs</li>
                    </ul>
                </div>
                <div class="skill-category">
                    <h3>Frontend</h3>
                    <ul>
                        <li>HTML5/CSS3</li>
                        <li>JavaScript</li>
                        <li>React</li>
                        <li>Responsive Design</li>
                    </ul>
                </div>
                <div class="skill-category">
                    <h3>Tools</h3>
                    <ul>
                        <li>Git</li>
                        <li>Docker</li>
                        <li>VS Code</li>
                        <li>Linux/Windows</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Experience -->
        <section class="section">
            <h2 class="section-title">Experience</h2>
            
            <div class="experience-item">
                <div class="experience-header">
                    <h3>Senior PHP Developer</h3>
                    <span class="date">Jan 2022 - Present</span>
                </div>
                <p class="company">Tech Company Inc.</p>
                <ul class="achievements">
                    <li>Developed and maintained multiple PHP web applications serving 50k+ users</li>
                    <li>Led team of 3 developers to implement new features and improvements</li>
                    <li>Improved application performance by 40% through optimization</li>
                </ul>
            </div>

            <div class="experience-item">
                <div class="experience-header">
                    <h3>PHP Developer</h3>
                    <span class="date">Jun 2020 - Dec 2021</span>
                </div>
                <p class="company">Web Solutions Ltd.</p>
                <ul class="achievements">
                    <li>Built RESTful APIs using Laravel framework</li>
                    <li>Collaborated with frontend developers to create responsive web applications</li>
                    <li>Implemented database optimization and caching strategies</li>
                </ul>
            </div>

            <div class="experience-item">
                <div class="experience-header">
                    <h3>Junior Developer</h3>
                    <span class="date">Jan 2020 - May 2020</span>
                </div>
                <p class="company">StartUp Solutions</p>
                <ul class="achievements">
                    <li>Assisted in development of customer-facing web portal</li>
                    <li>Fixed bugs and improved code quality</li>
                    <li>Learned best practices in PHP development and Git workflows</li>
                </ul>
            </div>
        </section>

        <!-- Education -->
        <section class="section">
            <h2 class="section-title">Education</h2>
            
            <div class="education-item">
                <div class="education-header">
                    <h3>Bachelor of Science in Computer Science</h3>
                    <span class="date">2019</span>
                </div>
                <p class="school">State University</p>
                <p class="gpa">GPA: 3.8/4.0</p>
            </div>

            <div class="education-item">
                <div class="education-header">
                    <h3>PHP Certification</h3>
                    <span class="date">2020</span>
                </div>
                <p class="school">Zend/Oracle PHP Certification Program</p>
            </div>
        </section>

        <!-- Certifications -->
        <section class="section">
            <h2 class="section-title">Certifications</h2>
            <ul class="certifications">
                <li>AWS Certified Solutions Architect</li>
                <li>Docker Certified Associate</li>
                <li>Laravel Certification</li>
            </ul>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; <?php echo date('Y'); ?> John Doe. All rights reserved.</p>
            <p>This resume is built with PHP & CSS</p>
        </footer>
    </div>
</body>
</html>
