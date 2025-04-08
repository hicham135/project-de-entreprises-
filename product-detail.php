<?php
// Include header
include 'includes/header.php';

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    redirect('categories.php');
}

// Get product ID
$product_id = intval($_GET['id']);

// Get product details
$product = get_product_details($product_id);

// If product not found, redirect to categories page
if (!$product) {
    redirect('categories.php');
}

// Get related products
$related_sql = "SELECT * FROM products WHERE category_id = {$product['category_id']} AND id != {$product_id} LIMIT 4";
$related_result = mysqli_query($conn, $related_sql);
$related_products = [];

if (mysqli_num_rows($related_result) > 0) {
    while($row = mysqli_fetch_assoc($related_result)) {
        $related_products[] = $row;
    }
}
?>

<!-- Product Detail Section -->
<section class="product-detail">
    <div class="container">
        <div class="product-grid">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="assets/images/products/<?php echo $product['main_image']; ?>" alt="<?php echo $product['name']; ?>" id="mainImage">
                </div>
                
                <div class="thumbnail-gallery">
                    <div class="thumbnail active">
                        <img src="assets/images/products/<?php echo $product['main_image']; ?>" alt="<?php echo $product['name']; ?>" onclick="changeImage(this)">
                    </div>
                    
                    <?php if (!empty($product['images'])): ?>
                        <?php foreach($product['images'] as $image): ?>
                        <div class="thumbnail">
                            <img src="assets/images/products/<?php echo $image['image_path']; ?>" alt="<?php echo $product['name']; ?>" onclick="changeImage(this)">
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php
                        // Use placeholder images if no product images are available
                        $placeholders = [
                            str_replace('.jpg', '-2.jpg', $product['main_image']),
                            str_replace('.jpg', '-3.jpg', $product['main_image']),
                            str_replace('.jpg', '-4.jpg', $product['main_image'])
                        ];
                        ?>
                        
                        <?php foreach($placeholders as $placeholder): ?>
                        <div class="thumbnail">
                            <img src="assets/images/products/<?php echo $placeholder; ?>" alt="<?php echo $product['name']; ?>" onclick="changeImage(this)" onerror="this.onerror=null; this.src='assets/images/placeholder.jpg';">
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="product-info">
                <h1><?php echo $product['name']; ?></h1>
                
                <div class="product-rating">
                <img src="assets/images/st1.jpg" width="15px">
                <img src="assets/images/st1.jpg" width="15px">
                <img src="assets/images/st1.jpg" width="15px">
                <img src="assets/images/st1.jpg" width="15px">
                <img src="assets/images/st1.jpg" width="15px">
                    <span>(12 Reviews)</span>
                </div>
                
                <div class="product-category">
                    <span>Category: <?php echo $product['category_name']; ?></span>
                </div>
                
                <div class="product-description">
                    <p><?php echo $product['description']; ?></p>
                </div>
                
                <div class="product-options">
                    <div class="option-group">
                        <label for="color">Select Color:</label>
                        <select id="color" name="color">
                            <option value="">Choose a color</option>
                            <option value="natural">Natural Wood</option>
                            <option value="black">Black</option>
                            <option value="white">White</option>
                            <option value="gray">Gray</option>
                        </select>
                    </div>
                </div>
                
                <div class="product-actions">
                    <button class="btn primary-btn request-quote-btn">Request Quote</button>
                    <button class="btn secondary-btn contact-btn">Contact Sales</button>
                </div>
            </div>
        </div>
        
        <div class="product-details-tabs">
            <div class="tabs-nav">
                <button class="tab-btn active" data-tab="details">Product Details</button>
                <button class="tab-btn" data-tab="specifications">Specifications</button>
                <button class="tab-btn" data-tab="reviews">Reviews</button>
            </div>
            
            <div class="tab-content active" id="details">
                <h3>Product Details</h3>
                <div class="details-content">
                    <?php 
                    // Format details with proper HTML
                    $details_html = nl2br($product['details']);
                    echo $details_html;
                    ?>
                </div>
            </div>
            
            <div class="tab-content" id="specifications">
                <h3>Specifications</h3>
                <table class="specs-table">
                    <tr>
                        <th>Material</th>
                        <td>High-quality wood veneer and durable metal</td>
                    </tr>
                    <tr>
                        <th>Finish</th>
                        <td>Matte black metal with natural wood grain</td>
                    </tr>
                    <tr>
                        <th>Lighting</th>
                        <td>Integrated LED lighting (optional)</td>
                    </tr>
                    <tr>
                        <th>Design</th>
                        <td>Space-efficient with built-in storage solutions</td>
                    </tr>
                    <tr>
                        <th>Style</th>
                        <td>Modern and minimalist, perfect for contemporary interiors</td>
                    </tr>
                    <tr>
                        <th>Customization</th>
                        <td>Available in multiple colors and configurations</td>
                    </tr>
                </table>
            </div>
            
            <div class="tab-content" id="reviews">
                <h3>Customer Reviews</h3>
                <div class="reviews-container">
                    <div class="review">
                        <div class="review-header">
                            <div class="reviewer">
                                <img src="assets/images/men1.jpg" alt="User">
                                <h4>Ahmed M.</h4>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-date">March 15, 2025</div>
                        <div class="review-content">
                            <p>Excellent quality and design. The installation team was very professional and completed the work ahead of schedule. Highly recommended!</p>
                        </div>
                    </div>
                    
                    <div class="review">
                        <div class="review-header">
                            <div class="reviewer">
                                <img src="assets/images/women1.jpg" alt="User">
                                <h4>Sofia L.</h4>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="review-date">February 28, 2025</div>
                        <div class="review-content">
                            <p>Beautiful design and excellent craftsmanship. The materials are high quality and the finish is perfect. Very happy with my purchase.</p>
                        </div>
                    </div>
                </div>
                
                <div class="write-review">
                    <h4>Write a Review</h4>
                    <p>Please <a href="login.php">login</a> to write a review.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
<?php if (!empty($related_products)): ?>
<section class="related-products">
    <div class="container">
        <h2>You May Also Like</h2>
        
        <div class="product-carousel">
            <?php foreach ($related_products as $related): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="assets/images/products/<?php echo $related['main_image']; ?>" alt="<?php echo $related['name']; ?>">
                    <div class="product-overlay">
                        <a href="product-detail.php?id=<?php echo $related['id']; ?>" class="view-btn">View Details</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3><?php echo $related['name']; ?></h3>
                    <p><?php echo substr($related['description'], 0, 100) . '...'; ?></p>
                    <?php 
                    $cat_sql = "SELECT name FROM categories WHERE id = " . $related['category_id'];
                    $cat_result = mysqli_query($conn, $cat_sql);
                    $category = mysqli_fetch_assoc($cat_result);
                    ?>
                    <span class="product-category"><?php echo $category['name']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
function changeImage(element) {
    // Change main image
    document.getElementById('mainImage').src = element.src;
    
    // Update active thumbnail
    let thumbnails = document.getElementsByClassName('thumbnail');
    for (let i = 0; i < thumbnails.length; i++) {
        thumbnails[i].classList.remove('active');
    }
    element.parentElement.classList.add('active');
}

// Tabs functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons and contents
            tabBtns.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            document.getElementById(this.dataset.tab).classList.add('active');
        });
    });
    
    // Request quote button
    document.querySelector('.request-quote-btn').addEventListener('click', function() {
        window.location.href = 'contact.php?product=<?php echo $product_id; ?>';
    });
    
    // Contact sales button
    document.querySelector('.contact-btn').addEventListener('click', function() {
        window.location.href = 'contact.php';
    });
});
</script>

<?php include 'includes/footer.php'; ?>
