</main>
        
        <!-- Newsletter Section -->
        <section id="newsletter" class="section-m1">
            <div class="newstext">
                <h4>Sign up for Newsletter</h4>
                <p>Get email updates about our latest collections and <span>special offers</span></p>
            </div>
            <div class="newsletter-form">
                <form action="newsletter-subscribe.php" method="post" id="newsletter-form">
                    <input type="email" name="newsletter_email" id="newsletter_email" placeholder="Your email address" required>
                    <p id="newsletter-result"></p>
                    <button type="submit" id="newsletter-submit">Sign Up</button>
                </form>
            </div>
        </section>
        
        <!-- Footer -->
        <footer>
            <div class="footer-column">
                <a href="index.php" class="footer-logo">
                    <img src="assets/images/logo3.png" alt="Eurozak Industrie">
                </a>
                <h4>Contact</h4>
                <p><strong>Address:</strong> 46 Boulevard Zerktouni, Casablanca, Morocco 20400</p>
                <p><strong>Phone:</strong> +212 640 810 396</p>
                <p><strong>Email:</strong> eurozakindustry@gmail.com</p>
                <div class="social-media">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="https://facebook.com/eurozakindustry" target="_blank"><img src="assets/images/f1.png"></img></a>
                        <a href="https://instagram.com/eurozakindustrie" target="_blank"><img src="assets/images/in1.jpg"></img></a>
                        <a href="https://twitter.com/eurozakindustry" target="_blank"><img src="assets/images/twww1.png"></img></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-column">
                <h4>About</h4>
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="delivery.php">Delivery Information</a></li>
                    <li><a href="privacy.php">Privacy Policy</a></li>
                    <li><a href="terms.php">Terms & Conditions</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>My Account</h4>
                <ul>
                    <li><a href="login.php">Sign In</a></li>
                    <li><a href="cart.php">View Cart</a></li>
                    <li><a href="wishlist.php">My Wishlist</a></li>
                    <li><a href="orders.php">Track My Order</a></li>
                    <li><a href="help.php">Help</a></li>
                </ul>
            </div>
            
            <div class="footer-column payment-apps">
                <div class="payment-methods">
                    <p>Secure Payment Methods</p>
                    <img src="assets/images/payment.webp" alt="Payment Methods" width="50px">
                </div>
                <p>Available on App Store and Google Play</p>
                <div class="app-downloads">
                    <a href="#"><img src="assets/images/app1.jpg" width="5px" alt="App Store" height="10px"></a>
                    <a href="#"><img src="assets/images/go1.webp" alt="Google Play"></a>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 Eurozak Industrie - Professional Interior Solutions</p>
            </div>
        </footer>
        
        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        
        <!-- JavaScript -->
        <script src="assets/js/main.js"></script>
        
        <?php if ($current_page == 'index.php'): ?>
        <script src="assets/js/home.js"></script>
        <?php endif; ?>
        
        <?php if ($current_page == 'login.php' || $current_page == 'register.php'): ?>
        <script src="assets/js/authentication.js"></script>
        <?php endif; ?>
        
        <?php if ($current_page == 'product-detail.php'): ?>
        <script src="assets/js/product-detail.js"></script>
        <?php endif; ?>
        
        <script src="assets/js/newsletter.js"></script>
    </body>
</html>
