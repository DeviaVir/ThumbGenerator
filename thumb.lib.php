<?PHP
        // I'm using ThumbXGen for this, but am using this 'frontend' to do the stuff I want it to do.
        require_once( 'thumb/ThumbLib.inc.php' ); 
          
        class Thumb {
        
                final private function __construct() { /*Protect */ }
                
                private static $thumb         =               null;
                private static $exceptions    =               null;
                
                /* !Rock 'n' Roll */
                public static function create( $path = null, $type = 'resize', $width = null, $height = null, $x = null, $y = null ) {
                        try { 
                                self::$thumb = PhpThumbFactory::create( $path ); 
                        } catch( exception $f ) {
                                self::$thumb = false; 
                                self::$exceptions[] = $f;
                        }
                                          
                        if( self::$thumb ) {
                                switch( $type ) {
                                        case 'resize':
                                                $error = null;
                                                if( is_Null( $width ) ) {
                                                        $error = 'No argument WIDTH specified';
                                                } else if( is_Null( $height ) ) {
                                                        $error = 'No argument HEIGHT specified';
                                                }
                                                
                                                if( is_Null( $error ) ) {
                                                        self::$thumb->resize( $width, $height );
                                                } else {
                                                        self::$exceptions[] = $error;
                                                }
                                        break;
                                        case 'smart':
                                                $error = null;
                                                if( is_Null( $width ) ) {
                                                        $error = 'No argument WIDTH specified';
                                                } else if( is_Null( $height ) ) {
                                                        $error = 'No argument HEIGHT specified';
                                                }
                                                
                                                if( is_Null( $error ) ) {
                                                        self::$thumb->adaptiveResize( $width, $height );
                                                } else {
                                                        self::$exceptions[] = $error;
                                                }
                                        break;
                                        case 'crop':
                                                $error = null;
                                                if( is_Null( $width ) ) {
                                                        $error = 'No argument WIDTH specified.';
                                                } else if( is_Null( $height ) ) {
                                                        $error = 'No argument HEIGHT specified.';
                                                } else if( is_Null( $x ) ) {
                                                        $error = 'No argument X specified.';
                                                } else if( is_Null( $y ) ) {
                                                        $error = 'No argument Y specified.';
                                                }
                                                
                                                if( is_Null( $error ) ) {
                                                        self::$thumb->crop( $x, $y, $width, $height );
                                                } else {
                                                        self::$exceptions[] = $error;
                                                }
                                        break;
                                        case 'rotate':
                                                $error = null;
                                                if( is_Null( $width ) ) {
                                                        $error = 'No argument DEGREES specified.';
                                                }
                                                
                                                if( is_Null( $error ) ) {
                                                        self::$thumb->rotateImageNDegrees( $width );
                                                } else {
                                                        self::$exceptions[] = $error;
                                                }
                                        break;
                                        default:
                                                self::$exceptions[] = 'No conversion type. Use resize | smart | crop | rotate';
                                        break;
                                }
                        }
                                          
                        if( self::$exceptions ) {
                                print '<pre>'; print_r( self::$exceptions ); print '</pre>';
                        }
                        
                        // Let's replace the last value with some stuff..
                        $arr = explode( '.', $path );    
                        $val = array_pop( $arr );
                        $arr[] = 'thumb.png';
                        $arr = implode( '.', $arr );
                        
                        self::$thumb->save( $arr, 'png' );
                        return $arr;
                }
        }   
?>      