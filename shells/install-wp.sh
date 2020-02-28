#!/bin/bash
# vps wordpress 安装脚本
# 接受参数
while [ -n "$1" ]  
do  
    case "$1" in
        # 生成的域名名称
        -domain)
            DOMAIN=$2
            shift
            ;;
    esac  
    shift  
done

# 参数判空
if [ "${DOMAIN}" = "" ]; then
    echo '-domain is necessary'
    exit 1
fi

# 初始化 wordpress 信息
Init_Wp(){
    # 替换文本中的 php 内容（将域名信息进行替换）
    sed -i 's/$key/'${DOMAIN}'/g'  /www/wwwroot/${DOMAIN}/wp-config.php
    php /www/wwwroot/${DOMAIN}/custom-install.php
}

# 插入数据库一些内容
Insert_Db(){

}

# 安装主方法
Install_Main(){
    Init_Wp
	Insert_Db
}


echo "
+----------------------------------------------------------------------
| AiyongTech 2020 VPS for CentOS/Ubuntu/Debian
+----------------------------------------------------------------------
"

# 进入域名文件夹
cd /www/wwwroot/${DOMAIN} &&
yum install -y wget &&
# 下载文件压缩包
wget -O wp.zip https://www.github.com/wp.zip &&
# 压缩包解压
unzip wp.zip &&

# 进行安装
Install_Main

endTime=`date +%s`
((outTime=($endTime-$startTime)/60))
echo -e "Time consumed:\033[32m $outTime \033[0mMinute!"
rm -f new_install.sh

echo -e "=================================================================="
echo -e "\033[32mCongratulations! Installed successfully!\033[0m"
echo -e "=================================================================="
echo  "Bt-Panel: http://${getIpAddress}:${panelPort}$auth_path"
echo -e "username: $username"
echo -e "password: $password"
echo -e "token: $TOKEN"
echo -e "token_crypt: $TOKEN_ENCRYPT"
echo -e "organization_id: $ORGANIZATIONID"
echo -e "sign: $sign"
echo -e "\033[33mWarning:\033[0m"
echo -e "\033[33mIf you cannot access the panel, \033[0m"
echo -e "\033[33mrelease the following port (8888|888|80|443|20|21) in the security group\033[0m"
echo -e "=================================================================="