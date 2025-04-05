<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Header/Navigation -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">Portfolio</div>
                <ul class="nav-links">
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="page/rate.php" target="_self">Review</a></li>
                </ul>
                <div class="hamburger">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Home Section -->
    <section id="home" class="home-section">
        <div class="container">
            <div class="home-content">
                <h1>Hi, I'm <span>Dyer Mun</span></h1>
                <h2>A Creative <span class="typing"></span></h2>
                <p>I design and build beautiful websites and applications for businesses of all sizes.</p>
                <div class="btn-group">
                    <a href="#portfolio" class="btn">View My Work</a>
                    <a href="#contact" class="btn secondary">Hire Me</a>
                </div>
                <div class="social-icons">
                    <a href="https://web.facebook.com/reymund.caboverde.5" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://x.com/Dyermun" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/dyermun/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://github.com/Dyermun" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <div class="home-image">
                <?php
                // You can add PHP logic here to dynamically load images
                $homeImage = "img/profile.jpg"; // Default image
                if (file_exists($homeImage)) {
                    echo '<img src="' . $homeImage . '" alt="Profile Image">';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2 class="section-title">About <span>Me</span></h2>
            <div class="about-content">
                <div class="about-image">
                    <?php
                    $aboutImage = "img/set1.jpg";
                    if (file_exists($aboutImage)) {
                        echo '<img src="' . $aboutImage . '" alt="About Me">';
                    } else {
                        echo '<img src="img/default-profile.jpg" alt="Default Profile">';
                    }
                    ?>
                </div>
                <div class="about-text">
                    <h3>Who am I?</h3>
                    <p>I'm a passionate web developer with over 5 years of experience creating modern and responsive websites. I specialize in front-end development but also have experience with back-end technologies.</p>
                    <p>My journey in web development started when I was in college and I've been in love with coding ever since. I enjoy solving problems and creating beautiful, functional websites that users love.</p>
                    <div class="about-details">
                        <div class="detail-item">
                            <p><span>Name:</span> Reymund Caboverde</p>
                            <p><span>Email:</span> reymundgandamon2@gmail.com</p>
                        </div>
                        <div class="detail-item">
                            <p><span>Age:</span>
                                <?php
                                $birthYear = 2004; // Change this to your birth year
                                $currentYear = date("Y");
                                echo $currentYear - $birthYear;
                                ?>
                            </p>
                            <p><span>From:</span> Dipolog City</p>
                        </div>
                    </div>
                    <a href="downloads/cv.pdf" class="btn" download>Download CV</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills-section">
        <div class="container">
            <h2 class="section-title">My <span>Skills</span></h2>
            <div class="skills-content">
                <div class="skills-text">
                    <h3>My creative skills & experiences.</h3>
                    <p>I have worked with a variety of technologies in the web development world. From front-end to back-end, I've got you covered. Here are some of my technical skills and expertise.</p>
                    <a href="#contact" class="btn">Hire Me</a>
                </div>
                <div class="skills-progress">
                    <?php
                    $skills = array(
                        array("name" => "HTML", "percentage" => 95),
                        array("name" => "CSS", "percentage" => 90),
                        array("name" => "JavaScript", "percentage" => 85),
                        array("name" => "React", "percentage" => 80),
                        array("name" => "Node.js", "percentage" => 75),
                        array("name" => "PHP", "percentage" => 85)
                    );

                    foreach ($skills as $skill) {
                        echo '<div class="skill-item">';
                        echo '<div class="skill-info">';
                        echo '<span>' . $skill['name'] . '</span>';
                        echo '<span>' . $skill['percentage'] . '%</span>';
                        echo '</div>';
                        echo '<div class="progress-bar">';
                        echo '<div class="progress" style="width: ' . $skill['percentage'] . '%"></div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio-section">
        <div class="container">
            <h2 class="section-title">My <span>Portfolio</span></h2>
            <div class="portfolio-filter">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="web">Web Design</button>
                <button class="filter-btn" data-filter="app">App Development</button>
                <button class="filter-btn" data-filter="graphic">Graphic Design</button>
            </div>
            <div class="portfolio-items">
                <?php
                $portfolioItems = array(
                    array(
                        "category" => "web",
                        "title" => "E-commerce Website",
                        "description" => "Web Design",
                        "image" => "img/profile.png"
                    ),
                    array(
                        "category" => "app",
                        "title" => "Mobile App",
                        "description" => "App Development",
                        "image" => "https://via.placeholder.com/600x400"
                    ),
                    array(
                        "category" => "graphic",
                        "title" => "Logo Design",
                        "description" => "Graphic Design",
                        "image" => "https://via.placeholder.com/600x400"
                    ),
                    array(
                        "category" => "web",
                        "title" => "Blog Website",
                        "description" => "Web Design",
                        "image" => "https://via.placeholder.com/600x400"
                    ),
                    array(
                        "category" => "app",
                        "title" => "Fitness App",
                        "description" => "App Development",
                        "image" => "https://via.placeholder.com/600x400"
                    ),
                    array(
                        "category" => "graphic",
                        "title" => "Brand Identity",
                        "description" => "Graphic Design",
                        "image" => "https://via.placeholder.com/600x400"
                    )
                );

                foreach ($portfolioItems as $item) {
                    echo '<div class="portfolio-item" data-category="' . $item['category'] . '">';
                    echo '<img src="' . $item['image'] . '" alt="' . $item['title'] . '">';
                    echo '<div class="portfolio-overlay">';
                    echo '<h3>' . $item['title'] . '</h3>';
                    echo '<p>' . $item['description'] . '</p>';
                    echo '<a href="#"><i class="fas fa-link"></i></a>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="section-title">Contact <span>Me</span></h2>
            <div class="contact-content">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <p>Feel free to reach out to me for any questions or opportunities. I'm always open to discussing new projects, creative ideas or opportunities to be part of your vision.</p>
                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <div class="info-content">
                            <h4>Name</h4>
                            <p>Reymund Caboverde</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="info-content">
                            <h4>Location</h4>
                            <p>Dipolog City</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div class="info-content">
                            <h4>Email</h4>
                            <p>reymundgandamon2@gmail.com</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div class="info-content">
                            <h4>Phone</h4>
                            <p>09758078697</p>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Message Me</h3>
                    <form id="contactForm" action="send_email.php" method="POST">
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="subject" name="subject" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea id="message" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                    <?php
                    // Display success/error messages if they exist
                    if (isset($_GET['message'])) {
                        $messageType = $_GET['status'] ?? 'error';
                        $messageClass = $messageType === 'success' ? 'success-message' : 'error-message';
                        echo '<div class="form-message ' . $messageClass . '">' . htmlspecialchars($_GET['message']) . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; <span id="year"><?php echo date("Y"); ?></span> All Rights Reserved. Designed by Reymund</p>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#home" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="assets/scripts.js"></script>
</body>

</html>