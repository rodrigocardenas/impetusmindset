<?php
/**
 * Plugin Name: ImpetuMindset Social Hub
 * Description: Añade el Social Hub al sitio (automáticamente al final del contenido o usando el shortcode [social_hub])
 * Version: 1.0
 * Author: Antigravity
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Enqueue CSS
function imsh_enqueue_scripts() {
    wp_enqueue_style( 'imsh-style', plugins_url( 'impetumindset-social-hub/assets/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'imsh_enqueue_scripts' );

// Generar el HTML del Social Hub
function imsh_get_social_hub_html() {
    ob_start();
    ?>
    <section class="social-hub-section">
      <div class="social-hub-container">
        
        <!-- Columna 1 -->
        <article class="social-column">
          <h3 class="social-column-title">YouTube</h3>
          <p class="social-column-text">Contenido y descripción orientada a tu audiencia tech/coaching.</p>
          <a href="#" class="cta-button">Ver Videos</a>
        </article>

        <!-- Columna 2 -->
        <article class="social-column">
          <h3 class="social-column-title">LinkedIn</h3>
          <p class="social-column-text">Contenido y descripción orientada a tu audiencia tech/coaching.</p>
          <a href="#" class="cta-button">Conectar</a>
        </article>

        <!-- Columna 3 -->
        <article class="social-column">
          <h3 class="social-column-title">Podcast / Blog</h3>
          <p class="social-column-text">Contenido y descripción orientada a tu audiencia tech/coaching.</p>
          <a href="#" class="cta-button">Escuchar</a>
        </article>

      </div>
    </section>
    <?php
    return ob_get_clean();
}

// 1. Permitir uso con Shortcode
add_shortcode( 'social_hub', 'imsh_get_social_hub_html' );

// 2. Inyectar automáticamente al final del contenido (para que sea visible de inmediato)
function imsh_inject_social_hub( $content ) {
    // Evitar inyección en feeds o si no estamos en el loop principal
    if ( is_feed() || ! is_main_query() ) {
        return $content;
    }
    
    // Lo añadimos al final del contenido
    return $content . imsh_get_social_hub_html();
}
add_filter( 'the_content', 'imsh_inject_social_hub' );
