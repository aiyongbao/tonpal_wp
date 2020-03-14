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
define( 'DB_NAME', '$DBNAME' );

/** MySQL数据库用户名 */
define( 'DB_USER', '$DBUSER' );

/** MySQL数据库密码 */
define( 'DB_PASSWORD', '$DBPASS' );

/** MySQL主机 */
define( 'DB_HOST', 'localhost' );

/** 创建数据表时默认的文字编码 */
define( 'DB_CHARSET', 'utf8mb4' );

/** 数据库整理类型。如不确定请勿更改 */
define( 'DB_COLLATE', '' );

define('WP_ALLOW_MULTISITE', true);

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'bEvMCip/&o&#j~%>:H:ao[sCcnn[ ^,:UoR,pec5=pH+zTep{WUP+D@D?X+G#~N,' );
define( 'SECURE_AUTH_KEY',  '<[lzo%a=t]JJbp*,QnyA)},xBXwld>@Fj0,|<J>(}ZTkZjbhh_#fyJ)O|sncEzDy' );
define( 'LOGGED_IN_KEY',    ')9MG83fyv,CRB_Ns_9sPLH%3Kux5mev6^SR9hIzZ~i7_p* JwH|#sb>R]@HUB_NM' );
define( 'NONCE_KEY',        ' o3m5Jns#tYz5288Va{pB.%u*9$3pfx*XW >y{VTg$]WxBeRxtY@MQX5*^<v[J] ' );
define( 'AUTH_SALT',        'uDu~.,F4n;HWbqD=*X qcojmO=v-lcbM&>,[*X!e6k/R1;:!^qU#{uVbNA5OY9xl' );
define( 'SECURE_AUTH_SALT', 'U-O3ay4xOTFf$hN#WR3G?[k0<{X$7c%@[(*ws]Z/>E)`z;mT&6?2X8aR[)_ZtqyE' );
define( 'LOGGED_IN_SALT',   'UFje)why+r^l#2yh^]C#JmD<-.)Fs:(b[j::uvswKRazqnijyS^U<4}Ei]u-n};5' );
define( 'NONCE_SALT',       'NzXM0_M>8.OOE2;,VHh3{v2K0}l_.`SUdoLtgr8L}?Mg3^%tMH hCgTTMdK/M2,r' );

	
define('JWT_AUTH_SECRET_KEY', '=i``G+H|} fSLR f,$8~&N#paMfPzrk6,e]Dg.-<|jip(H8C%) ^uO/ l~$3},fC');
define('JWT_AUTH_CORS_ENABLE', true);

/**#@-*/

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

define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );

// 开启WP_DEBUG模式
define( 'WP_DEBUG', false );

define( 'WP_CONTENT_URL', '/wp-content');
 
// 开启DEBUG日志，一定要记得关闭这个日志功能并清理这个日志文件哦，产生的日志文件在: /wp-content/debug.log
define( 'WP_DEBUG_LOG', false );
 
// 显示errors and warnings
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 'On' );

/** 更改访问域名 */
$domain = ['www.$DOMAIN', '$DOMAIN', 'm.$DOMAIN', '$TEMPDOMAIN']; 
if(in_array($_SERVER['HTTP_HOST'], $domain)){
    define('WP_SITEURL', 'https://' . $_SERVER['HTTP_HOST']);
    define('WP_HOME', 'https://' . $_SERVER['HTTP_HOST']);
}

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** 设置WordPress变量和包含文件。 */
require_once( ABSPATH . 'wp-settings.php' );
