<?php
/**
 * Template Name: Contact
 *
 * @package greenstar-theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <!-- Hero Section -->
    <section class="contact-hero" aria-labelledby="contact-hero-title">
        <div class="container contact-hero__container">
            <h1 class="contact-hero__title" id="contact-hero-title"><?php esc_html_e( 'Contact Us', 'greenstar-theme' ); ?></h1>
            <p class="contact-hero__subtitle">
                <?php esc_html_e( 'We\'d love to hear from you. Reach out to discuss partnerships, bulk orders, or any inquiries.', 'greenstar-theme' ); ?>
            </p>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="contact-main">
        <div class="container">
            <div class="contact-main__grid">
                
                <!-- Left Column: Contact Info -->
                <div class="contact-info">
                    
                    <div class="contact-card">
                        <div class="contact-card__icon">📍</div>
                        <div class="contact-card__content">
                            <h3 class="contact-card__title"><?php esc_html_e( 'Our Office', 'greenstar-theme' ); ?></h3>
                            <div class="contact-card__text">
                                <?php echo esc_html( get_theme_mod( 'greenstar_address', __( '4th Floor, Viet Tower Building, No. 1 Thai Ha Street, Trung Liet Ward, Dong Da District, Hanoi, Vietnam', 'greenstar-theme' ) ) ); ?>
                            </div>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon">📞</div>
                        <div class="contact-card__content">
                            <h3 class="contact-card__title"><?php esc_html_e( 'Call Us', 'greenstar-theme' ); ?></h3>
                            <div class="contact-card__text">
                                <?php
                                $phone = get_theme_mod( 'greenstar_phone', '0933 898 896' );
                                echo '<a href="tel:' . esc_attr( preg_replace( '/\s+/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a>';
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon">✉️</div>
                        <div class="contact-card__content">
                            <h3 class="contact-card__title"><?php esc_html_e( 'Email Us', 'greenstar-theme' ); ?></h3>
                            <div class="contact-card__text">
                                <?php
                                $email = get_theme_mod( 'greenstar_email', 'ketoangreenstar2023@gmail.com' );
                                echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon">🕐</div>
                        <div class="contact-card__content">
                            <h3 class="contact-card__title"><?php esc_html_e( 'Business Hours', 'greenstar-theme' ); ?></h3>
                            <div class="contact-card__text">
                                <?php esc_html_e( 'Mon – Fri: 8:00 AM – 5:30 PM (ICT)', 'greenstar-theme' ); ?>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Contact Form -->
                <div class="contact-form-wrapper">
                    <h2><?php esc_html_e( 'Send us a message', 'greenstar-theme' ); ?></h2>
                    <p><?php esc_html_e( 'Fill out the form below and our team will get back to you shortly.', 'greenstar-theme' ); ?></p>
                    
                    <form action="#" method="POST" class="gs-contact-form" aria-label="<?php esc_attr_e( 'Contact Form', 'greenstar-theme' ); ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact_name"><?php esc_html_e( 'Full Name *', 'greenstar-theme' ); ?></label>
                                <input type="text" id="contact_name" name="contact_name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_email"><?php esc_html_e( 'Email Address *', 'greenstar-theme' ); ?></label>
                                <input type="email" id="contact_email" name="contact_email" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact_phone"><?php esc_html_e( 'Phone Number', 'greenstar-theme' ); ?></label>
                                <input type="tel" id="contact_phone" name="contact_phone">
                            </div>
                            <div class="form-group">
                                <label for="contact_subject"><?php esc_html_e( 'Subject', 'greenstar-theme' ); ?></label>
                                <input type="text" id="contact_subject" name="contact_subject">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_message"><?php esc_html_e( 'Message *', 'greenstar-theme' ); ?></label>
                            <textarea id="contact_message" name="contact_message" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <?php esc_html_e( 'Send Message', 'greenstar-theme' ); ?>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="contact-map" aria-label="<?php esc_attr_e( 'Our Location', 'greenstar-theme' ); ?>">
        <!-- Standard placeholder iframe pointing to Hanoi, Vietnam -->
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m3!1d119176.0461877478!2d105.77258071804107!3d21.022696680414457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9bd9861ca1%3A0xe7887f7b72ca17a9!2sHanoi%2C%20Ho%C3%A0n%20Ki%E1%BA%BFm%2C%20Hanoi%2C%20Vietnam!5e0!3m2!1sen!2s!4v1714528190000!5m2!1sen!2s" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="<?php esc_attr_e( 'Google Maps Location', 'greenstar-theme' ); ?>">
        </iframe>
    </section>

</main><!-- #primary -->

<?php
get_footer();
