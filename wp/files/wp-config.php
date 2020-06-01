<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define( 'DB_NAME', 'wp_default' );

/** MySQL数据库用户名 */
define( 'DB_USER', 'root' );

/** MySQL数据库密码 */
define( 'DB_PASSWORD', '123456' );

/** MySQL主机 */
define( 'DB_HOST', 'mysql' );

/** 创建数据表时默认的文字编码 */
define( 'DB_CHARSET', 'utf8mb4' );

/** 数据库整理类型。如不确定请勿更改 */
define( 'DB_COLLATE', '' );

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ';z{CS`wHE,q8j!>J |PqNg/Dtrdg/b;RArSQzJ[lY7HxPZ4&hB,WOxiKg}[,?G,N' );
define( 'SECURE_AUTH_KEY',  '>L_u(GDa(O.CqL@+E05nntW_F9(f,npl~1!vgG P@QLx~%B`%^P@*Uh??NFT6F?`' );
define( 'LOGGED_IN_KEY',    'Dr3IHdwqdw8_C#WovEQ>:m;aN9w`jN35bkf+Fno?>$BwWm&jEne??^W#DU]]].XO' );
define( 'NONCE_KEY',        'rJffIc$NW>eSr_}~wEkWq=BizpXK5-_j 5 :@rF/{X[<`Y+LXIQh|8; &Y-Kz%($' );
define( 'AUTH_SALT',        '<S~,[!}c8*lM*Qt8_zkjZ%SJu`[XD6l3G&/cOu|6W:.zv,,jtDHZ>E{0W4=cbmIW' );
define( 'SECURE_AUTH_SALT', 'wR#C>zwrtn#9lhyE45:#F>q$L/m2MXcduJXb(Rv->v$c10u0Vy,P9D8]NAPr&)mv' );
define( 'LOGGED_IN_SALT',   'jF3Siz*3)r2^MV0Ht 240&1}ofX]tqx;94R>X>AYLWDF.SkGS &sLJ&+>YeX:-??' );
define( 'NONCE_SALT',       '6) CE&N|sJE!ZdUO}jUS0$;968>HUuM>?;v4?/E.(+yj%GQR|:[MW8d}5qp Yjeg' );

/**#@-*/
define('JWT_AUTH_SECRET_KEY', '=i``G+H|} fSLR f,$8~&N#paMfPzrk6,e]Dg.-<|jip(H8C%) ^uO/ l~$3},fC');
define('JWT_AUTH_CORS_ENABLE', true);

//定义wordPress Nginx缓存路径
define( 'RT_WP_NGINX_HELPER_CACHE_PATH','/www/server/nginx/cache');

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_POST_REVISIONS', false); 

define('SAVEQUERIES', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** 设置WordPress变量和包含文件。 */
require_once( ABSPATH . 'wp-settings.php' );
