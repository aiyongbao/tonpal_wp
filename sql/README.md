### sql加密
tar -zcf - init-wp.sql |openssl des3 -salt -k 加密密钥 | dd of=init-wp.sql.des3
### sql解密
dd if=init-wp.sql.des3 |openssl des3 -d -k 加密密钥 | tar zxf -