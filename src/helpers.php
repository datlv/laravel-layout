<?php
if ( ! function_exists( 'layout' ) ) {
    /**
     * @return \Datlv\Layout\Manager
     */
    function layout() {
        return app( 'layout' );
    }
}
