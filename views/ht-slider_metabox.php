<?php 
    $link_text = get_post_meta( $post->ID, 'ht_slider_link_text', true );
    $link_url = get_post_meta( $post->ID, 'ht_slider_link_url', true );
?>
<table class="form-table ht-slider-metabox"> 
<input type="hidden" name="ht_slider_nonce" value="<?php echo wp_create_nonce( "ht_slider_nonce" ); ?>">
    <tr>
        <th>
            <label for="ht_slider_link_text"><?php esc_html_e( 'Link Text', 'ht-slider' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="ht_slider_link_text" 
                id="ht_slider_link_text" 
                class="regular-text link-text"
                value="<?php echo ( isset( $link_text ) ) ? esc_html( $link_text ) : ''; ?>"
                required
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="ht_slider_link_url"><?php esc_html_e( 'Link URL', 'ht-slider' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="ht_slider_link_url" 
                id="ht_slider_link_url" 
                class="regular-text link-url"
                value="<?php echo ( isset( $link_url ) ) ? esc_url( $link_url ) : ''; ?>"
                required
            >
        </td>
    </tr>               
</table>