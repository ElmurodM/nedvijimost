<?php
/**
 * Add Header Builder Template
 *
 * @package Real_Home
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<script type="text/html" id="tmpl-real-home-builder-panel">
    <div class="real-home-customize-builder">
        <div class="real-home-inner">
            <div class="real-home-header">
                <div class="real-home-devices-switcher">
                </div>
                <div class="real-home-actions">
                    <a class="button button-secondary real-home-panel-close" href="#">
                        <span class="close-text"><?php esc_html_e( 'Close', 'real-home' ); ?></span>
                        <span class="panel-name-text">{{ data.title }}</span>
                    </a>
                </div>
            </div>
            <div class="real-home-body"></div>
        </div>
    </div>
</script>

<script type="text/html" id="tmpl-real-home-panel">
    <div class="real-home-rows">
        <# if ( ! _.isUndefined( data.rows.top ) ) { #>
        <div class="real-home-row-top real-home-row" data-row-id ="top" data-cols="{{ data.cols.top }}" data-id="{{ data.id }}_top">
            <div class="real-home-row-inner">
                <# for ( let i = 0; i < data.cols.top; i++ ) { #>
                <div class="col-items-wrapper"><div data-id="col-{{ i }}" class="col-items col-{{ i }} d-flex justify-content-center"></div></div>
                <# } #>
            </div>
            <a class="real-home-row-settings" title="{{ data.rows.top }}" data-id="top" href="#"></a>
        </div>
        <#  } #>

        <# if ( ! _.isUndefined( data.rows.main ) ) { #>
        <div class="real-home-row-main real-home-row" data-row-id ="main" data-cols="{{ data.cols.main }}" data-id="{{ data.id }}_main">
            <div class="real-home-row-inner">
                <# for ( let i = 0; i < data.cols.main; i++ ) { #>
                <div class="col-items-wrapper"><div data-id="col-{{ i }}" class="col-items col-{{ i }} d-flex justify-content-center"></div></div>
                <# } #>
            </div>
            <a class="real-home-row-settings" title="{{ data.rows.main }}" data-id="main" href="#"></a>
        </div>
        <#  } #>

        <# if ( ! _.isUndefined( data.rows.bottom ) ) { #>
        <div class="real-home-row-bottom real-home-row" data-row-id ="bottom" data-cols="{{ data.cols.bottom }}" data-id="{{ data.id }}_bottom">
            <div class="real-home-row-inner">
                <# for ( let i = 0; i < data.cols.bottom; i++ ) { #>
                <div class="col-items-wrapper"><div data-id="col-{{ i }}" class="col-items col-{{ i }} d-flex justify-content-center"></div></div>
                <# } #>
            </div>
            <a class="real-home-row-settings" title="{{ data.rows.bottom }}" data-id="bottom" href="#"></a>
        </div>
        <#  } #>
    </div>
</script>

<script type="text/html" id="tmpl-real-home-item">
    <div class="grid-stack-item item-from-list for-s-{{ data.section }}"
         title="{{ data.name }}"
         data-id="{{ data.id }}"
         data-section="{{ data.section }}"
    >
        <div class="item-tooltip" data-section="{{ data.section }}">{{ data.name }}</div>
        <div class="grid-stack-item-content">
            <div class="real-home-customizer-builder-item-desc">
                <h3 class="real-home-item-name" data-section="{{ data.section }}">{{ data.name }}</h3>
                <# if ( data.desc ) { #>
                <span class="real-home-customizer-builder-item-desc">{{ data.desc }}</span>
                <# } #>
            </div>
            <span class="real-home-item-remove real-home-icon"></span>
            <span class="real-home-item-setting real-home-icon" data-section="{{ data.section }}"></span>
        </div>
    </div>
</script>
