<?php

include 'includes/header.php';


$category_id = isset($_GET['category']) ? intval($_GET['category']) : null;


$categories = get_categories();

if ($category_id) {
    $products = get_products_by_category($category_id);
   
    $category_name = '';
    foreach ($categories as $cat) {
        if ($cat['id'] == $category_id) {
            $category_name = $cat['name'];
            break;
        }
    }
} else {
   
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    
    $products = [];
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
}
?>

<!-- Page Header -->
<section class="page-header categories-header">
    <div class="container">
        <h1><?php echo isset($category_name) ? $category_name : 'Our Categories'; ?></h1>
        <p>We provide quality solutions for professional kitchens and office spaces, with equipment optimized for performance and safety, as well as ergonomic furniture that enhances productivity and well-being. Explore our categories to transform your workspace.</p>
    </div>
</section>

<!-- Category Navigation -->
<section class="category-nav">
    <div class="container">
        <ul class="category-filter">
            <li><a href="categories.php" <?php echo !$category_id ? 'class="active"' : ''; ?>>All Categories</a></li>
            <?php foreach ($categories as $category): ?>
            <li><a href="categories.php?category=<?php echo $category['id']; ?>" <?php echo $category_id == $category['id'] ? 'class="active"' : ''; ?>><?php echo $category['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- Products Section -->
<section class="products-section" id="<?php echo strtolower($category_name); ?>">
    <div class="container">
        <?php if (empty($products)): ?>
        <div class="no-products">
            <p>No products found in this category.</p>
        </div>
        <?php else: ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="assets/images/products<?php echo $product['main_image']; ?>" alt="<?php echo $product['name']; ?>">
                    <div class="product-overlay">
                        <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="view-btn">View Details</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3><?php echo $product['name']; ?></h3>
                    <div class="product-rating">
                        <img src="assets/images/st1.jpg" width="15px">
                        <img src="assets/images/st1.jpg" width="15px">
                        <img src="assets/images/st1.jpg" width="15px">
                        <img src="assets/images/st1.jpg" width="15px">
                        <img src="assets/images/st1.jpg" width="15px">
                    </div>
                    <p><?php echo substr($product['description'], 0, 100) . '...'; ?></p>
                    <?php 
                    $cat_sql = "SELECT name FROM categories WHERE id = " . $product['category_id'];
                    $cat_result = mysqli_query($conn, $cat_sql);
                    $category = mysqli_fetch_assoc($cat_result);
                    ?>
                    <span class="product-category"><?php echo $category['name']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Special Offers Banner -->
<section class="offer-banner" id="offers">
    <div class="container">
        <div class="banner-content">
            <h2>Special Offers</h2>
            <h3>Up to <span>30% Off</span> - All Kitchens, Desks & Salon Furniture</h3>
            <a href="contact.php" class="btn primary-btn">Enquire Now</a>
        </div>
    </div>
</section>

<!-- Featured Offers -->
<section class="featured-offers">
    <div class="container">
        <div class="offers-grid">
            <div class="offer-item">
                <div class="offer-content">
                    <h4>Best Offer</h4>
                    <p>The kitchen features a sleek, modern design with dark matte cabinets contrasted by warm natural wood elements.</p>
                    <a href="categories.php?category=1" class="btn outline-btn">Learn More</a>
                </div>
                <div class="offer-background kitchen-offer"></div>
            </div>
            
            <div class="offer-item">
                <div class="offer-content">
                    <h4>Best Offer</h4>
                    <p>The salon features a black color scheme with dark wood floors and sleek black furniture. Crystal chandeliers add a touch of elegance, while metal accents provide a modern contrast.</p>
                    <a href="categories.php?category=3" class="btn outline-btn">Learn More</a>
                </div>
                <div class="offer-background salon-offer"></div>
            </div>
        </div>
        
        <div class="main-offer">
            <div class="offer-content">
                <h4>Best Offer</h4>
                <p>The reception area features a black and gray color scheme with light wood accents. A wood reception desk with metal highlights is central, surrounded by black wall panels and gray stone flooring. Green plants add a touch of nature, softening the modern, structured design.</p>
                <a href="categories.php?category=2" class="btn outline-btn">Learn More</a>
            </div>
            <div class="offer-background reception-offer"></div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
