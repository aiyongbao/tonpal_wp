#!/bin/bash
# vps wordpress 安装脚本
# 接受参数
while [ -n "$1" ]  
do  
    case "$1" in
        -uid)
            ORGANIZATIONID=$2 
            shift  
            ;;
        # 生成的域名名称
        -domain)
            DOMAIN=$2
            shift
            ;;
        # 临时域名
        -tempdomain)
            TEMPDOMAIN=$2
            shift
            ;;
        # wp 数据库名称
        -dbname)
            DBNAME=$2 
            shift  
            ;;
        # wp 数据库用户名
        -dbuser)
            DBUSER=$2 
            shift  
            ;;
        # wp 数据库密码
        -dbpass)
            DBPASS=$2
            shift
            ;;
        # wpuser
        -wpuser)
            WPUSER=$2
            shift
            ;;
        # wppass
        -wppass)
            WPPASS=$2
            shift
            ;;
        # wp SQL解压密码
        -sqldepass)
            SQLDEPASS=$2
            shift
            ;;
    esac  
    shift  
done

# 参数判空
if [ "${ORGANIZATIONID}" = "" ]; then
    echo '-uid is necessary'
    exit 1
fi
if [ "${DOMAIN}" = "" ]; then
    echo '-domain is necessary'
    exit 1
fi
if [ "${TEMPDOMAIN}" = "" ]; then
    echo '-tempdomain is necessary'
    exit 1
fi
if [ "${DBNAME}" = "" ]; then
    echo '-dbname is necessary'
    exit 1
fi
if [ "${DBUSER}" = "" ]; then
    echo '-dbuser is necessary'
    exit 1
fi
if [ "${DBPASS}" = "" ]; then
    echo '-dbpass is necessary'
    exit 1
fi
if [ "${WPUSER}" = "" ]; then
    echo '-wpuser is necessary'
    exit 1
fi
if [ "${WPPASS}" = "" ]; then
    echo '-wppass is necessary'
    exit 1
fi
if [ "${SQLDEPASS}" = "" ]; then
    echo '-sqldepass is necessary'
    exit 1
fi

# 初始化 wordpress 信息
Init_Wp(){
    yum install -y wget
    # 下载wp目录文件
    wget -O wp.zip https://raw.githubusercontent.com/aiyongbao/tonpal_wp/master/wp/wp.zip
    unzip -o wp.zip
    # 替换文本中的 php 内容（将数据库信息进行替换）
    sed -i 's/$TEMPDOMAIN/'${TEMPDOMAIN}'/g' /www/wwwroot/${DOMAIN}/wp-config.php
    sed -i 's/$DOMAIN/'${DOMAIN}'/g' /www/wwwroot/${DOMAIN}/wp-config.php
    sed -i 's/$DBNAME/'${DBNAME}'/g' /www/wwwroot/${DOMAIN}/wp-config.php
    sed -i 's/$DBUSER/'${DBUSER}'/g' /www/wwwroot/${DOMAIN}/wp-config.php
    sed -i 's/$DBPASS/'${DBPASS}'/g' /www/wwwroot/${DOMAIN}/wp-config.php
}

# 插入数据库一些内容
Insert_Db(){
    # 获取SQL文件
    wget -O init-wp.sql.des3 https://raw.githubusercontent.com/aiyongbao/tonpal_wp/master/sql/init-wp.sql.des3
    # 进行解密
    dd if=init-wp.sql.des3 |openssl des3 -d -k ${SQLDEPASS} | tar zxf -
    sed -i 's/$WPPASS/'${WPPASS}'/g' /www/wwwroot/${DOMAIN}/custom-install.php
    WPPASS=$(php custom-install.php)
    # 生成密码
    # 替换sql语句中域名, 替换成客户的域名
    sed -i 's/$DOMAIN/'${DOMAIN}'/g' /www/wwwroot/${DOMAIN}/init-wp.sql
    sed -i 's/$ORGANIZATION_ID/'${ORGANIZATIONID}'/g' /www/wwwroot/${DOMAIN}/init-wp.sql
    sed -i 's/$WPUSER/'${WPUSER}'/g' /www/wwwroot/${DOMAIN}/init-wp.sql
    sed -i 's/$WPPASS/'${WPPASS}'/g' /www/wwwroot/${DOMAIN}/init-wp.sql
    # 进入数据库，运行sql语句
    mysql -u${DBUSER} -p${DBPASS} ${DBNAME} < init-wp.sql
}

# 安装主方法
Install_Main(){
    cd /www/wwwroot/${DOMAIN}
    Init_Wp
	Insert_Db
}

echo "
+----------------------------------------------------------------------
| AiyongTech 2020 VPS for CentOS/Ubuntu/Debian
+----------------------------------------------------------------------
"

# 进入域名文件夹
# 进行安装
Install_Main

endTime=`date +%s`
((outTime=($endTime-$startTime)/60))
echo -e "Time consumed:\033[32m $outTime \033[0mMinute!"
echo -e "=================================================================="
echo -e "\033[32mCongratulations! Installed successfully!\033[0m"
echo -e "=================================================================="
echo -e "\033[33mWarning:\033[0m"
echo -e "\033[33mIf you cannot access the panel, \033[0m"
echo -e "\033[33mrelease the following port (8888|888|80|443|20|21) in the security group\033[0m"
echo -e "=================================================================="