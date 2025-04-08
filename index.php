<?php
// Include header
include 'includes/header.php';

// Get featured products
$featured_products_sql = "SELECT * FROM products ORDER BY id DESC LIMIT 3";
$featured_result = mysqli_query($conn, $featured_products_sql);
$featured_products = [];

if (mysqli_num_rows($featured_result) > 0) {
    while($row = mysqli_fetch_assoc($featured_result)) {
        $featured_products[] = $row;
    }
}
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div class="hero-slider" id="hero-slider">
            <div class="slide active">
                <img src="assets/images/cuisine-design.jpg" alt="Modern Kitchen Designs">
                <div class="slide-content">
                    <h1>Grand Opening</h1>
                    <h2>Interiors Concept Store</h2>
                    <p>We are pleased to announce the opening of our new Interiors Concept Store. Showcasing classic solutions for kitchens, reception desks, hair salons, and more.</p>
                    <a href="categories.php" class="btn primary-btn">Explore Now</a>
                </div>
            </div>
            <div class="slide">
                <img src="assets/images/s4.jpg" alt="Premium Office Solutions">
                <div class="slide-content">
                    <h1>Premium Office Solutions</h1>
                    <h2>Transform Your Workspace</h2>
                    <p>Discover our elegant reception desks and office furniture designed for maximum productivity and professional appeal.</p>
                    <a href="categories.php?category=2" class="btn primary-btn">View Collection</a>
                </div>
            </div>
            <div class="slide">
                <img src="assets/images/hero/salon-hero.jpg" alt="Salon Design Excellence">
                <div class="slide-content">
                    <h1>Salon Design Excellence</h1>
                    <h2>Elevate Your Business</h2>
                    <p>Create the perfect atmosphere for your clients with our premium salon furniture and complete interior solutions.</p>
                    <a href="categories.php?category=3" class="btn primary-btn">Discover More</a>
                </div>
            </div>
        </div>
        
        <div class="slider-controls">
            <div class="thumbnail-container">
                <img src="assets/images/box1.png" class="active" onclick="setSlide(0)" alt="Kitchen">
                <img src="assets/images/recption1.jpg" onclick="setSlide(1)" alt="Office">
                <img src="assets/images/sm-banner.jpg" onclick="setSlide(2)" alt="Salon">
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="who-we-are">
    <div class="container">
        <h2 class="section-title">Who We Are</h2>
        <div class="about-content">
            <div class="about-video">
                <video src="assets/videos/ji.mp4" controls poster="assets/images/video-poster.jpg">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="about-text">
                <p>Founded in 2008 and based in Casablanca, Eurozak Industrie is a premier luxury design and manufacturing firm.</p>
                <p>Specializing in bespoke creations for kitchens, bathrooms, and more, we offer a full range of services including trade work, flooring, painting, and window installations.</p>
                <p>With decades of experience, our designers are dedicated to crafting the perfect space tailored to your vision.</p>
                <a href="about.php" class="btn secondary-btn">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section" id="our-services">
    <div class="container">
        <h2 class="section-title">Our Services</h2>
        <p class="section-description">Although we're best known for luxury kitchens, our renovation and design expertise extends through the entire home. Whether you're upgrading your kitchen, bathroom, laundry, or want to add a home bar, library or a wine cellar, Eurozak Industrie is your trusted remodelling partner in Casablanca.</p>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <img src="assets/images/kch1.png" alt="Kitchen Design">
                </div>
                <h3>Kitchen Design</h3>
                <p>Custom kitchen solutions with premium materials and expert craftsmanship.</p>
                <a href="service.php#kitchen" class="btn text-btn">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <img src="assets/images/br2.jpg" alt="Reception Areas">
                </div>
                <h3>Reception Areas</h3>
                <p>Professional reception desks and waiting areas that make a lasting impression.</p>
                <a href="service.php#reception" class="btn text-btn">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <img src="assets/images/icons/salon.png" alt="Salon Interiors">
                </div>
                <h3>Salon Interiors</h3>
                <p>Complete salon solutions designed for style, comfort, and functionality.</p>
                <a href="service.php#salon" class="btn text-btn">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="featured-section">
    <div class="container">
        <h2 class="section-title">Featured Designs</h2>
        
        <div class="product-grid">
            <?php foreach ($featured_products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="assets/images/products/<?php echo $product['main_image']; ?>" alt="<?php echo $product['name']; ?>">
                    <div class="product-overlay">
                        <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="view-btn">View Details</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo substr($product['description'], 0, 100) . '...'; ?></p>
                    <div class="product-category">
                        <?php 
                        $cat_sql = "SELECT name FROM categories WHERE id = " . $product['category_id'];
                        $cat_result = mysqli_query($conn, $cat_sql);
                        $category = mysqli_fetch_assoc($cat_result);
                        echo $category['name']; 
                        ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="view-all-container">
            <a href="categories.php" class="btn primary-btn">View All Designs</a>
        </div>
    </div>
</section>

<!-- Showcase Section -->
<section class="showcase-section">
    <div class="container">
        <div class="showcase-grid">
            <div class="showcase-item large">
                <img src="assets/images/sm-banner.jpg" alt="Kitchen Showcase">
                <div class="showcase-overlay">
                    <h3>Premium Kitchens</h3>
                    <p>Elegant designs combining functionality with luxury</p>
                    <a href="categories.php?category=1" class="btn outline-btn">Explore</a>
                </div>
            </div>
            
            <div class="showcase-item">
                <img src="assets/images/recption1.jpg" alt="Reception Showcase">
                <div class="showcase-overlay">
                    <h3>Office Spaces</h3>
                    <p>Professional environments that inspire</p>
                    <a href="categories.php?category=2" class="btn outline-btn">Explore</a>
                </div>
            </div>
            
            <div class="showcase-item">
                <img src="assets/images/box1.png" alt="Salon Showcase">
                <div class="showcase-overlay">
                    <h3>Salon Design</h3>
                    <p>Stylish and functional salon spaces</p>
                    <a href="categories.php?category=3" class="btn outline-btn">Explore</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Feature Section -->
<section class="video-feature-section">
    <div class="video-feature-container">
        <div class="video-background">
            <video autoplay muted loop id="design-video">
                <source src="assets/videos/VEDIObanner.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="video-content">
            <h2>Discover the Pinnacle of Interior Design</h2>
            <p>Experience the perfect blend of craftsmanship and luxury. Our designs are stylish statements, combining rich wood tones with sleek metal for modern elegance. Every detail is crafted for beauty and functionality.</p>
            <a href="contact.php" class="btn primary-btn">Request Consultation</a>
        </div>
    </div>
</section>

<!-- Design Inspiration Section -->
<section class="inspiration-section">
    <div class="container">
        <h2 class="section-title">Design Inspiration</h2>
        
        <div class="inspiration-grid">
            <div class="inspiration-item">
                <img src="assets/images/br3.jpg" alt="Design Inspiration">
            </div>
            <div class="inspiration-item">
                <img src="assets/images/cadre4.jpg" alt="Design Inspiration">
            </div>
            <div class="inspiration-item large">
                <img src="assets/images/sin up.jpg" alt="Design Inspiration">
            </div>
            <div class="inspiration-item">
                <img src="assets/images/cover categoriges.webp" alt="Design Inspiration">
            </div>
        </div>
        
        <div class="inspiration-text">
            <h3>Designs That Inspire and Impress</h3>
            <p>Create spaces that reflect your personality and meet your needs, from elegant kitchens to upscale barbershops and reception areas that leave a lasting impression. Together, we craft an unforgettable design experience.</p>
        </div>
    </div>
</section>

<!-- Special Offers Section -->
<section class="offers-section" id="best-offers">
    <div class="container">
        <h2 class="section-title">Special Offers</h2>
        
        <div class="offers-container">
            <div class="offer-card">
                <div class="offer-image">
                    <img src="assets/images/cadre4.jpg" alt="Kitchen Special">
                </div>
                <div class="offer-content">
                    <h3>Premium Kitchen Package</h3>
                    <p>The kitchen features a sleek, modern design with dark matte cabinets contrasted by warm natural wood elements.</p>
                    <a href="categories.php?category=1" class="btn secondary-btn">Learn More</a>
                </div>
            </div>
            
            <div class="offer-card">
                <div class="offer-image">
                    <img src="assets/images/s4.jpg" alt="Salon Special">
                </div>
                <div class="offer-content">
                    <h3>Complete Salon Solution</h3>
                    <p>The salon features a black color scheme with dark wood floors and sleek black furniture. Crystal chandeliers add a touch of elegance, while metal accents provide a modern contrast.</p>
                    <a href="categories.php?category=3" class="btn secondary-btn">Learn More</a>
                </div>
            </div>
        </div>
        
        <div class="main-offer">
            <div class="main-offer-content">
                <h2>Reception Area Promotion</h2>
                <p>The reception area features a black and gray color scheme with light wood accents. A wood reception desk with metal highlights is central, surrounded by black wall panels and gray stone flooring. Green plants add a touch of nature, softening the modern, structured design.</p>
                <a href="categories.php?category=2" class="btn primary-btn">Discover Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-preview-section" id="contact">
    <div class="container">
        <h2 class="section-title">Get In Touch</h2>
        
        <div class="contact-preview-container">
            <div class="contact-info">
                <h3>Our Location</h3>
                <p><img src="assets/images/mp1.png" height="30px" width="30px">46 Boulevard Zerktouni, Casablanca, Morocco 20400</p>
                <p><img src="assets/images/gm1.png" height="30px" width="30px"> eurozakindustry@gmail.com</p>
                <p><img src="assets/images/ph2.png" height="30px" width="30px"> +212 640 810 396</p>
                <p><img src="assets/images/cl2.jpg" height="30px" width="30px"> Monday to Saturday: 8:30 AM to 6:00 PM</p>
                
                <div class="social-links">
                    <a href="https://facebook.com/eurozakindustry" target="_blank"><img src="assets/images/f1.png" width="30px"></img></a>
                    <a href="https://instagram.com/eurozakindustrie" target="_blank"><img src="assets/images/in1.jpg" width="30px"></img></a>
                    <a href="https://twitter.com/eurozakindustry" target="_blank"><img src="assets/images/twww1.png"width="30px" ></img></a>
                </div>
                
                <a href="contact.php" class="btn primary-btn">Contact Us</a>
            </div>
            
            <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.8631513048826!2d-7.6215158259064095!3d33.58290224236972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d2a267f16167%3A0x30e348bc08aa87d2!2s46%20Bd%20Mohamed%20Zerktouni%2C%20Casablanca%2020250!5e0!3m2!1sen!2sma!4v1723851752959!5m2!1sen!2sma" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
