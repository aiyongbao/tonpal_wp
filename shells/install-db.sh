#!/bin/bash
# vps wordpress 数据库 安装脚本
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
        # wp 数据库地址
        -dbhost)
            DBHOST=$2 
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
if [ "${DBHOST}" = "" ]; then
    echo '-dbhost is necessary'
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

# 插入数据库一些内容
Install_Db(){
    # 获取SQL文件
    wget -O install-db.sql.des3 https://raw.githubusercontent.com/aiyongbao/tonpal_wp/master/sql/install-db.sql.des3
    # 进行解密
    dd if=install-db.sql.des3 |openssl des3 -d -k ${SQLDEPASS} | tar zxf -
    # 替换sql语句中域名, 替换成客户的域名
    sed -i 's#$DOMAIN#'${DOMAIN}'#g' /www/wwwroot/${DOMAIN}/install-db.sql
    sed -i 's#$ORGANIZATION_ID#'${ORGANIZATIONID}'#g' /www/wwwroot/${DOMAIN}/install-db.sql
    sed -i 's#$WPUSER#'${WPUSER}'#g' /www/wwwroot/${DOMAIN}/install-db.sql
    # 生成密码
    ENWPPASS=""
    while [ "${ENWPPASS}" == "" ]
    do 
        ENWPPASS=$(php custom-install.php ${WPPASS})
        sleep 1
    done
    sed -i 's#$WPPASS#'${ENWPPASS}'#g' /www/wwwroot/${DOMAIN}/install-db.sql
    # 进入数据库，运行sql语句
    mysql -h${DBHOST} -u${DBUSER} -p${DBPASS} ${DBNAME} < install-db.sql
}

# 安装主方法
Install_Main(){
    cd /www/wwwroot/${DOMAIN}
	Install_Db
}

echo "
+----------------------------------------------------------------------
| AiyongTech 2020 VPS for CentOS/Ubuntu/Debian
+----------------------------------------------------------------------
"

# 进入域名文件夹
# 进行安装
startTime=`date +%s`
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